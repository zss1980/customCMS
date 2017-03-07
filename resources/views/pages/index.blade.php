@extends('layouts.master')

@section('title')
Test
@stop

@section('header')
<header style="background: #{{$data->bgColour}};">

@section('customScripts')
<script src="../js/scriptIndex.js"></script>

@stop     
    

<div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <img class="img-responsive" src="{{$data->image}}" alt="">
                    <div class="intro-text">
                        <span class="name">{{$data->companyName}}</span>
                        <hr class="star-light">
                        <span class="skills">{{$data->companyFeatures}}</span>
                    </div>
                </div>
            </div>
        </div>
</header>

@stop

@section('projects')
@inject('prjValues', 'App\HTTP\controllers\CustomerController')
<section id="portfolio">
        <div class="container">
            
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>{{$prjValues->getPropertyValue('sectionPortfolioName')}}</h2>
                    <hr class="star-primary">
                </div>
            </div>
            
            <div class="row">
            <?php $count=0;?>
            @foreach($projects as $project)
                <div class="col-sm-4 portfolio-item">
                    <a href="#portfolioModal{{$count}}" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="{{$project->image}}" width="360" height="225" class="img-responsive" alt="">
                    </a>
                </div>
                <?php $count++;?>
            @endforeach

                
            </div>
        </div>
        <?php echo $projects->render();?>
    </section>
@stop

@section('modals')
<?php $count=0;?>
@foreach($projects as $project)
<div class="portfolio-modal modal fade" id="portfolioModal{{$count}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>{{$project->title}}</h2>
                            <hr class="star-primary">
                            <img src="{{$project->image}}" class="img-responsive img-centered" alt="">
                            <p>{{$project->description}}</p>
                            <ul class="list-inline item-details">
                                <li>Date:
                                    <strong>{{$project->date}}
                                    </strong>
                                </li>
                                <li>SKU#:
                                    <strong>{{$project->id}}
                                    </strong>
                                </li>
                                <li>Approximate cost:
                                    <strong> {{$project->cost}}
                                    </strong>
                                </li>
                                <li>Category: <strong>{{$project->category}}
                                   </strong>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $count++;?>
    @endforeach
@stop

@section('about')
<section class="success" id="about" style="background: #{{$dataAbout->bgColour}};">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>{{$prjValues->getPropertyValue('sectionAboutName')}}</h2>
                    <hr class="star-light">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-lg-offset-2">
                    <p>{{$dataAbout->aboutInfoLeft}}</p>
                </div>
                <div class="col-lg-4">
                    <p>{{$dataAbout->aboutInfoRight}}</p>
                </div>
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <a href="{{$dataAbout->downloadLink}}" class="btn btn-lg btn-outline">
                        <i class="fa fa-download"></i> {{$dataAbout->downloadCaption}}
                    </a>
                </div>
            </div>
        </div>
    </section>
@stop

@section('footer')



<footer class="text-center" >
        <div class="footer-above" style="background: #{{$dataFooter->bgColour}};">
            <div class="container">
                <div class="row">
                    <div class="footer-col col-md-4">
                        <h3>{{$dataFooter->footerLeftCaption}}</h3>
                        <p>{!!$dataFooter->footerLeftText!!}</p>
                        <button id="btnmap" class="btn btn-link" data-toggle="collapse" data-target="#map"><img src="../img/map.png" class="responsive"></button>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3>{{$dataFooter->footerCentreCaption}}</h3>
                        <p>{!!$dataFooter->footerCentreText!!}</p>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3>{{$dataFooter->footerRightCaption}}</h3>
                        <p>{!!$dataFooter->footerRightText!!}</p>
                    </div>
                </div>
            </div>
        </div>
        <div id="map" class="collapse map">
                <div class="container">
                <div class="row">
                    <div class="col-lg-6">
        <span><img class="img-responsive" src="https://maps.googleapis.com/maps/api/staticmap?center={{$map->latitude}},{{$map->longtitude}}&zoom=$map->zoom&size=600x300&markers=color:blue%7Clabel:S%7C{{$map->latitude}},{{$map->longtitude}}&markers=size:tiny%7Ccolor:green&key=AIzaSyBBwYO0mX3k4m9Y3vXAAgrYkZ0OPR3HJm8"></span></div><div class="col-lg-6"><span>
        <img class="img-responsive" src="https://maps.googleapis.com/maps/api/streetview?size=600x300&location={{$map->latitude}},{{$map->longtitude}}&heading={{$map->heading}}&pitch={{$map->pitch}}&key=AIzaSyBBwYO0mX3k4m9Y3vXAAgrYkZ0OPR3HJm8"></span></div></div></div>
        
        </div>

        <div class="footer-below" style="background: #{{$dataFooter->bgcolorBottom}};">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        Copyright &copy; {!!$dataFooter->copyrightText!!}</div><div class="col-lg-3"><a href="https://webartisans.work/home">Developed by WebArtisans.work</a></div><div class="col-lg-1"><a href="/admin/projects">admin</a></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

@stop
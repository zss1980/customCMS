@extends('layouts.master')

@section('title')
Test
@stop

@section('header')
<header style="background: #{{$data->bgColour}};">
        
    

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

@section('about')
<section class="success" id="about" style="background: #{{$dataAbout->bgColour}};">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>About</h2>
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
        <div class="footer-below" style="background: #{{$dataFooter->bgcolorBottom}};">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        Copyright &copy; {{$dataFooter->copyrightText}}
                    </div>
                </div>
            </div>
        </div>
    </footer>

@stop
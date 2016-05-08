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
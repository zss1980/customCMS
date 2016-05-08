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
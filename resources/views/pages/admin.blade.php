@extends('layouts.admin')

@section('header')
<style>
header {
    text-align: center;
    color: #fff;
    background: #@{{bgcolor}};
}

header .container {
    padding-top: 100px;
    padding-bottom: 50px;
}

header img {
    display: block;
    margin: 0 auto 20px;
}

header .intro-text .name {
    display: block;
    text-transform: uppercase;
    font-family: Montserrat,"Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 2em;
    font-weight: 700;
}

header .intro-text .skills {
    font-size: 1.25em;
    font-weight: 300;
}
</style>

<header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <img class="img-responsive" v-bind:src="imgCurrent" alt="">
                    <div class="intro-text">
                        <span class="name">@{{companyName}}</span>
                        <hr class="star-light">
                        <span class="skills">@{{companyFeatures}}</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
@stop

@section('edit')
<input class="form-control" v-model="companyName"><br>
<input class="form-control" v-model="companyFeatures">
<br>
<input class="jscolor" v-model="bgcolor">
<input type="file" id="newImg">
<button type="button" class="btn btn-primary">Preview</button> 
@stop
@extends('layouts.admin')

@section('customScripts')
<script src="../../js/script.js"></script>
<script src="../../js/jscolor.js"></script>
@stop

@section('sectionName')
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
input[type=file].form-control {
    height: auto;
}
</style>

<header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <img class="img-responsive" id="imgConstr" v-bind:src="imgCurrent" alt="">
                    <div class="intro-text">
                        <span class="name">@{{companyName}}</span>
                        <hr class="star-light">
                        <span class="skills">@{{companyFeatures}}</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <button id="btnApply" type="button" class="btn btn-success" @click="applyChanges()">Apply changes</button><button id="btnDis" type="button" class="btn btn-danger" @click="discardChanges()">Discard changes</button><br>
@stop

@section('edit')
<LABEL>Company name: </LABEL><input class="form-control" v-model="companyName"><br>
<label>Company features: </label><input class="form-control" v-model="companyFeatures">
<label>Background colour: </label><input class="form-control jscolor" v-model="bgcolor">
{!!Form::open([
                        'id'=>'upload',
                        'method'=>'POST',
                        'files' => true,
                        'class' => 'ajax',
                        'route'=>['admin.uploadImg']
                        ])!!}
<label>Image: </label><input type="file" class="form-control" id="newImg" name='imag'>
{!!Form::submit('Preview', ['class'=>'btn btn-primary'])!!}
{!!Form::close()!!}
@stop

@section('scripts')
<script>
$(function() {
	$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
        $('form.ajax').on('submit', function(event){
            event.preventDefault();
            var filedata = new FormData();
            var f1 = $(this).find('input[type=file]')[0].files[0];
            filedata.append('imag', f1);
            filedata.append('height', '300');
            filedata.append('width', '300');

            

            if (f1) {
            var imagTarget = "imgConstr";
            };

            $.ajax({
                type     : "POST",
                url      : $(this).attr('action'),
                data     : filedata,
                cache    : false,
                contentType: false,
                processData: false,
                success  : function(data) {
                
                  if (imagTarget)
                  {
                    document.getElementById(imagTarget).src = "../../img/"+data[1];
                  }

                    //document.getElementById("ajax-response").innerHTML = data[0];

                    
                }
            })

            return false;

        });
});
</script>
@stop
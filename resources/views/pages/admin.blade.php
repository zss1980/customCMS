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
@stop

@section('edit')
<input class="form-control" v-model="companyName"><br>
<input class="form-control" v-model="companyFeatures">
<pre> @{{$data | json}}</pre>
<br>
<input class="jscolor" v-model="bgcolor">
{!!Form::open([
                        'id'=>'upload',
                        'method'=>'POST',
                        'files' => true,
                        'class' => 'ajax',
                        'route'=>['admin.uploadImg']
                        ])!!}
<input type="file" id="newImg" name='imag'>
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
            filedata.append('caption', $(this).find('input[name="caption"]').val());
            filedata.append('info', $(this).find('textarea[name="info"]').val());
            filedata.append('id', $(this).find('input[name="id"]').val());

            

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
                    document.getElementById(imagTarget).src = "img/"+data[1];
                  }

                    //document.getElementById("ajax-response").innerHTML = data[0];

                    
                }
            })

            return false;

        });
});
</script>
@stop
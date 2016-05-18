@extends('layouts.admin')

@section('customScripts')
<script src="../../js/scriptSettingUp.js"></script>
<script src="../../js/jscolor.js"></script>
@stop

@section('sectionName')
<style>

</style>

<div class="container">
                <div class="row">
                  
        <div class="container" style="background-color: #2c3e50;">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#page-top"><span><img id="imgLogo" v-bind:src="imgLogo" alt=""></span>@{{projectName}}</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#"></a>
                    </li>
                    <li class="page-scroll">
                        <a href="#">@{{sectionPortfolioName}}</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#">@{{sectionAboutName}}</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#">@{{sectionContactName}}</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    
                </div>
            </div>

            <button id="btnApply" type="button" class="btn btn-success" @click="applyChanges()">Apply changes</button><button id="btnDis" type="button" class="btn btn-danger" @click="discardChanges()">Discard changes</button><br>
            <div class="row"><div class="col-sm-4">
            <div v-show="showServerResponse" class="alert alert-success"> Saved.</div></div></div>
@stop

@section('edit')
<div class="row"><div class="col-sm-8">
            <div v-show="!serverStatus">
<label>Project name: </label><input v-bind:disabled="!newProject" class="form-control" v-model="projectName">
<label>Portfolio Section Name: </label><input class="form-control" v-model="sectionPortfolioName">
<label>About Section Name: </label><input class="form-control" v-model="sectionAboutName">
<label>Contact Section Name: </label><input class="form-control" v-model="sectionContactName">

{!!Form::open([
                        'id'=>'upload',
                        'method'=>'POST',
                        'files' => true,
                        'class' => 'ajax',
                        'route'=>['admin.uploadImg']
                        ])!!}
<label>Logo image: </label><input type="file" class="form-control" id="newImg" name='imag'>
{!!Form::submit('Preview', ['class'=>'btn btn-primary'])!!}
{!!Form::close()!!}
</div></div></div>

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
            

            

            if (f1) {
            var imagTarget = "imgLogo";
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
	
        $( "#datepicker" ).datepicker({
  dateFormat: "yy-mm-dd"
});
});
</script>
@stop
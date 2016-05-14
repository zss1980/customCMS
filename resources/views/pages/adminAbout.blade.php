@extends('layouts.admin')

@section('customScripts')
<script src="../../js/scriptAbout.js"></script>
<script src="../../js/jscolor.js"></script>
@stop

@section('sectionName')
<style>
   section {
    padding: 100px 0;
}

section h2 {
    margin: 0;
    font-size: 3em;
}

section.success {
    color: #fff;
    background: #@{{bgcolor}};
}

section.success a,
section.success a:hover,
section.success a:focus,
section.success a:active,
section.success a.active {
    outline: 0;
    color: #2c3e50;
}

.btn-outline {
    margin-top: 15px;
    border: solid 2px #fff;
    font-size: 20px;
    color: #fff;
    background: 0 0;
    transition: all .3s ease-in-out;
}
.btn-outline:hover,
.btn-outline:focus,
.btn-outline:active,
.btn-outline.active {
    border: solid 2px #fff;
    color: #18bc9c;
    background: #fff;
} 
</style>
<section class="success" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>About</h2>
                    <hr class="star-light">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-lg-offset-2">
                    <p>@{{aboutInfoLeft}}</p>
                </div>
                <div class="col-lg-4">
                    <p>@{{aboutInfoRight}}</p>
                </div>
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <a id="objectLink" v-bind:href="downloadLink" class="btn btn-lg btn-outline">
                        <i class="fa fa-download"></i> @{{downloadCaption}}
                    </a>
                </div>
            </div>
        </div>
    </section>
    <button id="btnApply" type="button" class="btn btn-success" @click="applyChanges()">Apply changes</button><button id="btnDis" type="button" class="btn btn-danger" @click="discardChanges()">Discard changes</button><br>
@stop

@section('edit')
<LABEL>About left: </LABEL><input class="form-control" v-model="aboutInfoLeft">
<label>About right: </label><input class="form-control" v-model="aboutInfoRight">
<label>Background colour: </label><input class="form-control jscolor" v-model="bgcolor">
<label>Download caption: </label><input class="form-control" v-model="downloadCaption">
 <label>Download object: </label>{!!Form::open([
                        'id'=>'upload',
                        'method'=>'POST',
                        'files' => true,
                        'class' => 'ajax',
                        'route'=>['admin.uploadObj']
                        ])!!}
<input type="file" class="form-control" id="newObject" name='object'>
{!!Form::submit('Upload', ['class'=>'btn btn-primary'])!!}
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
            filedata.append('object', f1);
            filedata.append('caption', $(this).find('input[name="caption"]').val());
            filedata.append('info', $(this).find('textarea[name="info"]').val());
            filedata.append('id', $(this).find('input[name="id"]').val());

            

            if (f1) {
            var objTarget = "objectLink";
            };

            $.ajax({
                type     : "POST",
                url      : $(this).attr('action'),
                data     : filedata,
                cache    : false,
                contentType: false,
                processData: false,
                success  : function(data) {
                
                  if (objTarget)
                  {
                    document.getElementById(objTarget).href = "../../img/"+data[1];
                  }

                    alert('File Uploaded!');

                    
                }
            })

            return false;

        });
});
</script>
@stop
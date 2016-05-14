@extends('layouts.admin')

@section('customScripts')
<script src="../../js/scriptProjectAdd.js"></script>
<script src="../../js/jscolor.js"></script>
@stop

@section('sectionName')
<style>

</style>

<div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>@{{projectTitle}}</h2>
                            <hr class="star-primary">
                            <img id = "imgProj" v-bind:src="imgCurrent" class="img-responsive img-centered" alt="">
                            <p>@{{projectDescription}}</p>
                            <ul class="list-inline item-details">
                                <li>@{{dateCaption}}:
                                    <strong>@{{projectDate}}
                                    </strong>
                                </li>
                                <li>@{{idCaption}}:
                                    <strong>@{{projectID}}
                                    </strong>
                                </li>
                                <li>@{{costCaption}}
                                    <strong> @{{projectCost}}
                                    </strong>
                                </li>
                                <li>@{{categoryCaption}}: <strong>@{{categoryList}}
                                   </strong>
                                </li>
                            </ul>
                            
                        </div>
                    </div>
                </div>
            </div>
            <button id="btnApply" type="button" class="btn btn-success" @click="applyChanges()">Apply changes</button><button id="btnDis" type="button" class="btn btn-danger" @click="discardChanges()">Discard changes</button><br>
            <div class="row"><div class="col-sm-4">
            <div v-show="serverStatus" class="alert alert-success">
  <strong>Success!</strong> Project (changes) has (have) been saved.</div></div></div>
@stop

@section('edit')
<div class="row"><div class="col-sm-8">
            <div v-show="!serverStatus">
<label>Project title: </label><input v-bind:disabled="!newProject" class="form-control" v-model="projectTitle">
<label>Project description: </label><input class="form-control" v-model="projectDescription">
<label>Project cost: </label><input class="form-control" v-model="projectCost">
<LABEL>Date: </LABEL><input type="text" id="datepicker" class="form-control" v-model="projectDate">
<LABEL>Category list: </LABEL>
 <select v-model="categoryList" class="form-control" placeholder="pick a category">
                                        <option v-for="option in options" v-bind:value="option.value">
                                            @{{ option.text }}
                                        </option>
                                    </select>
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
            var imagTarget = "imgProj";
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
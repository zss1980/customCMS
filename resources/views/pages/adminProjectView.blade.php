@extends('layouts.admin')

@section('customScripts')
<script src="../../js/scriptProjectView.js"></script>
<script src="../../js/jscolor.js"></script>
@stop

@section('sectionName')
<style>

</style>

<div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Project Title</h2>
                            <hr class="star-primary">
                            <img src="../img/portfolio/cabin.png" class="img-responsive img-centered" alt="">
                            <p>@{{projectDescription}}</p>
                            <ul class="list-inline item-details">
                                <li>@{{dateCaption}}:
                                    <strong><input type="text" id="datepicker" class="form-control">
                                    </strong>
                                </li>
                                <li>@{{idCaption}}:
                                    <strong>1
                                    </strong>
                                </li>
                                <li>@{{costCaption}}
                                    <strong> 100.00
                                    </strong>
                                </li>
                                <li>@{{categoryCaption}}:<strong>
                                    <select v-model="categoryList" class="form-control" placeholder="pick a category">
                                        <option v-for="option in options" v-bind:value="option.value">
                                            @{{ option.text }}
                                        </option>
                                    </select></strong>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
@stop

@section('edit')
<label>Date caption: </label><input class="form-control" v-model="dateCaption">
<label>ID caption: </label><input class="form-control" v-model="idCaption">
<label>Cost caption: </label><input class="form-control" v-model="costCaption">
<LABEL>Category caption: </LABEL><input class="form-control" v-model="categoryCaption"><br>
<LABEL>Category list: </LABEL>
<input v-model="newOption" v-on:keyup.enter="addOption" class="form-control">
  <ul>
    <li v-for="option in options">
      <span>@{{ option.text }}</span>
      <button v-on:click="removeOption($index)">X</button>
    </li>
  </ul>

@stop

@section('scripts')
<script>
$(function() {
	
        $( "#datepicker" ).datepicker();
});
</script>
@stop
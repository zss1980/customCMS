@extends('layouts.admin')

@section('customScripts')
<script src="../../js/scriptMap.js"></script>
<script src="../../js/jscolor.js"></script>
@stop

@section('sectionName')


<h3><strong>Your office at: </strong>@{{setLocation}}</h3>
      
      
    
    <div class= "responsive" style="width:820px; height:300px;">
    	<div id="map" style="width: 400px; height: 300px; float: left;"></div>
    	<div id="pano" style="width: 400px; height: 300px; float: left;"></div>
    </div>

    <br><button id="btnApply" type="button" class="btn btn-success" @click="applyChanges(map, panorama)">Apply changes</button>
    <button id="btnDis" type="button" class="btn btn-danger" @click="discardChanges()">Discard changes</button>
    <br>
    <div class="row">
    	<div class="col-sm-4">
            <div v-show="showServerResponse" class="alert alert-success"> Saved.</div>
        </div>
    </div>
    @stop

@section('edit')

<LABEL>Set your location on the map: </LABEL><input id= "address" class="form-control" v-model="setLocation">

<input type="button" class="btn btn-info" id="submit" type="button" value="Set location" @click="geocodeAddress(map, panorama)">


    
@stop

@section('scripts')
<script>




    </script>
    
@stop
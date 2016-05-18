@extends('layouts.admin')

@section('customScripts')
<script src="../../js/scriptContacts.js"></script>
<script src="../../js/jscolor.js"></script>
@stop

@section('sectionName')
<style>

</style>

<div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <p>
                        @{{siteEmail}}
                        </p>
                        <hr>
                        <p>@{{siteEmailMessage}}</p>

                        
                    </div>
                </div>
            </div>
            <button id="btnApply" type="button" class="btn btn-success" @click="applyChanges()">Apply changes</button><button id="btnDis" type="button" class="btn btn-danger" @click="discardChanges()">Discard changes</button><br>
            <div class="row"><div class="col-sm-4">
            <div v-show="serverStatus" class="alert alert-success">
  <strong>Success!</strong> Changes have been saved.</div></div></div>
@stop

@section('edit')
<div class="row"><div class="col-sm-8">
            
<label>e-mail for messages from your site: </label><input class="form-control" v-model="siteEmail">
<label>Message in the email: </label><input class="form-control" v-model="siteEmailMessage">

</div></div>

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
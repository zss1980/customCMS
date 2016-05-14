@extends('layouts.admin')

@section('customScripts')
<script src="../../js/scriptProjects.js"></script>
<script src="../../js/jscolor.js"></script>
@stop

@section('sectionName')
<h2>All projects</h2>
@stop

@section('edit')
<button type="button" class="btn btn-success" @click="addNewProject()" data-toggle="modal" data-target="#myModal" disabled>Add new</button>
  <div class="table-responsive"></div>
  <table class="table">
     <thead>
                <tr>
                  <th>#</th>
                  <th>@{{idCaption}}</th>
                  <th>Project title</th>
                  <th>@{{categoryCaption}}</th>
                  <th>@{{dateCaption}}</th>
                  <th>@{{costCaption}}</th>
                  <th>Description</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                
                <tr v-for="(index, project) in projects">
                  
                  <th>@{{index+1}}</th>
                  <td>@{{project.id}}</td>
                  <td>@{{project.title}}</td>
                  <td>@{{project.category}}</td>
                  <td>@{{project.date}}</td>
                  <td>@{{project.cost}}</td>
                  <td>@{{project.description}}</td>
                  <td><img class="img-responsive img-centered" width="100" height="100" v-bind:src="project.image"></td>
                  <td>
                     <button class="btn btn-success" @click="editRecord(index)" data-toggle="modal" data-target="#myModal">Edit</button><button id="deleteRec" class="btn btn-danger" @click="deleteRecord(index)">Delete</button>
                    </td>
                </tr>
                
                
              </tbody>
  </table>
</div>

   
   <editor :show.sync="showEditor"
            :project-title.sync = "projectTitle"
            :project-description.sync = "projectDescription"
            :project-cost.sync = "projectCost"
            :project-date.sync = "projectDate"
            :project-category.sync = "projectCategory"
            :options.sync = "options"
            :category-caption.sync ="categoryCaption"
            :id-caption.sync ="idCaption"
            :date-caption.sync ="dateCaption"
            :cost-caption.sync ="costCaption"
            :project-image.sync="imgCurrent"
            :project-id.sync = "projectID"
            :show-server-response.sync = "showServerResponse"
            ></editor> 





@stop

@section('modals')
<script type="x/template" id="editor-template">
<div v-show="show" id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
         <!-- Modal content-->
        <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" >&times;</button>
                    <h4 class="modal-title">Edit project</h4>
                </div>
                <div class="modal-body">
                    <h2>@{{projectTitle}}</h2>
                    <hr class="star-primary">
                    <img id = "imgProj" v-bind:src="projectImage" class="img-responsive img-centered" alt="">
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
                        <li>@{{categoryCaption}}: <strong>@{{projectCategory}}
                                   </strong>
                        </li>
                    </ul>
                            
                </div>
                    
            
            <div v-show="showServerResponse" class="alert alert-success"> Saved.</div>
            <button id="btnApply" type="button" class="btn btn-success" @click="applyChanges()">Apply changes</button><button id="btnDis" type="button" class="btn btn-danger" @click="discardChanges()">Discard changes</button><br>
<label>Project title: </label><input class="form-control" v-model="projectTitle">
<label>Project description: </label><input class="form-control" v-model="projectDescription">
<label>Project cost: </label><input class="form-control" v-model="projectCost">
<LABEL>Date: </LABEL><input type="text" id="datepicker" class="form-control" v-model="projectDate">
<LABEL>Category list: </LABEL>
 <select v-model="projectCategory" class="form-control" placeholder="pick a category">
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

<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      
</div>
</script>

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
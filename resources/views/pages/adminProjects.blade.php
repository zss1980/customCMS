@extends('layouts.admin')

@section('customScripts')
<script src="../../js/scriptProjects.js"></script>
<script src="../../js/jscolor.js"></script>
@stop

@section('sectionName')

@stop

@section('edit')
<div class="table-responsive">
  <table id="table_id" class="display">
     <thead>
                <tr>
                  <th>#</th>
                  <th>Id</th>
                  <th>Project title</th>
                  <th>Category</th>
                  <th>Date</th>
                  <th>Cost</th>
                  <th>Description</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php $count=0;
                  ?>
                  @foreach($projects as $project)
                <tr id="tr{{$count}}">
                  
                  <th>{{++$count}}</th>
                  <td>{{$project->id}}</td>
                  <td>{{$project->title}}</td>
                  <td>{{$project->category}}</td>
                  <td>{{$project->date}}</td>
                  <td>{{$project->cost}}</td>
                  <td>{{$project->description}}</td>
                  <td><img class="img-responsive img-centered" width="100" height="100" src="{{$project->image}}"></td>
                  <td>
                     <button class="btn btn-success">Edit</button><button id="deleteRec" tr="{{$count}}" class="btn btn-danger" onclick="delRec({{$count}}, {{$project->id}})">Delete</button>
                    </td>
                </tr>
                
                @endforeach
              </tbody>
  </table>
</div>
<div id="output1"></div>
@stop

@section('scripts')

<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.10/js/jquery.dataTables.js"></script>
  <script>
  function delRec(a, b) {
    $( "#tr"+(a-1) ).remove();

    $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
        
            var filedata = new FormData();
            filedata.append('id', b);
            
            $.ajax({
                type     : "POST",
                url      : '/admin/destroyProject',
                data     : filedata,
                cache    : false,
                contentType: false,
                processData: false,
                success  : function(data) {
                
                  document.getElementById('output1').innerHTML= "<div class=\'alert alert-success\'><strong>Success!</strong> Project  has been deleted.</div></div></div>";

                    

                    
                }
            });

            return false;

        };


  $(function() {
    $('#table_id').DataTable();
    

});
  </script>
@stop
@extends('admin.layouts.app')

@section('view_task_active')
active
@endsection



@section('modals')
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Create task</h4>
            </div>
            <div class="modal-body">
              
                
                    <form id="register_form" name="register_form" novalidate action="#"  method="POST">
                        @csrf
                            
    
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Subject</label>
                                        <input type="text" class="form-control" name="subject" placeholder="e.g Layout update" value="" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Priority</label>
                                        <select class="form-control" name="priority">
                                            <option value="not_urgent">Not Urgent</option>
                                            <option value="required">Required</option>
                                            <option value="urgent">Urgent</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
    
                            
    
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea rows="5" class="form-control" placeholder="Here can be your description" name="description" ></textarea>
                                    </div>
                                </div>
                            </div>
    
                            {{-- <button type="submit" class="btn btn-info btn-fill pull-right">Update Profile</button> --}}
                            <div class="clearfix"></div>
                        

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>

              <button type="submit" id="create-task-btn" class="btn btn-primary btn-fill">Create Task</button>

            </form>
            </div>
          </div>
        </div>
      </div>
@endsection



@section('content')




        <div class="col-md-12">
            <div class="card ">
                <div class="header">
                    <h4 class="title">Tasks  <button class="btn btn-info btn-flat btn-fill pull-right" data-toggle="modal" data-target="#myModal">Create Task</button></h4>
                    <p class="category">Backend development</p>
                    
                </div>
                <div class="content">
                    <div class="table-full-width">
                        <table class="table" id="tb">
                                {{-- <thead>
                                        <tr><th>#</th>
                                    	<th>Subject</th>
                                    	<th>Status</th>
                                    	<th>Priority</th>
                                    	<th>Action</th>
                                    </tr>
                                </thead> --}}
                                <tbody>

                                @foreach ($tasks as $task)

                                {{-- <tr>
                                        <td>{{$loop->index}}</td>
                                        <td>{{$task->subject}}</td>
                                        <td>{{$task->status}}</td>
                                        <td>{{$task->priority}}</td>
                                        <td class="td-actions text-left">
                                                <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </td>
                                </tr> --}}
                                <tr>
                                        <td style="width: 20px">
                                            <div class="checkbox">
                                                    <input id="checkbox2" type="checkbox" checked>
                                                    <label for="checkbox2"></label>
                                                </div>
                                        </td>
                                        <td class="text-left">{{$task->subject}}</td>
                                        <td class="td-actions text-right">
                                            <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>

                                @endforeach
                                
                                
                            </tbody>
                        </table>
                    </div>

                    <div class="footer">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-history"></i> Updated 3 minutes ago
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
@endsection




@section('script')

<script>
$(function() {

    var id = 0 ;
    
    $('#register_form').on('submit', function (e) {
    e.preventDefault();


    $.ajax({
        url: '/tasks',
        type: 'POST',
        data: new FormData(this),
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
          
          // $btn.button("reset");
          // var obj = jQuery.parseJSON(data);
          // //alert( obj.status === "success" );
          // console.log(data);

          if (data.message == 'success') {
              
              $('#myModal').modal('hide');

              $.notify({
            	icon: 'pe-7s-check',
            	message: "Task successfully created"

            },{
                type: 'success',
                timer: 4000
            });

            $('#tb').prepend(taskTemplate(data.subject, id));
            $('#' + id).hide().fadeIn(2500);
            id++;

          }

          
        }
      });



      function taskTemplate(subject, id) {
          return '<tr id="' + id +'"><td style="width: 20px"><div class="checkbox"><input id="checkbox2" type="checkbox" checked><label for="checkbox2"></label></div></td><td class="text-left">'+ subject+'</td><td class="td-actions text-right"><button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs"><i class="fa fa-edit"></i></button><button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs"><i class="fa fa-times"></i></button></td></tr>';
      }











    


    });
    
});



</script>


@endsection
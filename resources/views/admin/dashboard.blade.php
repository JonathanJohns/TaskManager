@extends('admin.layouts.app')

@section('dashboard_active')
active
@endsection

@section('page_name')
Admin Dashboard <small>(View all Tasks)</small>
@endsection

@section('modals')
<!-- Modal -->



      <!-- View Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Task</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-5 col-sm-offset-1 ">
                        <dl class="">
                                <dt>Subject :</dt>
                                <dd id="task_subject">...</dd><br>
                                <dt>Description :</dt>
                                <dd id="task_description">...</dd><br>
                                <dt>Priority :</dt>
                                <dd id="task_priority">...</dd><br>
                                <dt>Status :</dt>
                                <dd id="task_status">...</dd><br>
                                <dt>Date :</dt>
                                <dd id="task_date">...</dd>
                                
                        </dl>
                    </div>
                    <div class="col-sm-6">
                            <form id="note_form" name="note" enctype="multipart/form-data" novalidate action="#"  method="POST">
                                @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="note" style="z-index: 8000">Add a Note <small >(feature coming soon)</small></label>
                                                <textarea rows="5" class="form-control" placeholder="Here can be your description" name="note" required disabled></textarea>
                                            </div>
                                        </div>
                                    </div>
            
                                    {{-- <button type="submit" class="btn btn-info btn-fill pull-right">Update Profile</button> --}}
                                    <div class="clearfix"></div>
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <button type="button" class="btn btn-xs btn-disable pull-right" data-dismiss="modal" disabled>submit</button>
                                </div>
                                    
                            </div>
                            </form>
                    </div>
                </div>
                
              
                    
                
                        

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              <button type="button" id="task_completed_btn" data-user_id="" class="btn btn-success btn-fill pull-right">Mark as Done</button>

            
            </div>
          </div>
        </div>
      </div>
@endsection

@section('content')

<div class="row">
    <div class="col-xs-6">
        <div class="form-group">
            <label>Select a client</label>
            <select id="selectClient" class="form-control" >

            </select>
        </div>
            
    </div>
    <div class="col-xs-6">
        <div class="form-group">
            <label>Select a project</label>
            <select id="selectProject" class="form-control" >

            </select>
        </div>
            
    </div>
    
</div>



<div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="header">
                    <h4 class="title">Tasks  <!--<button class="btn btn-info btn-flat btn-fill pull-right" id="task_create" data-toggle="modal" data-target="#createModal">Create Task</button>-->
                    
                    {{-- <button class="btn btn-success btn-fill btn-xs pull-right " style="margin-left: 5px">Toggle Completed</button> --}}
                </h4>
                <p class="category">Recent Tasks</p>

                
                    
                </div>
                <div class="content" id="task_body">
                        <p class="text-center" id="no_task_error"><i class="fa fa-warning"></i> No tasks</p>                    

                    <div class="table-full-width table-responsive" id="table_parent">
                         
                        <table class="table table-bordered" id="tb">

                            
                                <thead>
                                        <tr>
                                        
                                        <th>#</th>
                                    	<th>Subject</th>
                                    	<th>Status</th>
                                    	<th>Related To</th>
                                        <th class="text-center">Action</th>
                                        

                                    </tr>
                                </thead>
                                <tbody id="table_body">
                                   
                                {{-- @foreach ($tasks as $task)

                                <!-- <tr>
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
                                </tr> -->
                            <tr id="{{$task->id}}">
                                        <td style="width: 20px">
                                            <!-- <div class="checkbox">
                                                    <input id="checkbox2" type="checkbox" checked>
                                                    <label for="checkbox2"></label>
                                                </div> -->
                                            <i class="fa fa-tasks"></i>
                                        </td>
                                        <td class="text-left">{{$task->subject}}</td>
                                        
                                            @switch ($task->status) 
                                                @case (0)
                                                <td><span class="label label-info">Pending</span></td>
                                                    @break

                                                @case (1)
                                                <td><span class="label label-success">Done</span></td>
                                                    @break

                                                @case (2)
                                                <td><span class="label label-warning">Viewed</span></td>
                                                    @break

                                                

                                            @endswitch
                                        
                                        <td class="text-left">{{ucwords(str_replace('_', ' ',$task->task_related_to))}}</td>
                                        <td class="td-actions text-right" style="width: 12px;">
                                        <button type="button" data-user_id="{{$task->id}}"  rel="tooltip" title="View Task" class="btn view btn-info btn-simple btn-xs">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                            <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>

                                @endforeach --}}
                                
                                
                            </tbody>
                        </table>

                        
                    </div>

                    {{-- <div class="footer">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="stats">
                                <i class="fa fa-history"></i> Updated 3 minutes ago
                                
                               
                            </div>
                            
                                    
                        </div>
                    </div>
                </div> --}}
                
                {{-- <span class="pull-right">{{$tasks->links()}}</span> --}}
                    </div>
                    

                
            </div>
        </div>
    </div>


    
@endsection




@section('script')


<script>


        
        
        $(function() {

            // $('#viewModal').modal('show');


        var priority; 
        var status;
        
        
        $('#task_completed_btn').on('click', function() {
            // $('#viewModal').modal('hide');
            var user_id = $(this).attr('data-user_id');
            changeStatus(user_id);
        });

        function changeStatus(id) {

            $.ajax({
                headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                url: '/tasks/' + id,
                type: 'PUT',
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    taskRefresh(data.id, 'status_update' );
                  
                }
              });

        }

        
        
        
            $(document).on('click', '.view' , function() {
                var data_user = $(this).attr('data-user_id');
                
                taskRefresh(data_user, 'view_modal');
            }); 


            function taskRefresh(data_user, usage, update_state) {
                $.ajax({
                url: '/tasks/' + data_user,
                type: 'GET',
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                  
                  // $btn.button("reset");
                  // var obj = jQuery.parseJSON(data);
                  // //alert( obj.status === "success" );
                  // console.log(data);
        
        
                switch (data.priority) {
                    case 'urgent':
                        priority = "Urgent";
                        break;
                    case 'not_urgent':
                        priority = "Not Urgent";
                        break;
                    case 'required':
                        priority = "Required";
                        break;
                }
        
                switch (data.status) {
                    case '0':
                        status = '<span class="label label-info">Pending</span>';
                        break;
                    case '1':
                        status = '<span class="label label-success">Done</span>';
                        break;
                    case '2':
                        status = '<span class="label label-warning">Viewed</span>';
                        break;
                }
                
                if (usage == 'view_modal') {
                    $('#viewModal').modal('show');
        
        
                  $('#task_description').text(data.description);
                  $('#task_priority').text(priority);
                  $('#task_subject').text(data.subject);
                  $('#task_status').html(status);
                  $('#task_date').text(data.created_at);
                  $('#task_completed_btn').attr('data-user_id', data_user);
                   
                  if (data.status == 1) {
                      $('#task_completed_btn').hide();
                  }

                  if (data.status == 0 || data.status == 2) {
                      $('#task_completed_btn').show();
                  }


                }

                if (usage == 'status_update') {
                    $("#status" + data_user).html('<span class="label label-success">Done</span>');
                    $("#status" + data_user).fadeOut(200);
                    
                    $("#status" + data_user).fadeIn(3000);
                    $('#viewModal').modal('hide');

                }
                  
                  
                  
                     
                    
        
                  }
        
                  
                
              });
        
            
            }
        
        
            
        
               
            
        
            
        
            
            
        });
        
        
        
        </script>
        
        <script>
        
            $(function(){
        
        
                $('#task_create').on('click', function() {
                    
                    projectSelect();
        
                });
        
        
        
                function projectSelect() {
                    $.ajax({
                    url: '/selectproject',
                    type: 'GET',
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                  
                  // $btn.button("reset");
                  // var obj = jQuery.parseJSON(data);
                  // //alert( obj.status === "success" );
                  // console.log(data);
        
        
                        for (i = 0; i < data.length ; i++) {
                                        $('#task_related').prepend(projectTemplate(data[i].project_name,  data[i].project_name_raw));
                
                        
                                        }
                            }
                    });
        
        
        
                    function projectTemplate(project, project_raw) {
                        return '<option value="' + project_raw + '">' + project +'</option>';
                    }
            }
        
        
        
        
        
        
        
        
        
        
                //end of document ready function
            });
        
        </script>
        <script src="{{asset('js/clientselect.js')}}"></script>
        <script>
            
            clientSelect('#selectClient');
        </script>
        <script>
            $(function() {

                var client_id = 'empty';
                var default_project = 'all_059';

                if(client_id == 'empty') {
                    $('#selectProject').html('');
                    emptyTask();
                    
                }


                $('#selectClient').change(function(){
                    var selected = $(this).children('option:selected').val();
                    client_id = selected;
                    
                    if (selected != 'empty') {
                        
                        projectRender(client_id, '#selectProject');
                    } else {
                        emptyTask();
                    }   
                });


                $('#selectProject').change(function(){
                    var selected = $(this).children('option:selected').val();
                    
                    // alert(selected + client_id + default_project);
                    taskRender(client_id, selected, default_project);

                    
                });


            function projectRender(id, element) {
                //render project based on client

        


                $.ajax({
                url: '/projectrender?client_id=' + id + '&project=' + default_project ,
                type: 'GET',
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                  
                  // $btn.button("reset");
                  // var obj = jQuery.parseJSON(data);
                  // //alert( obj.status === "success" );
                  // console.log(data);

                  

                  if (data.projects.length == 0) {
                      $(element).html('');
                      $(element).append('<option value="all_059">All</option>');
                  }

                    
                  if (data.projects.length > 0 ) {
                    $(element).html('');
                      $(element).append('<option value="all_059">All</option>');
                    
                  for (i = 0; i < data.projects.length ; i++) {
                       
                        $(element).append(projectTemplate(data.projects[i].project_name,  data.projects[i].project_name_raw));

          
                }

                function projectTemplate(project, project_raw) {
                    return '<option value="' + project_raw + '">' + project +'</option>';
                }

                // check for tasks

                
                  
                  }



                  if ( data.tasks.length != 0) {
                        $('#no_task_error').hide();
                        $('#table_parent').show();
                        $('#table_body').html('');
                        for (i = 0; i < data.tasks.length ; i++) {
                    
                    $('#tb').prepend(taskTemplate(data.tasks[i].subject, data.tasks[i].id, data.tasks[i].task_related_to, data.tasks[i].status));
                    $('#' + data.tasks[i].id).hide().fadeIn(1000);
                    }
                    }
                    
                    
                    if (data.tasks.length == 0) {
                        emptyTask();
                    }
                }
              });

              
        

            }

            });

            function taskRender(id, selected, default_selected) {
                var project;

                if (selected == default_selected) {
                    project = default_selected;
                } else {
                    project = selected;
                }

                $.ajax({
                url: '/projectrender?client_id=' + id + '&project=' + project ,
                type: 'GET',
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                  
                  // $btn.button("reset");
                  // var obj = jQuery.parseJSON(data);
                  // //alert( obj.status === "success" );
                  // console.log(data);

                  

                // check for tasks

                if ( data.tasks.length != 0) {
                        $('#no_task_error').hide();
                        $('#table_parent').show();
                        $('#table_body').html('');
                        for (i = 0; i < data.tasks.length ; i++) {
                    
                    $('#tb').prepend(taskTemplate(data.tasks[i].subject, data.tasks[i].id, data.tasks[i].task_related_to, data.tasks[i].status));
                    $('#' + data.tasks[i].id).hide().fadeIn(1000);
                    }
                    }
                    
                    
                    if (data.tasks.length == 0) {
                        emptyTask();
                    }
                  
                  }
                  
                
              });
                
                
                
            }

            function emptyTask() {
                        $('#no_task_error').show();
                        $('#table_parent').hide();
                    
            }

            function taskTemplate(subject, id, related_to, curr_status) {
                var status = 0;
                switch (curr_status) {
                    case '0':
                        status = '<span class="label label-info">Pending</span>';
                        break;
                    case '1':
                        status = '<span class="label label-success">Done</span>';
                        break;
                    case '2':
                        status = '<span class="label label-warning">Viewed</span>';
                        break;
                    case 'low':
                        priority = "Low (14 days)";
                        break;
                    case 'medium':
                        priority = "Medium (7 days)";
                        break;
                    case 'high':
                        priority = "High Priority (48 hours)";
                        break;
                    case 'urgent':
                        priority = "Urgent (24 hours)";
                        break;
                }

                  return '<tr id="' + id +'"><td style="width: 20px"><i class="fa fa-tasks"></i></td><td class="text-left">'+ subject + '</td><td id="status' + id +'">'+ status +'<td>' + related_to +'</td><td class="td-actions text-right"><button type="button" rel="tooltip" data-user_id="' + id +'" title="View Task" class="btn view btn-info btn-simple btn-xs"><i class="fa fa-eye"></i></button><button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs"><i class="fa fa-times"></i></button></td></tr>';
              }
        </script>
        

@endsection
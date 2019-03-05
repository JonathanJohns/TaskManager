@extends('admin.layouts.app')

@section('view_task_active')
active
@endsection



@section('modals')
<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                                        <label>Task Related to:</label>
                                        <select class="form-control" name="task_related_to">
                                            <option value="website">Website</option>
                                            <option value="supply_chain">Supply Chain</option>
                                            <option value="RAC_portal">RAC Portal</option>
                                            <option value="complaint_unit">Complaint Unit</option>
                                            <option value="unclaimed_benefit">Unclaimed Benefit</option>
                                            <option value="mobile_app">Mobile App</option>
                                            <option value="mozambique_website">Mozambique Website</option>
                                            <option value="other">Other</option>
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

            
            </div>
            </form>
          </div>
        </div>
      </div>


      <!-- View Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Task</h4>
            </div>
            <div class="modal-body">
              
                    <dl class="dl-horizontal">
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
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>

            
            </div>
          </div>
        </div>
      </div>
@endsection



@section('content')




        <div class="col-md-12">
            <div class="card ">
                <div class="header">
                    <h4 class="title">Tasks  <button class="btn btn-info btn-flat btn-fill pull-right" data-toggle="modal" data-target="#createModal">Create Task</button></h4>
                <p class="category">Recent Tasks</p>
                    
                </div>
                <div class="content">
                    @if (count($tasks) != 0 )

                    <div class="table-full-width table-responsive">
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
                            <tr id="{{$task->id}}">
                                        <td style="width: 20px">
                                            {{-- <div class="checkbox">
                                                    <input id="checkbox2" type="checkbox" checked>
                                                    <label for="checkbox2"></label>
                                                </div> --}}
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

                                @endforeach
                                
                                
                            </tbody>
                        </table>
                    </div>

                    <div class="footer">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="stats">
                                <i class="fa fa-history"></i> Updated 3 minutes ago
                                
                               
                            </div>
                            
                                    
                        </div>
                    </div>
                </div><span class="pull-right">{{$tasks->links()}}</span>
                    </div>
                    @else 

                    <p class="text-center"><i class="fa fa-warning"></i> No tasks</p>


                    @endif

                
            </div>
        </div>
    </div>

    
@endsection




@section('script')

<script>

var priority; 
var status;

$(function() {
    
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
              
              $('#createModal').modal('hide');

              $.notify({
            	icon: 'pe-7s-check',
            	message: "Task successfully created"

            },{
                type: 'success',
                timer: 4000
            });

            

            $('#tb').prepend(taskTemplate(data.subject, data.task_id, data.task_related_to));
            $('#' + data.task_id).hide().fadeIn(2500);
            

          }

          
        }
      });



      function taskTemplate(subject, id, related_to) {
          return '<tr id="' + id +'"><td style="width: 20px"><i class="fa fa-tasks"></i></td><td class="text-left">'+ subject + '</td><td><span class="label label-info">Pending</span></td><td>' + related_to +'</td><td class="td-actions text-right"><button type="button" rel="tooltip" data-user_id="' + id +'" title="View Task" class="btn view btn-info btn-simple btn-xs"><i class="fa fa-eye"></i></button><button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs"><i class="fa fa-times"></i></button></td></tr>';
      }




      





    


    });



    // $('.view').on('click', function() {
    //     alert($(this).attr('data-user_id'));
    // }); 

    $(document).on('click', '.view' , function() {
        
        
        $.ajax({
        url: '/tasks/' + $(this).attr('data-user_id'),
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
        

          $('#viewModal').modal('show');


          $('#task_description').text(data.description);
          $('#task_priority').text(priority);
          $('#task_subject').text(data.subject);
          $('#task_status').html(status);
          $('#task_date').text(data.created_at);
          
          
             
            

          }

          
        
      });

    
    }); 

    

    
    
});



</script>


@endsection
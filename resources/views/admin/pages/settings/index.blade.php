@extends('admin.layouts.app')

@section('settings_active')
active
@endsection

@section('page_name')
Settings
@endsection


@section('modals')

     <!-- View Modal -->
<div class="modal fade" id="clientModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Clients</h4>
            </div>
            <div class="modal-body">

                    <div class="table-full-width">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>
                                            {{-- <div class="checkbox">
                                                    <input id="checkbox1" type="checkbox">
                                                    <label for="checkbox1"></label>
                                                </div> --}}
                                                <i class="pe-7s-angle-right"></i>
                                        </td>
                                        <td>Sign contract for "What are conference organizers afraid of?"</td>
                                        <td class="td-actions text-right">
                                            <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="checkbox">
                                                    <input id="checkbox2" type="checkbox" checked>
                                                    <label for="checkbox2"></label>
                                                </div>
                                        </td>
                                        <td>Lines From Great Russian Literature? Or E-mails From My Boss?</td>
                                        <td class="td-actions text-right">
                                            <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>



            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>


            </div>
          </div>
        </div>
      </div>
@endsection



@section('content')


<div class="row">


        <div class="col-md-6">
            <div class="card" style="background-color: #E8E8E8">
                <div class="header">
                    <h4 class="title">Add Client</h4>
                    <p class="category">Add a new client</p>
                </div>
                <div class="content">

                        <form id="add_client_form" name="register_form" novalidate action="#"  method="POST">
                                @csrf


                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Client Name</label>
                                                <input type="text" class="form-control" id='client_name' name="name" placeholder="e.g MWPF" value="" placeholder="">
                                            </div>
                                        </div>
                                    </div>


                                    {{-- <button type="submit" class="btn btn-info btn-fill pull-right">Update Profile</button> --}}
                                    <div class="clearfix"></div>


                    </div>
                    <div class="modal-footer">
                      <button type="submit" id="create-task-btn" class="btn btn-primary btn-fill">Add</button>
                    </form>

                      {{-- <button class="btn btn-info pull-left " data-toggle='modal' data-target='#clientModal' id="view_clients">View all Clients</button> --}}


                    </div>



                </div>
            </div>
    
    


    {{-- Assign client --}}



        <div class="col-md-6">
            <div class="card ">
                <div class="header">
                    <h4 class="title">Assign Project Name to Client</h4>
                    <p class="category">Assign a new project name to a client  </p>
                </div>
                <div class="content">

                        <form id="assign_project_form" name="register_form" novalidate action="#"  method="POST">
                                @csrf


                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <label>Select a Client</label>
                                                <select class="form-control" id="client_select" name="client_name">
                                                        
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>New Project Name</label>
                                                <input type="text" class="form-control full-width" id='project_name' name="project_name" placeholder="e.g Website" value="" placeholder="">
                                            </div>
                                        </div>
                                    </div>


                                    {{-- <button type="submit" class="btn btn-info btn-fill pull-right">Update Profile</button> --}}
                                    <div class="clearfix"></div>


                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="client_id" value="" >
                      <button type="submit" id="create-task-btn" class="btn btn-primary btn-fill">Assign</button>
                    </form>
                      {{-- <button class="btn btn-info pull-left " data-toggle='modal' data-target='#clientModal' id="view_clients">View all Clients</button> --}}


                    </div>



                </div>
            </div>
        </div>


@endsection




@section('script')


<script>
    $(function() {

        var selectedClient;

        clientSelect();

        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

    // $("#client_select").change(function(){
    //     selectedClient = $(this).children("option:selected").attr('data-user_id');
    //     console.log(selectedClient);
    // });

    
        

        
        $('#add_client_form').on('submit', function (e) {
            e.preventDefault();
            
            addClient(new FormData(this));

            
        });
        $('#assign_project_form').on('submit', function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append('client_id', selectedClient);
            assignProject(formData);

            
        });
        




    $('#view_clients').on('click', function (e) {
            e.preventDefault();



            $.ajax({
                url : '/settings/allclients',
                type: 'GET',
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {

                    if (data.message == 'success') {

                            

                            $.notify({
            	            icon: 'pe-7s-check',
            	            message: "Client successfully created"

                            },{
                                type: 'success',
                                timer: 4000
                            });

                            

                    } else if (data.message == 'failed') {
                        $.notify({
            	            icon: 'pe-7s-close-circle',
            	            message: data.error

                            },{
                                type: 'danger',
                                timer: 4000
                            });
                    }
            }
        });

    });

        function assignProject(form_data) {


            $.ajax({
                url : '/settings/assignproject',
                type: 'POST',
                data: form_data,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {

                    if (data.message == 'success') {

                            $.notify({
            	            icon: 'pe-7s-check',
            	            message: "Project successfully assigned"

                            },{
                                type: 'success',
                                timer: 4000
                            });

                            $('#project_name').val('');

                    } else if (data.message == 'failed') {
                        $.notify({
            	            icon: 'pe-7s-close-circle',
            	            message: data.error

                            },{
                                type: 'danger',
                                timer: 4000
                            });
                    }
            }
        });
        }


        function addClient(form_data) {
            $.ajax({
                url : '/settings/addclient',
                type: 'POST',
                data: form_data,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {

                    if (data.message == 'success') {

                            $.notify({
            	            icon: 'pe-7s-check',
            	            message: "Client successfully created"

                            },{
                                type: 'success',
                                timer: 4000
                            });

                            $('#client_name').val('');

                    } else if (data.message == 'failed') {
                        $.notify({
            	            icon: 'pe-7s-close-circle',
            	            message: data.error

                            },{
                                type: 'danger',
                                timer: 4000
                            });
                    }
            }
        });
        }


    $('#client_select').on('focus', function () {
        clientSelect();
    });

    function clientSelect() {
            

            $.ajax({
                url : '/settings/allclients',
                type: 'GET',
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    $('#client_select').html('');

                    if ($('#client_select').html() == '') {
                        for (i = 0; i < data.length ; i++) {
                        $('#client_select').prepend(clientSelectTemplate(data[i].client,  data[i].id));
                    }

        //             selectedClient = $('#client_select').children("option:selected").attr('data-user_id');
        // console.log(selectedClient);
        //             }
                    }
                }

    
    });

}

    function clientSelectTemplate(client, id) {
       
         return '<option value="' + id + '">' + client +'</option>';

    }

});
</script>


@endsection
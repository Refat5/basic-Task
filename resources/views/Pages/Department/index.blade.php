@extends('layouts.app')
@section('page_name') Department @endsection
@section('section_header') Department @endsection
@section('breadcrumb')

<div class="breadcrumb-item"><a href="/">Home</a>
</div>
<div class="breadcrumb-item active">Department</div>
@endsection
@section('content')
<div class="row custom-row">
    <h2 class="section-title">Department List</h2>
   
    <div class="col-md-2" style="margin-left: 63%;"><button class="btn btn-primary float-right" data-toggle="modal" data-target="#addModal" >Add Department</button></div>

	
</div>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h4>Department Table</h4>
			</div>
			<div class="card-body"> 
            
                <div class="dt-responsive table-responsive">
                    <table id="dataTable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            
                            <th width=10>Action</th>
                        </tr>
                    </thead>
                    <form method="post" id="deleteForm">
                        
                    {{ csrf_field() }}
                    </form>
                        <tbody>
                            @foreach ($departments as $index=>$department)
                            <tr>
                                <td>{{ ++$index}}</td>
                                <td>{{ $department->dep_name }}</td>
                                
                                <td>
                                    <button class="btn btn-sm btn-info edit" data-id="{{$department->dep_id}}" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i></button>
                                    <a href="" class="btn btn-sm btn-danger" onclick="event.preventDefault(); Delete({{ $department->dep_id }});"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                           
                            <th>Action</th>
                        </tr>
                        </tfoot>
                    </table>
            </div>
			</div>
		</div>
	
</div>
</div>
</div>
<!-- ADD MODAL -->
<div class="modal fade" tabindex="-1" role="dialog" id="addModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Department</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
				</button>
			</div>
      <form action="{{route('department.store')}}" method="post" id="addForm">
      {{ csrf_field() }}
			<div class="modal-body">

      <div class="form-group">
        <label>Department Name:</label>
        <input type="text" class="form-control" name="dep_name" id="name">
      </div>


      <div class="form-group">
        <label>Department Details:</label>
        <textarea class="form-control" name="dep_details" cols="30" rows="10"></textarea>
      </div>
			</div>
			<div class="modal-footer bg-whitesmoke br">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button class="btn btn-primary">Save</button>
        </form>
			</div>
		</div>
	</div>
</div>

<!-- Edit MODAL -->
<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Department</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
				</button>
			</div>
      <form action="" method="post" id="editForm" >
      {{ csrf_field() }}
	<div class="modal-body">
      <div class="form-group">
			

      <div class="form-group">
        <label>Department Name:</label>
        <input type="text" class="form-control" name="dep_name" id="e_dep_name">
      </div>

      <div class="form-group">
        <label>Department Details:</label>
        <textarea class="form-control" name="dep_details" id="e_dep_details" cols="30" rows="10"></textarea>
      </div>
			</div>
			<input type="hidden" id="edit_id" name="id">
			<div class="modal-footer bg-whitesmoke br">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button class="btn btn-primary">Save Changes</button>
        </form>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script>
$(document).ready(function(){
     $("#dataTable").DataTable();
    $(".edit").click(function(){
        var id=$(this).attr("data-id");
        $.ajax({
            url:"/department/"+id+"/edit",
            type:'get',
            data:{"_token":"{{ csrf_token() }}"},
            dataType:"json",
            success:function(data)
            {
                $("#e_dep_name").val(data.dep_name);
                $("#e_dep_details").val(data.dep_details);
                $("#editForm").attr("action","/department/update/"+data.dep_id);
            }
        });
    });
});
function Delete(id){
    var id=id;
    iziToast.question({
        timeout: 20000,
        close: true,
        overlay: true,
        displayMode: 'once',
        id: 'question',
        zindex: 999,
        title: 'Wait!',
        message: 'Are you sure? Once Deleted Can\'t be undone!',
        position: 'center',
        buttons: [
            ['<button><b>YES</b></button>', function () {
                var $form = $("#deleteForm").closest('form');

                $form.attr('action','/department/delete/'+id);
                $form.submit();
            }, true],
            ['<button>NO</button>', function (instance, toast) {

                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

            }],
        ],
    });
}
</script>
{!! $validator->selector('#addForm') !!}
{!! $validator->selector('#editForm') !!}

@endsection

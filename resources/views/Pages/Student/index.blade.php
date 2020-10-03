@extends('layouts.app')
@section('page_name') Studet @endsection
@section('section_header') Studet @endsection
@section('breadcrumb')
<style>
.dataTables_filter{
	margin-left:70%;
}
</style>
<div class="breadcrumb-item"><a href="/">Home</a>
</div>
<div class="breadcrumb-item active">Studt</div>
@endsection
@section('content')
<div class="row custom-row">
    <h2 class="section-title">Studet</h2>
   
    <div class="col-md-2" style="margin-left: 63%;"><button class="btn btn-primary float-right" data-toggle="modal" data-target="#addModal" >Add Student</button></div>

	
</div>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h4>Studet Table</h4>
			</div>
			<div class="card-body"> 
            
                <div class="dt-responsive table-responsive">
                    <table id="dataTable" class="table table-striped table-bordered">
                    <thead>
							<tr>

								<th class="text-center">Profile</th>
								<th class="text-center">Name</th>
								<th class="text-center">Class</th>
				                <th class="text-center">Department</th>
								<th class="text-center">Section</th>
				                <th class="text-center">Blood</th>
				                <th class="text-center">Phone</th>
								<th class="text-center">Action</th>
							</tr>
						</thead>
						<form method="post" id="deleteForm">
                        
						{{ csrf_field() }}
						</form>
                   
                        <tbody>
                            @foreach ($students as $student )
							
                            <tr>
                                <td><img alt="image" id="previmage" width="120" height="120" src='/avatar.png' class="rounded-circle mb-3 emp_img"></center></td>
                                <td>{{$student->std_full_name }}</td>
                                <td>{{$student->studentClass->clas_name}}</td>
                                <td>{{$student->department->dep_name}}</td>
                                <td>{{$student->section->sec_name}}</td>
                                <td>{{$student->std_bllod}}</td>
                                <td>{{$student->std_phone}}</td>
                                
                                

                                
                                <td>
                               
                                <button class="btn btn-sm btn-info edit" data-toggle="modal" data-target="#editModal" data-id="{{$student->std_id}}" ><i class="fa fa-edit"></i></button>

								<a href="" class="btn btn-sm btn-danger" onclick="event.preventDefault(); Delete({{ $student->std_id }});"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
							<tr>
                                <th>Profile</th>
								<th>Name</th>
								<th>Class</th>
				                <th>Department</th>
								<th>Section</th>
				                <th>Blood</th>
				                <th>Phone</th>
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
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add student</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
				</button>
			</div>
      <form action="{{route('student.store')}}" method="post" id="addForm" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="modal-body">

			<!-- <div class="row">
			<div class="col-md-6">

			     <center>	<img alt="image" id="previmage" width="120" height="120" src='/avatar.png' class="rounded-circle mb-3 emp_img"></center>

		 </div>

		    <div class="col-md-6 mt-5">
				<div class="custom-file">
					<input type="file" class="custom-file-input" id="std_image" name="std_image" onchange="readURL(this);">
					<label class="custom-file-label" for="std_image">Choose image</label>
					<small class="form-text text-muted">File must be .jpg or .png</small>
				</div>
			</div>

		</div> -->


        <div class="row">
					<div class="col-md-6">
					<div class="form-group">
							 <label for="std_dept_id">Select Department</label>
							 <select class="form-control" id="std_dept_id" name="std_dept_id">
							 	<option selected hidden disabled>Select Department</option>
								 @foreach($departments as $dept)
								<option value="{{$dept->dep_id}}">{{ $dept->dep_name}}</option>
								@endforeach
							 </select>
			 			 </div>
					 </div>

          <div class="col-md-6">
            <div class="form-group">
                 <label for="std_section_id">Select Section</label>
                 <select class="form-control" id="std_section_id" name="std_section_id">
					<option selected hidden disabled>Select Section</option>
                   @foreach($sections as $section)
                  <option value="{{$section->sec_id}}">{{ $section->sec_name}}</option>
                  @endforeach
                 </select>
               </div>
          </div>


        </div>


        <div class="row">
        	<div class="col-md-6">
						<div class="form-group">
								 <label for="std_class_id">Select Class</label>
								 <select class="form-control" id="std_class_id" name="std_class_id">
							 		<option selected hidden disabled>Select Class</option>
									 @foreach($studentClass as $stdcls)
									 <option value="{{$stdcls->clas_id}}">{{ $stdcls->clas_name}}</option>
									 @endforeach
								 </select>
							 </div>
					</div>
          <div class="col-md-6">

            <dic class="form-group floating-label-form-group">
                <label for="name">Full Name</label>
                <input type="text" class="form-control" id="name" name="std_full_name" placeholder="Enter Full Name" >
            </dic>
          </div>

        </div>
				<div class="row">
				<div class="col-md-6">
					<div class="form-group floating-label-form-group">
							<label for="contact">Phone</label>
							<input type="text" class="form-control" id="contact" name="std_phone" placeholder="Enter Contact" >
					</div>
				</div>
				<div class="col-md-3">
            <div id="div_id_gender" class="form-group">
               <label for="id_gender"  class="control-label col-md-4">Gender </label>
               <div class="controls col-md-11"  style="margin-bottom: 10px">
                    <label class="radio-inline"> <input type="radio" name="std_gender" id="male" value="1"  style="margin-bottom: 10px">&nbsp Male</label>
                    <label class="radio-inline"> <input type="radio" name="std_gender" id="female" value="2"  style="margin-bottom: 10px">&nbsp Female</label>
               </div>
           </div>
          </div>

          <div class="col-md-3">
			<div class="form-group">
            <label for="std_bllod">Select Blood</label>
								 <select class="form-control"  id="std_bllod" name="std_bllod">
							 		<option selected hidden disabled >Select Group</option>
									 
									 <option value="A+">A+</option>
									 <option value="A-">A-</option>
									 <option value="AB+">AB+</option>
									 <option value="AB-">AB-</option>
									 <option value="B+">B+</option>
									 <option value="B-">B-</option>
									 <option value="O+">O+</option>
									 <option value="O-">O-</option>

									
								 </select>
        </div>
			</div>

</div>
        <div class="row">
        <div class="col-md-6">
            <fieldset class="form-group floating-label-form-group">
                <label for="salery">Registration</label>
                <input type="text" class="form-control" id="std_registration" name="std_registration" placeholder="Enter Registration">
            </fieldset>
          </div>
          <div class="col-md-6">
            <fieldset class="form-group floating-label-form-group">
                <label for="salery">Roll</label>
                <input type="text" class="form-control" id="std_roll" name="std_roll" placeholder="Enter Roll">
            </fieldset>
          </div>


        </div>
        <div class="row">

					<div class="col-md-6">
 					 <fieldset class="form-group floating-label-form-group">
 							 <label for="username">Father Name</label>
 							 <input type="text" class="form-control" id="std_father_name" name="std_father_name" placeholder="Enter Father Name">
 					 </fieldset>
 				 </div>

                  <div class="col-md-6">
 					 <fieldset class="form-group floating-label-form-group">
 							 <label for="username">Mother Name</label>
 							 <input type="text" class="form-control" id="std_mother_name" name="std_mother_name" placeholder="Enter Mother Name">
 					 </fieldset>
 				 </div>
        </div>

        <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">Email address</label>
                 <input type="email" class="form-control" id="std_email" name="std_email" placeholder="Enter Email ">
            </div>
          </div>
					<div class="col-md-6">
						<div class="form-group">
								<label for="std_dob" class=" col-form-label">Date of Birth</label>
									<input type="date" class="form-control" name="std_dob" id="std_dob">
						</div>
					</div>


        </div>


      </div>
      <div class="modal-footer">
          <input type="reset" class="btn btn-outline-secondary" data-dismiss="modal" value="Close">
          <input type="submit" class="btn btn-outline-primary" value="Submit">
      </div>

        </form>
			</div>
		</div>
	</div>
</div>

<!-- Edit MODAL -->

<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Eedit student</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="" method="post" id="editForm" >
      {{ csrf_field() }}
      <div class="modal-body">

			<!-- <div class="row">
			<div class="col-md-6">

			     <center>	<img alt="image" id="previmage" width="120" height="120" src='/avatar.png' class="rounded-circle mb-3 emp_img"></center>

		 </div>

		    <div class="col-md-6 mt-5">
				<div class="custom-file">
					<input type="file" class="custom-file-input" id="std_image" name="std_image" onchange="readURL(this);">
					<label class="custom-file-label" for="std_image">Choose image</label>
					<small class="form-text text-muted">File must be .jpg or .png</small>
				</div>
			</div>

		</div> -->


        <div class="row">
					<div class="col-md-6">
					<div class="form-group">
							 <label for="e_std_dept_id">Select Department</label>
							 <select class="form-control" id="e_std_dept_id" name="std_dept_id">
							 	<option selected hidden disabled>Select Department</option>
								 @foreach($departments as $dept)
								<option value="{{$dept->dep_id}}">{{ $dept->dep_name}}</option>
								@endforeach
							 </select>
			 			 </div>
					 </div>

          <div class="col-md-6">
            <div class="form-group">
                 <label for="e_std_section_id">Select Section</label>
                 <select class="form-control" id="e_std_section_id" name="std_section_id">
					<option selected hidden disabled>Select Section</option>
                   @foreach($sections as $section)
                  <option value="{{$section->sec_id}}">{{ $section->sec_name}}</option>
                  @endforeach
                 </select>
               </div>
          </div>


        </div>


        <div class="row">
        	<div class="col-md-6">
						<div class="form-group">
								 <label for="e_std_class_id">Select Class</label>
								 <select class="form-control" id="e_std_class_id" name="std_class_id">
							 		<option selected hidden disabled>Select Class</option>
									 @foreach($studentClass as $stdcls)
									 <option value="{{$stdcls->clas_id}}">{{ $stdcls->clas_name}}</option>
									 @endforeach
								 </select>
							 </div>
					</div>
          <div class="col-md-6">

            <dic class="form-group floating-label-form-group">
                <label for="e_std_full_name">Full Name</label>
                <input type="text" class="form-control" id="e_std_full_name" name="std_full_name" placeholder="Enter Full Name" >
            </dic>
          </div>

        </div>
				<div class="row">
				<div class="col-md-6">
					<div class="form-group floating-label-form-group">
							<label for="e_std_phone">Phone</label>
							<input type="text" class="form-control" id="e_std_phone" name="std_phone" placeholder="Enter Contact" >
					</div>
				</div>
				<div class="col-md-3">
            <div id="div_id_gender" class="form-group">
               <label for="id_gender"  class="control-label col-md-4">Gender </label>
               <div class="controls col-md-11"  style="margin-bottom: 10px">
                    <label class="radio-inline"> <input type="radio" name="std_gender" id="e_male" value="1"  style="margin-bottom: 10px">&nbsp Male</label>
                    <label class="radio-inline"> <input type="radio" name="std_gender" id="e_female" value="2"  style="margin-bottom: 10px">&nbsp Female</label>
               </div>
           </div>
          </div>

          <div class="col-md-3">
			<div class="form-group">
            <label for="e_std_bllod">Select Blood</label>
								 <select class="form-control"  id="e_std_bllod" name="std_bllod">
							 		<option selected hidden disabled >Select Group</option>
									 
									 <option value="A+">A+</option>
									 <option value="A-">A-</option>
									 <option value="AB+">AB+</option>
									 <option value="AB-">AB-</option>
									 <option value="B+">B+</option>
									 <option value="B-">B-</option>
									 <option value="O+">O+</option>
									 <option value="O-">O-</option>

									
								 </select>
        </div>
			</div>

</div>
        <div class="row">
        <div class="col-md-6">
            <fieldset class="form-group floating-label-form-group">
                <label for="e_std_registration">Registration</label>
                <input type="text" class="form-control" id="e_std_registration" name="std_registration" placeholder="Enter Registatopm">
            </fieldset>
          </div>
          <div class="col-md-6">
            <fieldset class="form-group floating-label-form-group">
                <label for="e_std_roll">Roll</label>
                <input type="text" class="form-control" id="e_std_roll" name="std_roll" placeholder="Enter Roll">
            </fieldset>
          </div>


        </div>
        <div class="row">

					<div class="col-md-6">
 					 <fieldset class="form-group floating-label-form-group">
 							 <label for="e_std_father_name">Father Name</label>
 							 <input type="text" class="form-control" id="e_std_father_name" name="std_father_name" placeholder="Enter Father Name">
 					 </fieldset>
 				 </div>

                  <div class="col-md-6">
 					 <fieldset class="form-group floating-label-form-group">
 							 <label for="e_std_mother_name">Mother Name</label>
 							 <input type="text" class="form-control" id="e_std_mother_name" name="std_mother_name" placeholder="Enter Mother Name">
 					 </fieldset>
 				 </div>
        </div>

        <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="e_std_email">Email address</label>
                 <input type="email" class="form-control" id="e_std_email" name="std_email" placeholder="Enter Email ">
            </div>
          </div>
					<div class="col-md-6">
						<div class="form-group">
								<label for="e_std_dob" class=" col-form-label">Date of Birth</label>
									<input type="date" class="form-control" name="std_dob" id="e_std_dob">
						</div>
					</div>


        </div>


      </div>
      <div class="modal-footer">
          <input type="reset" class="btn btn-outline-secondary" data-dismiss="modal" value="Close">
          <input type="submit" class="btn btn-outline-primary" value="Submit">
      </div>

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
            url:"/student/"+id+"/edit",
            type:'get',
            data:{"_token":"{{ csrf_token() }}"},
            dataType:"json",
            success:function(data)
            {
				console.log(data);
                $("#e_std_dept_id").val(data.std_dept_id);
				$("#e_std_section_id").val(data.std_section_id);
				$("#e_std_class_id").val(data.std_class_id);
				$("#e_std_full_name").val(data.std_full_name);
				$("#e_std_roll").val(data.std_roll);
				$("#e_std_registration").val(data.std_registration);
				$("#e_std_phone").val(data.std_phone);
				$("#e_std_bllod").val(data.std_bllod);

				$("#e_std_father_name").val(data.std_father_name);
				$("#e_std_mother_name").val(data.std_mother_name);
				$("#e_std_email").val(data.std_email);
				$("#e_std_dob").val(data.std_dob);
				$("#editForm").attr("action","/student/update/"+data.std_id);

				if(data.std_gender==1)
				{
					$("#e_male").attr("checked","checked");
				}
				else{
					$("#e_female").attr("checked","checked");
				}
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

                $form.attr('action','/student/delete/'+id);
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

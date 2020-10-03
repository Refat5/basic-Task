@extends('layouts.app')
@section('page_name') Report @endsection
@section('section_header') Report @endsection
@section('breadcrumb')
<div class="breadcrumb-item"><a href="/">Home</a>
</div>
<div class="breadcrumb-item active">Report</div>
@endsection
@section('content')
<div class="row custom-row">
    <h2 class="section-title">Report</h2>

</div>

<div class="row" >
	<div class="col-12">
		<div class="card">
        <form action="/report" method="get">
        {{ csrf_field() }}
			<div class="card-header">
				<h4>Report Table</h4>
                <div class="row" style="margin-left: 30%;">
					<div class="col-md-6">
					<div class="form-group">
							<strong> <label for="std_dept_id">Select Department</label></strong>
							 <select class="form-control" id="std_dept_id" name="dept">
							 	<option selected hidden disabled>Select Department</option>
								 @foreach($departments as $dept)
								<option value="{{$dept->dep_id}}">{{ $dept->dep_name}}</option>
								@endforeach
							 </select>
			 			 </div>
					 </div>

          <div class="col-md-6">
            <div class="form-group">
                 <strong><label for="std_section_id">  Select Blood</label></strong>
                 <select class="form-control"  id="std_bllod" name="bg">
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
               <button type="submit" class="btn btn-info"> Search Data</button>
               
          </div>
          </form>

        </div>
                

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




@endsection


<?php

namespace App\Http\Controllers;

use App\Student;
use App\Department;
use App\StudentClass;
use App\StudentSection;

use Illuminate\Http\Request;
use App\Http\Requests\StudentRequest;
use JsValidator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::with("department","studentClass","section")->get();
        $departments= Department::orderBy('dep_name','asc')->get();
        $studentClass= StudentClass::orderBy('clas_name','asc')->get();
        $sections= StudentSection::orderBy('sec_name','asc')->get();

        $rules = new StudentRequest;
        $validator = JsValidator::make($rules->rules(), [], $rules->name());
        return view('Pages.Student.index', compact('students','departments','sections','studentClass','validator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
         
        $student= new Student;
        $student->fill($request->all())->save();
       
        $notification = array(
            'title' => 'Student',
            'message' => 'Successfully! Student Information Saved.',
            'alert-type' => 'success',
        );
        
         return redirect()->back()->with($notification);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::findOrFail($id);
        return response()->json($student);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $student = Student::findOrFail($id);
      return response()->json($student);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(StudentRequest $request, $id)
    {
        $student=Student::find($id);
        $student->fill($request->all())->save();
        $notification = array(
            'title' => 'Student',
            'message' => 'Successfully! Student Information Updated.',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $delete=$student->delete();
        if($delete)
        {
            $notification = array(
                'title' => 'Student',
                'message' => 'Successfully! Student Information Deleted.',
                'alert-type' => 'success',
            );
        }
        else{
            $notification = array(
                'title' => 'Student',
                'message' => 'Ooh No! Something Went Wrong.',
                'alert-type' => 'error',
            );
        }
        return redirect()->back()->with($notification);
    }
}

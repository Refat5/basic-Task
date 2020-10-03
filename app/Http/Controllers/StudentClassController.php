<?php

namespace App\Http\Controllers;

use App\StudentClass;
use Illuminate\Http\Request;
use App\Http\Requests\StudentClassRequest;
use JsValidator;

class StudentClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $studentClass=StudentClass::orderBy('clas_id','asc')->get();
        $rules = new StudentClassRequest;
        $validator = JsValidator::make($rules->rules(), [], $rules->name());
        return view('Pages.StudentClass.index',compact('studentClass','validator'));
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
    public function store(StudentClassRequest $request)
    {
        $studentClass=New StudentClass;
        $studentClass->fill($request->all())->save();
       
        $notification = array(
            'title' => 'StudentClass',
            'message' => 'Successfully! StudentClass Information Saved.',
            'alert-type' => 'success',
        );
        
         return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StudentClass  $studentClass
     * @return \Illuminate\Http\Response
     */
    public function show(StudentClass $studentClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StudentClass  $studentClass
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $studentClass = StudentClass::findOrFail($id);
        return response()->json($studentClass);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StudentClass  $studentClass
     * @return \Illuminate\Http\Response
     */
    public function update(StudentClassRequest $request, $id)
    {
        $studentClass=StudentClass::find($id);
        $studentClass->fill($request->all())->save();
        $notification = array(
            'title' => 'Student Class',
            'message' => 'Successfully! Student Class Information Updated.',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StudentClass  $studentClass
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $class = StudentClass::findOrFail($id);
        $delete=$class->delete();
        if($delete)
        {
            $notification = array(
                'title' => 'Class',
                'message' => 'Successfully! Class Information Deleted.',
                'alert-type' => 'success',
            );
        }
        else{
            $notification = array(
                'title' => 'Class',
                'message' => 'Ooh No! Something Went Wrong.',
                'alert-type' => 'error',
            );
        }
        return redirect()->back()->with($notification);
    }
}

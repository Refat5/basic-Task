<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;
use App\Http\Requests\DepartmentRequest;
use JsValidator;
class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments=Department::orderBy('dep_id','asc')->get();
        $rules = new DepartmentRequest;
        $validator = JsValidator::make($rules->rules(), [], $rules->name());
        return view('Pages.Department.index',compact('departments','validator'));
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
    public function store(DepartmentRequest $request)
    {
        $department=New Department;
        $department->fill($request->all())->save();
       
        $notification = array(
            'title' => 'department',
            'message' => 'Successfully! department Information Saved.',
            'alert-type' => 'success',
        );
        
         return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $department = Department::findOrFail($id);
        return response()->json($department);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(DepartmentRequest $request, $id)
    {
        $department=Department::find($id);
        $department->fill($request->all())->save();
        $notification = array(
            'title' => 'Department',
            'message' => 'Successfully! Department Information Updated.',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $class = Department::findOrFail($id);
        $delete=$class->delete();
        if($delete)
        {
            $notification = array(
                'title' => 'Department',
                'message' => 'Successfully! Department Information Deleted.',
                'alert-type' => 'success',
            );
        }
        else{
            $notification = array(
                'title' => 'Department',
                'message' => 'Ooh No! Something Went Wrong.',
                'alert-type' => 'error',
            );
        }
        return redirect()->back()->with($notification);
    }
}

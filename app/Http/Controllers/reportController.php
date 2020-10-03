<?php

namespace App\Http\Controllers;
use App\Student;
use App\Department;
use App\StudentClass;
use App\StudentSection;




use Illuminate\Http\Request; 


class reportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $students = Student::with("department","studentClass","section")
        ->where(function($query) use($request){
            if($request->dept){
                $query->where('std_dept_id',$request->dept);
            }
            if($request->bg){
                $query->where('std_bllod',$request->bg);
            }
        })
        ->get();
        $departments= Department::orderBy('dep_name','asc')->get();
        $studentClass= StudentClass::orderBy('clas_name','asc')->get();
        $sections= StudentSection::orderBy('sec_name','asc')->get();

        return view('Pages.Report.index', compact('students','departments','sections','studentClass'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

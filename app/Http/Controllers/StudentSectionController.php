<?php

namespace App\Http\Controllers;

use App\StudentSection;
use Illuminate\Http\Request;
use App\Http\Requests\StudentSectionRequest;
use JsValidator;
 
class StudentSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $studentSections=StudentSection::orderBy('sec_id','asc')->get();
        $rules = new StudentSectionRequest;
        $validator = JsValidator::make($rules->rules(), [], $rules->name());
        return view('Pages.StudentSection.index',compact('studentSections','validator'));
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
    public function store(StudentSectionRequest $request)
    {
        $studentSection=New StudentSection;
        $studentSection->fill($request->all())->save();
       
        $notification = array(
            'title' => 'studentSection',
            'message' => 'Successfully! studentSection Information Saved.',
            'alert-type' => 'success',
        );
        
         return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StudentSection  $studentSection
     * @return \Illuminate\Http\Response
     */
    public function show(StudentSection $studentSection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StudentSection  $studentSection
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $section = StudentSection::findOrFail($id);
      return response()->json($section);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StudentSection  $studentSection
     * @return \Illuminate\Http\Response
     */
    public function update(StudentSectionRequest $request, $id)
    {
        $section=StudentSection::find($id);
        $section->fill($request->all())->save();
        $notification = array(
            'title' => 'Student Section',
            'message' => 'Successfully! Student Class Information Updated.',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StudentSection  $studentSection
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $section = StudentSection::findOrFail($id);
        $delete=$section->delete();
        if($delete)
        {
            $notification = array(
                'title' => 'Section',
                'message' => 'Successfully! Section Information Deleted.',
                'alert-type' => 'success',
            );
        }
        else{
            $notification = array(
                'title' => 'Section',
                'message' => 'Ooh No! Something Went Wrong.',
                'alert-type' => 'error',
            );
        }
        return redirect()->back()->with($notification);
    }
}

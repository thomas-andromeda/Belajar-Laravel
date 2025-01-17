<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\ClassroomEditRequest;
use App\Http\Requests\ClassroomCreateRequest;

class ClassController extends Controller
{
    public function index()
    {
        $class = ClassRoom::get();
        return view('classroom', ['classlist' => $class]);
    }

    public function show($id)
    {
        $class = ClassRoom::with(['homeroomTeacher', 'students'])
        ->findOrFail($id);
        return view('classroom-detail',['class' => $class]);
    }

    public function create()
    {    
        $teacher = Teacher::select('id', 'name')->get();
        return view('classroom-add', ['teacher' => $teacher]);
    }

    public function store(ClassroomCreateRequest $request)
    {
        $classroom = ClassRoom::create($request->all());

        if($classroom){
            Session::flash('status', 'success');
            Session::flash('message', 'Class added successfully');
        }
        
        return redirect('/classroom');
    }

    public function edit(Request $request, $id)
    {
        $class = ClassRoom::findOrFail($id);
        $teacher = Teacher::where('id', '!=', $class->id)->select('id', 'name')->get();
        return view('/classroom-edit', ['class' => $class, 'teacher' => $teacher]);
    }

    public function update(Request $request, $id)
    {
        $class = ClassRoom::findOrFail($request->id);
        $class->update($request->all());

        if($class->save()){
            Session::flash('status', 'success');
            Session::flash('message', 'Class updated successfully');
        }

        return redirect('/classroom');
    }

    public function delete($id)
    {
        $class = ClassRoom::findOrFail($id);
        return view('classroom-delete', ['class' => $class]);
    }

    public function destroy($id)
    {
        $deleteClass = Classroom::findOrFail($id);
        $deleteClass->delete();
        Session::flash('status', 'success');
        Session::flash('message', 'Class deleted successfully');

        return redirect('/classroom');
    }

    public function deletedClass()
    {
        $deletedClass = Classroom::onlyTrashed()->get();
        return view('classroom-deleted-list', ['class' => $deletedClass]);
    }

    public function restore($id)
    {
        $restoreClass = Classroom::withTrashed()->findOrFail($id);
        $restoreClass->restore();
        Session::flash('status', 'success');
        Session::flash('message', 'Class restored successfully');
        return redirect('/classroom');
    }
}

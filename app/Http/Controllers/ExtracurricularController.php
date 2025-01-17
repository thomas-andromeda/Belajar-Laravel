<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Extracurricular;
use Illuminate\Support\Facades\Session;


class ExtracurricularController extends Controller
{
    public function index()
    {
        $eksul = Extracurricular::get();
        return view('extracurricular', ['eksullist' => $eksul]);
    }

    public function show($id)
    {
        $eksul = Extracurricular::findOrFail($id);
        return view('extracurricular-detail', ['eksul' => $eksul]);
    }

    public function create()
    {    
        $eksul = Extracurricular::get();
        return view('extracurricular-add');
    }

    public function store(Request $request)
    {
        $eksul = Extracurricular::create($request->all());

            if($eksul){
                Session::flash('status', 'success');
                Session::flash('message', 'Extracurricular added successfully');
            }

        return redirect('/extracurricular');
    }

    public function edit(Request $request, $id)
    {
        $eksul = Extracurricular::findOrFail($request->id);
        return view('extracurricular-edit', ['extracurricular' => $eksul]);
    }

    public function update(Request $request, $id)
    {
        $eksul = Extracurricular::findOrFail($request->id);
        $eksul->update($request->all());

        if($eksul->save()){
            Session::flash('status', 'success');
            Session::flash('message', 'Extracurricular updated successfully');
        }

        return redirect('/extracurricular');
    }

    public function delete($id)
    {
        $eksul = Extracurricular::findOrFail($id);
        return view('extracurricular-delete', ['eksul' => $eksul]);
    }

    public function destroy($id)
    {
        $deleteEksul = Extracurricular::findOrFail($id);
        $deleteEksul->delete();
        Session::flash('status', 'success');
        Session::flash('message', 'Extracurricular deleted successfully');

        return redirect('/extracurricular');
    }

    public function deletedExtracurricular()
    {
        $deletedEksul = Extracurricular::onlyTrashed()->get();
        return view('extracurricular-deleted-list', ['eksul' => $deletedEksul]);
    }

    public function restore($id)
    {
        $restoreEksul = Extracurricular::withTrashed()->findOrFail($id);
        $restoreEksul->restore();
        Session::flash('status', 'success');
        Session::flash('message', 'Extracurricular restored successfully');
        return redirect('/extracurricular');
    }

}


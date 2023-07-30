<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\exercises;
use Illuminate\Http\Request;
use App\Exports\ExportExercises;
use App\Imports\ImportExercises;
use Maatwebsite\Excel\Facades\Excel;

class ExercisesController extends Controller
{
    public function index(){
        $exercises = exercises::OrderBy('id', 'desc')->paginate(10);
        return view('admin.exercises.index', compact('exercises'));
    }

    public function create(){
        return view('admin.exercises.create');
    }

    public function export()
    {
        return Excel::download(new ExportExercises, 'exercises.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

    public function import()
    {
        request()->validate([
            'file' => 'required',
        ]);

        Excel::import(new ImportExercises, request()->file('file'));

        return redirect()->route('exercises.index')
            ->with('success', 'Успешно создан.');
    }

    public function edit($id){
        $exercise = exercises::findOrFail($id);
        return view('admin.exercises.edit', compact('exercise'));
    }

    public function update(Request $request,$id){
        $exercise = exercises::findOrFail($id);

        request()->validate([
                                'name' => 'required',
                                'type' => 'required',
                                'apparatus' => 'required',
                                'experience' => 'required',
                                'description' => 'required',
                                'type_train' => 'required',
                            ]);

        $input = $request->all();

        if ($image = $request->file('photo')) {
            $destinationPath = 'photo/';
            $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $postImage);
            $input['photo'] = "$postImage";
        }else {
            unset($input['photo']);
        }

        $exercise->update($input);

        return redirect()->route('exercises.index')
            ->with('success', 'Успешно изменен.');

    }



}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExerciseType;
use App\Models\Exersires;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ExersireController extends Controller
{
    //
    public function index()
    {
        return view('exersire.index');
    }

    public function addExersire(ExerciseType $exerciseType)
    {
        $typeList = $exerciseType->orderBy('id','desc')->get();
        return view('exersire.add')->with([
            'typeList'=>$typeList
        ]);
    }

    public function createNewEx(Request $request, Exersires $exersires)
    {
        $request->validate([
            'type'=>'required|exists:exercise_type,id',
            'answer_select'=>'required',
            'code'=>'required|string|max:8',

        ]);
        try{
            $exersires->createEx($request);
            return redirect()->route('index.exersire')
            ->with(['alert-type' => 'success', 'message' => 'bài tập thành công']);
        }catch(Exception $ex){
            return back()
            ->with(['alert-type' => 'error', 'message' => 'bài tập thất bại']);
        }
    }

    public function datatable(Request $request, Exersires $exersires)
    {
        if($request->ajax()){
            $data = $exersires->getExersires();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('type_exercire', function ($data) {
                return !empty($data->typeExercire) ? $data->typeExercire->title : 'No subject';
            })
            ->addColumn('action', function ($data) {
                return view('elements.action_teacher', [
                    'model' => $data,
                    'url_edit' => '',
                    'url_delete'=>''
                ]);
            })->make(true);
        }
    }
}

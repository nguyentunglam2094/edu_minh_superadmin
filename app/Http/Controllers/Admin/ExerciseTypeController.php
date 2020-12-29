<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\ExerciseType;
use App\Models\Subject;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class ExerciseTypeController extends Controller
{
    //
    public function index()
    {
        return view('ExersireType.index');
    }

    public function createType(Request $request, ExerciseType $exerciseType)
    {
        $request->validate([
            'title'=>'required|max:255|string',
            'subject_id'=>'required|exists:subjects,id',
            'class_id'=>'required|exists:classes,id',
            'description'=>'required',
        ]);
        try{
            $exerciseType->createNewTypeEx($request);
            return redirect()->route('index.exersire.type')
            ->with(['alert-type' => 'success', 'message' => 'Thêm loại bài tập thành công']);
        }catch(Exception $ex){
            return back()
            ->with(['alert-type' => 'error', 'message' => 'Thêm loại bài tập thất bại']);
        }
    }

    public function viewAdd(Subject $subject, Classes $classes)
    {
        $listClass = $classes->getClass();
        $listSubject = $subject->getSubject();
        return view('ExersireType.add')->with([
            'listSubject'=>$listSubject,
            'listClass'=>$listClass,
        ]);
    }

    public function viewEdit(Subject $subject, Classes $classes, ExerciseType $exerciseType, $id)
    {
        $detail = $exerciseType->detail($id);
        $listClass = $classes->getClass();
        $listSubject = $subject->getSubject();
        return view('ExersireType.edit')->with([
            'listSubject'=>$listSubject,
            'listClass'=>$listClass,
            'detail'=>$detail,
        ]);
    }

    public function updateType(Request $request, ExerciseType $exerciseType)
    {
        $request->validate([
            'type_id'=>'required|exists:exercise_type,id',
            'title'=>'required|max:255|string',
            'subject_id'=>'required|exists:subjects,id',
            'class_id'=>'required|exists:classes,id',
            'description'=>'required',
        ]);
        try{
            $exerciseType->updateTypeEx($request);
            return redirect()->route('index.exersire.type')
            ->with(['alert-type' => 'success', 'message' => 'Sửa loại bài tập thành công']);
        }catch(Exception $ex){
            return back()
            ->with(['alert-type' => 'error', 'message' => 'Sửa loại bài tập thất bại']);
        }
    }

    public function datatable(Request $request, ExerciseType $exerciseType)
    {
        if($request->ajax()){
            $data = $exerciseType->getTypeEx();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('subject', function ($data) {
                return !empty($data->subject) ? $data->subject->title : 'No subject';
            })
            ->addColumn('action', function ($data) {
                return view('elements.action_teacher', [
                    'model' => $data,
                    'url_edit' => route('view.edit.type', $data->id),
                    'url_delete'=>''
                ]);
            })->make(true);
        }
    }

}

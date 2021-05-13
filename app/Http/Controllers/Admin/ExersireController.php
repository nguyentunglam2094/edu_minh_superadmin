<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Libraries\Ultilities;
use App\Models\Classes;
use App\Models\ExerciseType;
use App\Models\Exersires;
use App\Models\Subject;
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

    public function addExersire(ExerciseType $exerciseType, Classes $classes, Subject $subject)
    {
        $listClass = $classes->getClass();
        $listSubject = $subject->getSubject();
        $typeList = $exerciseType->orderBy('id','desc')->get();
        return view('exersire.add')->with([
            'typeList'=>$typeList,
            'listClass'=>$listClass,
            'listSubject'=>$listSubject,
        ]);
    }

    public function uploadImage(Request $request)
    {
        if($request->ajax()){
            if($request->hasFile('file')){
                $files = $request->file('file');
                $nameImage = Ultilities::uploadFile($files);
                return $nameImage;
            }
            return null;
        }
    }

    public function createNewEx(Request $request, Exersires $exersires)
    {
        $request->validate([
            'answer_select'=>'required',
            'code'=>'required|string|max:8|unique:exercises,code',
            'question'=>'required|string',
            'image_question'=>'required|string',
            'image_answer'=>'required|string',
            'class_id'=>'required|exists:classes,id',
            'subject_id'=>'required|exists:subjects,id',
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

    public function getUpdateEx(Request $request, Exersires $exersires,Classes $classes, Subject $subject, $id)
    {

        $detailEx = $exersires->getDetailById($id);
        if(empty($detailEx)){
            return back()
            ->with(['alert-type' => 'error', 'message' => 'Không tìm thấy bài tập']);
        }
        $listClass = $classes->getClass();
        $listSubject = $subject->getSubject();
        return view('exersire.edit')->with([
            'detailEx'=>$detailEx,
            'listClass'=>$listClass,
            'listSubject'=>$listSubject,
        ]);
    }

    public function updateExer(Request $request, Exersires $exersires)
    {
        $request->validate([
            'id'=>'required|exists:exercises,id',
            'answer_select'=>'required',
            'code'=>'required|string|max:8|unique:exercises,code,'.$request->id,
            'question'=>'required|string',
            'image_question'=>'required|string',
            'image_answer'=>'required|string',
            'class_id'=>'required|exists:classes,id',
            'subject_id'=>'required|exists:subjects,id',
        ]);
        try{
            $exersires->updateEx($request);
            return redirect()->route('index.exersire')
            ->with(['alert-type' => 'success', 'message' => 'Chỉnh sửa bài tập thành công']);
        }catch(Exception $ex){
            return back()
            ->with(['alert-type' => 'error', 'message' => 'Chỉnh sửa bài tập thất bại']);
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
                    'url_edit' => route('view.update.ex', $data->id),
                    'url_delete'=>''
                ]);
            })->make(true);
        }
    }
}

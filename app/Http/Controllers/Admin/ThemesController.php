<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\Themes;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class ThemesController extends Controller
{
    //
    public function index()
    {
        return view('Themes.index');
    }

    public function datatable(Request $request, Themes $exerciseType)
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
                    'url_edit' => route('view.edit.themes', $data->id),
                    'url_delete'=>''
                ]);
            })->make(true);
        }
    }


    public function createThemes(Request $request, Themes $exerciseType)
    {
        $request->validate([
            'title'=>'required|max:255|string',
            'subject_id'=>'required|exists:subjects,id',
            'class_id'=>'required|exists:classes,id',
            'description'=>'required',
        ]);
        try{
            $exerciseType->createNewTypeEx($request);
            return redirect()->route('index.themes')
            ->with(['alert-type' => 'success', 'message' => 'Thêm chủ đề thành công']);
        }catch(Exception $ex){
            return back()
            ->with(['alert-type' => 'error', 'message' => 'Thêm chủ đề thất bại']);
        }
    }

    public function updateThemes(Request $request, Themes $exerciseType)
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
            return redirect()->route('index.themes')
            ->with(['alert-type' => 'success', 'message' => 'Sửa loại bài tập thành công']);
        }catch(Exception $ex){
            return back()
            ->with(['alert-type' => 'error', 'message' => 'Sửa loại bài tập thất bại']);
        }
    }

    public function viewEdit(Subject $subject, Classes $classes, Themes $exerciseType, $id)
    {
        $detail = $exerciseType->detail($id);
        $listClass = $classes->getClass();
        $listSubject = $subject->getSubject();
        return view('Themes.edit')->with([
            'listSubject'=>$listSubject,
            'listClass'=>$listClass,
            'detail'=>$detail,
        ]);
    }

    public function viewAdd(Subject $subject, Classes $classes)
    {
        $listClass = $classes->getClass();
        $listSubject = $subject->getSubject();
        return view('Themes.add')->with([
            'listSubject'=>$listSubject,
            'listClass'=>$listClass,
        ]);
    }

}

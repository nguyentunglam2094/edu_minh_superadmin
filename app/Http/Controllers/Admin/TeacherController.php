<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Libraries\Ultilities;
use App\Models\Subject;
use App\Models\Teachers;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TeacherController extends Controller
{
    //
    public function index()
    {
        return view('teacher.index');
    }

    public function getEdit(Request $request,Subject $subject, Teachers $teachers, $id)
    {
        $detailTeacher = $teachers->detail($id);
        $listSubject = $subject->getSubject();
        return view('teacher.edit')->with([
            'teacher'=>$detailTeacher,
            'listSubject'=>$listSubject
        ]);
    }

    public function viewAdd(Subject $subject)
    {
        $listSubject = $subject->getSubject();
        return view('teacher.add')->with([
            'listSubject'=>$listSubject
        ]);
    }

    public function createTeacher(Request $request, Teachers $teachers)
    {
        $request->merge([
            'phone'=>Ultilities::replacePhone($request->phone)
        ]);
        $request->validate([
            'name'=>'required|max:255',
            'phone'=>'required|max:15|min:10|regex:/^([0-9\s\-\+\(\)]*)$/',
            'email'=>'required|email|max:255|unique:teachers,email',
            'subject'=>'required|exists:subjects,id',
            'description'=>'required'
        ]);
        try{
            $teachers->createTeacher($request);
            return redirect()->route('manage.teacher')
            ->with(['alert-type' => 'success', 'message' => 'Thêm giáo viên thành công']);
        }catch(Exception $ex){
            return back()
            ->with(['alert-type' => 'error', 'message' => 'Thêm giáo viên thất bại']);
        }
    }

    public function updateTeacher(Request $request, Teachers $teachers)
    {
        $request->merge([
            'phone'=>Ultilities::replacePhone($request->phone)
        ]);
        $request->validate([
            'teacher_id'=>'required|exists:teachers,id',
            'name'=>'required|max:255',
            'phone'=>'required|max:15|min:10|regex:/^([0-9\s\-\+\(\)]*)$/',
            'email'=>'required|email|max:255|unique:teachers,email,'.$request->teacher_id,
            'subject'=>'required|exists:subjects,id',
            'description'=>'required'

        ]);
        try{
            $teachers->updateTeacher($request);
            return redirect()->route('manage.teacher')
            ->with(['alert-type' => 'success', 'message' => 'Sửa giáo viên thành công']);
        }catch(Exception $ex){
            return back()
            ->with(['alert-type' => 'error', 'message' => 'Sửa giáo viên thất bại']);
        }
    }

    public function datatable(Request $request, Teachers $teachers)
    {
        if($request->ajax()){
            $data = $teachers->getTeacher();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('subject', function ($data) {
                return !empty($data->subject) ? $data->subject->title : 'No subject';
            })
            ->addColumn('action', function ($data) {
                return view('elements.action_teacher', [
                    'model' => $data,
                    'url_edit' => route('view.edit.teacher', $data->id),
                    'url_delete'=>route('delete.teacher')
                ]);
            })->make(true);
        }
    }

    public function deleteTeacher(Request $request, Teachers $teachers)
    {
        if($request->ajax()){
            $teachers->where('id', $request->id)->delete();
        }
    }
}

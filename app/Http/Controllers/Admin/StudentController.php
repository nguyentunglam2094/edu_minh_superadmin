<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Users;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
class StudentController extends Controller
{
    //
    public function activeStudent(Request $request, Users $user)
    {
        $active = 1;
        if($request->active === 'false'){
            $active = 0;
        }
        $user->activeStudent($request->id, $active);
    }

    public function index()
    {
        return view('students.index');
    }

    public function detail(Request $request, Users $user, $id)
    {
        $detail = $user->getDetail($id);
        return view('students.detail')->with([
            'detail'=>$detail
        ]);
    }

    public function datatable(Request $request, Users $user)
    {
        if($request->ajax()){
            $data = $user->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('name', function ($data){
                return view('elements.name_detail', [
                    'model' => $data,
                    'url_edit' => route('student.detail', $data->id),
                ]);
            })
            ->addColumn('verify', function ($data) {
                return view('elements.active_student', [
                    'data'=>$data
                ]);
            })
            ->addColumn('action', function ($data) {
                return view('elements.action_student', [
                    'model' => $data,
                    'url_edit' => route('view.edit.teacher', $data->id),
                ]);
            })->make(true);
        }
    }
}

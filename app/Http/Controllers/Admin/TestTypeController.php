<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\TestType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class TestTypeController extends Controller
{
    //
    public function index(Request $request, TestType $testType)
    {
        if($request->ajax()){
            $data = $testType->with('class')->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('class', function ($data) {
                return !empty($data->class) ? $data->class->title : 'No class';
            })
            ->addColumn('action', function ($data) {
                return view('elements.action_teacher', [
                    'model' => $data,
                    'url_edit' => route('view.edit.test.type', $data->id),
                    'url_delete'=>''
                ]);
            })
            ->make(true);
        }
        return view('testtype.index');
    }

    public function add(Request $request, Classes $classes)
    {
        $listClass = $classes->getClass();
        return view('testtype.add')->with([
            'listClass'=>$listClass,
        ]);
    }

    public function getTestType(Request $request, TestType $testType)
    {
        if($request->ajax()){
            $list = $testType->getTestType($request->id);
            return $list;
        }
    }

    public function edit(Request $request, Classes $classes, TestType $testType, $id)
    {
        $listClass = $classes->getClass();
        $detail = $testType->where('id', $id)->first();
        if(empty($detail)){
            return back()
            ->with(['alert-type' => 'error', 'message' => 'Không tìm thấy loại ']);
        }
        return view('testtype.edit')->with([
            'listClass'=>$listClass,
            'detail'=>$detail
        ]);
    }

    public function store(Request $request, TestType $testType)
    {
        $request->validate([
            'title'=>'required|string|max:255',
            'class_id'=>'required|exists:classes,id'
        ]);
        try{
            DB::beginTransaction();
            $createNew = $testType->createOrUpdate($request);
            DB::commit();
            return redirect()->route('index.test.type')
            ->with(['alert-type' => 'success', 'message' => 'Thêm loại đề thi thành công']);

        }catch(Exception $ex){
            DB::rollback();
            return back()
            ->with(['alert-type' => 'error', 'message' => 'Thêm loại đề thi tthất bại']);
        }
    }

    public function update(Request $request, TestType $testType)
    {
        $request->validate([
            'id'=>'required|exists:test_type,id',
            'title'=>'required|string|max:255',
            'class_id'=>'required|exists:classes,id'
        ]);
        try{
            DB::beginTransaction();
            $createNew = $testType->createOrUpdate($request);
            DB::commit();
            return redirect()->route('index.test.type')
            ->with(['alert-type' => 'success', 'message' => 'Sửa loại đề thi thành công']);

        }catch(Exception $ex){
            DB::rollback();
            return back()
            ->with(['alert-type' => 'error', 'message' => 'Sửa loại đề thi tthất bại']);
        }
    }
}

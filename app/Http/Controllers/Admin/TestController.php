<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\TestAnswers;
use App\Models\Tests;
use App\Models\UserAnswer;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TestController extends Controller
{
    //
    public function index()
    {
        return view('Test.index');
    }

    public function updateAnswer(Request $request, TestAnswers $testAnswers)
    {
        if($request->ajax()){
            $testAnswers->updateAnswerById($request->answerid, $request->answer);
        }
    }

    public function saveImageAnswer(Request $request, TestAnswers $testAnswers)
    {
        if($request->ajax()){
            $testAnswers->where('id', $request->id)->update([
                'image_answer'=>$request->image_answer
            ]);
        }
    }

    public function uploadImgAns(Request $request, TestAnswers $testAnswers)
    {
        if($request->ajax()){
            \Log::debug($request->all());
            $testAnswers->updateImageAns($request);
        }
    }

    public function addTestOnline(Subject $subject, Classes $classes)
    {
        $listClass = $classes->getClass();
        $listSubject = $subject->getSubject();
        return view('Test.add')->with([
            'listSubject'=>$listSubject,
            'listClass'=>$listClass,
        ]);
    }

    public function viewTestAnswers(Tests $test, Subject $subject, Classes $classes, TestAnswers $testAnswers, UserAnswer $userAnswer, $id)
    {
        $detail = $test->getDetailTest($id);
        $listClass = $classes->getClass();
        $listSubject = $subject->getSubject();
        $answerList = $userAnswer->getAnswer($id);

        return view('Test.answers')->with([
            'detail'=>$detail,
            'listSubject'=>$listSubject,
            'listClass'=>$listClass,
            'answerList'=>$answerList,
        ]);
    }

    public function updateTest(Request $request, Tests $tests)
    {
        $request->validate([
            'test_id'=>'required|exists:tests,id',
            'title'=>'required|max:255|string',
            'subject_id'=>'required|exists:subjects,id',
            'class_id'=>'required|exists:classes,id',
            'question_number'=>'required|numeric|gte:0',
            'min'=>'required|numeric|gte:0',
            'image'=>'required'
        ]);
        try{
            $createNew = $tests->updateTest($request);
            return redirect()->route('answer.test', $createNew->id)
            ->with(['alert-type' => 'success', 'message' => 'Chỉnh sửa bài thi online hành công']);
        }catch(Exception $ex){
            return back()
            ->with(['alert-type' => 'error', 'message' => 'Chỉnh sửa bài thi online thất bại']);
        }
    }

    public function createTest(Request $request, Tests $tests)
    {
        $request->validate([
            'title'=>'required|max:255|string',
            'subject_id'=>'required|exists:subjects,id',
            'class_id'=>'required|exists:classes,id',
            'question_number'=>'required|numeric|gte:0',
            'min'=>'required|numeric|gte:0',
            'image'=>'required'
        ]);
        try{
            $createNew = $tests->createNewTest($request);
            return redirect()->route('answer.test', $createNew->id)
            ->with(['alert-type' => 'success', 'message' => 'Thêm bài thi online hành công']);
        }catch(Exception $ex){
            return back()
            ->with(['alert-type' => 'error', 'message' => 'Thêm bài thi online thất bại']);
        }
    }

    public function datatable(Request $request, Tests $tests)
    {
        if($request->ajax()){
            $data = $tests->getAllTest();
            \Log::debug($data);
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('subject', function ($data) {
                return !empty($data->subject) ? $data->subject->title : 'No subject';
            })
            ->addColumn('class', function ($data) {
                return !empty($data->subject) ? $data->class->title : 'No class';
            })
            ->addColumn('action', function ($data) {
                return view('elements.action_teacher', [
                    'model' => $data,
                    'url_edit' => route('answer.test', $data->id),
                    'url_delete'=>''
                ]);
            })->make(true);
        }
    }
}

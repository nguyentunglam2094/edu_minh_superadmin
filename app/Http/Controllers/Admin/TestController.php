<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Comments;
use App\Models\PushNotifications;
use App\Models\Subject;
use App\Models\TestAnswers;
use App\Models\Tests;
use App\Models\TestType;
use App\Models\UserAnswer;
use App\Models\UserTest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            $testAnswers->where('id', $request->id_answer)->update([
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

    public function addTestOnline(Subject $subject, Classes $classes, TestType $testType)
    {
        $listClass = $classes->getClass();
        $listSubject = $subject->getSubject();

        return view('Test.add')->with([
            'listSubject'=>$listSubject,
            'listClass'=>$listClass,
        ]);
    }

    public function viewTestAnswers(Comments $comments, Tests $test, Subject $subject, Classes $classes, TestAnswers $testAnswers, UserAnswer $userAnswer, $id)
    {
        $detail = $test->getDetailTest($id);
        $listClass = $classes->getClass();
        $listSubject = $subject->getSubject();
        $answerList = $userAnswer->getAnswer($id);

        PushNotifications::where('screen', 'detailtest')->where('reference_id', $detail->id)
        ->update([
            'read'=>1
        ]);
        $listComment = $comments->getCommentByExer($id, 'object_id');
        return view('Test.answers')->with([
            'detail'=>$detail,
            'listSubject'=>$listSubject,
            'listClass'=>$listClass,
            'answerList'=>$answerList,
            'listComment'=>$listComment,
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
            'image'=>'nullable|sometimes',
            'type_test'=>'required|numeric|exists:test_type,id'
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
            'subject_id'=>'required|numeric|exists:subjects,id',
            'class_id'=>'required|numeric|exists:classes,id',
            'question_number'=>'required|numeric|gte:0',
            'min'=>'required|numeric|gte:0',
            'image'=>'required',
            'type_test'=>'required|numeric|exists:test_type,id'
        ]);
        try{
            DB::beginTransaction();
            $createNew = $tests->createNewTest($request);
            DB::commit();
            return redirect()->route('answer.test', $createNew->id)
            ->with(['alert-type' => 'success', 'message' => 'Thêm bài thi online hành công']);

        }catch(Exception $ex){
            DB::rollback();
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
                return !empty($data->class) ? $data->class->title : 'No class';
            })
            ->addColumn('report', function($data){
                return view('elements.export', [
                    'model' => $data,
                    'url_edit' => route('report.test', $data->id)
                ]);
            })
            ->addColumn('action', function ($data) {
                return view('elements.action_teacher', [
                    'model' => $data,
                    'url_edit' => route('answer.test', $data->id),
                    'url_delete'=>route('delete.test')
                ]);
            })->make(true);
        }
    }

    public function deleteTest(Request $request, Tests $test)
    {
        if($request->ajax()){
            $test->deleteTest($request->id);
        }
    }

    public function reportTest(Tests $test, UserAnswer $userAnswer, UserTest $userTest, $id)
    {
        $detail = $test->getDetailTest($id);
        $answerList = $userAnswer->getAnswer($id);
        $listUserTest = $userTest->with('user')->where('test_id', $id)->orderBy('answer_corredt', 'desc')->get();

        return view('Test.export_test')->with([
            'detail'=>$detail,
            'answerList'=>$answerList,
            'listUserTest'=>$listUserTest,
        ]);
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PushNotifications;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class NotificationController extends Controller
{
    //
    public function index(Request $request, PushNotifications $pushNotifications)
    {
        if($request->ajax()){
            $data = $pushNotifications->with('sender')->where('source_to', PushNotifications::SOURCE_ADMIN)->latest();
            return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('title', function($data){
                $route = route('view.comment.exersire', $data->reference_id);
                if($data->screen == 'detailtest'){
                    $route = route('answer.test', $data->reference_id);
                }
                return '<a href="'.$route.'">'.$data->title.'</a>';
            })
            ->editColumn('screen', function($data){
                if($data->screen == 'detailtest'){
                    return 'Bình luận đề thi';
                }
                return 'Bình luận bài tập';
            })
            ->editColumn('read', function($data){
                return $data->read == 0 ? '<span class="label label-danger">Chưa đọc</span>' : '';
            })
            ->addColumn('sender_name', function($data){
                return !empty($data->sender) ? $data->sender->name : '';
            })
            ->rawColumns(['read', 'title'])
            ->make(true);
        }
        return view('notificaiton.index');
    }
}

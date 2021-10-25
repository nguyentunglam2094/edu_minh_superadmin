<?php

namespace App\Jobs;

use App\Libraries\SendPushNotification;
use App\Models\PushNotifications;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendPushNotifications implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $push_id;

    public function __construct($push_id)
    {
        //
        $this->push_id = $push_id;
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $pushNotificationDb = new PushNotifications();
        $detailPush =  $pushNotificationDb->getById($this->push_id);
        $data = (!empty($detailPush->data)) ? json_decode($detailPush->data, true) : [];
        if (empty($detailPush)) {
            return \Log::error("Not found push notification ID {$this->push_id}");
        }
        $pushUser = $detailPush->userPush;
        $sendPushNoti = new SendPushNotification();
        if(!empty($pushUser)){
            if($detailPush->type == PushNotifications::TYPE_SIMPLE){
                $pushUser = $pushUser->first();
                //get token
                $token = !empty($pushUser->userDevice) ? $pushUser->userDevice->token : null;
                if(!empty($token)){
                    $sendPushNoti->sendToDevice($token, $detailPush->title, $detailPush->content, $data);
                }
            }else{
                $token = [];
                foreach($pushUser as $val){
                    if(!empty($val->userDevice)){
                        array_push($token, $val->userDevice->token);
                    }
                }
                if(count($token) > 0){
                    $isPush = $sendPushNoti->sendToGroup($token, $detailPush->title, $detailPush->content, $data);
                }
            }
        }
        if (!empty($isPush)) {
            $pushNotificationDb->updatePush($detailPush->id, ['status' => PushNotifications::STATUS_SEND]);
        } else {
            $pushNotificationDb->updatePush($detailPush->id, ['status' => PushNotifications::STATUS_FAILURE]);
        }
    }
}

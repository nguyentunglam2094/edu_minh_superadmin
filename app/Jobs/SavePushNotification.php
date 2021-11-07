<?php

namespace App\Jobs;

use App\Models\PushNotifications;
use App\Models\PushUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SavePushNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $config = [
        'sender_id' => 0,
        'user_id' => [],
        'data' => [],
        'title' => '',
        'message' => '',
        'reference_id' => 0,
        'type' => 0,
        'source' => 0,
        'type_activity' => 0,
        'push_type' => '',
        'source_to' => 0,
        'name_db' => '',
        'conten_db'=>'',
    ];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($options)
    {
        //
        $options = array_merge($this->config, $options);
        foreach ($options as $key => $value) {
            $this->{$key} = $value;
        }
        $this->config = $options;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->config as $key => $value) {
            $this->{$key} = $value;
        }
        $dataPush = [
            'title' => $this->title,
            'content' => $this->message,
            'sender_id' => $this->sender_id,
            'user_id'=>0,
            'data' =>  json_encode($this->data),
            'type' => $this->type,
            'status' => 0,
            'reference_id' => $this->reference_id,
            'source' => $this->source,
            'source_to' => $this->source_to,
            'screen' => $this->screen,
        ];
        $pushNotificationDb = new PushNotifications();
        $push = $pushNotificationDb->create($dataPush);
        $pushId = $push->id;
        if($this->user_id != 0){
            $userPush = [];
            foreach($this->user_id as $id){
                $userPush[] = [
                    'push_id'=>$pushId,
                    'user_id'=>$id,
                    'read'=>PushNotifications::UN_READ,
                    'user_type'=>$this->source_to
                ];
            }
            $pushUser = new PushUser();
            $pushUser->insert($userPush);
        }
        // dispatch(new SendPushNotifications($pushId));
    }
}

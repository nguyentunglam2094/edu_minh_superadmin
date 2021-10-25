<?php

namespace App\Models;

use App\Libraries\Ultilities;
use Illuminate\Database\Eloquent\Model;

class UserDevices extends Model
{
    //
    //
    protected $table = 'user_devices';
    protected $fillable =['id','token', 'user_id','user_type'];

    const SOURCE_ADMIN = 1;
    const SOURCE_STUDENT = 2;

    public function saveTokenDevice($request, $user_type)
    {
        $user = $request->user();
        $userId = $user->id;

        $conditions = [
            'user_id' => $userId,
            'user_type' => $user_type,
        ];

        $device = [
            'token' => Ultilities::clearXSS($request->token),
        ];
        // dd($device);
        return $this->updateOrCreate($conditions, $device);
    }
}

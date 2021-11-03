<?php

namespace App\Http\Controllers;

use App\Models\PushNotifications;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $count = PushNotifications::where('source_to', PushNotifications::SOURCE_ADMIN)->where('read', 0)->count();
        View::share ( 'notification', $count );
    }
}

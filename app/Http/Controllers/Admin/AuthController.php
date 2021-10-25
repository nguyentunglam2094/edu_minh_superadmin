<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banners;
use App\Models\Teachers;
use App\Models\UserDevices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AuthController extends Controller
{
    //
    protected $redirectTo = '/';
    public function logout()
    {
        \Auth::guard()->logout();
        return redirect()->route('login');
    }


            /**
     * update device token client web
     * @author lamnt
     * @date 2020 07 17
     */
    public function updateDevice(Request $request, UserDevices $userDevices)
    {
        if (!\Auth::check()) {
            return false;
        }
        try {
            $userDevices->saveTokenDevice($request, UserDevices::SOURCE_ADMIN);
        } catch (\Exception $ex) {
            return response()->json([
                'message' => __('api.save_token_failure'),
            ], 500);
        }
    }

    public function getLogin(){
        return view('auth.login');
    }
    public function login(Request $request)
    {
        // điều kiện đăng nhập
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        $admin_login_data = array(
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        );
        $remember = $request->has('remember');
        if (Auth::attempt($admin_login_data, $remember)) {
            //success
            return redirect()->route('view.dashboard');
        }

        return back();
    }

    /**
     * view dashboard
     * @date 2020 04 27
     * @param
     * @author lamnt
     */
    public function viewDashboard(Request $request, Banners $banners)
    {
        $list = $banners->orderBy('id', 'desc')->get();
        return view('dashboard')->with([
            'banners'=>$list
        ]);
    }
}

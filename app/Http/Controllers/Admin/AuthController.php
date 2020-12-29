<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teachers;
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
        return redirect()->route('getLogin');
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
    public function viewDashboard(Request $request)
    {
        return view('dashboard');
    }
}

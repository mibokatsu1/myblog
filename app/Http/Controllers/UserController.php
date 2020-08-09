<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // ログアウト遷移先変更
    public function getLogout(Request $request){
        Auth::logout();
        return redirect()->route('login');
    }
}

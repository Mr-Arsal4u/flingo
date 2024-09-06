<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect()->route('dashboard');
        // return view('home');
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        // dd($user);
        if ($user) {
            $user->update([
                'logged_in' => false,
                'last_login_at' => now(),
            ]);
            Auth::logout();
            return redirect('/login');
        }
    }


}

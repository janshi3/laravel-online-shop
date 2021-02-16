<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Rules\MatchOldPassword;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ConfirmsPasswords;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ChangePasswordController extends Controller
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

    public function index()
    {
        return view('auth.passwords.change');
    }

    public function store(Request $request)

    {

        $request->validate([

            'current_password' => 'required', new MatchOldPassword,

            'new_password' => 'required|confirmed',

        ]);

        User::find(Auth::id())->update(['password'=> Hash::make($request->new_password)]);

        return redirect('/users/' . Auth::id())->with('status', 'Password changed!');

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::guest()){
            return redirect()->back();
        }
        if (Auth::user()->admin == 0){
            return redirect()->back();
        }
        $users = User::all();

        return view('users', [
            'users' => $users
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::guest()){
            return redirect()->back();
        }
        if (Auth::id() != $id){
            return redirect()->back();
        }

        $user = User::find($id);

        $productCount = DB::table('products')->where('user_id', $id)->get()->count();

        return view('profile', [
            'user' => $user,
            'productCount' => $productCount
        ]);
    }

    public function products($id)
    {
        if (Auth::guest()){
            return redirect()->back();
        }
        if (Auth::id() != $id){
            return redirect()->back();
        }

        $products = DB::table('products')->where('user_id', $id)->get();

        return view('user_products', [
            'products' => $products
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ]);

        $user = User::where('id', $id)->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        ]);

        $url = '/users/' . $id;

        return redirect($url)->with('status', 'Profile Changed Successfully!');
    }

    public function changeAdmin(Request $request, $id)
    {
        $user = User::find($id);

        $user->update([
            'admin' => !$user->admin
        ]);

        if ($user->admin){
            $message = 'Admin status given to user "' . $user->name . '"';
        }
        else{
            $message = 'Admin Status Taken From User "' . $user->name . '"';
        };

        return redirect('/users')->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::Find($id);

        $user->delete();

        if (Auth::id() != $id) {
            return redirect('/users')->with('error', 'User Removed!');
        }
        return redirect('/login')->with('error', 'Account Deleted!');
    }
}

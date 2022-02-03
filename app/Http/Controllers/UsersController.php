<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        if (Auth::user()->isAdmin){

            $users = User::all();

            return view('users.index', compact('users'));
        }
        return redirect('/');
    }

    public function create(Request $request)
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $randomString = $this->rand_string(10);
        $user = new User;

        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = Hash::make(crypt($request->password, $randomString));
        $user->isAdmin = 0;

        $user-> save();

        return redirect()->route('users.index');
    }

    public function show($id)
    {
        $users = User::findOrFail($id);

        return view('users.show', compact('users'));
        //$users = User::find($id);
        //return view('users.createUserShow');
        //return view('users.show', compact('users'));
    }

    public function edit($id)
    {
        // *****
        if (Auth::id() == $id || Auth::user()->isAdmin) {
            $users = User::findOrFail($id);

            return view('users.edit', compact('users'));
        }

        return redirect('/');
    }

    public function update(Request $request)
    {
        $randomString = $this->rand_string(10);
        $user = User::find($request->id);

        $user->name = $request->get('name');
        $user->lastname = $request->get('lastname');
        //$user->password = Hash::make($request->get('password'));
        $user->password = Hash::make(crypt($request->get('password'), $randomString));
        $user->save();

        return redirect()->route('users.edit', $user);
    }

    public function destroy($id)
    {
        //Destroy
        User::findOrFail($id)->delete();

        return redirect()->route('users.index');
    }
    function rand_string( $length ) {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz@#$&*.,";
        $size = strlen( $chars );
        for( $i = 0; $i < $length; $i++ ) {
            $str= $chars[ rand( 0, $size - 1 ) ];
        }
        return $str;
    }
}

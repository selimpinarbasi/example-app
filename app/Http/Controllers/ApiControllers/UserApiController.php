<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Nette\Utils\Random;

class UserApiController extends Controller
{
    //get users data {get}
    function user($id=null)
    {
        return $id?User::find($id):User::all();
    }

    //add user {post}
    function addUser(Request $request)
    {
        $randomString = $this->RandomString(10);

        $user= new User;

        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = Hash::make(crypt($request->password, $randomString));
        $user->isAdmin = 0;

        $result = $user->save();

        if ($result)
        {
            return ["Data saved"];
        }
        else
        {
            return ["Fail"];
        }
    }

    //update user {put}
    function updateUser(Request $request)
    {
        $randomString = $this->RandomString(10);

        $user = User::find($request->id);

        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = Hash::make(crypt($request->password, $randomString));
        $user->isAdmin = $request->isAdmin;

        $result = $user->save();

        if ($result)
        {
            return ["Data updated"];
        }
        else
        {
            return ["Fail"];
        }
    }

    function deleteUser($id)
    {
        $user = User::find($id);
        if ($user->isAdmin)
        {
            return ["Admin is not erasable"];
        }
        else
        {
            $result = $user->delete();
        }

        if ($result)
        {
            return ["Data deleted"];
        }
        else
        {
            return ["Fail"];
        }
    }

    public function sendToken(Request $request)
    {
        $user= User::where('email', $request->email)->first();
        // print_r($data);
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => ['These credentials do not match our records.']
            ], 404);
        }

        $token = $user->createToken('my-app-token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
        //return[$this->RandomString(100)];
    }
    function RandomString($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

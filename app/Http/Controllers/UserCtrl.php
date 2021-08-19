<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserCtrl extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('token'));
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'role' => $request->get('role'),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user','token'),201);
    }

    public function getAuthenticatedUser()
    {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        return response()->json(compact('user'));
    }

    public function show() {
        $data = User::all();
        return view('pages.user.view', compact('data'));
    }

    public function store(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'password' => 'required|string|min:8|confirmed',
        // ]);

        // if($validator->fails()){
        //     return response()->json($validator->errors()->toJson(), 400);
        // }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'role' => $request->get('role'),
        ]);

        return redirect('/user');
    }

    public function update(Request $request) {
        if ($request->password == "") {
            User::where('id', $request->user_id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'is_active' => $request->is_active,
                ]);
        } else {
            User::where('id', $request->user_id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->new_password),
                'role' => $request->role,
                'is_active' => $request->is_active,
                ]);
        }
 
    	return redirect('/user');
    }

    public function changePass(Request $request) {
        $data = User::where('id', $request->user_id)
        ->get();

        
        
        if (Hash::check($request->old_password, $data[0]["password"])) {
            $updatePassword = User::where('id', $request->user_id)
                ->update([
                'password' => Hash::make($request->new_password),
            ]);
            $res = [
                "status" => "success"
            ];
            return response()->json($res, 200);
        } else {
            $res = [
                "status" => "failed"
            ];
            return response()->json($res, 200);
        }
    }
}

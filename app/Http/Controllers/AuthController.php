<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $v = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'password'  => 'required|min:3|confirmed',
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|min:6|max:10',
        ]);

        if ($v->fails()) {
            foreach ($v->errors()->messages() as $key => $value) {
                $errors[] = is_array($value) ? implode(',', $value) : $value;
            }
            $errors = implode(", <br> ", $errors);
            return response()->json([
                    'errors' => $errors
            ], 401);
        }

        $user = new User;
        $user->email = $request->email;
        $user->name = $request->name;
        $user->mobile = $request->mobile;
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json(['status' => 'success'], 200);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $token = $this->guard()->attempt($credentials);
        if ($token = $this->guard()->attempt($credentials)) {
            return response()->json(['status' => 'success'], 200)->header('Authorization', $token);
        }

        return response()->json(['error' => 'login_error'], 401);
    }

    public function logout()
    {
        $this->guard()->logout();

        return response()->json([
            'status' => 'success',
            'msg' => 'Logged out Successfully.'
        ], 200);
    }

    public function user(Request $request)
    {
        $user = User::find(Auth::user()->id);

        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }

    public function getUsers(Request $request)
    {
        $user = User::orderBy('id','desc')->get();

        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }

    public function refresh() {
        if ($token = $this->guard()->refresh()) {
            return response()
                ->json(['status' => 'successs'], 200)
                ->header('Authorization', $token);
        }

        return response()->json(['error' => 'refresh_token_error'], 401);
    }

    public function updateData(Request $request) {
        
        $v = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email,'.$request->id,
            'password'  => 'required|min:3|confirmed',
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|min:6|max:10',
        ]);

        if ($v->fails()) {
            foreach ($v->errors()->messages() as $key => $value) {
                $errors[] = is_array($value) ? implode(',', $value) : $value;
            }
            $errors = implode(", <br> ", $errors);
            return response()->json([
                    'errors' => $errors
            ], 401);
        }

        $user = User::find($request->id);
        $user->email = $request->email;
        $user->name = $request->name;
        $user->mobile = $request->mobile;
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json(['status' => 'success'], 200);
    }

    private function guard()
    {
        return Auth::guard();
    }
}


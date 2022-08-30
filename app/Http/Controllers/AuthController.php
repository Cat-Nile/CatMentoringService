<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;



class AuthController extends Controller
{

    public function index()
    {
        $users =  User::all();
        return response()->json([
            'success'=>true,
            'message'=> 'Display a listing of the resource.',
            'data'  => $users
        ]);
    }

    public function signUp(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'age' => 'required|integer|between:1,15',
            'breed' => ['required', 'in:터키시앙고라,샴,스코티시폴드,러시안블루,먼치킨,
            코리안쇼트헤어,스노우슈'],
            'hair' => ['required', 'in:흰색,회색,검정색,삼색,턱시도,고등어,치즈'],
            'role' => ['required', 'in:멘토,멘티'],
            'password' => 'required|min:4',
            'password_confirmation' => 'required|same:password',
        ]);

        if($validator->fails()) {
            return response()->json(['message' => '폼 검증 실패', 'errors' => $validator->errors()], 422);
        }

        $params = $request->only(['name', 'email', 'password', 'age', 'breed', 'hair', 'role']);
        $params['password'] = bcrypt($params['password']); 
        $user = User::create($params);
        return response()->json($user);
    }
    
    public function signIn(Request $request) {
        $params = $request->only(['email', 'password']);
        if(Auth::attempt($params)){
            $user = User::where('email', $params['email'])->first();
            $token = $user->createToken(env('APP_KEY'));
            return response()->json([
                'user' => $user,
                'token' => $token->plainTextToken,
            ]);
        }
        else{
            return response()->json(['message' => '로그인 정보를 확인하세요'], 400);
        }
        /*
        1. email과 일치하는 사용자 찾기
        2. 비밀번호 암호화 확인
        3. 로그인된 사용자 정보 반환
        //*/
    }
}


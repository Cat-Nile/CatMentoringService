<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;



class AuthController extends Controller
{
    public function signUp(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4',
            'password_confirmation' => 'required|same:password',
        ]);

        if($validator->fails()) {
            return response()->json(['message' => '폼 검증 실패', 'errors' => $validator->errors()], 422);
        }

        $params = $request->only(['name', 'email', 'password']);
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


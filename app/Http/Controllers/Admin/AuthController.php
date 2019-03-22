<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * AuthController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:admin', ['except' => ['login']]);
    }
    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('phone', 'password');
        if (!$token = auth('admin')->attempt($credentials)) {
            return response()->json(array(
                'code' => 1002,
                'msg' => 'login failed',
                'data'=>'',
            ));
        }else{
            $user=auth('admin')->user();
            $user['role']=0;
            return response()->json(array(
                'code' => 0,
                'msg' => 'login success',
                'data'=>array('token'=>$token,'user'=>$user),
             ));
        }
    }
     /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        if(auth('admin')->logout()){
            return response()->json(
                array(
                    'code' =>0,
                    'msg' => 'logout success',
                    'data'=>array('user'=>auth('admin')->user())
                )
            );
        }else{
            return response()->json(
                array(
                    'code' => 1005,
                    'msg' => 'logout failed',
                    'data'=>''
                )
            );
        }
    }
    public function changePassword(Request $request){
        
    }
}

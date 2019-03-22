<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;


class AuthController extends Controller
{

    /**
     * AuthController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:home', ['except' => ['login','register']]);
    }
    public function register(Request $request)
    {
        $user = new User;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);
        //确认手机号是否注册
        if($user->save()){
            return response()->json(array(
                    'code'=>0,
                    'msg'=>'user register success',
                    'data'=>''
            ));
        }else{
            return response()->json(array(
                    'code'=>1001,
                    'msg'=>'user register failed',
                    'data'=>''
            ));
        }   
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
        if (!$token = auth('home')->attempt($credentials)) {
            return response()->json(array(
                'code' => '1001',
                'msg' => 'Invalid Credentials',
                'data'=>'',
            ));
        }
        return response()->json(array(
            'code' => '0',
            'msg' => 'Valid Credentials',
            'data'=>array('token'=>$token,'user'=>auth('home')->user()),
        ));
    }

    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(
            array(
                'code' => '0',
                'msg' => 'user info',
                'data'=>array('user'=>auth('home')->user())
            )
        );
        
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('home')->logout();

        return response()->json(['message' => 'Successfully logged out']);
       
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(api('home')->refresh());
    }
}

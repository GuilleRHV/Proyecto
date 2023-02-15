<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }




    /* public function login()
    {
        $credentials = request(['email', 'password']);

        // $credentials;
        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }*/


    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            if ($token = auth('api')->attempt($credentials)) {
                return $this->respondWithToken($token); //OK
            } else {
                return response()->json(['error' => 'Credenciales inválidas'], 400);
            }
        } catch (JWTException $e) {
            \Log::error($e->getMessage());
            return response()->json(['error' => 'No se pudo crear el token'], 500);
        }
    }






    public function logout()
    {
        // auth()->logout();
        auth('api')->logout();

        return response()->json(['message' => 'Salió con éxito']);
    }

    public function me()
    {
        return response()->json(auth('api')->user());
    }


    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }


    protected function respondWithToken($token, $status = 200)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ], $status);
    }
}

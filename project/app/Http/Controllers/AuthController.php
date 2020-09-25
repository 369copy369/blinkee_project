<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['register', 'login']]);
    }

    /**
     * Register user and give him a JWT.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register()
    {
        $credentials = request(['name', 'email', 'password']);
        $rules = array(
            'name'      => 'required|string|min:3|max:24',
            'email'     => 'required|string|min:4|max:24',
            'password'  => 'required|string|min:4|max:24'
        );

        $validator = Validator::make($credentials, $rules);

        $data = [
            'statusMessage' => 'Invalid credentials',
            'status' => 401
        ];

        if (! $validator->fails()) {

            $userAlreadyExist = User::where('email', $credentials['email'])->first();

            if (!$userAlreadyExist) {

                $user = User::create([
                    'name' => $credentials['name'],
                    'email' => $credentials['email'],
                    'password' => Hash::make($credentials['password']),
                ]);

                $token = auth()->login($user);

                return $this->respondWithToken($token);

            } else {

                $data['statusMessage'] = 'User already exists';
            }          
        }

        return response()->json($data, $data['status']);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Invalid email or password'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'access_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}

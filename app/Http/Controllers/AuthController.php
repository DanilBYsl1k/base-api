<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\AuthRequest;
use App\Http\Requests\Auth\RestorePasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class AuthController extends BaseController
{

    public function login(): JsonResponse
    {
        try {
            $credentials = request(['email', 'password']);
            $token = auth()->attempt($credentials);

            if (!$token) {
                return $this->sendError('Unauthorized',['error' => 'Unauthorized'], 401);
            }
            $data = $credentials;
            $data['token'] = $token;

            return $this->respondWithToken($token);
        } catch (\Exception $exception) {
            return $this->sendError($exception->getMessage(), $exception->getCode());
        }
    }

    public function register(AuthRequest $request): JsonResponse
    {
        $data = $request->validated();

        $user = new User;
        $user->name = $data['email'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->save();

        return $this->sendResponse($data, 'user created successfully', 201);
    }

    public function profile()
    {
        $user = Auth::user();
        return $this->sendResponse($user);
    }

    public function logout(): JsonResponse
    {
        Auth::logout();
        return $this->sendResponse(null, 'Successfully logged out', 200);
    }

    public function refresh(): JsonResponse
    {
        $token = auth()->refresh();
        return $this->respondWithToken($token);
    }

    public function resetPassword(RestorePasswordRequest $request): JsonResponse
    {
        $data = $request->validated();

        $password = bcrypt($data['password']);

        User::where('email', $data['email'])->update(['password' => $password]);

        return $this->sendResponse(true, 'Password reset successfully', 200);
    }

    protected function respondWithToken($token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}

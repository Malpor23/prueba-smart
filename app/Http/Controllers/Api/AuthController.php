<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\UnauthorizedException;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{
    protected UserService $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function login(Request $request): JsonResponse
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            throw UnauthorizedException::invalidCredentials();
        }

        $user = $this->service->findWhere('email', $request->email)->first();
        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->responseWithToken($token, $user, 'Usuario autenticado exitosamente');
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $data = $request->only('name', 'email', 'password');

        $user = $this->service->create($data);
        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->responseWithToken($token, $user, 'Usuario registrado exitosamente');
    }

    public function logout(Request $request): JsonResponse
    {
        if (!$request->user()) {
            throw UnauthorizedException::notAuthenticated();
        }

        $request->user()->currentAccessToken()->delete();
        return $this->successResponse(null, 'Se sesión se ha cerrado exitosamente');
    }

    private function responseWithToken(string $token, User $user, string | null $message): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => new UserResource($user),
            'token' => $token
        ], Response::HTTP_OK);
    }
}

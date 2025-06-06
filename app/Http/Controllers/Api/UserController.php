<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\UnauthorizedException;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class UserController extends BaseController implements HasMiddleware
{
    private UserService $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public static function middleware(): array
    {
        return [
            new Middleware('auth:sanctum'),
            new Middleware('admin', only: ['index', 'store', 'show', 'update', 'destroy']),
        ];
    }

    public function index(Request $request): JsonResponse
    {
        if (!$request->user()->isAdmin()) {
            throw UnauthorizedException::notAuthorized();
        }

        $data = $this->service->all($request->all());
        return $this->respondWithCollection(UserResource::collection($data));
    }

    public function store(Request $request): JsonResponse
    {
        if (!$request->user()->isAdmin()) {
            throw UnauthorizedException::notAuthorized();
        }

        $user = $this->service->create($request->all());

        return $this->successResponse(
            new UserResource($user),
            'Usuario creada exitosamente'
        );
    }

    public function show(Request $request, int $id): JsonResponse
    {
        if (!$request->user()->isAdmin()) {
            throw UnauthorizedException::notAuthorized();
        }

        $data = $this->service->find($id);
        return $this->successResponse(new UserResource($data));
    }

    public function update(Request $request, int $id): JsonResponse
    {
        if (!$request->user()->isAdmin()) {
            throw UnauthorizedException::notAuthorized();
        }

        $input = $request->all();
        $category = $this->service->update($id, $input);

        return $this->successResponse(
            new UserResource($category),
            'Usuario actualizada exitosamente'
        );
    }

    public function destroy(Request $request, int $id): JsonResponse
    {
        if (!$request->user()->isAdmin()) {
            throw UnauthorizedException::notAuthorized();
        }

        $this->service->delete($id);
        return $this->successResponse(null, 'Usuario eliminada exitosamente');
    }
}

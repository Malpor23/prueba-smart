<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\UnauthorizedException;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class CategoryController extends BaseController implements HasMiddleware
{
    private CategoryService $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    public static function middleware(): array
    {
        return [
            new Middleware('auth:sanctum'),
            new Middleware('admin', only: ['store', 'update', 'destroy']),
        ];
    }

    public function index(Request $request): JsonResponse
    {
        if (!$request->user()) {
            throw UnauthorizedException::notAuthenticated();
        }

        $data = $this->service->all($request->all());
        return $this->respondWithCollection(CategoryResource::collection($data));
    }

    public function store(CategoryRequest $request): JsonResponse
    {
        if (!$request->user()) {
            throw UnauthorizedException::notAuthenticated();
        }

        if (!$request->user()->isAdmin()) {
            throw UnauthorizedException::notAuthorized();
        }

        $input = $request->all();
        $category = $this->service->create($input);
        return $this->successResponse(
            new CategoryResource($category),
            'Categoría creada exitosamente'
        );
    }

    public function show(Request $request, int $id): JsonResponse
    {
        if (!$request->user()) {
            throw UnauthorizedException::notAuthenticated();
        }

        $data = $this->service->find($id);
        return $this->successResponse(new CategoryResource($data));
    }

    public function update(CategoryRequest $request, int $id): JsonResponse
    {

        if (!$request->user()) {
            throw UnauthorizedException::notAuthenticated();
        }

        if (!$request->user()->isAdmin()) {
            throw UnauthorizedException::notAuthorized();
        }

        $input = $request->all();
        $category = $this->service->update($id, $input);

        return $this->successResponse(
            new CategoryResource($category),
            'Categoría actualizada exitosamente'
        );
    }

    public function destroy(Request $request, int $id): JsonResponse
    {

        if (!$request->user()) {
            throw UnauthorizedException::notAuthenticated();
        }

        if (!$request->user()->isAdmin()) {
            throw UnauthorizedException::notAuthorized();
        }

        $this->service->delete($id);
        return $this->successResponse(null, 'Categoría eliminada exitosamente');
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\UnauthorizedException;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ProductController extends BaseController implements HasMiddleware
{
    protected ProductService $service;

    public function __construct(ProductService $service)
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
        return $this->respondWithCollection(ProductResource::collection($data));
    }

    public function store(ProductRequest $request): JsonResponse
    {
        if (!$request->user()) {
            throw UnauthorizedException::notAuthenticated();
        }

        if (!$request->user()->isAdmin()) {
            throw UnauthorizedException::notAuthorized();
        }

        $input = $request->all();
        $product = $this->service->create($input);
        return $this->successResponse(
            new ProductResource($product),
            'Producto creado exitosamente'
        );
    }

    public function show(Request $request, int $id): JsonResponse
    {
        if (!$request->user()) {
            throw UnauthorizedException::notAuthenticated();
        }

        $data = $this->service->find($id);
        return $this->successResponse(new ProductResource($data));
    }

    public function update(ProductRequest $request, int $id): JsonResponse
    {
        if (!$request->user()) {
            throw UnauthorizedException::notAuthenticated();
        }

        if (!$request->user()->isAdmin()) {
            throw UnauthorizedException::notAuthorized();
        }

        $input = $request->all();
        $product = $this->service->update($id, $input);

        return $this->successResponse(
            new ProductResource($product),
            'Producto actualizado exitosamente'
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
        return $this->successResponse(null, 'Producto eliminado exitosamente');
    }
}

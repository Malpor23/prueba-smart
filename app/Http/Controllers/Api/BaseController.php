<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

abstract class BaseController extends Controller
{
    protected function successResponse($data, ?string $message = null, int $code = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function errorResponse(string $message, int $code, ?array $data = null): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];

        if ($data) {
            $response['data'] = $data;
        }

        return response()->json($response, $code);
    }


    protected function respondWithCollection(ResourceCollection $collection, ?string $message = null, int $code = 200): JsonResponse
    {
        $resourceData = $collection->response()->getData(true);

        $response = [
            'success' => true,
            'data' => $resourceData['data'],
        ];

        if (isset($resourceData['meta'])) {
            $response['meta'] = $resourceData['meta'];
        }

        if (isset($resourceData['links'])) {
            $response['links'] = $resourceData['links'];
        }

        if (!is_null($message)) {
            $response['message'] = $message;
        }

        return response()->json($response, $code);
    }
}

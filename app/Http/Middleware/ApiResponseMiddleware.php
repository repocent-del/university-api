<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;

class ApiResponseMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if ($response instanceof JsonResponse) {
            $original = $response->getData(true);
            $response->setData([
                'status' => $response->getStatusCode(),
                'success' => $response->getStatusCode() < 400,
                'data' => $original['data'] ?? $original,
                'meta' => $original['meta'] ?? null,
                'errors' => $original['errors'] ?? null,
                'message' => $original['message'] ?? null,
            ]);
        }

        return $response;
    }
}

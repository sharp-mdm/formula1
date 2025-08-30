<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class FallbackController extends Controller
{

    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        return response()->json([
            'message' => 'Resource not found.'
        ], 404);
    }
}

<?php

namespace App\Http\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait ApiResponser
{
    /**
     * Build a success response.
     *
     * @param  string|array|null  $data
     * @param  int  $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function successResponse($data = null, $code = Response::HTTP_OK): JsonResponse
    {
        return response()->json(['data' => $data], $code);
    }

    /**
     * Build an error response.
     *
     * @param  string|array  $message
     * @param  int  $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function errorResponse($message, $code): JsonResponse
    {
        $errorCode = is_numeric($code) ? $code : Response::HTTP_INTERNAL_SERVER_ERROR;

        return response()->json(['error' => $message], $errorCode);
    }

    /**
     * Build a JSON response.
     *
     * @param  string|array|null  $data
     * @param  int  $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function jsonResponse($data = null, $code = Response::HTTP_OK): JsonResponse
    {
        return response()->json($data, $code);
    }
}

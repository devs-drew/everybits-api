<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * Render an exception into an HTTP response.
     */
    public function render($request, Throwable $exception): JsonResponse
    {
        // Handle authentication exceptions.
        if ($exception instanceof AuthenticationException) {
            return response()->json([
                'message' => 'Unauthenticated.'
            ], 401);
        }

        // Handle model not found exceptions.
        if ($exception instanceof ModelNotFoundException) {
            $model = class_basename($exception->getModel());
            return response()->json([
                'message' => "{$model} not found."
            ], 404);
        }

        // Handle query exceptions.
        if ($exception instanceof QueryException) {
            return response()->json([
                'message' => "Oops! Something went wrong while processing your request. Please try again later."
            ], 500);
        }

        return parent::render($request, $exception);
    }
}

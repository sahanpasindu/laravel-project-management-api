<?php

namespace App\Exceptions;

use Illuminate\Http\Request;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Throwable;

class ApiExceptionHandler
{
    public function register(Exceptions $e): void
    {
        $e->renderable(fn(NotFoundHttpException $ex, $req)
            => $this->json($req, $ex, $this->resolveNotFoundMessage($ex), 404));

        $e->renderable(fn(AuthenticationException $ex, $req)
            => $this->json($req, $ex, 'You must be authenticated', 401));

        $e->renderable(fn(AuthorizationException $ex, $req)
            => $this->json($req, $ex, 'You are not authorized', 403));

        $e->renderable(fn(Throwable $ex, $req)
            => $this->json($req, $ex, 'Server error', 500));
    }

    protected function resolveNotFoundMessage(NotFoundHttpException $ex): string
    {
        return $ex->getPrevious() instanceof ModelNotFoundException
            ? 'Resource not found'
            : 'Endpoint not found';
    }

    protected function json($req, $ex, $msg, $code)
    {
        if (!$req->is('api/*')) {
            return null;
        }

        return response()->json([
            'message' => $msg,
            'status' => $code,
            'error' => app()->environment('local') ? $ex->getMessage() : null,
        ], $code);
    }
}

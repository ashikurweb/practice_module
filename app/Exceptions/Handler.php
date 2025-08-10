<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    protected $dontReport = [
        //
    ];

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof \Illuminate\Auth\Access\AuthorizationException) {
            return response()->view('errors.403', [], 403);
        }

        if ($exception instanceof \Illuminate\Validation\ValidationException) {
            return response()->view('errors.404', [], 404);
        }

        return parent::render($request, $exception);
    }
}
<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Route;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        /**
         * Respond with fallback route when NotFoundHttpException occured
         */
        if ($exception instanceof NotFoundHttpException) {
            return Route::respondWithRoute('fallback');
        }

        /**
         * Respond with fallback route when ModelNotFoundException occured
         */
        if ($exception instanceof ModelNotFoundException) {
            return Route::respondWithRoute('fallback');
        }

        /**
         * Respond with 405 route when MethodNotAllowedHttpException occured
         */
        if ($exception instanceof MethodNotAllowedHttpException) {
            return response()->json([
                'error' => 'Method is not allowed for the requested route!',
            ], 405);
        }

        return parent::render($request, $exception);
    }
}

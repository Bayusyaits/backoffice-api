<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
        // \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException::class,
        "\Symfony\Component\HttpKernel\Exception\HttpException",
        "\Illuminate\Database\Eloquent\ModelNotFoundException"
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
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        if ($exception instanceof CustomException) {
            //
        }

        return parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if($e instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException){
            return api_404();
        }

        if($e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException){
            return api_404();
        }

        if($e instanceof \App\Exceptions\CustomException){
            return $e->render($request);
        }

        $response = parent::render($request, $e);

        if ($request->is('api/*')) {
            app('Asm89\Stack\CorsService')->addActualRequestHeaders($response, $request);
        }

        return $response;
    }
}

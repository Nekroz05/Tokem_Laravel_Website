<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

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
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (Throwable $exception) {

            if($this->isHttpException($exception)){
                if($exception->getStatusCode()=='404'){
                    return response()->view('error',['error'=>'Error 404 Cuyy']);
                }
                if($exception->getStatusCode()=='403'){
                    return response()->view('error',['error'=>'Error 403 Cuyy']);
                }
            }
            // return parent::render($request, $exception);
        });
    }
}

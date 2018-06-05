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
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        //dd($exception);
        if ($exception instanceof AuthorizationException) {
            return response()->json(['error' => $exception->getMessage(), 'code' => 403], 403);
        }
        return parent::render($request, $exception);
    }
        /**
     * Convert an authentication exception into a response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    // protected function unauthenticated($request, AuthenticationException $exception)
    // {
    //     return parent::unauthenticated($request, $exception);
    //     return ($request->expectsJson() || $request->ajax())
    //                 ? response()->json(['message' => $exception->getMessage()], 401)
    //                 : redirect()->guest(route('login'));
    // }
}

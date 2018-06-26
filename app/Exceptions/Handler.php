<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Validation\ValidationException;
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
        //$guard = array_get($exception->guards(), 0);
        //dd($exception->guards());
 // dd($exception);
        if ($exception instanceof AuthorizationException) {
            return response()->json(['error' => $exception->getMessage(), 'code' => 401], 401);
        }
        if ($exception instanceof ValidationException) {
                $res = [
                    'message' => $exception->getMessage(),
                    'errors' => $exception->errors(),
                ];
                return response()->json($res, 400);
                
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
    public function unauthenticated($request, AuthenticationException $exception)
    {
        //return response()->json(['mess'=>false]);
        //dd($request->route());
        $guard = array_get($exception->guards(), 0);
        
        switch ($guard) {
            case 'api':
                return response()->json(['messages' => $exception->getMessage()], 401);
                break;
            
            // case 'admin':
            //     return ($request->expectsJson() || $request->ajax())
            //         ? response()->json(['message' => $exception->getMessage()], 401)
            //         : redirect()->guest(route('admin.login'));
            //     break;

            default:
                return ($request->expectsJson() || $request->ajax())
                        ? response()->json(['message' => $exception->getMessage()], 401)
                        : redirect()->guest(route('admin.login'));
                break;
        }
        // return response()->json(['message' => $exception->getMessage()], 401);
        // return ($request->expectsJson() || $request->ajax())
        //             ? response()->json(['message' => $exception->getMessage()], 401)
        //             : redirect()->guest(route('admin.login'));
    }
}

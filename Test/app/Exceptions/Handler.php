<?php
namespace App\Exceptions;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
class Handler extends ExceptionHandler
{

    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    public function render($request, Exception $exception)
    {

        if ($request->wantsJson())
        {
            $response = [
                'errors' => 'Sorry, something went wrong.'
            ];
            if (config('app.debug'))
            {
                $response['exception'] = get_class($exception);
                $response['message'] = $exception->getMessage();
                $response['trace'] = $exception->getTrace();
            }
            $status = 400;
            if ($exception instanceof HttpException)
            {
                $status = $exception->getStatusCode();
            }
            return response()->json($response, $status);
        }
        return parent::render($request, $exception);
    }
}
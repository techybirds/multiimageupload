<?php

namespace App\Exceptions;

use App\Models\StatusCode;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
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
        $this->reportable(function (Throwable $e) {
            //
        });
    }


    public function render($request, Throwable $exception)
    {
        if ($exception instanceof NotFoundHttpException && $request->wantsJson()) {

            return response()->api(StatusCode::RESOURCE_NOT_FOUND,'Resource not found on this endpoint', null);
        }

        if ($exception instanceof HttpException && $request->wantsJson()) {

            $app = Application::getInstance();

            if(true == $app->isDownForMaintenance()) {

                return response()->api(StatusCode::MAINTENANCE_MODE,'Server is in maintenance mode', null);
            }
        }


        return parent::render($request, $exception);
    }
}

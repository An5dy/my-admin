<?php

namespace App\Exceptions;

use Exception;
use App\Helpers\APIResponse;
use App\Helpers\ResponseMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\Permission\Exceptions\PermissionAlreadyExists;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    use APIResponse;

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
        if ($exception instanceof PermissionAlreadyExists) {

            return $this->failedResponse(
                '当前权限已存在。',
                JsonResponse::HTTP_CONFLICT);
        }
        if ($exception instanceof ModelNotFoundException) {

            return $this->failedResponse(
                ResponseMessage::HTTP_NOT_FOUND,
                JsonResponse::HTTP_NOT_FOUND);
        }
        if ($exception instanceof ValidationException) {

            return $this->failedResponse(
                collect($exception->errors())->flatten()->first(),
                JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
        if ($exception instanceof UnauthorizedException) {
            return $this->failedResponse(
                ResponseMessage::HTTP_FORBIDDEN,
                JsonResponse::HTTP_FORBIDDEN);
        }

        return parent::render($request, $exception);
    }
}

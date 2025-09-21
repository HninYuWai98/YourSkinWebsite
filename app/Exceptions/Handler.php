<?php

namespace App\Exceptions;

use App\Foundations\Exceptions\CustomGeneralException;
use App\Foundations\Exceptions\DuplicateEntryException;
use App\Foundations\Exceptions\FatalErrorException;
use App\Foundations\Exceptions\NotFoundResourceException;
use App\Foundations\Exceptions\UnauthenticatedException;
use App\Foundations\Exceptions\ValidationException;
use App\Foundations\Routing\Formatter;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use Illuminate\Auth\AuthenticationException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Sentry\Laravel\Integration;


class Handler extends ExceptionHandler
{
    protected $dontReport = [
        ValidationException::class,
        UnauthenticatedException::class,
        NotFoundResourceException::class,
        DuplicateEntryException::class,
    ];
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            Integration::captureUnhandledException($e);
        });

        if (request()->wantsJson()) {
            $this->renderable(function (Exception $exception) {
                return $this->handle($exception);
            });
        }

    }

    public function render($request, \Exception|Throwable $e)
    {
        $statusCode = $e->getCode() == 0 ? 404 : $e->getCode();

        if (get_class($e) == "App\Foundations\Exceptions\FatalErrorException") {
            return response()->json([
                'message' => $e->getMessage()
            ], $statusCode);
        }
        return parent::render($request, $e);
    }

    public function handle(Exception $e): JsonResponse
    {
        $customCode = null;
        $statusCode = $e->getCode();
        $errMessage = $e->getMessage();

        if ($e instanceof MethodNotAllowedHttpException) {
            $statusCode = $e->getStatusCode();
            $errMessage = 'The requested method is not supported for this route.';
        }

        if ($e instanceof FatalErrorException) {
            $statusCode = $e->getCode();
            $errMessage = $e->getMessage();
        }

        if ($e instanceof NotFoundHttpException) {
            $statusCode = $e->getStatusCode();
            $errMessage = 'The requested route does not exist.';
        }

        if ($e instanceof AuthenticationException) {
            $statusCode = 401;
        }

        if ($e instanceof CustomGeneralException) {
            $statusCode = 400;
            $customCode = $statusCode;
            $errMessage = $e->getMessage();
        }

        if ($e instanceof ValidationException) {
            $statusCode = 422;
            $customCode = $statusCode;
            $errMessage = $e->getMessage();
        }

        if ($e instanceof TokenExpiredException) {
            $statusCode = 401;
            $customCode = $statusCode;
            $errMessage = $e->getMessage();
        }
        \Sentry\captureException($e);
        return Formatter::factory()->throwException($errMessage, $statusCode, $customCode);
    }
}

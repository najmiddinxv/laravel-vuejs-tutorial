<?php

namespace App\Exceptions;


use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Exceptions\PermissionAlreadyExists;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Spatie\Permission\Exceptions\RoleAlreadyExists;
use Exception;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use TypeError;


class Handler extends ExceptionHandler
{
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
            //
        });
        $this->renderable(function (Exception $e, $request) {

            if ($request->expectsJson() || $request->is('api/*')) {
                // Non standard errors handler
                if ($e instanceof ModelNotFoundException) {
                    $message = $e->getMessage();
                    if (str_contains($message, 'No query results for model')) {
                        $message = __('lang.no_records');
                    }

                    return sendError(message:$message);

                    // return response()->json([
                    //     'success' => false,
                    //     'code' => 404,
                    //     'message' => $message,
                    //     'data' => []
                    // ], 404);
                }

                if ($e instanceof NotFoundHttpException) {
                    //route not found

                    return sendError(message: __('lang.not_found'));
                    // yoki bu usulda
                    // return response()->json([
                    //    'success' => false,
                    //    'code' => 404,
                    //    'message' => __('lang.not_found'),
                    //    'data' => []
                    // ], 404);

                    // yoki bu usulda
                    // return response()->json([
                    //     'error' => true,
                    //     'code' => 404,
                    //     'message' => __('lang.no_records'),
                    //     'data' => []
                    // ], 404);

                }
                if ($e instanceof AuthorizationException) {
                    return sendError(code:403, message: $e->getMessage());
                    // return response()->json([
                    //     'success' => false,
                    //     'code' => 403,
                    //     'message' => $e->getMessage(),
                    //     'data' => []
                    // ], 403);
                }

                if ($e instanceof UnauthorizedException) {
                    return sendError(code:403, message: 'You dont have permissions to do this action');
                    // return response()->json([
                    //     'success' => false,
                    //     'code' => 403,
                    //     'message' => 'You dont have permissions to do this action',
                    //     'data' => []
                    // ], 403);
                }
                if ($e instanceof RoleAlreadyExists) {
                    return sendError(code:422, message: 'This role already exists');
                    // return response()->json([
                    //     'success' => false,
                    //     'code' => 422,
                    //     'message' => 'This role already exists',
                    //     'data' => []
                    // ], 422);
                }

                if ($e instanceof MethodNotAllowedHttpException) {
                    return sendError(code:405, message: $e->getMessage());

                    // return response()->json([
                    //     'success' => false,
                    //     'code' => 405,
                    //     'message' => $e->getMessage(),
                    //     'data' => []
                    // ], 405);
                }

                if ($e instanceof AuthenticationException) {
                    return sendError(code:401, message: $e->getMessage());

                    // return response()->json([
                    //     'success' => false,
                    //     'code' => 401,
                    //     'message' => $e->getMessage(),
                    //     'data' => []
                    // ], 401);
                }

                if ($e instanceof Exception) {
                    return sendError(code:500, message: $e->getMessage());
                    // return response()->json([
                    //     'success' => false,
                    //     'code' => 500,
                    //     'message' => $e->getMessage(),
                    //     'data' => [],
                    //     // 'file'    => $e->getFile(),
                    //     // 'line'    => $e->getLine(),
                    //     // 'data'    => $e->getTrace(), // buni commentdan chiqarsak birdunyo laravelni errorlarini chiqaradi
                    // ], 500);
                }
            }

        });
    }

}

<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Database\QueryException;
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
        if($exception instanceof ValidationException){
            return $this->convertValidationExceptionToResponse($exception, $request);
        }
        if($exception instanceof ModelNotFoundException){
            $modelo = strtolower(class_basename($exception->getModel()));
            return response()->json(['data' => "No existe ninguna instancia de {$modelo} con el id especificado",'code' => 404], 404);
            //return response()->json("No existe ninguna instancia de {$modelo} con el id especificado", 404);
        }
        if($exception instanceof AuthenticationException){
            return $this->unauthenticated($request, $exception);
        }
        if($exception instanceof AuthorizationException){
            return response()->json(['error' => "No posee permisos para ejecutar esta accion ", 'code' => 403],403);
        }
        if($exception instanceof AuthorizationException){
            return response()->json("No posee permisos para ejecutar esta accion ",403);
        }
        if($exception instanceof NotFoundHttpException){
            return response()->json("No se encotró la URL especificada",404);
        }
        if($exception instanceof MethodNotAllowedHttpException){
            return response()->json(['error'=>"El método especificado en la petición no es válido", 'code' => 405],405);
        }
        if($exception instanceof HttpException){
            return response()->json(['error' => $exception->getMessage, 'code' => $exception->getCode],$exception->getCode);
        }
        if($exception instanceof QueryException){
            $codigo = $exception->errorInfo[1];
            if($codigo == 1451){
                return response()->json(['error' => 'No se puede eliminar de forma permanente el recurso porque está relacionado con algun otro', 'code' => 409],409);
            }
        }    
        
        if(config('app.debug')){
            return parent::render($request, $exception);
        }

        return response()->json(['error' => 'Falla inesperada. Intente luego', 'code' => 500],500); 

    }

    /*protected function unauthenticated($request, AuthenticationException $exception){
        return response()->json("No autenticado", 401);
    }*/

    /**
     * Create a response object from the given validation exception.
     *
     * @param  \Illuminate\Validation\ValidationException  $e
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {
        $errors = $e->validator->errors()->getMessages();

        return response()->json($errors,422);
    }
    
}

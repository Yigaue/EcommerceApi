<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait ExceptionTrait

{

    public function ApiException($request, $e)

    {
        if($this->isModel($e)){

            return $this->httpResponse();

        }

            if($this->isHTTP($e)){

                return $this->modelResponse();

            }

    }

    public function isModel($e)
    {
        return $e instanceof ModelNotFoundException;
    }

    public function isHTTP($e)

    {
        return $e instanceof NotFoundHttpException;
    }

    public function modelResponse()

    {
        return response()->json(

            [
                'message' => 'route not found'
            ],

            Response::HTTP_NOT_FOUND);
    } 

    public function httpResponse()

    {
        return response()->json(

            [
            'message' => 'Product model not found'
            ],

            Response::HTTP_NOT_FOUND);
    }
}

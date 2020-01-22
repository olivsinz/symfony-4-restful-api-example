<?php

namespace App\Normalizer;

use Symfony\Component\HttpFoundation\Response;

class MethodNotAllowedHttpExceptionNormalizer extends AbstractNormalizer
{
    public function normalize(\Exception $exception)
    {
        $result['code'] = Response::HTTP_METHOD_NOT_ALLOWED;

        $result['body'] = [
            'code' => Response::HTTP_METHOD_NOT_ALLOWED,
            'message' => $exception->getMessage()
        ];

        return $result;
    }
}

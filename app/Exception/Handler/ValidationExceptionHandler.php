<?php
/**
 * Project: hyperf-jwt-api.
 * Author: Kwin
 * QQ:284843370
 * Email:kwinwong@hotmail.com
 */

namespace App\Exception\Handler;


use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\Validation\ValidationException;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class ValidationExceptionHandler extends ExceptionHandler
{
    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        $this->stopPropagation();
        /** @var \Hyperf\Validation\ValidationException $throwable */
        $body = json_encode(
            [
                'msg' => '字段验证未通过',
                'code' => 422,
                'data' => $throwable->validator->errors()
            ], JSON_UNESCAPED_UNICODE);


        if (! $response->hasHeader('content-type')) {
            $response = $response->withAddedHeader('content-type', 'application/json; charset=utf-8');
        }
        return $response->withStatus(200)->withBody(new SwooleStream($body));
    }

    public function isValid(Throwable $throwable): bool
    {
        return $throwable instanceof ValidationException;
    }
}
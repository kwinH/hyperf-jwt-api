<?php
/**
 * Project: hyperf-api.
 * Author: Kwin
 * QQ:284843370
 * Email:kwinwong@hotmail.com
 */

declare(strict_types=1);

namespace App\Middleware;

use App\Model\User;
use Hyperf\HttpServer\Contract\ResponseInterface as HttpResponse;
use Hyperf\Utils\Context;
use Phper666\JWTAuth\JWT;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class JwtAuthMiddleware implements MiddlewareInterface
{
    /**
     * @var HttpResponse
     */

    protected $response;
    protected $jwt;

    public function __construct(HttpResponse $response, JWT $jwt)
    {
        $this->response = $response;
        $this->jwt = $jwt;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            if ($this->jwt->checkToken()) {
                $jwtData = $this->jwt->getParserData();

                //更改上下文，写入用户信息
                //User模型自行创建
                $user = User::query()
                    ->where('id', $jwtData['uid'])
                    ->first();

                if (!$user) {
                    throw new \Exception('Unauthorized', 401);
                }

                $request = Context::get(ServerRequestInterface::class);
                $request = $request->withAttribute('user', $user);
                Context::set(ServerRequestInterface::class, $request);

                return $handler->handle($request);
            } else {
                throw new \Exception('Unauthorized', 401);
            }
        } catch (\Exception $e) {
            $data = [
                'code' => 401,
                'msg' => '对不起，token验证没有通过',
                'data' => "",
            ];
            return $this->response->json($data);
        }
    }
}
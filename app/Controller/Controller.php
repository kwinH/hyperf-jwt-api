<?php
/**
 * Project: hyperf-jwt-api.
 * Author: Kwin
 * QQ:284843370
 * Email:kwinwong@hotmail.com
 */

declare(strict_types=1);

namespace App\Controller;

use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Psr\Container\ContainerInterface;

class Controller
{
    /**
     * @Inject
     *
     * @var ContainerInterface
     */
    protected $container;
    /**
     * @Inject
     *
     * @var RequestInterface
     */
    protected $request;
    /**
     * @Inject
     *
     * @var ResponseInterface
     */
    protected $response;

    /**
     * 请求成功
     *
     * @param        $data
     * @param string $message
     *
     * @return array
     */
    public function success($data, $message = 'success')
    {
        $code = $this->response->getStatusCode();
        return ['code' => $code, 'msg' => $message, 'data' => $data];
    }

    /**
     * 请求失败.
     *
     * @param string $message
     *
     * @return array
     */
    public function failed($message = '', $code = 500)
    {
        return ['code' => 500, 'msg' => $message, 'data' => ''];
    }
}
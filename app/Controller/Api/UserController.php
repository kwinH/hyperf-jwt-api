<?php
/**
 * Project: hyperf-jwt-api.
 * Author: Kwin
 * QQ:284843370
 * Email:kwinwong@hotmail.com
 */

declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\Controller;
use Hyperf\Di\Annotation\Inject;
use Phper666\JWTAuth\JWT;

class UserController extends Controller
{

    /**
     * @Inject()
     * @var JWT
     */
    protected $jwt;

    /**
     * 获取用户信息
     * @return [type] [description]
     */
    public function info()
    {
        //获取用户数据
        $user = $this->request->getAttribute('user');
        return $this->success($user);

    }


    public function editName()
    {
        $user = $this->request->getAttribute('user');
        $user->name = $this->request->input('name');
        if ($user->save()) {
            return $this->success(null, '编辑成功');
        }

        return $this->failed('编辑失败');
    }


}
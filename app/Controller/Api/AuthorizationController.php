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
use App\Model\User;
use App\Request\UserRegisterRequest;
use Hyperf\Di\Annotation\Inject;
use Phper666\JWTAuth\JWT;

class AuthorizationController extends Controller
{
    /**
     * @Inject
     *
     * @var JWT
     */
    protected $jwt;


    /**
     * 注册
     * @return array
     */
    public function register(UserRegisterRequest $request)
    {
        $data['mobile'] = $request->input('mobile');
        if (
        User::query()
            ->where('mobile', $data['mobile'])
            ->count()
        ) {
            return $this->failed('该号码已注册');
        }

        $data['password'] = password_hash($request->input('password'), PASSWORD_DEFAULT);
        if (User::query()->create($data)) {
            return $this->success(null, '注册成功');
        }

        return $this->failed('注册失败');
    }


    /**
     * 用户登录.
     *
     * @return array
     */
    public function login()
    {
        $user = User::query()->where('mobile', $this->request->input('mobile'))->first();
        //验证用户账户密码
        if (!empty($user->password) && password_verify($this->request->input('password'), $user->password)) {
            $userData = [
                'uid' => $user->id,
                'mobile' => $user->mobile,
            ];
            $token = $this->jwt->getToken($userData);
            $data = [
                'token' => (string)$token,
                'exp' => $this->jwt->getTTL(),
            ];
            return $this->success($data);
        }
        return $this->failed('登录失败');
    }

    /**
     * 用户退出
     * @return array
     */
    public function logout()
    {
        if ($this->jwt->logout()) {
            return $this->success('', '退出登录成功');
        };
        return $this->failed('退出登录失败');
    }
}
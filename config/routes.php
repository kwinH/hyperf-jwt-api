<?php

declare(strict_types=1);

/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

use Hyperf\HttpServer\Router\Router;

Router::addRoute(['GET', 'POST', 'HEAD'], '/', 'App\Controller\IndexController@index');
Router::addRoute(['GET', 'POST', 'HEAD'], '/test/{id}', 'App\Controller\IndexController@test');


Router::addGroup('/api/', function () {
    Router::post('login', 'App\Controller\Api\AuthorizationController@login');
    Router::post('register', 'App\Controller\Api\AuthorizationController@register');


//个人资料
    Router::addGroup('user/', function () {
        Router::post('logout', 'App\Controller\Api\AuthorizationController@logout');
        Router::get('info', 'App\Controller\Api\UserController@info');
        Router::put('edit_name', 'App\Controller\Api\UserController@editName');
    }, [
        'middleware' => [App\Middleware\JwtAuthMiddleware::class]
    ]);
});

<?php

namespace App\Http\Middleware;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }


    //ADD>>> PUKYO.shenjianghui 2021-10-25 禅道0 认证失败，统一返回认证失败json结果
    protected function unauthenticated($request, array $guards)
    {
        if (in_array('admin', $guards)){
            return ;  //admin验证失败，这里不做处理.
        }

        throw new AuthenticationException(
            'Unauthenticated.', $guards, $this->redirectTo($request)
        );
    }
    //<<<ADD PUKYO.shenjianghui 2021-10-25 禅道0 认证失败，统一返回认证失败json结果
}

<?php

namespace App\Api\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * 不需要登录的方法
     */
    public $not_need_login = [];

    /**
     * 是否免登录验证
     * @return bool
     */
    public function isNotNeedLogin()
    {
        $not_need_login = $this->not_need_login;

        if (empty($not_need_login)) {
            return false;
        }

        $action = request()->route()->getActionMethod();

        if (!in_array(trim($action), $not_need_login)) {
            return false;
        }

        return true;
    }
}

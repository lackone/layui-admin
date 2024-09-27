<?php

namespace App\Admin\Services;

use App\Models\Config;

class ConfigService
{
    /**
     * 获取参数
     * @param $key
     * @param $sub_key
     * @return array|mixed|string
     */
    public static function getConfig($key, $sub_key = '')
    {
        $configs = Config::getAllConfigs($key);
        if ($sub_key) {
            return $configs[$key][$sub_key] ?: '';
        }
        return $configs;
    }
}

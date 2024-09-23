<?php

if (!function_exists('ps')) {
    /**
     * 打印sql
     */
    function ps()
    {
        \Illuminate\Support\Facades\DB::listen(function ($query) {
            $bindings = $query->bindings;
            $sql = $query->sql;
            foreach ($bindings as $replace) {
                $value = is_numeric($replace) ? $replace : "'" . $replace . "'";
                $sql = preg_replace('/\?/', $value, $sql, 1);
            }
            dump($sql);
        });
    }
}

if (!function_exists('adminAsset')) {
    /**
     * 后台资源路径生成
     */
    function adminAsset($path): string
    {
        $theme = config('admin.theme', 'pear_admin_layui');
        $path = $theme . '/' . ltrim($path, '/');

        return (config('admin.https') || config('admin.secure')) ? secure_asset($path) : asset($path);
    }
}

if (!function_exists('success')) {
    /**
     * 成功
     */
    function success($data = [], $msg = 'success', $code = 200)
    {
        if (is_array($data) && empty($data)) {
            $data = (object)$data;
        }
        $result = [
            'code' => $code,
            'msg' => $msg,
            'data' => $data,
        ];
        return response()->json($result, 200);
    }
}

if (!function_exists('error')) {
    /**
     * 错误
     */
    function error($msg = 'error', $data = [], $code = 500)
    {
        if (is_array($data) && empty($data)) {
            $data = (object)$data;
        }
        $result = [
            'code' => $code,
            'msg' => $msg,
            'data' => $data,
        ];
        return response()->json($result, 200);
    }
}

if (!function_exists('getRealIp')) {
    /**
     * 获取真实IP
     * @return mixed|string
     */
    function getRealIp()
    {
        if (isset($_SERVER['HTTP_X_REAL_IP'])) {
            $ip = $_SERVER['HTTP_X_REAL_IP'];
        } else if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $ip = trim(current($ip));
        } elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip = $_SERVER['REMOTE_ADDR'];
        } else {
            $ip = '0.0.0.0';
        }
        return $ip;
    }
}

if (!function_exists('makeTree')) {
    /**
     * 生成树型数据
     * @param array $items 数组数据
     * @param string $id ID字段名
     * @param string $pid 父级ID字段名
     * @param string $son 子类数组下标名
     */
    function makeTree($items, $id = 'id', $pid = 'pid', $son = 'children')
    {
        $tree = [];
        $tmp = [];
        foreach ($items as $item) {
            $tmp[$item[$id]] = $item;
        }
        foreach ($items as $item) {
            if (isset($tmp[$item[$pid]])) {
                $tmp[$item[$pid]][$son][] = &$tmp[$item[$id]];
            } else {
                $tree[] = &$tmp[$item[$id]];
            }
        }
        unset($tmp);
        return $tree;
    }
}

if (!function_exists('paramConvert')) {
    /**
     * 参数转换
     */
    function paramConvert($param, $type)
    {
        $type = strtolower(trim($type));
        switch ($type) {
            case 'array':
                if (is_array($param)) {
                    return $param;
                }
                if (stripos($param, ',') !== false) {
                    return explode(',', (string)$param);
                }
                if (json_decode($param)) {
                    return (array)json_decode($param, true);
                }
                return (array)$param;
            case 'object':
                return (object)$param;
            case 'string':
                return (string)$param;
            case 'int':
                return (int)$param;
            case 'float':
                return (float)$param;
            case 'time':
                return strtotime($param) !== false ? strtotime($param) : $param;
            case 'datetime':
                return $param ? date('Y-m-d H:i:s', (int)$param) : '';
            default:
                return $param;
        }
    }
}

if (!function_exists('checkAuth')) {
    /**
     * 权限验证
     */
    function checkAuth($admin_id, $auth)
    {
        return \App\Admin\Services\RBACService::checkAuth($admin_id, $auth);
    }
}

if (!function_exists('authRoute')) {
    /**
     * 权限路由
     */
    function authRoute($name, $parameters = [], $absolute = false)
    {
        return trim(route($name, $parameters, $absolute), '/');
    }
}

if (!function_exists('jsonEncode')) {
    /**
     * json编码
     */
    function jsonEncode($data)
    {
        return json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}

if (!function_exists('getWeek')) {
    /**
     * 获取指定时间所在的周一与周日
     */
    function getWeek($today = 0)
    {
        !$today && $today = date('Y-m-d');
        return [
            date('Y-m-d', strtotime('monday this week', strtotime($today))),
            date('Y-m-d', strtotime('sunday this week', strtotime($today)))
        ];
    }
}

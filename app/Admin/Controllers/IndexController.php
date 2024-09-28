<?php

namespace App\Admin\Controllers;

use App\Admin\Services\RBACService;
use App\Admin\Services\UserService;
use App\Models\AdminAuth;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * 首页
     */
    public function index(Request $request)
    {
        return view('index.index', compact(''));
    }

    /**
     * 配置
     * @param Request $request
     */
    public function config(Request $request)
    {
        $admin_id = session('admin_id');
        $menu_tree = RBACService::authTreeById($admin_id, AdminAuth::TYPE_MENU);

        UserService::generateMenu($menu_tree);

        array_unshift($menu_tree, [
            'id' => 'space',
            'title' => '工作空间',
            'type' => 0,
            'icon' => 'layui-icon layui-icon-console',
            'children' => [
                [
                    'id' => 'welcome',
                    'title' => '欢迎页',
                    'type' => 1,
                    'icon' => 'layui-icon layui-icon-home',
                    'href' => route('admin.welcome', [], false),
                    'openType' => '_component',
                ],
            ],
        ]);

        $config = config('admin.pear_admin_layui_config');

        $config['logo']['title'] = cfg('website', 'admin_index_title') ?: config('admin.default_login_title');
        $config['logo']['image'] = cfg('website', 'admin_logo') ?: config('admin.default_logo');
        $config['menu']['data'] = $menu_tree;

        $config['tab']['index']['href'] = route('admin.welcome', [], false);

        return response()->json($config);
    }

    /**
     * 欢迎
     */
    public function welcome(Request $request)
    {
        $admin_id = session('admin_id');
        $role_name = RBACService::roleNameById($admin_id);

        return view('index.welcome', compact('role_name'));
    }

    /**
     * 登录
     */
    public function login(Request $request)
    {
        $params = $request->all();

        if ($request->ajax()) {
            try {
                if (!$params['account'] || !$params['password']) {
                    throw new \Exception('账号和密码不能为空');
                }

                $res = UserService::login($params['account'], $params['password']);

                return success($res);
            } catch (\Exception $e) {
                return error($e->getMessage());
            }
        }

        return view('index.login');
    }

    /**
     * 登出
     */
    public function logout(Request $request)
    {
        session()->flush();

        if ($request->ajax()) {
            return success();
        }

        return redirect(route('admin.login'));
    }

    /**
     * 错误
     */
    public function forbidden(Request $request)
    {
        $msg = $request->input('msg');

        return view('index.forbidden', compact('msg'));
    }

    /**
     * 文件上传
     * @param Request $request
     */
    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $path = $request->file->store(date('Ym') . '/' . date('d'), 'uploads');
            $path = '/uploads/' . ltrim($path, '/');

            if ($request->header('wangEditor')) {
                return response()->json([
                    'errno' => 0,
                    'data' => [['url' => $path]],
                ]);
            }

            return success([
                'ext' => $request->file->extension(),
                'path' => $path,
                'url' => asset($path),
                'name' => $request->file->getClientOriginalName(),
                'size' => $request->file->getSize(),
            ]);
        }

        $data = [];
        for ($i = 1; $i <= 5; $i++) {
            $key = 'file' . $i;
            if ($request->hasFile($key)) {
                $path = $request->{$key}->store(date('Ym') . '/' . date('d'), 'uploads');
                $path = '/uploads/' . ltrim($path, '/');

                $data[] = [
                    'url' => $path,
                ];
            }
        }

        if ($data) {
            if ($request->header('wangEditor')) {
                return response()->json([
                    'errno' => 0,
                    'data' => $data,
                ]);
            }
        }

        return error('请重新上传文件');
    }
}

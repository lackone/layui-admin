<?php

namespace App\Admin\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConfigController extends Controller
{
    /**
     * 网站设置
     */
    public function website(Request $request)
    {
        $params = $request->all();

        if ($request->isMethod('POST')) {
            $insert = [];

            if ($params['config']) {
                foreach ($params['config'] as $key => $item) {
                    if (is_array($item)) {
                        foreach ($item as $sub_key => $v) {
                            $insert[] = [
                                'key' => $key,
                                'sub_key' => $sub_key,
                                'value' => $v,
                            ];
                        }
                    } else {
                        $insert[] = [
                            'key' => $key,
                            'sub_key' => '',
                            'value' => $item,
                        ];
                    }
                }
            }

            $insert && Config::upsert($insert, ['key', 'sub_key', 'value']);

            return success();
        }

        $config = Config::getAllConfigs('website');

        return view('config.website', compact('params', 'config'));
    }

    /**
     * 微信设置
     * @param Request $request
     */
    public function weixin(Request $request)
    {
        $params = $request->all();

        if ($request->isMethod('POST')) {
            $insert = [];

            if ($params['config']) {
                foreach ($params['config'] as $key => $item) {
                    if (is_array($item)) {
                        foreach ($item as $sub_key => $v) {
                            $ext = '';

                            if (in_array($sub_key, ['pay_private_key', 'pay_certificate'])) {
                                $day = date('YmdHis');
                                $path = "{$day}_{$sub_key}.pem";
                                Storage::disk('cert')->put($path, $v);
                                $ext = Storage::disk('cert')->path($path);
                            }

                            $insert[] = [
                                'key' => $key,
                                'sub_key' => $sub_key,
                                'value' => $v,
                                'ext' => $ext,
                            ];
                        }
                    } else {
                        $insert[] = [
                            'key' => $key,
                            'sub_key' => '',
                            'value' => $item,
                            'ext' => '',
                        ];
                    }
                }
            }

            $insert && Config::upsert($insert, ['key', 'sub_key', 'value', 'ext']);

            return success();
        }

        $config = Config::getAllConfigs('weixin');

        return view('config.weixin', compact('params', 'config'));
    }
}

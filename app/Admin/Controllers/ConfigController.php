<?php

namespace App\Admin\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;

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
}

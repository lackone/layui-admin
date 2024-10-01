<?php

namespace App\Models;

class Config extends BaseModel
{

    /**
     * 获取指定key的配置
     * @param $key
     * @param $ext 是否取扩展数据
     * @return array
     */
    protected function getAllConfigs($key = '', $ext = false)
    {
        $list = $this->where(function ($query) use ($key) {
            $key && $query->where('key', $key);
        })->get()->toArray();

        $data = [];
        if ($list) {
            foreach ($list as $item) {
                $value = $ext ? $item['ext'] : $item['value'];

                if (isJson($value)) {
                    $data[$item['key']][$item['sub_key']] = json_decode($value, true) ?: [];
                } else {
                    $data[$item['key']][$item['sub_key']] = $value ?: '';
                }
            }
        }
        return $data;
    }
}

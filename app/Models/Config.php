<?php

namespace App\Models;

class Config extends BaseModel
{

    /**
     * 获取指定key的配置
     * @param $key
     * @return array
     */
    protected function getAllConfigs($key = '')
    {
        $list = $this->where(function ($query) use ($key) {
            $key && $query->where('key', $key);
        })->get()->toArray();

        $data = [];
        if ($list) {
            foreach ($list as $item) {
                if (isJson($item['value'])) {
                    $data[$item['key']][$item['sub_key']] = json_decode($item['value'], true) ?: [];
                } else {
                    $data[$item['key']][$item['sub_key']] = $item['value'] ?: '';
                }
            }
        }
        return $data;
    }


}

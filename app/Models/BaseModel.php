<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;
use Illuminate\Support\Facades\DB;

class BaseModel extends Model
{
    const CREATED_AT = 'created';

    const UPDATED_AT = 'updated';

    /**
     * 指示模型是否主动维护时间戳。
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * 模型日期字段的存储格式。
     *
     * @var string
     */
    protected $dateFormat = 'U';

    /**
     * 序列化日期
     *
     * @param DateTimeInterface $date
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format($this->getDateFormat());
    }

    /**
     * 获取指定ID的列表
     * @param $ids
     * @param $key
     * @param $field
     * @return array
     */
    protected function listByIds($ids, $key = 'id', $field = '*')
    {
        $ids = array_unique(array_filter($ids));
        if (!$ids) {
            return [];
        }
        $list = $this->select(DB::raw($field))->whereIn($key, $ids)->get();
        $data = [];
        if ($list) {
            foreach ($list as $value) {
                $data[$value[$key]] = $value;
            }
        }
        return $data;
    }
}

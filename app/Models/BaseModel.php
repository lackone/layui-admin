<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends Model
{
    //use SoftDeletes;

    const CREATED_AT = 'created';

    const UPDATED_AT = 'updated';

    const DELETED_AT = 'deleted';

    protected $connection = 'mysql';

    protected $guarded = ['_token'];

    /**
     * 可空字段
     *
     * @var array
     */
    public $nullable = [];

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
     * 获取列表
     * @param $key
     * @param $value
     * @param $where
     * @return array
     */
    protected function optionList($key, $value, $where = [])
    {
        if (stripos($value, ',') === false) {
            return $this->where($where)->pluck($value, $key)->toArray();
        }

        $list = $this->where($where)->get();
        $data = [];
        if ($list) {
            $value = explode(',', $value) ?: [];
            foreach ($list as $item) {
                if ($value) {
                    foreach ($value as $v) {
                        $data[$item[$key]] .= $item[$v] . '-';
                    }
                }
                $data[$item[$key]] = rtrim($data[$item[$key]], '-');
            }
        }
        return $data;
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

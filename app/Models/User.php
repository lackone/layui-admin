<?php

namespace App\Models;

class User extends BaseModel
{
    //来源(1-微信小程序 2-微信公众号 3-手机H5 4-电脑PC 5-苹果APP 6-安卓APP)
    const SOURCE_WX_MINI = 1;
    const SOURCE_WX_GZH = 2;
    const SOURCE_MOBILE_H5 = 3;
    const SOURCE_PC = 4;
    const SOURCE_IOS = 5;
    const SOURCE_ANDROID = 6;

    public static $sourceList = [
        self::SOURCE_WX_MINI => '微信小程序',
        self::SOURCE_WX_GZH => '微信公众号',
        self::SOURCE_MOBILE_H5 => '手机H5',
        self::SOURCE_PC => '电脑PC',
        self::SOURCE_IOS => '苹果APP',
        self::SOURCE_ANDROID => '安卓APP',
    ];

    //设备类型(0未知，1android，2ios，3windows)
    const DEVICE_TYPE_UNKNOWN = 0;
    const DEVICE_TYPE_ANDROID = 1;
    const DEVICE_TYPE_IOS = 2;
    const DEVICE_TYPE_WINDOWS = 3;

    public static $deviceTypeList = [
        self::DEVICE_TYPE_UNKNOWN => '未知',
        self::DEVICE_TYPE_ANDROID => 'android',
        self::DEVICE_TYPE_IOS => 'ios',
        self::DEVICE_TYPE_WINDOWS => 'windows',
    ];

    //状态(-1:禁用,1:启用)
    const STATUS_DISABLE = -1;
    const STATUS_ENABLE = 1;
}

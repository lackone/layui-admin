<?php

namespace App\Models;

class UserWeixin extends BaseModel
{

    //来源(1-微信小程序 2-微信公众号 3-手机H5 4-电脑PC 5-苹果APP 6-安卓APP)
    const SOURCE_WX_MINI = 1;
    const SOURCE_WX_GZH = 2;
    const SOURCE_MOBILE_H5 = 3;
    const SOURCE_PC = 4;
    const SOURCE_IOS = 5;
    const SOURCE_ANDROID = 6;
}

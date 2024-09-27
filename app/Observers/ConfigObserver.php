<?php

namespace App\Observers;

use App\Models\BaseModel;

class ConfigObserver extends BaseObserver
{
    public function saving(BaseModel $model)
    {
        parent::saving($model);
    }
}

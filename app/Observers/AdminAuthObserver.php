<?php

namespace App\Observers;

use App\Models\BaseModel;

class AdminAuthObserver extends BaseObserver
{
    public function saving(BaseModel $model)
    {
        parent::saving($model);
    }
}

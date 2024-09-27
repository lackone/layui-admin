<?php

namespace App\Observers;

use App\Models\BaseModel;

class AdminRoleObserver extends BaseObserver
{
    public function saving(BaseModel $model)
    {
        parent::saving($model);
    }
}

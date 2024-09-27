<?php

namespace App\Observers;

use App\Models\BaseModel;

class AdminObserver extends BaseObserver
{
    public function saving(BaseModel $model)
    {
        parent::saving($model);
    }
}

<?php

namespace App\Observers;

use App\Models\BaseModel;

class DictObserver extends BaseObserver
{
    public function saving(BaseModel $model)
    {
        parent::saving($model);
    }
}

<?php

namespace App\Observers;

use App\Models\BaseModel;

class ArticleObserver extends BaseObserver
{
    public function saving(BaseModel $model)
    {
        $model->admin_id = session('admin_id') ?: 0;

        parent::saving($model);
    }
}

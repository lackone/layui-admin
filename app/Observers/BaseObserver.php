<?php

namespace App\Observers;

use App\Models\BaseModel;

class BaseObserver
{
    public function creating(BaseModel $model)
    {

    }

    public function created(BaseModel $model)
    {

    }

    public function updating(BaseModel $model)
    {

    }

    public function updated(BaseModel $model)
    {

    }

    public function saving(BaseModel $model)
    {
        $attrs = $model->getAttributes();
        if ($attrs) {
            foreach ($attrs as $key => $value) {
                if (is_null($value) && !in_array($key, array_merge($model->nullable, ['deleted']))) {
                    $model->{$key} = '';
                }
            }
        }
    }

    public function saved(BaseModel $model)
    {

    }

    public function deleting(BaseModel $model)
    {

    }

    public function deleted(BaseModel $model)
    {

    }
}

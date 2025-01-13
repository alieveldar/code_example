<?php

namespace app\models;

use app\models\Todo;

class TodoApi extends Todo
{
    public function optimisticLock()
    {
        return null;
    }
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        unset($behaviors['optimisticLock']);
        return $behaviors;
    }
}

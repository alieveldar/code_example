<?php

namespace app\models;

use yii\db\ActiveQuery;

/**
 * Class TodoQuery is the ActiveQuery class for [[Todo]]
 *
 * @see Todo
 */
class TodoQuery extends ActiveQuery
{
    /**
     * @param null $db
     *
     * @return Todo[]
     */
    public function all($db = null): array
    {
        return parent::all($db);
    }

    /**
     * @param null $db
     *
     * @return Todo|null
     */
    public function one($db = null): ?Todo
    {
        return parent::one($db);
    }
}

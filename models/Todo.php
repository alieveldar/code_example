<?php

namespace app\models;

use yii\behaviors\OptimisticLockBehavior;

/**
 * Class Todo is a model class for table 'todo'
 *
 * @property int     $id
 * @property string  $title
 * @property int     $priority
 * @property boolean $done
 * @property int     $version
 */
class Todo extends \yii\db\ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName(): string
    {
        return '{{%todo}}';
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['title'], 'required'],
            [['title'], 'string'],

            [['priority', 'version'], 'integer'],
            [['done'], 'boolean'],
        ];
    }

    /**
     * @return string[]
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'priority' => 'Priority',
            'done' => 'Done',
        ];
    }

    /**
     * @return TodoQuery
     */
    public static function find(): TodoQuery
    {
        return \Yii::createObject(TodoQuery::class, [static::class]);
    }

    public function optimisticLock()
    {
        return 'version';
    }

    /**
     * @return array the behavior configurations.
     */

    public function behaviors()
    {
        return [
            'optimisticLock' => [
                'class' => OptimisticLockBehavior::class,
                'attributes' => ['version'],
            ],
        ];
    }

}

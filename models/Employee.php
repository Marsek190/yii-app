<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * @property int id
 * @property string initials
 * @property \DateTime birthday
 * @property string city
 * @property \DateTime created_at
 * @property \DateTime updated_at
 */
class Employee extends ActiveRecord
{
    public static function tableName()
    {
        return '{{employee}}';
    }
}
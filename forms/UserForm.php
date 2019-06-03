<?php

namespace app\forms;

use Yii;
use yii\base\Model;

class UserForm extends Model
{
    public $initials;
    public $birthday;
    public $city;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['initials', 'birthday', 'city'], 'required', 'message' => 'Поле должно быть заполнено'],
            [['initials', 'city'], 'string', 'min' => 6, 'tooShort' => 'Введите строку длиной более 6 символов'],
            [['initials', 'city'], 'string', 'max' => 255, 'tooLong' => 'Введите строку длиной не более 255 символов'],
            ['birthday', 'date', 'format' => 'php:Y-m-d', 'message' => 'Неверный формат даты']
        ];
    }
}
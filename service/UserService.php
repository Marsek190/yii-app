<?php

namespace app\service;

use app\forms\UserForm;
use app\models\Employee;
use yii\data\Pagination;

class UserService 
{
    /**
     * @param int $page
     * @return array
     */
    public function findAll(): array
    {
        $query = Employee::find();
        if ($query->count()) {
            $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 5]);
            $employees = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->asArray()
                ->all();
            return compact('pages', 'employees');
        }
        return $query->asArray()->all();
    }

    /**
     * @param mixed $id
     * @param UserForm $form
     * @return void
     */
    public function editProfile($id, UserForm $form): Employee
    {
        $employee = Employee::findOne($id);
        if (!$employee) {
            throw new \DomainException('Undefined employee with id = ' . $id);
        }
        $employee->initials = $form->initials;
        $employee->birthday = $form->birthday;
        $employee->city = $form->city;
        if (!$employee->save()) {
            throw new \DomainException('');
        }
        return $employee;
    }

    /**
     * @param UserCreateForm $form
     * @return Employee
     */
    public function createEmployee(UserForm $form): Employee
    {
        $employee = new Employee();
        $employee->initials = $form->initials;
        $employee->birthday = $form->birthday;
        $employee->city = $form->city;
        //$employee->load($form->attributes());
        if (!$employee->save()) {
            throw new \DomainException('woooops!');
        }
        return $employee;
    }

    /**
     * @param mixed $id
     * @return Employee
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function deleteEmployee($id): Employee
    {
        $employee = Employee::findOne($id);
        if (!$employee) {
            throw new \DomainException('Undefined employee with id = ' .$id);
        }
        if (!$employee->delete()) {
            throw new \RuntimeException('Deleting entity error with id = ' .$id);
        }
        return $employee;
    }
}
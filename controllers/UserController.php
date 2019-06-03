<?php

namespace app\controllers;

use Yii;
use app\forms\UserForm;
use yii\web\Controller;
use app\service\UserService;

class UserController extends Controller
{
    public $enableCsrfValidation = false;

    /**
     * @var UserService $userService
     */
    private $userService;

    public function __construct($id, $module, UserService $userService, $config = [])
    {
        $this->userService = $userService;
        parent::__construct($id, $module, $config);
    }    

    /**
     * {@inheritdoc}
     */
    public function beforeAction($action)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return parent::beforeAction($action);
    }

    public function behaviors()
    {
        return [
            'corsFilter' => [
                'class' => \yii\filters\Cors::className(),
            ],
        ];
    }

    public function actionDelete(): void
    {
        $id = Yii::$app->request->post('id');
        try {
            $this->userService->deleteEmployee($id);
        } catch (\Exception $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
    }

    public function actionCreate()
    {
        $form = new UserForm();
        if ($form->load(Yii::$app->request->post(), '') && $form->validate()) {
            try {
                $employee = $this->userService->createEmployee($form);
                return $employee;
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return ['errors' => $form->getFirstErrors()];
    }

    public function actionEdit()
    {
        $id = Yii::$app->request->post('id');
        $form = new UserForm();
        if ($form->load(Yii::$app->request->post(), '') && $form->validate()) {
            try {
                $this->userService->editProfile($id, $form);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return ['errors' => $form->getFirstErrors()];
    }

    /**
     * Displays homepage and all vue.js pages
     *
     * @return array
     */
    public function actionUsers(): array
    {
        return $this->userService->findAll();
    }
}
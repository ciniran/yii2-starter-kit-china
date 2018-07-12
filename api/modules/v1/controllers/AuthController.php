<?php
/**
 * Created by PhpStorm.
 * User: boxie
 * Date: 2018/7/10
 * Time: 下午10:29
 */

namespace api\modules\v1\controllers;


use api\modules\v1\resources\User;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\HttpHeaderAuth;
use yii\filters\auth\QueryParamAuth;
use yii\filters\Cors;
use yii\rest\Controller;

class AuthController extends Controller
{
    protected function verbs()
    {
        return [
          'login'=>['POST','GET','OPTIONS'],
            'user'=>['POST','GET','OPTIONS'],
        ];
    }

    public function behaviors()
    {
        $behaviors =  parent::behaviors();
        $behaviors['corsFilter'] = [
            'class'=>Cors::class
        ];
        if (\Yii::$app->getRequest()->getMethod() !== 'OPTIONS') {
            $behaviors['authenticator'] = [
                'class' => CompositeAuth::class,
                'authMethods' => [
                    HttpBasicAuth::class,
                    HttpBearerAuth::class,
                    HttpHeaderAuth::class,
                    QueryParamAuth::class
                ],
                'except' => ['login'],
            ];
        }
        return $behaviors;
    }

    public function actionLogin()
    {
        $data = \Yii::$app->request->getQueryParams();
        $model = User::findByUsername($data['name']);
        if (\Yii::$app->user->login($model)) {
            return ['token'=>$model->access_token];
        }else{
            return '登陆失败';
        }
    }
    public function actionUser(){
        $model = \Yii::$app->user->identity;
        return ['user' => $model];
    }
    public function actionLogout(){

    }

}
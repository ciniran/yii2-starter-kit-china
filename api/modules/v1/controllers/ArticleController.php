<?php

namespace api\modules\v1\controllers;

use api\modules\v1\resources\Article;
use yii\data\ActiveDataProvider;
use yii\filters\ContentNegotiator;
use yii\filters\Cors;
use yii\rest\ActiveController;
use yii\rest\IndexAction;
use yii\rest\OptionsAction;
use yii\rest\Serializer;
use yii\rest\ViewAction;
use yii\web\HttpException;
use yii\web\Response;

/**
 * Class ArticleController
 * @author Eugene Terentev <eugene@terentev.net>
 */
class ArticleController extends ActiveController
{
    /**
     * @var string
     */
    public $modelClass = 'api\modules\v1\resources\Article';
    /**
     * @var array
     */
    public $serializer = [
        'class' => Serializer::class,
        'collectionEnvelope' => 'items'
    ];

    public function verbs()
    {
        return [
            'index' => ['GET', 'POST','HEAD','OPTIONS'],
            'view' => ['GET', 'HEAD'],
            'create' => ['POST'],
            'update' => ['PUT', 'PATCH'],
            'delete' => ['DELETE'],
        ];    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [/*
            'index' => [
                'class' => IndexAction::class,
                'modelClass' => $this->modelClass,
                'prepareDataProvider' => [$this, 'prepareDataProvider']
            ],*/
            'view' => [
                'class' => ViewAction::class,
                'modelClass' => $this->modelClass,
                'findModel' => [$this, 'findModel']
            ],
            'options' => [
                'class' => OptionsAction::class
            ]
        ];
    }

    public function behaviors()
    {
        $behaviors =  parent::behaviors();
        $behaviors['CORS'] = [
            'class'=>Cors::class
        ];
        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::class,
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
                'application/xml' => Response::FORMAT_XML,
            ],
        ];
        return $behaviors;
    }

    public function actionIndex()
    {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
       $aaa =\Yii::$app->request->getRawBody();
        return $aaa;
        return (\Yii::$app->request->post());
       // return [1,2, 3];
    }

    /**
     * @return ActiveDataProvider
     */
    public function prepareDataProvider()
    {
        return new ActiveDataProvider(array(
            'query' => Article::find()->published()
        ));
    }

    /**
     * @param $id
     * @return array|null|\yii\db\ActiveRecord
     * @throws HttpException
     */
    public function findModel($id)
    {
        $model = Article::find()
            ->published()
            ->andWhere(['id' => (int)$id])
            ->one();
        if (!$model) {
            throw new HttpException(404);
        }
        return $model;
    }
}

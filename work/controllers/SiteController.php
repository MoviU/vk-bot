<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\RegisterForm;
use app\models\Settings;
use app\models\Tariff;
use app\components\AuthHandler;
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['get'],
                ],
            ],
        ];
    }
	

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
		
        return [
            'auth'=>[
                
                'class' => 'yii\authclient\AuthAction',
                "successCallback"=>[$this,"onAuthSuccess"]
            ],
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    public function onAuthSuccess($client){
        (new AuthHandler($client))->handle();
    }
    public function init(){
		$c = Settings::find()->asArray()->one();
		\Yii::$app->params["contacts"] = $c;
		\Yii::$app->params["support"] = "https://vk.com";

	}
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->layout = "landing";
        $tariffs = Tariff::find()->all();
		if(!\Yii::$app->user->isGuest)
			return $this->redirect(["/constructor"]);
        return $this->render('index',compact("tariffs"));
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout = "usergate";
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays partner page
     *
     * @return Response|string
     */
    public function actionPartners()
    {
        $this->layout = "landing";
        return $this->render('partners', [
            
        ]);
    }

    /**
     * Displays price page.
     *
     * @return string
     */
    public function actionPrice()
    {
        $tariffs = Tariff::find()->all();
        $this->layout = "landing";
        return $this->render('price',compact("tariffs"));
    }

	/**
     * Displays reguister page
     *
     * @return string
     */
	public function actionRegister(){
         $this->layout = "usergate";
		if(!Yii::$app->user->isGuest)
			return $this->goHome();
		$model = new RegisterForm();
		if($model->load(Yii::$app->request->post()) && $model->validate()){
			$user = new \app\models\User();
			$user->email = $model->email;
			$user->password = Yii::$app->security->generatePasswordHash( $model->password );
			
			if($user->save()){
                Yii::$app->user->login($user,  3600*24*30);
                
				return $this->redirect(["/site/regsuccess"]);
			}

		}
		return $this->render("register", ["model"=>$model]);
	}
    public function actionRegsuccess(){
        return $this->render("register_success");
    }
}

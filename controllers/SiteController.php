<?php

namespace app\controllers;

use app\models\SignupForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
use app\models\UserAttributes;
use app\models\UserAttributeValues;
use yii\base\Model;
use yii\base\DynamicModel;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','contact'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['contact'],
                        'allow' => true,
                        'roles' => ['author'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function getModelFormAttributes($attrs){
        $attrModel=[];
        foreach ($attrs as $attr){
            $attrModel[]=$attr['name'];
        }
        //Динамическая модель
        $modelAttr = new DynamicModel($attrModel);

        //echo '<pre>';print_r($attrs);echo '</pre>';

        //Валидация доп.полей
        foreach($attrs as $attr) {
            //$modelAttr->addRule([$attr['name']], $attr['attributeValidate'][0]->value, ['min' => 3]);
            /*if($attr['attributeValidate'][0]->required){
                $modelAttr->addRule([$attr['name']], 'required');
            }*/
        }
        return $modelAttr;
    }


    public function actionSignup()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new SignupForm();
        $attrs=UserAttributes::find()->with('attributeValidate','attributeValidate2')->indexBy('id')->all();

        echo '<pre>';print_r($attrs);echo '</pre>';

        $modelAttr=$this->getModelFormAttributes($attrs);

        //
        if($model->load(Yii::$app->request->post()) && $modelAttr->load(Yii::$app->request->post())){
            $isValid = $model->validate();
            $isValid = $modelAttr->validate() && $isValid;

            if($isValid){
                $user = new User();
                $user->email = $model->email;
                $user->password = $model->password;
                $user->group = 2;

                if($user->save()) {
                    foreach ($attrs as $id_attr => $attr_val) {
                        if (!empty($modelAttr->$attr_val['name'])) {
                            $UserAttribVal = new UserAttributeValues();
                            $UserAttribVal->attr_id = $id_attr;
                            $UserAttribVal->user_id = $user->id;
                            $UserAttribVal->value = $modelAttr->$attr_val['name'];
                            if(!$UserAttribVal->save()){
                                return false;
                            }
                        }
                    }
                    Yii::$app->user->login($user);
                    return $this->goHome();
                }
            }
        }
        return $this->render('signup', [
            'model' => $model,
            'modelAttr' => $modelAttr,
            'attrs' => $attrs
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
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        /*if (Yii::$app->user->can('author')) {
            echo "update post";
        }*/

        $user = User::findOne(84);
        //echo '<pre>';print_r($user);echo '</pre>';

        $userAttributes=UserAttributes::findOne(3);
        $user->link('userAttributes', $userAttributes);


        $asd=$user->userAttributeValues;

        echo '<pre>';print_r($asd);echo '</pre>';

        $asd[2]->value='sfsfs';
        //$userAttrib = UserAttributeValues::findOne(69);

        //$userAttrib->value = 'asdads';

        $user->link('userAttributeValues', $asd[2]);


        return $this->render('about');
    }
}

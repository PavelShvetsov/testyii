<?php

namespace app\controllers\admin;

use Yii;
use app\models\UserAttributes;
use app\models\AttributeValidate;
use app\models\Validate;
use app\models\admin\search\UserAttributesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Model;

/**
 * UserAttributesController implements the CRUD actions for UserAttributes model.
 */
class AttributesController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all UserAttributes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserAttributesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserAttributes model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new UserAttributes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserAttributes();

        $values=$this->initValid($model);

        $post=Yii::$app->request->post();

        //echo '<pre>';print_r($values);echo '</pre>';

        if ($model->load($post) && $model->save() && Model::loadMultiple($values, $post)) {
            $this->saveValid($values,$model);
            return $this->redirect(['view', 'id' => $model->id]);

            /*echo '<pre>';print_r($post);echo '</pre>';
            echo '<pre>';print_r($values);echo '</pre>';

            return $this->render('create', [
                'model' => $model,
                'values' => $values,
            ]);*/
        }else {
            return $this->render('create', [
                'model' => $model,
                'values' => $values,
            ]);
        }
    }

    /**
     * Updates an existing UserAttributes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $values=$this->initValid($model);

        $post=Yii::$app->request->post();

        if ($model->load($post) && $model->save() && Model::loadMultiple($values, $post)) {
            $this->saveValid($values,$model);
            return $this->redirect(['view', 'id' => $model->id]);
        }else {
            return $this->render('update', [
                'model' => $model,
                'values' => $values,
            ]);
        }
    }

    /**
     * Deletes an existing UserAttributes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserAttributes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserAttributes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserAttributes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    private function initValid(UserAttributes $model){

        $values = $model->getAttributeValidate()->with('attrProp')->indexBy('valid_id')->all();

        $validates = Validate::find()->indexBy('id')->all();

        foreach (array_diff_key($validates, $values) as $valid) {
            $values[$valid->id] = new AttributeValidate(['valid_id' => $valid->id]);
        }

        foreach ($values as $value) {
            $value->setScenario(AttributeValidate::SCENARIO_TABULAR);
        }

        return $values;
    }

    private function saveValid($values, UserAttributes $model)
    {
        foreach ($values as $value) {
            $value->attr_id = $model->id;
            if ($value->validate()) {
                if (!empty($value->value)) {
                    $value->save(false);
                } else {
                    $value->delete();
                }
            }
        }
    }

}

<?php

namespace app\controllers\admin;

use Yii;
use app\models\admin\IblockSection;
use app\models\admin\search\IblockSectionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * IblockSectionController implements the CRUD actions for IblockSection model.
 */
class IblockSectionController extends Controller
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
     * Lists all IblockSection models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IblockSectionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single IblockSection model.
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
     * Creates a new IblockSection model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new IblockSection();

        if ($model->load(Yii::$app->request->post())) {
            $parentSectionNew = IblockSection::findOne($model->iblock_section_id);
            IblockSection::updateSectionsAfterCreate($parentSectionNew);
            $model->left_margin = $parentSectionNew->right_margin;
            $model->right_margin = $parentSectionNew->right_margin + 1;
            $model->depth_level = $parentSectionNew->depth_level + 1;
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing IblockSection model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $parent_section_id = $model->iblock_section_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //update section margins
            if($parent_section_id !== $model->iblock_section_id){
                $parentSectionNew = IblockSection::findOne($model->iblock_section_id);
                IblockSection::updateSectionsAfterMove($parentSectionNew,$model);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing IblockSection model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        //$this->findModel($id)->delete();
        $section = $this->findModel($id);
        IblockSection::sectionsDelete($section);

        return $this->redirect(['index']);
    }

    /**
     * Finds the IblockSection model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return IblockSection the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = IblockSection::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}

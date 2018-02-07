<?php

namespace backend\controllers;

use Yii;
use backend\models\MluUserEnrollee;
use backend\models\MluUserEnrolleeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/* ***** emje add ***** */
use backend\models\MluCourse;
use backend\models\MluCourseManualSearch;
use backend\models\MluManualAssessment;
/* ***** emje add ***** */

/**
 * MluUserEnrolleeController implements the CRUD actions for MluUserEnrollee model.
 */
class MluUserEnrolleeController extends Controller
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
     * Lists all MluUserEnrollee models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MluUserEnrolleeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MluUserEnrollee model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $training_list_temp = MluUserEnrollee::find()->where(['id' => $id])->one();
        $training_list = MluUserEnrollee::find()->where(['user_id' => $training_list_temp['user_id']])->all();
        $training_manual_list = MluManualAssessment::find()->where(['id_number' => $training_list_temp['id_number']])->all();
        $training_manual_list_count = MluManualAssessment::find()->where(['id_number' => $training_list_temp['id_number']])->count();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'training_list' => $training_list,
            'training_manual_list' => $training_manual_list,
            'training_manual_list_count' => $training_manual_list_count,
        ]);
    }

    /**
     * Creates a new MluUserEnrollee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MluUserEnrollee();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing MluUserEnrollee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing MluUserEnrollee model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionEnrollee($id)
    {
        $searchModel = new MluCourseManualSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['mlu_course.course_id' => $id]);
        //$dataProvider->query->andWhere(['=', 'mlu_course.course_id', $id]);

        $title = MluCourse::find()->where(['course_id' => $id])->one();

        return $this->render('enrollee', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'title' => ucwords($title['name']),
        ]);
    }

    /**
     * Finds the MluUserEnrollee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MluUserEnrollee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MluUserEnrollee::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

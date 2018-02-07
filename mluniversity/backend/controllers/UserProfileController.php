<?php

namespace backend\controllers;

use Yii;
use backend\models\UserProfile;
use backend\models\User;
use backend\models\MluRoleUser;
use backend\models\UserProfileSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use backend\models\AuthAssignment;

/**
 * UserProfileController implements the CRUD actions for UserProfile model.
 */
class UserProfileController extends Controller
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
     * Lists all UserProfile models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserProfileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserProfile model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $get_user_profile = UserProfile::find()->where(['id' => $id])->one();
        $count_user_role = MluRoleUser::find()->where(['user_id' => $get_user_profile->user_id])->count();
        $get_user_role = MluRoleUser::find()->where(['user_id' => $get_user_profile->user_id])->all();
        $check_exist = AuthAssignment::find()->where(['user_id' => $get_user_profile->user_id])->one();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'count_user_role' => $count_user_role,
            'get_user_role' => $get_user_role,
            'check_exist' => $check_exist,
        ]);
    }

    /**
     * Creates a new UserProfile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserProfile();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UserProfile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        //if ($model->load(Yii::$app->request->post()) && $model->save()) {
        if ($model->load(Yii::$app->request->post())) {

            $model->picture = UploadedFile::getInstance($model, 'picture');
            
            if (!empty($model->picture)){
              if (($model->picture->extension != 'jpg') && ($model->picture->extension != 'jpeg') && ($model->picture->extension != 'png')){
                Yii::$app->getSession()->setFlash('uploaderrorextension', 'File extension not recognized!');
                return $this->redirect(['view', 'id' => $model->id]);
              }

              $folder = "dp/".Yii::$app->user->identity->id; 
              if(!is_dir($folder)){
                $save_folder = $folder;
                mkdir($folder);
              } else {
                $save_folder = $folder;
              }

            $DPname = Yii::$app->user->identity->id. '-DP';
            $model->picture->saveAs($save_folder. '/' .$DPname. '.' .$model->picture->extension);

            $model->avatar_path = $DPname. '.' .$model->picture->extension;
            $model->avatar_base_url = Yii::$app->session['dp'].Yii::$app->user->identity->id. '/';
            
            } 

            $model->save();
            /*else {
                $model->avatar_path = '-';
                $model->avatar_base_url = '-';
                $model->save();
            }*/
            Yii::$app->session->setFlash('profileupdate', 'You have successfully update your profile.');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing UserProfile model.
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
     * Finds the UserProfile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserProfile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserProfile::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

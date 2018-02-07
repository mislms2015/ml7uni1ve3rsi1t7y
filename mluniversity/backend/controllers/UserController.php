<?php

namespace backend\controllers;

use Yii;
use backend\models\User;
use backend\models\UserChangePassword;
use backend\models\UserSearch;
use backend\models\AuthItem;
use backend\models\AuthAssignment;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\SignupForm;
use backend\models\MluRole;
use backend\models\MluRoleUser;
use backend\models\MluRegion;
use backend\models\MluRoleAssignment;
//use common\models\User;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        /*$role_list1 = AuthItem::find()->where(['type' => 1])
                                     ->andWhere(['<>', 'name', 'administrator'])
                                     ->all();*/

        $count_exist = AuthAssignment::find()->where(['user_id' => $id])->count();
        $check_exist = AuthAssignment::find()->where(['user_id' => $id])->one();

        $role_list = MluRole::find()->all();

        return $this->render('view', [
            'model' => $this->findModel($id),
            //'role_list1' => $role_list1,
            'count_exist' => $count_exist,
            'check_exist' => $check_exist,
            'role_list' => $role_list,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
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
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionSignme()
    {
        $model = new SignupForm();
        $model->scenario = 'register';
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                //if (Yii::$app->getUser()->login($user)) { // this condition set to redirect to login new created account
                    Yii::$app->getSession()->setFlash('signme', 'Account successfully created!');
                    return $this->redirect(['/']);
                    //return $this->goHome();
                //}
            }
        }

        //return $this->render('../../../frontend/views/site/signup', [
        //    'model' => $model,
        //]);

        return $this->render('@frontend/views/site/signup', [
        'model' => $model,
        ]);
        //return $this->redirect(['index']);
    }

    public function actionChangepassword(){
    //set up user and load post data
    $user = Yii::$app->user->identity;

    $loadedPost = $user->load(Yii::$app->request->post());
    $user->setScenario('change_password');

    // validate for normal request
    if ($loadedPost && $user->validate()){
        $user->password = $user->newPassword;
        //save, set flash, and refresh page
        $user->save(false);
        //var_dump($user->errors);
        Yii::$app->session->setFlash('success', 'You have successfully changed your password.');
        return $this->refresh();
    }
    //render
    return $this->render('changepassword', [
        'user' => $user,
    ]);
    }


    public function actionSetrole($id, $user){
        //$id variable hold id of role
        //$user variable hold id of user

        Yii::$app->db->createCommand()->insert('mlu_role_user', ['user_id' => $user, 'role_id' => $id])->execute();

        Yii::$app->getSession()->setFlash('setrole', 'Role successfully added!');

        return $this->redirect(['view', 'id' => $user]);
    }


    public function actionRemoverole($id, $user){
        //$id variable hold id of role
        //$user variable hold id of user

        //
        $role_user_check = MluRoleUser::find()->where(['user_id' => $user])
                                              ->andWhere(['role_id' => $id])
                                              ->all();
        foreach($role_user_check as $role_user_check_result):
            $role_assign_count = MluRoleAssignment::find()->where(['assign_id' => $role_user_check_result->id])->count();
            if ($role_assign_count > 0){
                Yii::$app->db->createCommand()->delete('mlu_role_assignment', ['assign_id' => $role_user_check_result->id])->execute();
            }
        endforeach;
        //

        Yii::$app->db->createCommand()->delete('mlu_role_user', ['user_id' => $user, 'role_id' => $id])->execute();

        Yii::$app->getSession()->setFlash('removerole', 'Role successfully removed!');

        return $this->redirect(['view', 'id' => $user]);
    }

    public function actionAddregion($id, $user, $role_user){
        $region_list = MluRegion::find()->all();

        $user_info = User::find()->where(['id' => $user])->one();
        $role_info = MluRole::find()->where(['id' => $id])->one();

        if (isset($_POST['crs'])){
            foreach($_POST['crs'] as $index => $crs):
                $course = ($crs);

                $role_assign_count = MluRoleAssignment::find()->where(['assign_id' => $role_user])
                                                              ->andWhere(['region_id' => $course])
                                                              ->count();

                if($role_assign_count == 0){
                    Yii::$app->db->createCommand()->insert('mlu_role_assignment', ['assign_id' => $role_user, 'region_id' => $course])->execute();
                }

            endforeach;

            Yii::$app->getSession()->setFlash('regionadd', 'Region successfully added!');

            return $this->redirect(['view', 'id' => $user]);
        } else {
        return $this->render('addregion', [
                'role_id' => $id,
                'user_id' => $user,
                'region_list' => $region_list,
                'username' => ucwords($user_info->username),
                'role_name' => ucwords($role_info->full_name),
                'role_user' => $role_user,

            ]);
        }
    }

    public function actionSetadmin($id){
        $date_time_temp = date('Y-m-d h:i:s', time());
        $date_time_final = strtotime($date_time_temp);

        Yii::$app->db->createCommand()->delete('auth_assignment', ['user_id' => $id])->execute();

        Yii::$app->db->createCommand()->insert('auth_assignment', ['item_name' => 'system admin', 'user_id' => $id, 'created_at' => $date_time_final])->execute();

        Yii::$app->getSession()->setFlash('assign', 'Role successfully set!');

        return $this->redirect(['view', 'id' => $id]);
    }

    public function actionRemoveadmin($id){
        $date_time_temp = date('Y-m-d h:i:s', time());
        $date_time_final = strtotime($date_time_temp);

        Yii::$app->db->createCommand()->delete('auth_assignment', ['user_id' => $id])->execute();

        Yii::$app->db->createCommand()->insert('auth_assignment', ['item_name' => 'system user', 'user_id' => $id, 'created_at' => $date_time_final])->execute();

        Yii::$app->getSession()->setFlash('removeassign', 'Role successfully remove!');

        return $this->redirect(['view', 'id' => $id]);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

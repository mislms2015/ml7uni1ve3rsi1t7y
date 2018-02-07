<?php

namespace backend\controllers;

use Yii;
use backend\models\MluCourse;
use backend\models\MluCourseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/* ***** emje add ***** */
use yii\helpers\Url;
use backend\models\MluQuiz;
use backend\models\MluSubCourse;
use backend\models\MluUserEnrollee;
use Mpdf\Mpdf;
use backend\models\MluCourseManualSearch;
/* ***** emje add ***** */

/**
 * MluCourseController implements the CRUD actions for MluCourse model.
 */
class MluCourseController extends Controller
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
     * Lists all MluCourse models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MluCourseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MluCourse model.
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
     * Creates a new MluCourse model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MluCourse();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing MluCourse model.
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
     * Deletes an existing MluCourse model.
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
     * Syncing course from lms system
     *
     */
    public function actionSynccourse()
    {
        $course_data = [];
        $sub_course_data = [];
        $sync_sub_course_data = [];
        $quiz_data = [];
        $sub_course_quiz_data = [];

        /**
         * Syncing courses
         *
         */
        $course_query = Yii::$app->db2->createCommand("SELECT *FROM mdl_course WHERE category='27'")->queryAll();

        foreach($course_query as $course_result):
            $exist_course_count = MluCourse::find()->where(['course_id' => $course_result['id']])->count();
            if($exist_course_count == 0){
                $course_enroll_query = Yii::$app->db2->createCommand("SELECT *FROM mdl_enrol WHERE courseid='$course_result[id] ' AND enrol='MANUAL'")->queryOne();
                $course_data[] = [$course_result['id'], $course_result['fullname'], $course_enroll_query['id']];
            }
        endforeach;

        Yii::$app->db->createCommand()->batchInsert('mlu_course', ['course_id', 'name', 'enroll_id'], $course_data)->execute();

        /**
         * Syncing sub-category
         *
         */
        $sub_course_query = Yii::$app->db2->createCommand("SELECT *FROM mdl_course_categories WHERE path like '/27/%'")->queryAll();
        foreach($sub_course_query as $sub_course_result):
            $exist_sub_course = MluSubCourse::find()->where(['course_id' => $sub_course_result['id']])->count();
            if($exist_sub_course == 0){
                $sub_course_data[] = [$sub_course_result['id'], $sub_course_result['name']];
            }
        endforeach;

        Yii::$app->db->createCommand()->batchInsert('mlu_sub_course', ['course_id', 'name'], $sub_course_data)->execute();

        $sync_sub_course_query = MluSubCourse::find()->all();

        foreach($sync_sub_course_query as $sync_sub_course_result):
            $sync_sub_course_query2 = Yii::$app->db2->createCommand("SELECT *FROM mdl_course WHERE category='$sync_sub_course_result[course_id]'")->queryAll();
            foreach($sync_sub_course_query2 as $sync_sub_course_result2):
                $exist_sync_count = MluCourse::find()->where(['course_id' => $sync_sub_course_result2['id']])->count();
                if($exist_sync_count == 0){
                    $sub_course_enroll_query = Yii::$app->db2->createCommand("SELECT *FROM mdl_enrol WHERE courseid='$sync_sub_course_result2[id] ' AND enrol='MANUAL'")->queryOne();
                    $sync_sub_course_data[] = [$sync_sub_course_result2['id'], $sync_sub_course_result2['fullname'], $sub_course_enroll_query['id']];
                }
            endforeach;
        endforeach;

        Yii::$app->db->createCommand()->batchInsert('mlu_course', ['course_id', 'name', 'enroll_id'], $sync_sub_course_data)->execute();

        /**
         * Syncing quiz
         *
         */
        $quiz_query = MluCourse::find()->all();

        foreach($quiz_query as $quiz_result):
            $quiz_query2 = Yii::$app->db2->createCommand("SELECT *FROM mdl_quiz WHERE course='$quiz_result[course_id]'")->queryAll();
            foreach($quiz_query2 as $quiz_result2):
                $exist_quiz_count = MluQuiz::find()->where(['quiz_id' => $quiz_result2['id']])->count();
                if($exist_quiz_count == 0){
                    $quiz_data[] = [$quiz_result2['id'], $quiz_result2['course'], $quiz_result2['name']];
                }
            endforeach;
        endforeach;

        Yii::$app->db->createCommand()->batchInsert('mlu_quiz', ['quiz_id', 'course_id', 'name'], $quiz_data)->execute();

        /**
         * Syncing quiz from sub-course
         *
         */
        $sub_course_quiz_query = MluSubCourse::find()->all();

        foreach($sub_course_quiz_query as $sub_course_quiz_result):
            $sub_course_quiz_query2 = Yii::$app->db2->createCommand("SELECT *FROM mdl_quiz WHERE course='$sub_course_quiz_result[course_id]'")->queryAll();
            foreach($sub_course_quiz_query2 as $sub_course_quiz_result2):
                $exist_sub_course_quiz_count = MluQuiz::find()->where(['quiz_id' => $sub_course_quiz_result2['id']])->count();
                if($exist_sub_course_quiz_count == 0){
                    $sub_course_quiz_data[] = [$sub_course_quiz_result2['id'], $sub_course_quiz_result2['course'], $sub_course_quiz_result2['name']];
                }
            endforeach;
        endforeach;

        Yii::$app->db->createCommand()->batchInsert('mlu_quiz', ['quiz_id', 'course_id', 'name'], $sub_course_quiz_data)->execute();

        /*return $this->render('sample', [
            'query' => $query,
        ]);*/

        Yii::$app->getSession()->setFlash('synccourses', 'Courses successfully sync!');

        return $this->redirect(Url::to(['../dashboard']));
    }

    /**
     * Syncing enrollee from lms system
     *
     */
    public function actionSyncenrollee()
    {
        $enrollee_data = [];

        $enrollee_query = MluCourse::find()->all();
        foreach($enrollee_query as $enrollee_query_result):
            $enrollee_query2 = Yii::$app->db2->createCommand("SELECT *FROM mdl_user_enrolments WHERE enrolid='$enrollee_query_result[enroll_id]'")->queryAll();
            
            foreach($enrollee_query2 as $enrollee_query2_result):
                $enrollee_exist_count = MluUserEnrollee::find()->where(['enrollment_id' => $enrollee_query2_result['id']])->count();
                if($enrollee_exist_count == 0){
                    $enrolle_info = Yii::$app->db2->createCommand("SELECT *FROM mdl_user WHERE id='$enrollee_query2_result[userid]'")->queryOne();

                    $idnumber = preg_replace('/\D/', '', $enrolle_info['username']);

                    $enrollee_data[] = [ $enrolle_info['id'], $idnumber, $enrolle_info['username'], $enrollee_query2_result['id'], $enrollee_query_result['course_id'], $enrolle_info['firstname'], $enrolle_info['lastname'] ];
                }
            endforeach;

        endforeach;

         Yii::$app->db->createCommand()->batchInsert('mlu_user_enrollee', ['user_id', 'id_number', 'username', 'enrollment_id', 'course_id', 'fname', 'lname'], $enrollee_data)->execute();

         Yii::$app->getSession()->setFlash('syncenrollee', 'Enrollee successfully sync!');

        return $this->redirect(Url::to(['../dashboard']));
    }

        public function actionSample(){
        $data = [];

        $name_list = array('sample2', 'sample3', 'sample4');

        for($i = 2; $i <= 4; $i++){
          $data[] = ['sample'.$i];
        }

        $a=array('sample');
        array_push($a,"blue","yellow");

        $query = MluCourse::find()->where(['name' => $data])->all();
        
        return $this->render('sample', [
          'query' => $query,
          'data' => $data,
          'a' => $a,
        ]);

    $content = $this->renderPartial('sample');
    //$mpdf = new \Mpdf\Mpdf();
    $mpdf = new Mpdf(); //, array(215.9,279.4) this is for page size
    $mpdf->SetDisplayMode('fullpage');
    //$mpdf->SetFooter('Learning and Development Generated Report. '. date('M d, Y'));
    $mpdf->SetTitle('sampletitle');

    $writeme = $content;
    
    //$mpdf->WriteHTML(Yii::$app->request->BaseUrl);

    $mpdf->SetWatermarkText('M. Lhuillier', 0.15);

    $mpdf->watermark_font = 'DejaVuSansCondensed';
    $mpdf->showWatermarkText = true;

    $mpdf->SetWatermarkImage(dirname(__FILE__).'/../pdf/watermark/smalllogo.jpg', 0.10, '');
    $mpdf->showWatermarkImage = true;

    $mpdf->WriteHTML($writeme);

    $filename="sample.pdf";

    $mpdf->Output($filename, 'I');

    /*$mpdf=new \Mpdf\Mpdf(); 
 
$mpdf->SetDisplayMode('fullpage');
 
$mpdf->list_indent_first_level = 0;  // 1 or 0 - whether to indent the first level of a list
 
$mpdf->WriteHTML(file_get_contents('C:\inetpub\wwwroot\mluniversity\backend\views\mlu-course\sample.php'));
         
$mpdf->Output();*/
    }

    public function actionSynccert($id)
    {
      Yii::$app->session['sync_cert'] = $id;

      $content = $this->renderPartial('synccert');
      $mpdf = new Mpdf();
      $mpdf->SetDisplayMode('fullpage');
      //$mpdf->SetFooter('Learning and Development Generated Report. '. date('M d, Y'));
      $mpdf->SetTitle('Individual Certificate');

      $writeme = $content;

      $mpdf->SetWatermarkText('ML University', 0.15);

      $mpdf->watermark_font = 'DejaVuSansCondensed';
      $mpdf->showWatermarkText = true;

      $mpdf->SetWatermarkImage(dirname(__FILE__).'/../pdf/watermark/smalllogo.jpg', 0.10, '');
      $mpdf->showWatermarkImage = true;

      $mpdf->WriteHTML($writeme);

      $filename="manualtraining.pdf";

      $mpdf->Output($filename, 'I');
    }

    public function actionSyncattendedcert($id)
    {
      Yii::$app->session['sync_attended_cert'] = $id;

      $content = $this->renderPartial('syncattendedcert');
      $mpdf = new Mpdf();
      $mpdf->SetDisplayMode('fullpage');
      //$mpdf->SetFooter('Learning and Development Generated Report. '. date('M d, Y'));
      $mpdf->SetTitle('Individual Certificate');

      $writeme = $content;

      $mpdf->SetWatermarkText('ML University', 0.15);

      $mpdf->watermark_font = 'DejaVuSansCondensed';
      $mpdf->showWatermarkText = true;

      $mpdf->SetWatermarkImage(dirname(__FILE__).'/../pdf/watermark/smalllogo.jpg', 0.10, '');
      $mpdf->showWatermarkImage = true;

      $mpdf->WriteHTML($writeme);

      $filename="manualtraining.pdf";

      $mpdf->Output($filename, 'I');
    }

    /**
     * Finds the MluCourse model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MluCourse the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MluCourse::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

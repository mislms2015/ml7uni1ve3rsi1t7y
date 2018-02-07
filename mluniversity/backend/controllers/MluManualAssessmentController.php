<?php

namespace backend\controllers;

use Yii;
use backend\models\MluManualAssessment;
use backend\models\MluManualAssessmentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/* ***** emje add ***** */
use yii\web\UploadedFile;
use backend\models\MluManualTraining;
use yii\helpers\Url;
use Mpdf\Mpdf;
use yii\data\Pagination;
use backend\models\MluManualAssessmentListSearch;
use backend\models\MluManualAssessmentManualSearch;
use backend\models\MluUserEnrollee;
use backend\models\MluRegion;
use backend\models\MluRoleUser;
use backend\models\MluRoleAssignment;
use backend\models\MluManualDiamond;
use backend\models\MluManualGold;
/* ***** emje add ***** */

/**
 * MluManualAssessmentController implements the CRUD actions for MluManualAssessment model.
 */
class MluManualAssessmentController extends Controller
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
     * Lists all MluManualAssessment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MluManualAssessmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MluManualAssessment model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
      $training_list_temp = MluManualAssessment::find()->where(['id' => $id])->one();
      $training_list = MluManualAssessment::find()->where(['id_number' => $training_list_temp['id_number']])->all();
      $training_sync_list = MluUserEnrollee::find()->where(['id_number' => $training_list_temp['id_number']])->all();
      $training_sync_list_count = MluUserEnrollee::find()->where(['id_number' => $training_list_temp['id_number']])->count();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'training_list' => $training_list,
            'training_sync_list' => $training_sync_list,
            'training_sync_list_count' => $training_sync_list_count,
        ]);
    }

    /**
     * Creates a new MluManualAssessment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MluManualAssessment();

        /*if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }*/

        if ($model->load(Yii::$app->request->post())) {

            $model->trainingupload = UploadedFile::getInstance($model, 'trainingupload');

            /*create random string for filename*/
            $random_number = mt_rand(1,100);
            $characters = 'abcdefghijkmnopqrstuvwxyz';
            $randstring = '';
              for ($i = 0; $i < 4; $i++) {
                  //$randstring = $characters[rand(0, strlen($characters))];
                  $randstring = $characters[rand(0, (strlen($characters) - 1))];
              }
            $random_char = $random_number. '' .$randstring;
            /*create random string for filename*/

            if (!empty($model->trainingupload)){
              if (($model->trainingupload->extension != 'xlsx') && ($model->trainingupload->extension != 'xls')){
                Yii::$app->getSession()->setFlash('uploaderrorextension', 'File extension not recognized!');
                return $this->redirect(Url::to(['../dashboard']));
              }
            $DPname = $random_char. '-training-'. date('Y-m-d');
            $excelfile = 'training/'.$DPname.'.'.$model->trainingupload->extension;
            $model->trainingupload->saveAs('training/'.$DPname.'.'.$model->trainingupload->extension);

            /*Yii::$app->db->createCommand()->insert('mlu_manual_training', [
                'name' => 'Sam',
                'age' => 30,
                ])->execute();*/
            
                try{
                    $inputFileType = \PHPExcel_IOFactory::identify($excelfile);
                    $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($excelfile);
                } catch (Exception $e){
                    die('Error');
                }

                $sheet = $objPHPExcel->getsheet(0);
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();
                $data = [];
                $title_data_temp = [];
                $title_data = [];

                if ($highestColumn == 'I'){
                    $switch_me = 'diamond';
                    $analyzer = 'diamond';
                } elseif ($highestColumn == 'G'){
                    $switch_me = 'gold';
                    $analyzer = 'gold';
                } elseif ($highestColumn == 'E'){
                    $switch_me = 'default';
                    $analyzer = 'default';
                } else{
                    Yii::$app->getSession()->setFlash('uploadinvalidform', 'Invalid form format!');
                    return $this->redirect(Url::to(['../dashboard']));
                }
                
                for($row = 1; $row <= 4 ; $row++){
                    $rowData = $sheet->rangeToArray('A'.$row.':'.'B'.$row,NULL,True,False);

                    if ($row == 2){
                        //date('F j, Y', strtotime($schedule_info['added']))
                      $title_data_temp[] = [ date('Y-m-d', strtotime($rowData[0][1]))];
                    } elseif($row == 3){
                      $title_data_temp[] = [ date('Y-m-d', strtotime($rowData[0][1]))];
                    } else {
                        $title_data_temp[] = [$rowData[0][1]];
                    }
                }

                $title_data[] = [$title_data_temp[0][0], $title_data_temp[1][0], $title_data_temp[2][0], $title_data_temp[3][0]];

                $training_count = MluManualTraining::find()->where(['name' => $title_data_temp[0][0]])
                                                           ->andWhere(['date_conduct' => $title_data_temp[1][0]])
                                                           ->andWhere(['date_conduct_to' => $title_data_temp[2][0]])
                                                           ->andWhere(['trainor' => $title_data_temp[3][0]])
                                                           ->count();

                if($training_count == 0){
                  Yii::$app->db->createCommand()
                               ->batchInsert('mlu_manual_training', ['name', 'date_conduct', 'date_conduct_to', 'trainor'], $title_data)
                               ->execute(); 
                }

                $training_info = MluManualTraining::find()->where(['name' => $title_data_temp[0][0]])
                                                          ->andWhere(['date_conduct' => $title_data_temp[1][0]])
                                                          ->andWhere(['date_conduct_to' => $title_data_temp[2][0]])
                                                          ->andWhere(['trainor' => $title_data_temp[3][0]])
                                                          ->one();

                $diamond_data_temp = [];
                $gold_data_temp = [];
                for($row = 6; $row <= $highestRow; $row++){
                    $rowData = $sheet->rangeToArray('A'.$row.':'.$highestColumn.$row,NULL,True,False);
                    
                    if ($row == 6){
                      continue;
                    }

                    $chck_assessment_exist = MluManualAssessment::find()->where(['training_id' =>$training_info['id']])
                                                                        ->andWhere(['id_number' => $rowData[0][2]])
                                                                        ->count();

                    switch ($switch_me) {
                      case "diamond":
                      $clarity_val = $rowData[0][5];
                      $color_val = $rowData[0][6];
                      $cut_val = $rowData[0][7];
                      $carat_val = $rowData[0][8];

                      if (strpos($clarity_val, '.') !== false) { 
                        $clarity_temp = $clarity_val * 100;
                        $clarity = $clarity_temp . '%';
                      } else{
                        $clarity = $clarity_val. '%';
                      }

                      if (strpos($color_val, '.') !== false) { 
                        $clarity_temp = $color_val * 100;
                        $color = $clarity_temp . '%';
                      } else{
                        $color = $color_val. '%';
                      }

                      if (strpos($cut_val, '.') !== false) { 
                        $clarity_temp = $cut_val * 100;
                        $cut = $clarity_temp . '%';
                      } else{
                        $cut = $cut_val. '%';
                      }

                      if (strpos($carat_val, '.') !== false) { 
                        $clarity_temp = $carat_val * 100;
                        $carat = $clarity_temp . '%';
                      } else{
                        $carat = $carat_val. '%';
                      }

                        $diamond_data_temp[] = [$training_info['id'], $rowData[0][2], $clarity, $color, $cut, $carat];

                        if ($chck_assessment_exist == 0){
                          $data[] = [$training_info['id'], $rowData[0][0], $rowData[0][1], $rowData[0][2], $rowData[0][3], $rowData[0][4]];
                        }
                      break;

                      case "gold":
                      $day1 = $rowData[0][5];
                      $day2 = $rowData[0][6];

                      if (strpos($day1, '.') !== false) { 
                        $day1_temp = $day1 * 100;
                        $firstday = $day1_temp . '%';
                      } else{
                        $firstday = $day1. '%';
                      }

                      if (strpos($day2, '.') !== false) { 
                        $day2_temp = $day2 * 100;
                        $seconday = $day2_temp . '%';
                      } else{
                        $seconday = $day2. '%';
                      }

                        $gold_data_temp[] = [$training_info['id'], $rowData[0][2], $firstday, $seconday];

                        if ($chck_assessment_exist == 0){
                          $data[] = [$training_info['id'], $rowData[0][0], $rowData[0][1], $rowData[0][2], $rowData[0][3], $rowData[0][4]];
                        }
                      break;

                      case "default":
                        if ($chck_assessment_exist == 0){
                          $data[] = [$training_info['id'], $rowData[0][0], $rowData[0][1], $rowData[0][2], $rowData[0][3], $rowData[0][4]];
                        }
                      break;
                      default:
                    }

                }

                Yii::$app->db->createCommand()
                             ->batchInsert('mlu_manual_assessment', ['training_id', 'fname', 'lname', 'id_number', 'region', 'area'], $data)
                             ->execute(); 

                if ($analyzer == 'diamond'){
                  $diamond_data = [];
                  for($i = 0; $i < sizeof($diamond_data_temp); $i++){
                    $get_user_info = MluManualAssessment::find()->where(['training_id' => $diamond_data_temp[$i][0]])
                                                                ->andWhere(['id_number' => $diamond_data_temp[$i][1]])
                                                                ->one();
                    
                    $diamond_exist = MluManualDiamond::find()->where(['examinee_id' => $get_user_info->id])->count();

                    if ($diamond_exist == 0){
                      $diamond_data[] = [$get_user_info->id, $diamond_data_temp[$i][2], $diamond_data_temp[$i][3], $diamond_data_temp[$i][4], $diamond_data_temp[$i][5]];
                    }
                  }

                  Yii::$app->db->createCommand()
                             ->batchInsert('mlu_manual_diamond', ['examinee_id', 'clarity', 'color', 'cut', 'carat'], $diamond_data)
                             ->execute(); 
                }

                if ($analyzer == 'gold'){
                  $gold_data = [];
                  for($i = 0; $i < sizeof($gold_data_temp); $i++){
                    $get_user_info = MluManualAssessment::find()->where(['training_id' => $gold_data_temp[$i][0]])
                                                                ->andWhere(['id_number' => $gold_data_temp[$i][1]])
                                                                ->one();
                    
                    $gold_exist = MluManualGold::find()->where(['examinee_id' => $get_user_info->id])->count();

                    if ($gold_exist == 0){
                      $gold_data[] = [$get_user_info->id, $gold_data_temp[$i][2], $gold_data_temp[$i][3]];
                    }
                  }

                  Yii::$app->db->createCommand()
                             ->batchInsert('mlu_manual_gold', ['examinee_id', 'day1', 'day2'], $gold_data)
                             ->execute(); 
                }

                    //print_R($title_data);
                    //print_R($data); // display all the data from excel file. stop here

                Yii::$app->getSession()->setFlash('uploadmanual', 'Training Successfully uploaded!');

                return $this->redirect(Url::to(['../dashboard']));

            } else{
                Yii::$app->getSession()->setFlash('uploadmanualfail', 'Unrecognized File!');

                return $this->redirect(Url::to(['../dashboard']));
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionManualenrolleeBreakOld($id)
    {
      $query = MluManualAssessment::find()->where(['training_id' => $id]);
        $perpage = 10;
        $pagination = new Pagination([
            'defaultPageSize' => $perpage,
            'totalCount' => $query->count(),
            ]);

        $enrollee = $query->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();
        /*******************************************************************************/
        //$enrollee = MluManualAssessment::find()->where(['training_id' => $id])->all();
        $title = MluManualTraining::find()->where(['id' => $id])->one();

        return $this->render('manualenrollee', [
                'enrollee' => $enrollee,
                'title' => ucwords($title['name']),
                'pagination' => $pagination,
                'dataProvider' => $enrollee,
                'perpage' => $perpage,
            ]);
    }

    public function actionIndividualcert($id)
    {
      //Yii::$app->session['manual_individual'] = $id;
      $individual_cert = MlumanualAssessment::find()->where(['id' => $id])->one();
      $training = MluManualTraining::find()->where(['id' => $individual_cert['training_id']])->one();
      $diamond_check = MluManualDiamond::find()->where(['examinee_id' => $id])->count();
      $gold_check = MluManualGold::find()->where(['examinee_id' => $id])->count();

      $content = $this->renderPartial('individualcert', [
        'individual_cert' => $individual_cert,
        'training' => $training,
        'diamond_check' => $diamond_check,
        'gold_check' => $gold_check,
        'id' => $id,
      ]);

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

    public function actionAttendedcert($id)
    {
      $attended_cert = MlumanualAssessment::find()->where(['id' => $id])->one();
      $attended_all = MlumanualAssessment::find()->where(['id_number' => $attended_cert['id_number']])->all();

      $content = $this->renderPartial('attendedcert', [
        'attended_cert' => $attended_cert,
        'attended_all' => $attended_all,
      ]);

      $mpdf = new Mpdf();
      $mpdf->SetDisplayMode('fullpage');
      //$mpdf->SetFooter('Learning and Development Generated Report. '. date('M d, Y'));
      $mpdf->SetTitle('Attended Certificate');

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

    public function actionDownloadform()
    {
      $path = Yii::getAlias('@webroot'). '/format';
      $file = $path. '/Format.xlsx';
      if (file_exists($file)){
        Yii::$app->response->SendFile($file);
        //Yii::$app->response->xSendFile($file);
      } /*else{
      $this->render('download404');
      }*/
    }

    public function actionDownloadformgold()
    {
      $path = Yii::getAlias('@webroot'). '/format';
      $file = $path. '/Formatgold.xlsx';
      if (file_exists($file)){
        Yii::$app->response->SendFile($file);
      }
    }

    public function actionDownloadformdiamond()
    {
      $path = Yii::getAlias('@webroot'). '/format';
      $file = $path. '/Formatdiamond.xlsx';
      if (file_exists($file)){
        Yii::$app->response->SendFile($file);
      }
    }

    public function actionTrainingreport($id)
    {
      //Yii::$app->session['training'] = $id;
      $training_info = MluManualTraining::find()->where(['id' => $id])->one();
      $attendee = MluManualAssessment::find()->where(['training_id' => $id])->orderBy(['region'=>SORT_ASC, 'area'=>SORT_ASC])->all();

      $content = $this->renderPartial('trainingreport', [
        'title' => ucwords($training_info['name']),
        'facilitator' => ucwords($training_info['trainor']),
        'attendee' => $attendee,
        'date_conduct' => date('F j, Y', strtotime($training_info['date_conduct'])),
      ]);

      $mpdf = new Mpdf();
      $mpdf->SetDisplayMode('fullpage');
      $mpdf->SetFooter('ML University Generated Report. '. date('M d, Y'));
      $mpdf->SetTitle('Training Report');

      $writeme = $content;

      $mpdf->SetWatermarkText('ML University', 0.15);

      $mpdf->watermark_font = 'DejaVuSansCondensed';
      $mpdf->showWatermarkText = true;

      $mpdf->SetWatermarkImage(dirname(__FILE__).'/../pdf/watermark/smalllogo.jpg', 0.10, '');
      $mpdf->showWatermarkImage = true;

      $mpdf->WriteHTML($writeme);

      $filename="trainingreport.pdf";

      $mpdf->Output($filename, 'I');
    }

    public function actionRegionreport($id, $rname)
    {
      //Yii::$app->session['training'] = $id;
      //Yii::$app->session['regionname'] = $rname;

      $training_info = MluManualTraining::find()->where(['id' => $id])->one();
      $attendee = MluManualAssessment::find()->where(['training_id' => $id])
                  ->andWhere(['region' => $rname])
                  ->orderBy(['area'=>SORT_ASC])->all();

      $content = $this->renderPartial('regionreport', [
        'training_info' => $training_info,
        'attendee' => $attendee,
      ]);

      $mpdf = new Mpdf();
      $mpdf->SetDisplayMode('fullpage');
      $mpdf->SetFooter('ML University Generated Report. '. date('M d, Y'));
      $mpdf->SetTitle('Region Report');

      $writeme = $content;

      $mpdf->SetWatermarkText('ML University', 0.15);

      $mpdf->watermark_font = 'DejaVuSansCondensed';
      $mpdf->showWatermarkText = true;

      $mpdf->SetWatermarkImage(dirname(__FILE__).'/../pdf/watermark/smalllogo.jpg', 0.10, '');
      $mpdf->showWatermarkImage = true;

      $mpdf->WriteHTML($writeme);

      $filename="regionreport.pdf";

      $mpdf->Output($filename, 'I');
    }

    public function actionAreareport($id, $rname, $aname)
    {
      //Yii::$app->session['training'] = $id;
      //Yii::$app->session['regionname'] = $rname;

      $training_info = MluManualTraining::find()->where(['id' => $id])->one();
      $attendee = MluManualAssessment::find()->where(['training_id' => $id])
                  ->andWhere(['region' => $rname])
                  ->andWhere(['area' => $aname])
                  ->orderBy(['area'=>SORT_ASC])->all();

      $content = $this->renderPartial('areareport', [
        'training_info' => $training_info,
        'attendee' => $attendee,
      ]);

      $mpdf = new Mpdf();
      $mpdf->SetDisplayMode('fullpage');
      $mpdf->SetFooter('ML University Generated Report. '. date('M d, Y'));
      $mpdf->SetTitle('Area Report');

      $writeme = $content;

      $mpdf->SetWatermarkText('ML University', 0.15);

      $mpdf->watermark_font = 'DejaVuSansCondensed';
      $mpdf->showWatermarkText = true;

      $mpdf->SetWatermarkImage(dirname(__FILE__).'/../pdf/watermark/smalllogo.jpg', 0.10, '');
      $mpdf->showWatermarkImage = true;

      $mpdf->WriteHTML($writeme);

      $filename="areareport.pdf";

      $mpdf->Output($filename, 'I');
    }

    /**
     * Updates an existing MluManualAssessment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    /*public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }*/

    public function actionManualenrollee($id)
    {
        $region = array();
        $searchModel = new MluManualAssessmentManualSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //$dataProvider->query->andWhere(['training_id' => $id])->andWhere(['region' => ['Bazam', 'Tarpan']]);
        $counter = 0;

        if ((Yii::$app->user->can('administrator')) || Yii::$app->user->can('system admin')){
          $dataProvider->query->andWhere(['training_id' => $id]);
        } else{
          $user_id = Yii::$app->user->identity->id;
          $count_role_user = MluRoleUser::find()->where(['user_id' => $user_id])->count();
          if ($count_role_user > 0){
            $check_role_user = MluRoleUser::find()->where(['user_id' => $user_id])->all();
              foreach($check_role_user as $check_role_user_result):
                $count_role_assign = MluRoleAssignment::find()->where(['assign_id' => $check_role_user_result->id])->count();
                if ($count_role_assign > 0){
                  $counter = $counter + 1;
                  $role_assign = MluRoleAssignment::find()->where(['assign_id' => $check_role_user_result->id])->all();
                  foreach($role_assign as $role_assign_result):
                    $region_assign = MluRegion::find()->where(['id' => $role_assign_result->region_id])->one();
                    //@$region = $region. "'" .$region_assign->full_name. "'" .", ";
                    array_push($region, $region_assign->full_name);
                  endforeach;
                }
              endforeach;

              if ($counter > 0){
                $dataProvider->query->andWhere(['training_id' => $id])->andWhere(['region' => $region]);
              } else{
                $dataProvider->query->andWhere(['training_id' => 0]);
              }
          } else{
            $dataProvider->query->andWhere(['training_id' => 0]);
          }

        }

        $title = MluManualTraining::find()->where(['id' => $id])->one();

        $date_conduct_to_temp = date('F j, Y', strtotime($title['date_conduct_to']));
        if($date_conduct_to_temp != "January 1, 1970"){
          $conduct_date = date('j', strtotime($title['date_conduct_to']));
          $date = date('F j-'.$conduct_date.', Y', strtotime($title['date_conduct']));
        } else{
          $date = date('F j, Y', strtotime($title['date_conduct']));
        }

        return $this->render('manualassessment', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'title' => ucwords($title['name']),
            'date' => $date,
            'facilitator' => ucwords($title['trainor']),
            //
            /*'sample_user_id' => $user_id,
            'sample_region' => $region,
            'counter' => $counter,*/
        ]);
    }

    /**
     * Deletes an existing MluManualAssessment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $check_gold = MluManualGold::find()->where(['examinee_id' => $id])->count();
        if ($check_gold > 0){
          Yii::$app->db->createCommand()->delete('mlu_manual_gold', ['examinee_id' => $id])->execute();
        }

        $check_diamond = MluManualDiamond::find()->where(['examinee_id' => $id])->count();
        if ($check_diamond > 0){
          Yii::$app->db->createCommand()->delete('mlu_manual_diamond', ['examinee_id' => $id])->execute();
        }

        Yii::$app->db->createCommand()->delete('mlu_manual_assessment', ['id' => $id])->execute();

        Yii::$app->session->setFlash('deleteexaminee', 'Attendee successfully delete!');

          return $this->redirect(['index']);
    }

    public function actionDeletexaminee($id)
    {
        $check_gold = MluManualGold::find()->where(['examinee_id' => $id])->count();
        if ($check_gold > 0){
          Yii::$app->db->createCommand()->delete('mlu_manual_gold', ['examinee_id' => $id])->execute();
        }

        $check_diamond = MluManualDiamond::find()->where(['examinee_id' => $id])->count();
        if ($check_diamond > 0){
          Yii::$app->db->createCommand()->delete('mlu_manual_diamond', ['examinee_id' => $id])->execute();
        }

        Yii::$app->db->createCommand()->delete('mlu_manual_assessment', ['id' => $id])->execute();

        Yii::$app->session->setFlash('deleteexaminee', 'Attendee successfully delete!');

          return $this->redirect(['manualenrollee', 'id'=>Yii::$app->session['training_id']]);
    }

    public function actionList(){
      $training_list = MluManualTraining::find()->all();

      return $this->render('list',[
        'training_list' => $training_list,
      ]);
    }

    /**
     * Finds the MluManualAssessment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MluManualAssessment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MluManualAssessment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

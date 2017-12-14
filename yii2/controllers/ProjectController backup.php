<?php
namespace app\controllers;

use Yii;
use yii\db\Query;
use yii\filters\AccessControl;
use app\models\InvestorProject;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\User;
use app\models\UserProfile;
use app\models\Roles; 
use app\models\InvestorProjects;
use app\models\UploadForm;
use app\models\UploadedFile;
use app\models\Country;
use app\models\State;
use app\models\Tehsil;
use app\models\City;
use app\models\Town;
use yii\helpers\Html;
use yii\helpers\BaseUrl;
use app\models\CompanyType;
use app\models\MmLineOfActivity;
use app\components\DefaultUtility;
use app\models\WorkflowHistoryExt;

class ProjectController extends \yii\web\Controller { 
	
	public $layout = 'investorLayoutIspiniaCaf';
	
	//public $layout = 'investorLayoutIspinia'; 

	public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => [ 'index', 'profile', 'service'],
                'rules' => [
                    [ 
                        'allow' => true,
                        'roles' => ['@'],
                    ], 
                ],
            ],  
        ];
    }


    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                //'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


    public function actionIndex() {  

    }
		 
	public function actionStates($id) { 

        $rows = State::find()->all();
        echo "<option>Select</option>";
        
		if(isset($rows)) {
			if(count($rows)>0){
				foreach($rows as $row){
					echo "<option value='$row->country_id'>$row->name</option>";
				}
			}
			else{
				echo "<option>No States Available</option>";
			}
		}
   
 
    }
	public function actionDistrictcities($id) { 

        $rows = City::find()->where(['district_id'=>$id])->all();
//$rows = City::find()->where(['investor_id'=>$id])->one();		

        echo "<option>Select</option>";
        
		if(isset($rows)) {
			if(count($rows)>0){
				foreach($rows as $row){
					echo "<option value='$row->id'>$row->name</option>";
				}
			}
			else{
				echo "<option>No Districts Available</option>";
			}
		}
   
 
    }
	public function actionDistricttehsils($id) { 

        $rows = Tehsil::find()->where(['district_id'=>$id])->all();
 
        echo "<option>Select</option>";
        
		if(isset($rows)) {
			if(count($rows)>0){
				foreach($rows as $row){
					echo "<option value='$row->id'>$row->name</option>";
				}
			}
			else{
				echo "<option>No Tehsil Available</option>";
			}
		}
   
 
    }


	public function actionCitytowns($id) { 

        $rows = Town::find()->where(['city_id'=>$id])->all(); 
        echo "<option>Select</option>";
        
		if(isset($rows)) {
			if(count($rows)>0){
				foreach($rows as $row){
					echo "<option value='$row->id'>$row->name</option>";
				}
			}
			else{
				echo "<option>No towns available</option>";
			}
		}
   
 
    }

	
	public function actionView() { 

		$user_id = '';
		if(isset(Yii::$app->user->identity->id)) {
			$user_id = Yii::$app->user->identity->id; 
		}
		
		$project_id = Yii::$app->getRequest()->getQueryParam('projectId');
		
		if($project_id == '') {
			return $this->redirect(['investor/index']);
		}

		$query = InvestorProjects::find();  
        $investor_project = $query->where(['investor_id' => $user_id, 'id' => $project_id])->one();	
		
		if(count($investor_project) == 0) {
			return $this->redirect(['investor/index']);
		}  
		
			$query = new Query;
			$query->select('m2, name')->from('yii_master_code')->where(['m1' => '1'])->orderBy('name');
			$command = $query->createCommand();
            $sectors = $command->queryAll(); 

            $query_compny = CompanyType::find();
	        $comp_type = $query_compny->orderBy('name')->all();
		
		return $this->render('projectview', [
			'comp_type' => $comp_type,
			'model' => $investor_project,
			'user_id' => $user_id,
			'sectors'=>$sectors
		]);  		 
 
	}

	/**
	* this function is used to call the api this can be used as common function is DefaultUtility
	*/
	private function callAPI($requestParams,$url){
		if(count($requestParams)>1){
			$url .= http_build_query($requestParams,'','&');
			if(file_get_contents($url))
				return true;
		}
		return false;
	}


	/**
	*@author Hemant Thakur
	* cleaned the code
	*/

	public function actionAdd(){
		$user_id=Yii::$app->user->identity->id;    // check this is not using access rules
		$model = new InvestorProjects();
		if(isset($_POST['InvestorProjects'])){
			$post = DefaultUtility::sanatizeParams(Yii::$app->request->post());
			$post['InvestorProjects']['investor_id']=$user_id;
			$post['InvestorProjects']['type']='new';
			$model->load($post);
			if ($model->validate() && $model->save()) {
				$arr_param = array(
							'r'=>'notifications/createnotifications',
							'caf_id' => $model->id,
							'service_id' => '',
							'user_id' => $user_id,
							't_event' => "New Project submited by investor",
							'notification_detail' => "New Project submited by investor",
							'date_created' => date('Y-m-d H:i:s')
						);
				// $this->callAPI($arr_param,Yii::$app->getUrlManager()->createAbsoluteUrl('/'));
				Yii::$app->getSession()->setFlash('success', 'Thank you for your interest! The project Details are shared with Dept. for approval. Once approved you will be able to avail services.'); 
				/*
				* add common method to send the notification to investor as well as department user which needs to be developed in the DefaultUtility
				*/
				WorkflowHistoryExt::generateHistory("PROJECT_APPROVAL",2,$user_id,4,"Applicant has submitted the application to department for their review.",'P');
	            return $this->redirect(['investor/index']);

        	}
        	else{
        		$err="";
        		// echo "<pre>";print_r($model->geterrors());die;

        		foreach ($model->geterrors() as $field => $errors) {
        			foreach ($errors as $key => $errs) {
        				$err.="'" . $field . "' " .$errs;
        			}
        		}
        		Yii::$app->getSession()->setFlash('error', "Please resolove following issues: ". $err); 

        	}
		}
		/**
		*@bharar, clean this below 4 lines according the model
		*/
		$query = new Query;
		$query->select('m2, name')->from('yii_master_code')->where(['m1' => '1'])->orderBy('name');
		$command = $query->createCommand();
        $sectors = $command->queryAll(); 

		$comp_type = CompanyType::find()->orderBy('name')->all();
		return $this->render('project', [
		 	'comp_type' => $comp_type,
			'model' => $model,
			'user_id' => $user_id,
			'sectors' => $sectors]);  



	}
	public function actionExisting() { 

		$user_id = '';
		if(isset(Yii::$app->user->identity->id)) {
			
			$user_id = Yii::$app->user->identity->id; 
		}

        $model = new InvestorProjects();  
 
        $request = Yii::$app->request;
		$post = $request->post();


		if (count($post)) {
			$model->investor_id = $user_id;
			$model->department_approval = 1; 
			$model->type = 'existing'; 
		}

        if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
			
			Yii::$app->getSession()->setFlash('success', 'Project added successfully!'); 
            return $this->redirect(['investor/index']);

        }
		else {
            return $this->render('existing', [
			'model' => $model,
			'user_id' => $user_id]);  
        }
		 
 
	} 

}
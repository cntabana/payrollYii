<?php

class PayrollController extends CController
{
        public $breadcrumbs;
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='main';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','upload'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','GeneratePdf','GenerateExcel'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView()
	{
		$id=$_REQUEST["id"];
	     
	       if(Yii::app()->request->isAjaxRequest)
	       {
	         $this->renderPartial('ajax_view',array(
			'model'=>$this->loadModel($id),
		));
	         
	       }
	       else
	       {
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	       }
	}

	public function actionUpload(){
      
       $model = new Payroll;

		// Uncomment the following line if AJAX validation is needed
		//$this->performAjaxValidation($model,"payroll-upload-csv");
		

 	//	if (isset($_POST['Payroll'])) {
           
           $rnd = rand(0,9999);  // generate random number between 0-9999
           $model->setAttributes($_POST['Payroll']); //is always in action create
 
            $uploadedFile=CUploadedFile::getInstance($model,'filename');
           
           if(!empty($uploadedFile)){
			$fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
            $model->filename = $fileName;
            }
				$csv_file = 'csv/'.$fileName;
				$uploadedFile->saveAs($csv_file);  // image 
				$csvfile = fopen($csv_file, 'r');
				$i = 0;
			 
				//	$row = 1;
					$csvfile = fopen($csv_file, "r");
					
				while (!feof($csvfile))
				{
				   $csv_data[] = fgets($csvfile, 1024);
				   $csv_array = explode(",", $csv_data[$i]);
				   $insert_csv = array();
				   if(!empty($csv_array[0])){

				   	          $olddate = str_replace('"', ' ', $csv_array[4]);             // returns bool(false)
                              $Work_Date = strtotime(str_replace('/', '-', $olddate));  	 
                              
					                   $names = explode(" ", $csv_array[0]);  
										if(sizeof($names) == 3){
										$firstname = $names[0];
										$middlename = $names[1];
										$familyname = $names[2];
										}
										else if(sizeof($names) == 2){
										$firstname = $names[0];
										$familyname = $names[1];
										$middlename = '';
										}else{

										$firstname = $names[0];
										$middlename = '';
										$familyname = '';
										}

	                                   $insert_csv['firstname'] = str_replace('"', ' ',$firstname);
									   $insert_csv['middlename'] = str_replace('"', ' ',$middlename);
									   $insert_csv['familyname'] = str_replace('"', ' ',$familyname);
									   $insert_csv['Payroll_Ref']= $csv_array[1];
									   $insert_csv['Total_Hours_Worked'] = $csv_array[2];
									   $insert_csv['Total_Pay'] = $csv_array[3];
									   $insert_csv['Work_Date'] = $Work_Date;
							    
									   $query = "INSERT INTO payroll (firstname,familyname,middlename,Payroll_Ref,Total_Hours_Worked,Total_Pay,Work_Date ) VALUES
									             ('".$insert_csv['firstname']."',
									              '".$insert_csv['familyname']."',
									              '".$insert_csv['middlename']."',
									              ".$insert_csv['Payroll_Ref'].",
									              ".$insert_csv['Total_Hours_Worked'].",
									              ".$insert_csv['Total_Pay'].",
									              ".$insert_csv['Work_Date']."
									              )";
                                     if($i>0) {
									  $connection=Yii::app()->db->createCommand($query)->execute();
									}

									  
									  
									   $i++;

				   }
				  
				  
				} 
				
					fclose($csvfile);


			if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('index'));
			
	//	}

		//$this->render('create', array( 'model' => $model));

	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{	
            $model=new Payroll;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model,"payroll-create-form");
            if(Yii::app()->request->isAjaxRequest)
	       {
		    if(isset($_POST['Payroll']))
		    {
			    $model->attributes=$_POST['Payroll'];
			    if($model->save())
			    {
			      echo $model->id;
			    }
			    else
			    {
			      echo "false";
			    } 
			    return;
		    }
	       }
	       else
	       {
	           if(isset($_POST['Payroll']))
		    {
			    $model->attributes=$_POST['Payroll'];
			    if($model->save())
			     $this->redirect(array('view','id'=>$model->id));
			
		    }
               
		    $this->render('create',array(
			    'model'=>$model,
		    ));
	       }	
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate()
	{
      
	    $id=isset($_REQUEST["id"])?$_REQUEST["id"]:$_REQUEST["Payroll"]["id"];
	    $model=$this->loadModel($id);
			    
	    // Uncomment the following line if AJAX validation is needed
	      $this->performAjaxValidation($model,"payroll-update-form");
	    
	  if(Yii::app()->request->isAjaxRequest)
	    {
	    
		if(isset($_POST['Payroll']))
		{
		  
			$model->attributes=$_POST['Payroll'];
			if($model->save())
			{
			  echo $model->id;
			}
			else
			{
			  echo "false";
			}
			return;
		}
		    
		  $this->renderPartial('_ajax_update_form',array(
		    'model'=>$model,
		    ));
		  return; 
	    
	    }
	    

	    if(isset($_POST['Payroll']))
	    {
		    $model->attributes=$_POST['Payroll'];
		    if($model->save())
			    $this->redirect(array('view','id'=>$model->id));
	    }

	    $this->render('update',array(
		    'model'=>$model,
	    ));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete()
	{
	        $id=$_POST["id"];
	   
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset(Yii::app()->request->isAjaxRequest))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
			else
			   echo "true";
		}
		else
		{
		    if(!isset($_GET['ajax']))
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		    else
			   echo "false"; 	
	        }	
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
            $session=new CHttpSession;
            $session->open();		
            $criteria = new CDbCriteria();            

                $model=new Payroll('search');
                $model->unsetAttributes();  // clear any default values

                if(isset($_GET['Payroll']))
		{
                        $model->attributes=$_GET['Payroll'];
			
			
                   	
                       if (!empty($model->firstname)) $criteria->addCondition('firstname = "'.$model->firstname.'"');
                     
                    	
                       if (!empty($model->familyname)) $criteria->addCondition('familyname = "'.$model->familyname.'"');
                     
                    	
                       if (!empty($model->middlename)) $criteria->addCondition('middlename = "'.$model->middlename.'"');
                     
                    	
                       if (!empty($model->Payroll_Ref)) $criteria->addCondition('Payroll_Ref = "'.$model->Payroll_Ref.'"');
                     
                    	
                       if (!empty($model->Total_Hours_Worked)) $criteria->addCondition('Total_Hours_Worked = "'.$model->Total_Hours_Worked.'"');
                     
                    	
                       if (!empty($model->Total_Pay)) $criteria->addCondition('Total_Pay = "'.$model->Total_Pay.'"');
                     
                    	
                       if (!empty($model->Work_Date)) $criteria->addCondition('Work_Date = "'.$model->Work_Date.'"');
                     
                    	
                       if (!empty($model->id)) $criteria->addCondition('id = "'.$model->id.'"');
                     
                    			
		}
                 $session['Payroll_records']=Payroll::model()->findAll($criteria); 
       

                $this->render('index',array(
			'model'=>$model,
		));

	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Payroll('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Payroll']))
			$model->attributes=$_GET['Payroll'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Payroll::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model,$form_id)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']===$form_id)
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        public function actionGenerateExcel()
	{
            $session=new CHttpSession;
            $session->open();		
            
             if(isset($session['Payroll_records']))
               {
                $model=$session['Payroll_records'];
               }
               else
                 $model = Payroll::model()->findAll();

		
		Yii::app()->request->sendFile(date('YmdHis').'.xls',
			$this->renderPartial('excelReport', array(
				'model'=>$model
			), true)
		);
	}
        public function actionGeneratePdf() 
	{
           $session=new CHttpSession;
           $session->open();
		Yii::import('application.extensions.ajaxgii.bootstrap.*');
		require_once('tcpdf/tcpdf.php');
		require_once('tcpdf/config/lang/eng.php');

             if(isset($session['Payroll_records']))
               {
                $model=$session['Payroll_records'];
               }
               else
                 $model = Payroll::model()->findAll();



		$html = $this->renderPartial('expenseGridtoReport', array(
			'model'=>$model
		), true);
		
		//die($html);
		
		$pdf = new TCPDF();
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor(Yii::app()->name);
		$pdf->SetTitle('Payroll Report');
		$pdf->SetSubject('Payroll Report');
		//$pdf->SetKeywords('example, text, report');
		$pdf->SetHeaderData('', 0, "Report", '');
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "Example Report by ".Yii::app()->name, "");
		$pdf->setHeaderFont(Array('helvetica', '', 8));
		$pdf->setFooterFont(Array('helvetica', '', 6));
		$pdf->SetMargins(15, 18, 15);
		$pdf->SetHeaderMargin(5);
		$pdf->SetFooterMargin(10);
		$pdf->SetAutoPageBreak(TRUE, 0);
		$pdf->SetFont('dejavusans', '', 7);
		$pdf->AddPage();
		$pdf->writeHTML($html, true, false, true, false, '');
		$pdf->LastPage();
		$pdf->Output("Payroll_002.pdf", "I");
	}
}

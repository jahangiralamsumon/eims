<?php

class InstitutionConfigurationsController extends Controller
{
	
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
				array('auth.filters.AuthFilter')
		);
	}
	

	
	public function actionSetup()
	{
		$model=new InstituteConfigForm;
		$model->institution_name=InstitutionConfigurations::model()->findByAttributes(array('id'=>1))->config_value;
		$model->institution_short_name=InstitutionConfigurations::model()->findByAttributes(array('id'=>10))->config_value;
		$model->institution_code=InstitutionConfigurations::model()->findByAttributes(array('id'=>2))->config_value;
		$model->institution_address=InstitutionConfigurations::model()->findByAttributes(array('id'=>3))->config_value;
		$model->institution_phone=InstitutionConfigurations::model()->findByAttributes(array('id'=>4))->config_value;
		$model->institution_fax=InstitutionConfigurations::model()->findByAttributes(array('id'=>5))->config_value;
		$model->institution_email=InstitutionConfigurations::model()->findByAttributes(array('id'=>6))->config_value;
		if(isset($_POST['InstituteConfigForm']))
		{
			
			$model->attributes=$_POST['InstituteConfigForm'];			
			if($model->validate()){
				
				$config_1=InstitutionConfigurations::model()->findByAttributes(array('id'=>1));
				$config_1->config_value =$model->institution_name ;
				$config_1->save();
				
				$config_2=InstitutionConfigurations::model()->findByAttributes(array('id'=>2));
				$config_2->config_value =$model->institution_code ;
				$config_2->save();
				
				$config_3=InstitutionConfigurations::model()->findByAttributes(array('id'=>3));
				$config_3->config_value =$model->institution_address ;
				$config_3->save();
				
				$config_4=InstitutionConfigurations::model()->findByAttributes(array('id'=>4));
				$config_4->config_value =$model->institution_phone ;
				$config_4->save();
				
				$config_5=InstitutionConfigurations::model()->findByAttributes(array('id'=>5));
				$config_5->config_value =$model->institution_fax ;
				$config_5->save();
				
				$config_6=InstitutionConfigurations::model()->findByAttributes(array('id'=>6));
				$config_6->config_value =$model->institution_email;
				$config_6->save();
				
				$config_10=InstitutionConfigurations::model()->findByAttributes(array('id'=>10));
				$config_10->config_value =$model->institution_short_name;
				$config_10->save();

				if($file=CUploadedFile::getInstance($model,'logo'))
				{
					
					$path=Yii::app()->basePath.'/../uploadedfiles/';
					if (!is_dir($path))
					{
						mkdir($path,0777);
					}
					
					$path=Yii::app()->basePath.'/../uploadedfiles/institution_logo/';
					if (!is_dir($path))
					{
						mkdir($path,0777);
					}
					
					//move_uploaded_file($file->tempName,$path.$file->name);
				
					$file->saveAs($path.$file->name);  // image
				
					$config_7=InstitutionConfigurations::model()->findByAttributes(array('id'=>7));
					$config_7->config_value = $file->name;
					$config_7->save();
				} 				
			}
			
		}
		$this->render('setup',array('model'=>$model));
	}
	
	
	
	public function actionRemove($id)
	{
	
		$config_7=InstitutionConfigurations::model()->findByAttributes(array('id'=>$id));
		$logo_path=Yii::app()->basePath.'/../uploadedfiles/institution_logo/'.$config_7->config_value;
		if(file_exists($logo_path)){
			unlink($logo_path);
		}
		$config_7->config_value ='';
		$config_7->save(false);
		$this->redirect(array('setup'));
	}
}
<?php

class UserController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */

	public function filters()
	{
		return array(
				'accessControl',
				array('auth.filters.AuthFilter -RemoveImage Profile ProfileEdit ChangePassword'),
				'postOnly + delete', // we only allow deletion via POST request
		);
	}

	
	public function accessRules()
	{
		return array(
				array('allow',  // allow all users to perform 'index' and 'view' actions
						'users'=>array('@'),
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
	public function actionView($id)
	{
		$this->render('view',array(
				'model'=>$this->loadModel($id),
		));
	}
	
	public function  actionProfile(){
		$this->render('profile',array(
				'model'=>$this->loadModel(Yii::app()->user->id),
		));
	}
	
	public function actionProfileEdit(){
		$model=$this->loadModel(Yii::app()->user->id);
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->validate()){
					
				if($file=CUploadedFile::getInstance($model,'user_img'))
				{
		
					$path=Yii::app()->basePath.'/../uploadedfiles/';
					if (!is_dir($path))
					{
						mkdir($path,0777);
					}
		
					$path=Yii::app()->basePath.'/../uploadedfiles/userimage/';
					if (!is_dir($path))
					{
						mkdir($path,0777);
					}
		
					$path=Yii::app()->basePath.'/../uploadedfiles/userimage/'.$model->id.'/';
					if (!is_dir($path))
					{
						mkdir($path,0777);
					}
		
					//move_uploaded_file($file->tempName,$path.$file->name);
		
					$file->saveAs($path.$file->name);  // image
		
					//$model=InstitutionConfigurations::model()->findByAttributes(array('id'=>7));
					$model->user_img = $file->name;
		
				}
				$model->save();
				$this->redirect(array('profile'));
				
			}
		}
		
		$this->render('change_profile',array(
				'model'=>$model,
		));
		
		
	}

	public function actionChangePassword()
	{
		$model=new ChangePassword;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['ChangePassword']))
		{
			$model->attributes=$_POST['ChangePassword'];
			if($model->validate()){
				$user =User::model()->findByPk(Yii::app()->user->id);
				$user->password=hash_hmac('sha256',$model->new_password,Yii::app()->params['encryptionKey']);			
				if($user->save()){
					Yii::app()->user->setFlash('success','Password Change Successful.');
					$this->refresh();
				}
			}
		}
		
	
		$this->render('change_password',array(
				'model'=>$model,
		));
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new User;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->validate()){

				$criteria=new CDbCriteria;
				$criteria->select='max(id) AS id';
				$row =User::model()->find($criteria);
				$max =isset($row->id)?$row->id:0;
				$model->id=$max+1;

				if($file=CUploadedFile::getInstance($model,'user_img'))
				{

					$path=Yii::app()->basePath.'/../uploadedfiles/';
					if (!is_dir($path))
					{
						mkdir($path,0777);
					}

					$path=Yii::app()->basePath.'/../uploadedfiles/userimage/';
					if (!is_dir($path))
					{
						mkdir($path,0777);
					}

					$path=Yii::app()->basePath.'/../uploadedfiles/userimage/'.$model->id.'/';
					if (!is_dir($path))
					{
						mkdir($path,0777);
					}

					//move_uploaded_file($file->tempName,$path.$file->name);

					$file->saveAs($path.$file->name);  // image

					//$model=InstitutionConfigurations::model()->findByAttributes(array('id'=>7));
					$model->user_img = $file->name;

				}
				$model->save();
				$this->redirect(array('AssignRole', 'user_id' => $model->id));
			}
		}

		$this->render('create',array(
				'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->validate()){
				$model->password=hash_hmac('sha256',$model->password,Yii::app()->params['encryptionKey']);
				if($file=CUploadedFile::getInstance($model,'user_img'))
				{

					$path=Yii::app()->basePath.'/../uploadedfiles/';
					if (!is_dir($path))
					{
						mkdir($path,0777);
					}

					$path=Yii::app()->basePath.'/../uploadedfiles/userimage/';
					if (!is_dir($path))
					{
						mkdir($path,0777);
					}

					$path=Yii::app()->basePath.'/../uploadedfiles/userimage/'.$model->id.'/';
					if (!is_dir($path))
					{
						mkdir($path,0777);
					}

					//move_uploaded_file($file->tempName,$path.$file->name);

					$file->saveAs($path.$file->name);  // image

					//$model=InstitutionConfigurations::model()->findByAttributes(array('id'=>7));
					$model->user_img = $file->name;
					
				

				}
				$model->save();
				$this->redirect(array('AssignRole', 'user_id' => $model->id));
			}
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
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('User');
		$this->render('index',array(
				'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->render('admin',array(
				'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param User $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public  function actionAssignRole($user_id){

		$formModel = new AddAuthItemForm();

		if (isset($_POST['AddAuthItemForm']))
		{
			$am = Yii::app()->getAuthManager();
			$formModel->attributes = $_POST['AddAuthItemForm'];
			if ($formModel->validate())
			{
				if (!$am->isAssigned($formModel->items, $user_id))
				{
					$am->assign($formModel->items, $user_id);
					if ($am instanceof CPhpAuthManager)
						$am->save();

					if ($am instanceof ICachedAuthManager)
						$am->flushAccess($formModel->items, $user_id);
				}
			}
		}

		$auth = Yii::app()->authManager;
		$roles = $auth->getRoles($user_id);

		$assignmentOptions = $this->getAssignmentOptions($user_id);

		if (!empty($assignmentOptions))
			$assignmentOptions = array_merge(array('' =>'Select Role' . ' ...'), $assignmentOptions);
			

		$this->render('assign_role',array(
				'roles'=>$roles,
				'user_id'=>$user_id,
				'assignmentOptions'=>$assignmentOptions,
				'formModel'=>$formModel
					
		));

	}

	/**
	 * Revokes an assignment from the given user.
	 * @throws CHttpException if the request is invalid.
	 */
	public function actionRevoke($item_name,$user_id)
	{
		if (isset($item_name,$user_id))
		{
			$item_name = $_GET['item_name'];
			$user_id = $_GET['user_id'];

			/* @var $am CAuthManager|AuthBehavior */
			$am = Yii::app()->getAuthManager();

			if ($am->isAssigned($item_name, $user_id))
			{
				$am->revoke($item_name, $user_id);
				if ($am instanceof CPhpAuthManager)
					$am->save();

				if ($am instanceof ICachedAuthManager)
					$am->flushAccess($item_name, $user_id);
			}


			$this->redirect(array('AssignRole', 'user_id' => $user_id));
		}
		else
			throw new CHttpException(400, Yii::t('AuthModule.main', 'Invalid request.'));
	}

	protected function getAssignmentOptions($user_id)
	{
		$options = array();

		/* @var $am CAuthManager|AuthBehavior */
		$am = Yii::app()->authManager;

		$assignments = $am->getAuthItems(2,$user_id);
		$assignedItems =array_keys($assignments);

		/* @var $authItems CAuthItem[] */
		$authItems = $am->getAuthItems(2);
		foreach ($authItems as $itemName => $item)
		{
			if (!in_array($itemName, $assignedItems))
				$options[$itemName] = $item->description;
		}

		return $options;
	}

	public function actionRoleSetting(){

		if(isset($_POST['role'])&& (strlen($_POST['role'])>1)){

			$role=$_POST['role'];
			$items= $_POST['items'];
			
			if ((Yii::app()->getAuthManager()->getAuthItem($role))=== null)
			{
				Yii::app()->getAuthManager()->createRole($role,$role);
				if (Yii::app()->getAuthManager() instanceof CPhpAuthManager)
					Yii::app()->getAuthManager()->save();
			}
			
		   
			foreach ($items as $item){
				if (!Yii::app()->getAuthManager()->hasItemChild($role,$item))
				{
					Yii::app()->getAuthManager()->addItemChild($role,$item);
					if (Yii::app()->getAuthManager() instanceof CPhpAuthManager)
						Yii::app()->getAuthManager()->save();
				}
				
			}
			
			$this->redirect(array('rolemanage'));
		}
		$tasks = Yii::app()->authManager->getAuthItems(1);
		$this->render('role_setting',array(
				'tasks'=>$tasks,
					
		));

	}
	
	public function actionRoleEdit($name){
		
		$items=array();
		$childs=Yii::app()->authManager->getItemChildren($name);
		foreach ($childs as $key=> $child){
			$items[$key]=$child->name;
		}
		if(isset($_POST['role'])){
		
			$role=$_POST['role'];
			$post_items= $_POST['items'];
											
			 
			foreach ($items as $item){
				if (Yii::app()->getAuthManager()->hasItemChild($role,$item))
				{
					Yii::app()->getAuthManager()->removeItemChild($role,$item);
					if (Yii::app()->getAuthManager() instanceof CPhpAuthManager)
						Yii::app()->getAuthManager()->save();
				}
			}
			
			foreach ($post_items as $item){
				if (!Yii::app()->getAuthManager()->hasItemChild($role,$item))
				{
					Yii::app()->getAuthManager()->addItemChild($role,$item);
					if (Yii::app()->getAuthManager() instanceof CPhpAuthManager)
						Yii::app()->getAuthManager()->save();
				}
			}	
			$this->redirect(array('rolemanage'));
		}
		
	    $tasks = Yii::app()->authManager->getAuthItems(1);
	    $this->render('role_edit',array(
	    		'tasks'=>$tasks,
	    		'items'=>$items,
	    		'role'=>$name
	    			
	    ));
	}
	
	public  function ActionRoleManage(){
		$roles = Yii::app()->authManager->getAuthItems(2);
		$this->render('role_manage',array(
				'roles'=>$roles,
					
		));
		
	} 
	public function actionRemoveImage($id,$redirect=null)
	{

		$model=User::model()->find('id=:id',array(':id'=>$id));
		$logo_path=Yii::app()->basePath.'/../uploadedfiles/userimage/'.$id.'/'.$model->user_img;
		if(file_exists($logo_path)){
			unlink($logo_path);
		}
		$model->user_img ='';
		$model->save(false);
		if($redirect==null){
		$this->redirect(array('update','id'=>$model->id));
		}
		else{
			$this->redirect(array($redirect));
		}
	}
}

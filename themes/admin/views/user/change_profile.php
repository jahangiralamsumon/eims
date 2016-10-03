<?php
$this->breadcrumbs=array(
	'Profile'=>array('profile'),
	'Profile Edit',
);


$this->menu=array(
array('label'=>'Profile', 'url'=>array('profile')),
array('label'=>'Change Password', 'url'=>array('changePassword')),	
);
?>
<div class="tray tray-center p20 va-t posr">
<div class="panel">
	<div class="panel-heading">
		<span class="panel-title">Profile  Details</span>
	</div>
	<div class="panel-body">
<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
	'type' => 'horizontal',
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

		<?php echo $form->textFieldGroup(
			$model,
			'username',
			array(
				'wrapperHtmlOptions' => array(
					'class' => 'col-sm-5',
				),
               'htmlOptions'=>array('class'=>'span5','maxlength'=>300)
			)
		); ?>

	
	<?php echo $form->textFieldGroup(
			$model,
			'name',
			array(
				'wrapperHtmlOptions' => array(
					'class' => 'col-sm-5',
				),
               'htmlOptions'=>array('class'=>'span5','maxlength'=>300)
			)
		); ?>
 	<?php echo $form->textFieldGroup(
			$model,
			'short_name',
			array(
				'wrapperHtmlOptions' => array(
					'class' => 'col-sm-5',
				),
               'htmlOptions'=>array('class'=>'span5','maxlength'=>300)
			)
		); ?>
	
	<?php echo $form->textFieldGroup(
			$model,
			'email',
			array(
				'wrapperHtmlOptions' => array(
					'class' => 'col-sm-5',
				),
               'htmlOptions'=>array('class'=>'span5','maxlength'=>300)
			)
		); ?>

	

	         <?php
						
						if(!$model->isNewRecord)	
						{
							$img=User::model()->find('id=:id',array(':id'=>$model->id))->user_img;
							if(strlen($img)>0){
						?>
						<div class="form-group">
							<label class="col-lg-3 control-label">Logo </label>
							<div class="col-sm-6">
								<?php 
									
								echo '<img class="imgbrder" src="'.Yii::app()->request->baseUrl.'/uploadedfiles/userimage/'.$model->id.'/'.$img .'" alt="'.$img.'" width="100" height="100" />';
								echo CHtml::link(Yii::t('settings','Remove'), array('User/RemoveImage', 'id'=>$model->id,'redirect'=>'profileEdit'));
									
								?>
							</div>
						</div>
						<?php
							 }
							 else {
						?>
						<div class="form-group">
							<?php echo $form->labelEx($model, 'user_img',array('class'=>'col-sm-3 control-label')); ?>
							<div class="col-sm-6">
								<?php 
								echo $form->fileField($model, 'user_img',array('class'=>'btn btn-success fileinput-button'));
								echo $form->error($model, 'user_img');
								?>
							</div>
						</div>
						<?php } 
						}

						else {
						?>
						<div class="form-group">
							<?php echo $form->labelEx($model, 'user_img',array('class'=>'col-sm-3 control-label')); ?>
							<div class="col-sm-6">
								<?php 
								echo $form->fileField($model, 'user_img',array('class'=>'btn btn-success fileinput-button'));
								echo $form->error($model, 'user_img');
								?>
							</div>
						</div>
						<?php } ?>
	

<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
</div>
</div>
</div>

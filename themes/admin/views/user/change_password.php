<?php
$this->breadcrumbs=array(
	'Profile'=>array('profile'),
	'Change Password',
);


$this->menu=array(
array('label'=>'Edit Profile', 'url'=>array('profileEdit')),
array('label'=>'Profile', 'url'=>array('profile')),		
);
?>
<div class="tray tray-center p20 va-t posr">
<div class="panel">
	<div class="panel-heading">
		<span class="panel-title">Password Details</span>
	</div>
	<div class="panel-body">
<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
	'type' => 'horizontal',
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>
<?php
		$this->widget('booster.widgets.TbAlert', array(
		    'alerts'=>array( // configurations per alert type
		        'fade'=>true, // use transitions?
				'closeText'=>'&times;',
		        'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger,
		    ),
		));
	?>
    
		<?php echo $form->passwordFieldGroup(
			$model,
			'password',
			array(
				'wrapperHtmlOptions' => array(
					'class' => 'col-sm-5',
				),
               'htmlOptions'=>array('class'=>'span5')
			)
		); ?>

	 <?php echo $form->passwordFieldGroup(
			$model,
			'new_password',
			array(
				'wrapperHtmlOptions' => array(
					'class' => 'col-sm-5',
				),
               'htmlOptions'=>array('class'=>'span5',)
			)
		); ?>
		
		 <?php echo $form->passwordFieldGroup(
			$model,
			'repeat_password',
			array(
				'wrapperHtmlOptions' => array(
					'class' => 'col-sm-5',
				),
               'htmlOptions'=>array('class'=>'span5',)
			)
		); ?>
	

	

<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=> 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
</div>
</div>
</div>

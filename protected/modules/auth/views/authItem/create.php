<?php
/* @var $this OperationController|TaskController|RoleController */
/* @var $model AuthItemForm */
/* @var $form TbActiveForm */

$this->breadcrumbs = array(
	$this->capitalize($this->getTypeText(true)) => array('index'),
	Yii::t('AuthModule.main', 'New {type}', array('{type}' => $this->getTypeText())),
);
?>

<div class="panel">
			<div class="panel-heading">
				<span class="panel-title"><?php echo Yii::t('AuthModule.main', 'New {type}', array('{type}' => $this->getTypeText())); ?></span>
			</div>
			<div class="panel-body">


<?php $form = $this->beginWidget('booster.widgets.TbActiveForm', array(
	'type'=>'horizontal',
)); ?>

<?php echo $form->hiddenField($model, 'type'); ?>
<?php echo $form->textFieldGroup($model, 'name'); ?>
<?php echo $form->textFieldgroup($model, 'description'); ?>

<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
		'buttonType' => 'submit',
		'context' => 'primary',
		'label' => Yii::t('AuthModule.main', 'Create'),
	)); ?>
	<?php $this->widget('booster.widgets.TbButton', array(
		'context' => 'link',
		'buttonType' =>'link',
		'label' => Yii::t('AuthModule.main', 'Cancel'),
		'url' => array('index'),
	)); ?>
</div>
<?php $this->endWidget(); ?>
</div>
</div>


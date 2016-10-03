<?php
/* @var $this OperationController|TaskController|RoleController */
/* @var $model AuthItemForm */
/* @var $item CAuthItem */
/* @var $form TbActiveForm */

$this->breadcrumbs = array(
	$this->capitalize($this->getTypeText(true)) => array('index'),
	$item->description => array('view', 'name' => $item->name),
	Yii::t('AuthModule.main', 'Edit'),
);
?>


<div class="panel">
			<div class="panel-heading">
				<span class="panel-title"><?php echo CHtml::encode($item->description); ?>
				<small><?php echo $this->getTypeText(); ?></small></span>
			</div>
			<div class="panel-body">
<?php $form = $this->beginWidget('booster.widgets.TbActiveForm', array(
	'type'=>'horizontal',
)); ?>

<?php echo $form->hiddenField($model, 'type'); ?>
<?php echo $form->textFieldGroup($model, 'name', array(
				'wrapperHtmlOptions' => array(
					'class' => 'col-sm-5',
				),
				'widgetOptions' => array(
					'htmlOptions' => array('disabled' => true)
				),
              'hint' => Yii::t('AuthModule.main', 'System name cannot be changed after creation.'),
			

)); ?>
<?php echo $form->textFieldGroup($model, 'description',array(
				'wrapperHtmlOptions' => array(
					'class' => 'col-sm-5',
				),
				'widgetOptions' => array(
					'htmlOptions' => array()
				),)); ?>

<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
		'buttonType' => 'submit',
		'context' => 'primary',
		'label' => Yii::t('AuthModule.main', 'Save'),
	)); ?>
	<?php $this->widget('booster.widgets.TbButton', array(
		'context' => 'link',
		'buttonType' => 'link',
		'label' => Yii::t('AuthModule.main', 'Cancel'),
		'url' => array('view', 'name' => $item->name),
	)); ?>
</div>

<?php $this->endWidget(); ?>
</div>
</div>
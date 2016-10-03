<?php
$this->breadcrumbs=array(
		'Fees'=>array(''),
		'Fees Allocation',
);
?>
<div class="row">
	<div class="col-md-12">
		<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
				'id'=>'fee-allocation-form',
				'type' => 'horizontal',
				'enableAjaxValidation'=>false,
)); ?>

		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title">Fee Allcation Details</span>
			</div>
			<div class="panel-body">
				<p class="help-block">
					Fields with <span class="required">*</span> are required.
				</p>

				<?php if(Yii::app()->user->hasFlash('success')):?>

				<?php $this->widget('booster.widgets.TbAlert', array(
						'fade'=>true, // use transitions?
						'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
						'alerts'=>array( // configurations per alert type
            'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
        ),
    )); ?>

				<?php echo Yii::app()->user->getFlash('success'); ?>


				<?php endif; ?>

				<?php echo $form->errorSummary($model); ?>

				<?php echo $form->dropDownListGroup(
						$model,
						'month',
						array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
						'widgetOptions' => array(
						'data' =>FeeGenForm::months(),
						'htmlOptions' =>array('empty' => 'Select Month','class'=>'span2'),

						)
					)
				);
				?>

				<?php echo $form->dropDownListGroup(
						$model,
						'year',
						array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
						'widgetOptions' => array(
						'data' =>FeeGenForm::years(),
						'htmlOptions' =>array('empty' => 'Select Year','class'=>'span2'),

						)
					)
				);
				?>
				
					<?php echo $form->dropDownListGroup(
								$model,
								'class_id',
								array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
						'widgetOptions' => array(
						'data' => CHtml::listData(Classes::model()->byid()->findAll(),'class_id','class_name'),
						'htmlOptions' =>array('empty' => 'All','class'=>'span2','ajax' => array(
						'type'=>'POST', //request type
						'url'=>CController::createUrl('fees/dynamicparticular'), //url to call
						'update'=>'#'.CHtml::activeId($model,'fee_particular_id')
						)),

						)
			)
    
	     	);
			 ?>
								
				<?php echo $form->dropDownListGroup(
								$model,
								'fee_particular_id',
								array(
								'wrapperHtmlOptions' => array(
								'class' => 'col-sm-5',
								),
                              	'widgetOptions' => array(
								'data' =>$data			
								))
								);
							?>		


				<div class="form-actions">
					<?php $this->widget('booster.widgets.TbButton', array(
							'buttonType'=>'submit',
							'context'=>'primary',
							'label'=>'Save',
		)); ?>
				</div>
			</div>

		</div>
		<?php $this->endWidget(); ?>
	</div>
</div>

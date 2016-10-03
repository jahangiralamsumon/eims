<?php
$this->breadcrumbs=array(
		'Fees'=>array(''),
		'Add Student Fees',
);
?>
<div class="row">
	<div class="col-md-12">
		<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
				'id'=>'stu-fee-allocation-form',
				'type' => 'horizontal',
				'enableAjaxValidation'=>false,
)); ?>

		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title">Add Student Fees</span>
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
                <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-4">
				<?php echo $form->dropDownListGroup(
						$model,
						'month',
						array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-9',
						),
						'widgetOptions' => array(
						'data' =>FeeGenForm::months(),
						'htmlOptions' =>array('empty' => 'Select Month','class'=>'span2'),

						)
					)
				);
				?>
              </div>
              <div class="col-md-4">
				<?php echo $form->dropDownListGroup(
						$model,
						'year',
						array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-9',
						),
						'widgetOptions' => array(
						'data' =>FeeGenForm::years(),
						'htmlOptions' =>array('empty' => 'Select Year','class'=>'span2'),

						)
					)
				);
				?>
				</div>
				</div>
			<?php echo $form->textFieldGroup($model,'student_id',
								array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
						'widgetOptions'=>array('htmlOptions'=>array('class'=>'span5',))));
         ?>	
		<?php echo $form->textFieldGroup($prt_model,'name',array('wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),'widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>

	<?php echo $form->textAreaGroup($prt_model,'description', array('wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),'widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'span8')))); ?>

	<?php echo $form->textFieldGroup($prt_model,'amount',array('wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),'widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>15)))); ?>

	<?php echo $form->dropDownListGroup(
								$prt_model,
								'fee_category_id',
								array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
						'widgetOptions' => array(
						'data' => CHtml::listData(FeeCategories::Categories_array(),'id','name','group'),
						'htmlOptions' =>array('empty' => 'Select Fee Category','class'=>'span2'),

						)
					)
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

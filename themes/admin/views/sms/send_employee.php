<?php
$this->breadcrumbs=array(
		'Sms'=>array('index'),
		'Send Student',
);


$this->menu=array(
		array('label'=>'Send SMS','url'=>array('send')),
		array('label'=>'Send SMS Student','url'=>array('sendstudent')),
		array('label'=>'Bulk SMS','url'=>array('sendbulk')),
);
?>
<div class="tray tray-center p20 va-t posr">
<div class="row">
	<div class="col-md-12">
		<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
				'id'=>'send-message',
				'type' => 'horizontal',
				'enableAjaxValidation'=>false,
)); ?>

		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title">Send SMS Employee</span>
			</div>
			<div class="panel-body">


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
				
					<?php if(Yii::app()->user->hasFlash('warning')):?>

				<?php $this->widget('booster.widgets.TbAlert', array(
						'fade'=>true, // use transitions?
						'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
						'alerts'=>array( // configurations per alert type
           				 'warning'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
          				  ),
        		  )); ?>

				<?php echo Yii::app()->user->getFlash('warning'); ?>

				<?php endif; ?>
				
				<p class="help-block">
					Fields with <span class="required">*</span> are required.
				</p>
				<?php echo $form->errorSummary($model); ?>
				<?php 
				/* echo $form->select2Group(
				 $model,
								'numbers',
								array(
									'wrapperHtmlOptions' => array(
											'class' => 'col-sm-6',
									),
									'widgetOptions' => array(
											'asDropDownList' => false,
											'options' => array(
													'minimumInputLength'=>'1',
													'tags' => array(),
													'placeholder' => 'Add numbers',
													'width' => '90%',
													'tokenSeparators' => array(',', ' '),
                                                    'ajax'       => array(
													'url'       => Yii::app()->controller->createUrl('sms/findnumber'),
													'dataType'  => 'json',
													'data'      => 'js:function(term, page) { return {q: term }; }',
													'results'   => 'js:function(data) { return {results: data}; }',
              
											),

											),
                                         'htmlOptions' =>array('class'=>'span2'),

									)
							)
							); */
						?>

			<?php echo $form->dropDownListGroup(
								$model,
								'department_id',
								array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-6',
						),
						'widgetOptions' => array(
						'data' => CHtml::listData(EmpDepartments::model()->byid()->findAll(),'id','name'),
						'htmlOptions' =>array('empty' => 'All','class'=>'span2'),

						)
					)
						);
						?>


				<?php echo $form->textAreaGroup(
						$model,
						'message',
						array(
				'wrapperHtmlOptions' => array(
					'class' => 'col-sm-6',
				),
				'widgetOptions' => array(
					'htmlOptions' => array('rows' => 5, ),
				),
			)
  
		); ?>




				<div class="form-actions">
					<?php
					/*  $this->widget('booster.widgets.TbButton', array(
					 'buttonType'=>'ajaxSubmit',
									'context'=>'primary',
									'label'=>'Send',
									'url' => Yii::app()->createUrl(
											'sms/ajaxsend',array()
									),
									'ajaxOptions' => array(
											'type' => 'POST',
											'update'=>'#send_status',
									)
					)); */
                       
					$this->widget('booster.widgets.TbButton', array(
                       		'buttonType'=>'submit',
                       		'context'=>'primary',
                       		'label'=>'Send',
                       ));

                       ?>
				</div>

			</div>
		</div>
		<?php $this->endWidget(); ?>
	</div>
</div>
</div>
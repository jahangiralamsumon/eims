<?php
$this->breadcrumbs=array(
		'Sms'=>array('index'),
		'Send Bulk SMS',
);


$this->menu=array(
		array('label'=>'Send SMS','url'=>array('send')),
		array('label'=>'Send SMS Students','url'=>array('sendstudent')),
		array('label'=>'Send SMS Employees','url'=>array('sendemployee')),
);
?>
<div class="tray tray-center p20 va-t posr">
<div class="row">
	<div class="col-md-12">
		<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
				'id'=>'send-message',
				'type' => 'horizontal',
				'enableAjaxValidation'=>false,
				'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title">Send Bulk SMS </span>
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

			<div class="form-group">
							<?php echo $form->labelEx($model, 'file',array('class'=>'col-sm-3 control-label')); ?>
							<div class="col-sm-6">
								<?php 
								echo $form->fileField($model, 'file',array('class'=>'btn btn-success fileinput-button'));
								echo $form->error($model, 'file');
								?>
							<span class="help-block mt10"><span class="tm-tag tm-tag-info"> <span>info</span></span>
							  CSV File </span>
						</div>
						</div>


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
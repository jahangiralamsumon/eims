<?php
$this->breadcrumbs=array(
		'Accounts'=>array('index'),
		'Voucher  Entry',
);
?>
<div class="row">
	<div class="col-md-12">
		<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
				'id'=>'voucher-entry-form',
				'type' => 'horizontal',
				'enableAjaxValidation'=>false,
)); ?>

		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title">Voucher Entry</span>
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

				<div class="col-md-6">
					<?php echo $form->textFieldGroup($model,'voucher_no',array(
							'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
					'widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>15)
				))); ?>
			
			    <div class="form-group">
			    <label class="col-sm-3 control-label" >Dr Account<span class="required">*</span></label>
			      <div class="col-sm-6 ">
					<?php 
					$this->widget(
								'booster.widgets.TbSelect2',
								array(
                                       'model' => $model,
                                        'attribute' => 'dr_account',
										'data' => AccHead::ledger_account(),
										'options' => array(
            								'placeholder' => 'just type!',
                                             'width' => '90%',
            							
        							)
								)
						);
						?>
					</div>	
					</div>	
					<?php echo $form->textFieldGroup($model,'amount',array(
							'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
					'widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>15)
				))); ?>
					<?php echo $form->textAreaGroup($model,'particulars', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'span8')))); ?>

				</div>
				<div class="col-md-6">
					<?php echo $form->datePickerGroup($model,'voucher_date',array(
							'wrapperHtmlOptions' => array(
						'class' => 'col-sm-4',
						),'widgetOptions'=>array('options'=>array('dateFormat' => 'yy-mm-dd','changeMonth'=>true,
        'changeYear'=>true,'yearRange'=>'1950:2050',),'htmlOptions'=>array('class'=>'span5')), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>')); ?>

				<div class="form-group">
			    <label class="col-sm-3 control-label" >Cr Account<span class="required">*</span></label>
			      <div class="col-sm-6 ">
					<?php 
					$this->widget(
								'booster.widgets.TbSelect2',
								array(
                                       'model' => $model,
                                        'attribute' => 'cr_account',
										'data' => AccHead::ledger_account(),
										'options' => array(
            								'placeholder' => 'just type!',
                                             'width' => '90%',
            							
        							),
                                 
								)
						);
						?>
					</div>	
					</div>
					<?php echo $form->dropDownListGroup(
								$model,
								'voucher_type',
								array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
						'widgetOptions' => array(
						'data' => VoucherType::all_type(),
						'htmlOptions' =>array('empty' => 'Select Vouche Type','class'=>'span2'),

						)
					)
						);
						?>

				</div>
				<div class="clearfix"></div>
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

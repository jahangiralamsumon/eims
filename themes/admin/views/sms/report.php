<?php
$this->breadcrumbs=array(
		'SMS'=>array('index'),
		'Report',
);
?>
<div class="row">
	<div class="col-md-12">
		<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
				'id'=>'trial-balance-form',
				'type' => 'horizontal',
				'enableAjaxValidation'=>false,
				'method'=>'GET',
)); ?>

		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title">SMS Report</span>
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


				<?php echo $form->datePickerGroup($model,'from_date',array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-4',
						),'widgetOptions'=>array('options'=>array('dateFormat' => 'yy-mm-dd','changeMonth'=>true,
        'changeYear'=>true,'yearRange'=>'1950:2050',),'htmlOptions'=>array('class'=>'span5')), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>')); ?>

				<?php echo $form->datePickerGroup($model,'to_date',array('wrapperHtmlOptions' => array(
						'class' => 'col-sm-4',
				),'widgetOptions'=>array('options'=>array('dateFormat' => 'yy-mm-dd','changeMonth'=>true,
        'changeYear'=>true,'yearRange'=>'1950:2050',),'htmlOptions'=>array('class'=>'span5')), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>')); ?>

				<div class="form-actions">
					<?php $this->widget('booster.widgets.TbButton', array(
							'buttonType'=>'submit',
							'context'=>'primary',
							'label'=>'View',
		)); ?>
				</div>
			</div>

		</div>
		<?php $this->endWidget(); ?>
	</div>

	<?php if(isset($arrayDataProvider)):?>
	<div class="col-md-12">
		<div class="panel">
			<div class="panel-body">
				<h1>Sent SMS report</h1>
				<h3>
					<small>From <?php echo date("d-M-Y",strtotime($model->from_date)).' to '.date("d-M-Y",strtotime($model->to_date))  ?>
					</small>
				</h3>
				<?php
				$this->widget('booster.widgets.TbGridView',array(
			    		'dataProvider' => $arrayDataProvider,
                        'filter'=>$filtersForm,
			    		'columns' => array(
			    				array(
			    						'name' => 'number',
                                        'header'=>'Number',
			    						'type' => 'raw',
			    						'value' => 'CHtml::encode($data["number"])'
			    				),
			    				array(
			    						'name' => 'date',
                                        'header'=>'Date',
			    						'type' => 'raw',
			    						'value' =>'date("d-M-Y g:i a",strtotime($data["date"]))',
                                        'filter'=> false,
			    				),

                                  array(
									'name' => 'status',
									'header'=>'Status',
									'type' => 'raw',
									'value' => '(CHtml::encode($data["status"])=="1701")?"DELIVRD":"FAILED"',
									'filter'=>  array("1701"=>"DELIVRD",">1701"=>"FAILED"),
							),
						  ),
			    ));
			    ?>
			</div>
		</div>
	</div>
	<?php endif; ?>

</div>

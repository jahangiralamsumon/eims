<?php
$this->breadcrumbs=array(
		'Accounts'=>array('index'),
		'Ledger',
);
?>
<div class="row">
	<div class="col-md-12">
		<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
				'id'=>'general-ledger-form',
				'type' => 'horizontal',
				'enableAjaxValidation'=>false,
)); ?>

		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title"> Ledger </span>
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

				
				<div class="form-group">
			    <label class="col-sm-3 control-label" >Account<span class="required"> *</span></label>
			      <div class="col-sm-6 ">
					<?php 
					$this->widget(
								'booster.widgets.TbSelect2',
								array(
                                       'model' => $model,
                                        'attribute' => 'acc_id',
										'data' => AccHead::ledger_account(),
										'options' => array(
            								'placeholder' => 'just type!',
                                             'width' => '60%',
            							
        							),
                                 
								)
						);
						?>
					</div>	
					</div>
				

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

	<?php if(isset($ledger_data)):?>
	<div class="col-md-12">
		<div class="panel">
		<div class="panel-heading">
						<span class="panel-title">
						Ledger
						</span>
					</div>
			<div class="panel-body">
			      <div class="invoice-buttons">
						<?php echo CHtml::link('<i class="fa fa-floppy-o pr5"></i>Save PDF',array('/accounts/ledgerprint','acc_id'=>$model->acc_id,'from_date'=>$model->from_date,'to_date'=>$model->to_date),array("class"=>"btn btn-primary btn-gradient", "target"=>"blank")); ?>
				  </div>
				
				<h2 style="text-align: center;"><?php echo AccHead::acc_head_name($model->acc_id) ?> <small>(<?php echo date("d-M-Y",strtotime($model->from_date)).' to '.date("d-M-Y",strtotime($model->to_date))  ?> )</small></h2>
				
				
				
				<table class="items table table-striped">
					<tr>
						<th>Date</th>
						<th>Particulars</th>
						<th>Dr.Amount</th>
						<th>Cr.Amount</th>
						<th>Balance</th>
						<th>Type</th>
					</tr>

					<?php foreach ($ledger_data as $row):?>
					<tr>
						<td><?php echo $row['voucher_date']?></td>
						<td><?php echo $row['particular']?></td>
						<td><?php echo $row['dr_amount']?></td>
						<td><?php echo $row['cr_amount']?></td>
						<td><?php echo $row['balance']?></td>
						<td><?php echo $row['type']?></td>
					</tr>
					<?php endforeach; ?>
				</table>
                  
              
			
				
			</div>
			
		</div>
		  
	</div>
	<?php endif;?>

</div>

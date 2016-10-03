<?php
$this->breadcrumbs=array(
		'Accounts'=>array('index'),
		'Student Ledger',
);
?>
<div class="row">
	<div class="col-md-12">
		<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
				'id'=>'student-ledger-form',
				'type' => 'horizontal',
				'enableAjaxValidation'=>false,
)); ?>

		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title">Student Ledger </span>
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

				<?php echo $form->textFieldGroup($model,'student_id',array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
					'widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>15)
				))); ?>

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
			<div class="panel-body">
				<h1>Ledger</h1>
				<h3>
					<small> <?php echo date("d-M-Y",strtotime($model->from_date)).' to '.date("d-M-Y",strtotime($model->to_date))  ?>
					</small>
				</h3>
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

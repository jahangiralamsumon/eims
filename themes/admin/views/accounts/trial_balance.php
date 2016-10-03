<?php
$this->breadcrumbs=array(
		'Accounts'=>array('index'),
		'Trial Balance',
);
?>
<div class="row">
	<div class="col-md-12">
		<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
				'id'=>'trial-balance-form',
				'type' => 'horizontal',
				'enableAjaxValidation'=>false,
)); ?>

		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title">Trial Balance</span>
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

	<?php if(isset($data)):?>
	<div class="col-md-12">
		<div class="panel">
			<div class="panel-body">
				<h1>Trila Balance</h1>
				<h3>
					<small> <?php echo date("d-M-Y",strtotime($model->from_date)).' to '.date("d-M-Y",strtotime($model->to_date))  ?>
					</small>
				</h3>
				<table class="items table table-striped table-bordered">
					<tr>
						<th>Account Name</th>
						<th>Debit Balance</th>
						<th>Credit Balance</th>
					
					</tr>

					<?php 
					$total_debit_balance=0;
					$total_crebit_balance=0;
					foreach ($data as $row):
					if($row['balance']!=0 && $row['lr']=='L')
					{
						if($row['balance']>0)
						$total_debit_balance=$total_debit_balance+$row['balance'];
						else 
						$total_crebit_balance=$total_crebit_balance+$row['balance'];
					?>
					
					<tr>
						<td><?php echo $row['name']?></td>
						<td><?php echo $row['balance']>0?number_format($row['balance'],2,'.','') :''?></td>
						<td><?php echo $row['balance']<0?number_format(-1*$row['balance'],2,'.',''):'' ?></td>
					</tr>
					<?php 
					}
					 endforeach; ?>
					 
					 <tr>
						<th>Total</th>
						<th><?php echo  number_format($total_debit_balance,2,'.','') ;?></th>
						<th><?php echo  number_format(-1*$total_crebit_balance,2,'.','') ; ?></th>
					
					</tr>
					 
				</table>

			</div>
		</div>
	</div>
	<?php endif;?>

</div>

<?php
$this->breadcrumbs=array(
		'Fees'=>array(''),
		'Due List',
);
?>
<div class="row">

	<div class="col-md-12">
		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title">Fees Collection</span>
			</div>
			<div class="panel-body">
				<p class="help-block">
					Fields with <span class="required">*</span> are required.
				</p>
				<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
						'id'=>'student-attendance-form',
						'type' => 'horizontal',
						'enableAjaxValidation'=>false,
)); ?>
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
						'class_id',
						array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
						'widgetOptions' => array(
						'data' =>CHtml::listData(Classes::model()->findAll(),'class_id','class_name'),
						'htmlOptions' =>array('empty' => 'All','class'=>'span2','ajax' => array(
						'type'=>'POST', //request type
						'url'=>CController::createUrl('fees/dynamicsections'), //url to call
						'update'=>'#'.CHtml::activeId($model,'section_id')
						)),

						)
					)
				);
				?>
				<?php echo $form->dropDownListGroup(
						$model,
						'section_id',
						array(
								'wrapperHtmlOptions' => array(
								'class' => 'col-sm-5',
								),
                              	'widgetOptions' => array(
								'data' =>$section_data	,
                                'htmlOptions' =>array('empty' => 'Select Section','class'=>'span2'),
								))
				);
				?>
				
				
				<?php echo $form->dropDownListGroup(
								$model,
								'group',
								array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
						'widgetOptions' => array(
                         'data'=>Classes::group_option(),
						'htmlOptions' =>array('empty' =>'Select Group','class'=>'span2'),

						)
					)
						);
						?>
			

				<div class="form-actions">
					<?php $this->widget('booster.widgets.TbButton', array(
							'buttonType'=>'submit',
							'context'=>'primary',
							'label'=>'Submit',
		)); ?>
				</div>
				<?php $this->endWidget(); ?>
			</div>
		</div>
	</div>

	<?php 
	if(isset($data)):

	?>
	<div class="col-md-12">
		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title">Fee Due List</span>
			</div>
			<div class="panel-body">
				<div class="invoice-buttons">
					<a href="javascript:window.print()" class="btn btn-default mr10"><i
						class="fa fa-print pr5"></i> Print</a>
				</div>
				<h2 style="text-align: center;">
					Due List as on Date  <small>(<?php echo date("d-M-Y") ?>
						)
					</small>
				</h2>

				<div class="row">
					<div class="col-md-12">
					 <?php 
					 $classes=Classes::items();
					$groups=Classes::group_option();
					$groups=$groups['HSC'];
					$sub_total_balance=0;
					foreach ($classes as $class_id=>$class):
					if(empty($model->class_id) OR $model->class_id==$class_id){
					foreach ($groups as $group=>$group_name){
					if(empty($model->group) OR $model->group==$group){
					 ?>
					 
					 
						<h2><?php echo $class  ?></h2>
					   <h3><?php echo $group_name  ?></h3>
						<table class="items table table-striped table-bordered">
							<tr>
								<th>Student ID</th>
								<th>Student Name</th>
								<th>Roll  No</th>
								<th>Amount</th>

							</tr>

							<?php 
							$total_balance=0;
							foreach ($data as $key=> $row):

							if($row['balance']>0 && $class_id==$row['class_id'] && $group==$row['group'])
							{
							
									$total_balance=$total_balance+$row['balance'];
									
							?>
							<tr>
								<td><?php echo $row['student_id']?></td>
								<td><?php echo $row['student_name']?></td>
								<td><?php echo $row['roll_no']?></td>
								<td><?php echo number_format($row['balance'],2,'.','') ; ?>
								</td>

							</tr>
							<?php
																			
							}

							endforeach;
							
							$sub_total_balance=$sub_total_balance+$total_balance;
							?>
                           <tr>
						<th>Total Due</th>
						<th colspan="3">
						<?php
						
						echo number_format($total_balance,2,'.','');
						
						?>
						</th>
						
					
					</tr>
						</table>
						<?php		
 						}
 						}
}
						endforeach;
						
						
						?>
						<br>
					<table class="table  table-bordered">
							<tr>
						<th>Sub Total Due</th>
						<th colspan="3">
						<?php
						
						echo number_format($sub_total_balance,2,'.','');
						
						?>
						</th>
						
					
					</tr>
						</table>
						
						
					</div>


				</div>
			</div>
		</div>
	</div>
	<?php endif;?>
</div>


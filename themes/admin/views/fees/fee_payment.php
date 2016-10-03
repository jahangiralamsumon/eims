<?php
$this->breadcrumbs=array(
		'Fees'=>array('index'),
		'Fees Collection',
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
						'method'=>'GET',
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
						'htmlOptions' =>array('empty' => 'Select Class','class'=>'span2','ajax' => array(
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
								'data' =>$data	,
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
	if(isset($student_data)):

	?>
	<div class="col-md-12">
		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title">Student Details</span>
			</div>
			<div class="panel-body">

				<div class="row">
					<div class="col-md-12">
					
						<h2></h2>
					
						<table class="items table table-striped table-bordered">
							<tr>
								<th>SI No.</th>
								<th>Student Name</th>
								<th>Roll No</th>
								<th>Unpaid Amount</th>
								<th>Action</th>

							</tr>

							<?php 
							$total_balance=0;
							foreach ($student_data as $key=> $row):
								
							?>
							<tr id="row_<?php echo $row['student_id']?>">
								<td><?php echo $key+1 ?></td>
								<td><?php echo $row['student_name']?></td>
								<td><?php echo $row['roll_no']?></td>
								<td><?php echo number_format(($row['balance']>0?$row['balance']:0),2,'.','') ; ?>
								</td>
								<td>
								<?php  
							$this->widget(
									'booster.widgets.TbButton',
									array(
											'context' => 'primary',
											'label'=>'Take Fees ',
											'buttonType' =>'link',
											'size' => 'small',
					                    	'icon' => 'usd',
					                    	'url' => array('feesCollection', 'sid' =>$row['student_id']),
					                  	  'htmlOptions' => array('target' => '_blank', 'title' =>''),
                					)) ; ?>
								</td>

							</tr>
							<?php												
						

							endforeach;
							?>
                           
						</table>
						
					</div>


				</div>
			</div>
		</div>
	</div>
	<?php endif;?>
</div>
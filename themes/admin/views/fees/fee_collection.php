<?php
$this->breadcrumbs=array(
		'Fees'=>array(''),
		'Fees Collection'=>array('feesPayment'),
		$student_obj->name
);
?>
<div class="row">

	<div class="col-md-12">
		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title">Student Details</span>
			</div>
			<div class="panel-body">

				<div class="row">
					<div class="col-md-3">
						<?php if(empty($student_obj->img_file_name)) {?>
						<div class="fileupload fileupload-new admin-form"
							data-provides="fileupload">
							<div class="fileupload-preview thumbnail mb20">
								<img data-src="holder.js/100%x140" alt="100%x140"
									style="height: 220px; width: 100%; display: block;" src=""
									data-holder-rendered="true">
							</div>
						</div>
						<?php } else {?>
						<div class="fileupload fileupload-new admin-form"
							data-provides="fileupload">
							<div class="fileupload-preview thumbnail mb20">
								<img style="height: 220px; width: 100%; display: block;"
									src="<?php echo Yii::app()->baseUrl.'/uploadedfiles/student/'.$student_obj->student_id.'/'.$student_obj->img_file_name?>"
									data-holder-rendered="true">
							</div>
						</div>

						<?php } ?>
					</div>
					<div class="col-md-9">
						<h2>
							<?php echo $student_obj->name ?>
							<small>Profile</small>
						</h2>
						<table class="table table-hover table-bordered  table-striped ">

							<tr>

								<th width="50%">Class</th>
								<td width="50%"><?php echo $student_obj->class_name?></td>
							</tr>
							
							<tr>
								<th>Group</th>
								<td><?php echo ucfirst($student_obj->group); ?></td>

							</tr>
							<tr>
								<th>Roll No</th>
								<td><?php echo $student_obj->roll_no ?></td>

							</tr>
							<tr>
								<th>Year</th>
								<td><?php echo $student_obj->year_name ?></td>

							</tr>
							<tr>
								<th>Last Payment History</th>
								<td>
								<table class="table  table-bordered ">
					<tr class="header">
						<th>Date</th>
						<th>Payment mode</th>
						<th>Amount</th>
					</tr>
				
								<?php
								
								$colection_record=FeeCollection::std_collection_history($model->student_id);
								if(!empty($colection_record[0])){	
								$row= $colection_record[0];						
						
								echo '<tr>';
								echo '<tr>';
								echo '<td>'.date("d-M-Y",strtotime( $row->payment_date)).'</td>';
								echo '<td>'.(($row->payment_mode==1) ? "Cash" : "Bank").'</td>'; 
								echo '<td>'.$row->amount.'</td>';
								echo '</tr>';
							
								}
								?>
							</table>
                              </td>
							</tr>
							
						</table>
						
						
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-12">
		<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
				'id'=>'fee-collection-form',
			
				'enableAjaxValidation'=>false,
)); ?>

		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title">Fees Collection</span>
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
				
				
				<div class="col-md-4">
				<?php echo $form->textFieldGroup($model,'student_id',array(
				'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),	
					'widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>15,'readonly'=>'readonly')
				))); ?>
				</div>
				<div class="col-md-4">
				<?php echo $form->textFieldGroup($model,'amount',array(
				'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),	
					'widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>15)
				))); ?>
				</div>
				<div class="col-md-4">
				<?php echo $form->textFieldGroup($model,'fee_id',array(
				'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),	
					'widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>15)
				))); ?>
				</div>
				<div class="col-md-4">
				<?php echo $form->textFieldGroup($model,'receipt_no',array(
				'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),	
					'widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>15)
				))); ?>
				</div>
				<div class="col-md-4">
				<?php echo $form->dropDownListGroup(
						$model,
						'payment_mode',
						array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
						'widgetOptions' => array(
						'data' =>array('1'=>'Cash','2'=>'Bank'),
						'htmlOptions' =>array('empty' => 'Select Mode','class'=>'span2'),

						)
					)
				);
				?>
				</div>
				<div class="clearfix"></div>
				<div class="col-md-4">
				<?php echo $form->textAreaGroup($model,'remark', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'span8')))); ?>
                </div>
                <div class="clearfix"></div>
				<div class="form-actions">
					<?php $this->widget('booster.widgets.TbButton', array(
							'buttonType'=>'submit',
							'context'=>'primary',
							'label'=>'Save',
							'htmlOptions' => array('confirm'=> 'Are you sure to complete transaction?'),
							
		)); ?>
	
				</div>
			</div>

		</div>
		<?php $this->endWidget(); ?>
	</div>
</div>

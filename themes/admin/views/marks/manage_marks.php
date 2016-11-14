<?php
$this->breadcrumbs=array(
	'Result'=>array('manage'),
	'Manage Marks',
);

?>

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
		'id'=>'marks-manage-form',
		'type' => 'horizontal',
		'method'=>'GET',
		'enableAjaxValidation'=>false,
)); ?>
<div class="row">
<div class="col-md-12">
<div class="panel">
	<div class="panel-heading">
		<span class="panel-title">Marks</span>
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
		
		<?php echo $form->dropDownListGroup(
				$model,
				'year',
				array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
						'widgetOptions' => array(
						'data' => AcademicYearInfo::year_list(),
						'htmlOptions' =>array('empty' => 'Select Year','class'=>'span2'),

						)
					)
		);
		?>



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
						'url'=>CController::createUrl('site/dynamicExam'), //url to call
						'update'=>'#'.CHtml::activeId($model,'exam_id')
						)),

						)
					)
					);
				?>
				
			<?php echo $form->dropDownListGroup(
				$model,
				'exam_id',
				array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
						'widgetOptions' => array(
						'data' =>$exam_data,
						'htmlOptions' =>array('empty' => 'Select Exam','class'=>'span2','ajax' => array(
						'type'=>'POST', //request type
						'url'=>CController::createUrl('marks/dynamicsubjects'), //url to call
						'update'=>'#'.CHtml::activeId($model,'subject_id')
						)),


						)
					)
		);
		?>
			<?php echo $form->dropDownListGroup(
								$model,
								'subject_id',
								array(
								'wrapperHtmlOptions' => array(
								'class' => 'col-sm-5',
								),
                              	'widgetOptions' => array(
								'data' =>$data,
                                'htmlOptions' =>array('empty' => 'Select subject','class'=>'span2'),		
								))
								);
							?>			
		

		<div class="form-actions">
			<?php $this->widget('booster.widgets.TbButton', array(
					'buttonType'=>'submit',
					'context'=>'primary',
					'label'=>'Manage Marks',
		)); ?>
		</div>
	</div>
</div>
</div>
<style type="text/css">
div.loading {
background-image: url('<?php echo Yii::app()->baseUrl?>/images/ajax-loader.gif');
background-position: center center;
background-repeat: no-repeat;
z-index:9999;
height:50px;
}
</style>
<?php $this->endWidget(); ?>


	<?php if(isset($subject_marks)):
	
	$sub_details=Subjects::model()->findByPk($model->subject_id);
	?>
	<div class="col-md-12">
		<div class="panel">
			<div class="panel-body">
			<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
			'id'=>'marks-input-form',
			'type' => 'horizontal',
			'enableAjaxValidation'=>false,
			)); ?>
			<?php //echo $form->errorSummary($marks_input_model); ?>
				<h1>Manage Marks</h1>
				<?php echo CHtml::activeHiddenField($marks_input_model,'subject_id',array('value'=>$model->subject_id)); ?>
				<table class="items table table-bordered table-hover">
					<tr>
						<th style="width: 5%;">Student ID</th>
						<th style="width: 15%;">Student</th>
						<th style="width: 5%;">Class Roll</th>
						<?php if($sub_details->written>0) :?>
						<th style="width: 10%;" >CQ <small><?php echo $sub_details->written ?></small></th>
						<?php endif; ?>
						<?php if($sub_details->mcq>0) :?>
						<th style="width: 10%;" >MCQ <small><?php echo $sub_details->mcq ?></small></th>
						<?php endif;?>
						<?php if($sub_details->practical>0) :?>
						<th style="width: 10%;" >Practical <small><?php echo $sub_details->practical ?></small></th>
						<?php endif; ?>
						<!-- <th style="width: 10%;" >Attendance</th>  -->
						<th style="width: 15%;" >Action</th>
			
					</tr>

					<?php foreach ($subject_marks as $key=>$row):?>
					<tr id="row_<?php echo $row->id ?>" class="<?php echo $row->mark>0?'info':''?>">
					   <td>
					   <?php echo $row->student_id;?>
					   </td>
						<td>
						<?php echo CHtml::activeHiddenField($marks_input_model,'mark_id['.$key.']',array('value'=>$row->id)); ?>
						<?php echo Student::student_name($row->student_id) ?></td>
						<td><?php echo StudentClass::class_roll($row->student_id) ?></td>
						<?php if($sub_details->written>0) :?>
						<td>
						<div class="col-sm-10">
							<?php //echo CHtml::textField('markobtained['.$row->student_id.']',isset($row->mark)?$row->mark:0,array('id'=>'markobtained'.$row->student_id,'class'=>'form-control')); ?>
						     <?php echo CHtml::activeTextField($marks_input_model,'written['.$key.']',array('class'=>'form-control','value'=>$row->written,'id'=>'written_'.$row->id)); ?>
						     <?php echo $form->error($marks_input_model,'written['.$key.']'); ?>
						</div>
						</td>
						<?php endif; ?>
						<?php if($sub_details->mcq>0) :?>
						<td>
						<div class="col-sm-10">
							<?php //echo CHtml::textField('markobtained['.$row->student_id.']',isset($row->mark)?$row->mark:0,array('id'=>'markobtained'.$row->student_id,'class'=>'form-control')); ?>
						     <?php echo CHtml::activeTextField($marks_input_model,'mcq['.$key.']',array('class'=>'form-control','value'=>$row->mcq,'id'=>'mcq_'.$row->id)); ?>
						     <?php echo $form->error($marks_input_model,'mcq['.$key.']'); ?>
						</div>
						</td>
						<?php endif;?>
						<?php if($sub_details->practical>0) :?>
						<td>
						<div class="col-sm-10">
							<?php //echo CHtml::textField('markobtained['.$row->student_id.']',isset($row->mark)?$row->mark:0,array('id'=>'markobtained'.$row->student_id,'class'=>'form-control')); ?>
						     <?php echo CHtml::activeTextField($marks_input_model,'practical['.$key.']',array('class'=>'form-control','value'=>$row->practical,'id'=>'practical_'.$row->id)); ?>
						     <?php echo $form->error($marks_input_model,'practical['.$key.']'); ?>
						</div>
						</td>
						<?php endif; ?>
						<!-- 
						<td>
							<div class="col-sm-10"><?php //echo CHtml::textField('attendance['.$row->student_id.']',isset($row->attendance)?$row->attendance:0,array('id'=>'attendance'.$row->student_id,'class'=>'form-control')); ?>
	                         <?php echo CHtml::activeTextField($marks_input_model,'attendance['.$key.']',array('class'=>'form-control','value'=>$row->attendance,'id'=>'attendance_'.$row->id)); ?>
						     <?php echo $form->error($marks_input_model,'attendance['.$key.']'); ?>     				
	                        </div>	
						</td>
						-->
						<td>
					   <div id="loading_<?php echo $row->id?>"></div>
						<?php //echo CHtml::activeTextArea($marks_input_model,'remark['.$key.']',array('class'=>'form-control','value'=>$row->remark)); ?>
						
						<?php 
						/*
						echo CHtml::ajaxLink(
					    $text = 'Save', 
					    $url =array('site/marksUpdate', 'mark_id'=>$row->id),
					    $ajaxOptions=array (
							'type'=>'POST',
					        'data'=> 'written=$("#MarksInputForm_written_0").val()',
					        'success'=>'function(data) {
                       				$("#row_'.$row->id.'").addClass("info");
					    		    alert(data);
							}',
					        ), 
					    $htmlOptions=array ('class'=>'mark-update-button')
					    );
						*/

						echo CHtml::link(
								$text = 'Save',
								$url =array('site/marksUpdate', 'mark_id'=>$row->id),
								
								$htmlOptions=array ('class'=>'mark-update-button btn btn-primary btn-xs')
						);
						?>     
					    </td>
				      </tr>
					<?php endforeach; ?>
				</table>
				<br>
				<div class="form-actions">
			<?php $this->widget('booster.widgets.TbButton', array(
					'buttonType'=>'submit',
					'context'=>'primary',
					'label'=>'Save',
		)); ?>
		
		<?php
		$sub_details->written=$sub_details->written+0;
		$sub_details->mcq=$sub_details->mcq+0;
		$sub_details->practical=$sub_details->practical+0;
		Yii::app()->clientScript->registerScript('mark_update', "
		$('.mark-update-button').click(function(event){	
		    event.preventDefault();
			var url=$(this).attr('href') ;	
			var arr=url.split('mark_id='); 	
			var mark_id=arr[1]; 
			var written=0;
			var mcq=0;
			var practical=0;
			var attendance=0;
			if($('#written_' + mark_id).length != 0){
    		written=$('#written_' + mark_id).val();
			}
			if($('#mcq_' + mark_id).length != 0){
			mcq=$('#mcq_' + mark_id).val();
			}
			if($('#practical_' + mark_id).length != 0){
			practical=$('#practical_' + mark_id).val();
			}	
			if($('#attendance_' + mark_id).length != 0){
			attendance=$('#attendance_' + mark_id).val();
			}
			var sub_details =[". $sub_details->written .",".$sub_details->mcq. ",".$sub_details->practical."];
			 $.ajax({
                          type: 'POST',
                          url: url,
                          data: 'sub_details=' + sub_details + '& written=' + written +'& mcq='+ mcq +'& practical='+ practical +'& attendance='+ attendance,
						  dataType: 'json',
            		      'beforeSend': function() {
                                     $('#loading_'+ mark_id).empty();
                       				 $('#loading_'+ mark_id).addClass('loading');
							}, 
                          success: function(data) {  
            					$('#loading_'+ mark_id).removeClass('loading');
        						if($('#written_' + mark_id).hasClass('error')){
        						$('#written_' + mark_id).removeClass('error');
								}
        						if($('#mcq_' + mark_id).hasClass('error')){
        						$('#mcq_' + mark_id).removeClass('error');
								}
        						if($('#practical_' + mark_id).hasClass('error')){
        						$('#practical_' + mark_id).removeClass('error');
								}
                            if (data.status == 'success'){
                               $('#row_'+ mark_id).addClass('info');
        						
                            }
        					else if (data.status == 'failed'){
        		                $('#row_'+ mark_id).removeClass('info');	
					    		if (data.written_error != null){		                  
       							$('#written_' + mark_id).addClass('error');
                                 }
								else if (data.mcq_error != null){      		              	
        							$('#mcq_' + mark_id).addClass('error');
                                 }

        						else if (data.practical_error != null){	
        							$('#practical_' + mark_id).addClass('error');
                                 } 
        		
                            }
        		          
                          }
                        });
		});

		");
		
		?>
		</div>
                <?php $this->endWidget(); ?>
			</div>
		</div>
	</div>
	<?php endif;?>
	</div>

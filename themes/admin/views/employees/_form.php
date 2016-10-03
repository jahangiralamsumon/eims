

<p class="help-block">
	Fields with <span class="required">*</span> are required.
</p>
<div class="row">
	<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
			'id'=>'employees-form',
			'type' => 'vertical',
			'enableAjaxValidation'=>false,
			'htmlOptions' => array('enctype' => 'multipart/form-data'),
		
)); ?>

	<?php echo $form->errorSummary($model); ?>
	
	<?php
		$this->widget('booster.widgets.TbAlert', array(
		    'alerts'=>array( // configurations per alert type
		        'fade'=>true, // use transitions?
				'closeText'=>'&times;',
		        'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger,
		    ),
		));
	?>
	<div class="col-md-12">
		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title">Employee Details</span>
			</div>
			<div class="panel-body">
			<div class="col-md-12">
				<div class="col-md-4">
					<?php echo $form->textFieldGroup($model,'emp_number',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>
				</div>
				
				<div class="col-md-4">
				<?php echo $form->textFieldGroup($model,'job_title',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>
                </div> 

				<div class="col-md-4">
					<?php echo $form->datePickerGroup($model,'joining_date',array('widgetOptions'=>array('options'=>array('dateFormat' => 'yy-mm-dd','changeMonth'=>true,
       				 'changeYear'=>true,'yearRange'=>'1950:2050',),'htmlOptions'=>array('class'=>'span5')), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>')); ?>

				</div>
			</div>
		</div>
		</div>


		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title">General Details</span>
			</div>
			<div class="panel-body">
				<div class="col-md-12">
				<div class="col-md-4">
					<?php echo $form->textFieldGroup($model,'name',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>
				</div>
				<div class="col-md-4">
					<?php echo $form->textFieldGroup($model,'name_bn',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>
				</div>
				<div class="col-md-4">
				<?php echo $form->fileFieldGroup($model,'photo_file_name',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>
               </div>
				</div>
				<div class="col-md-12">
				<div class="col-md-6">
				 <?php echo $form->dropDownListGroup(
						$model,
						'gender',
						array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
						'widgetOptions' => array(
						'data' => array('Select Gender','M' => 'Male', 'F' => 'Female'),
						'htmlOptions' =>array('class'=>'span5','maxlength'=>10),
						)
					)
				);
				?>
                </div>
                <div class="col-md-6">
				<?php echo $form->dropDownListGroup(
						$model,
						'blood_group',
						array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
						'widgetOptions' => array(
						'data' => array('A+' => 'A+', 'A-' => 'A-', 'B+' => 'B+', 'B-' => 'B-', 'O+' => 'O+', 'O-' => 'O-', 'AB+' => 'AB+', 'AB-' => 'AB-'),
						'htmlOptions' =>array('empty' => 'Unknown'),

						)
					)
				);
			 ?>
				 </div>
                </div>
                <div class="col-md-12">
                <div class="col-md-6">
				<?php echo $form->textFieldGroup($model,'religion',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>500)))); ?>
                </div>
                <div class="col-md-6">
					<?php echo $form->datePickerGroup($model,'date_of_birth',array('widgetOptions'=>array('options'=>array('dateFormat' => 'yy-mm-dd','changeMonth'=>true,
       				 'changeYear'=>true,'yearRange'=>'1950:2050',),'htmlOptions'=>array('class'=>'span5')), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>')); ?>

				</div>
				</div>
				<div class="col-md-12">
                <div class="col-md-6">
				<?php echo $form->textFieldGroup($model,'national_id_no',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5')))); ?>
                </div>
                <div class="col-md-6">
               	<?php echo $form->dropDownListGroup(
						$model,
						'emp_designation_id',
						array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
						'widgetOptions' => array(
						'data' => CHtml::listData(EmpDesignation::model()->findAll(),'designation_id','designation_name'),
						'htmlOptions' =>array('empty' => 'Select Designation','class'=>'span5'),

						)
					)
				);
			 ?>
                </div>
                </div>
                <div class="col-md-12">
                <div class="col-md-6">
                	<?php echo $form->dropDownListGroup(
						$model,
						'emp_department_id',
						array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
						'widgetOptions' => array(
						'data' => CHtml::listData(EmpDepartments::model()->findAll(),'id','name'),
						'htmlOptions' =>array('empty' => 'Select Depertment','class'=>'span5'),

						)
					)
				);
			 ?>
                
                
                </div>
                <div class="col-md-6">
                <?php echo $form->dropDownListGroup(
						$model,
						'employee_category_id',
						array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
						'widgetOptions' => array(
						'data' => CHtml::listData(EmpCategory::model()->findAll(),'emp_category_id','emp_category_name'),
						'htmlOptions' =>array('empty' => 'Select Category','class'=>'span5'),

						)
					)
				);
			 ?>
                </div>
                </div>
                <div class="col-md-12">
                 <div class="col-md-6">
				<?php echo $form->textFieldGroup($model,'qualification',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>
                </div>
                <div class="col-md-6 ">
                	<label class="control-label " for="">Total Experience</label>
                <div class="form-group ">
						<div class="col-lg-4">
					
                  <?php echo $form->dropDownList($model,'experience_year',array('0'=>0,'1'=>1,'2'=>2,'3'=>3,'4'=>4,'5'=>5
																			  ,'6'=>6,'7'=>7,'8'=>8,'9'=>9,'10'=>10,'11'=>11
																			  ,'12'=>12,'13'=>13,'14'=>14,'15'=>15,'16'=>16,'17'=>17
																			  ,'18'=>18,'19'=>19,'20'=>20),array('class'=>'form-control','empty' => 'Years')); ?>
				   <?php echo $form->error($model,'experience_year'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</div>
			
				<div class="col-lg-4">
		        <?php echo $form->dropDownList($model,'experience_month',array('0'=>0,'1'=>1,'2'=>2,'3'=>3,'4'=>4,'5'=>5,
																						'6'=>6,'7'=>7,'8'=>8,'9'=>9,'10'=>10,'11'=>11,),array('class'=>'form-control','empty' => 'Months')); ?>
				<?php echo $form->error($model,'experience_month'); ?>
                 </div>
                 </div>
                 </div>
                </div>
                <div class="col-md-12">
                <div class="col-md-6">
				<?php echo $form->textAreaGroup($model,'experience_detail', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'span8')))); ?>
                </div>
                
               </div>
            
                   </div>
                 </div>
                <div class="panel">
			<div class="panel-heading">
				<span class="panel-title">Personal Details</span>
			</div>
			<div class="panel-body">
			    <div class="col-md-12">
                <div class="col-md-6">
                <?php echo $form->dropDownListGroup(
						$model,
						'marital_status',
						array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
						'widgetOptions' => array(
						'data' => array('Single' => 'Single', 'Married' => 'Married','Divorced'=>'Divorced'),
						'htmlOptions' =>array('class'=>'span5','maxlength'=>10),
						)
					)
				);
				?>
                </div>
                <div class="col-md-6">
				<?php echo $form->textFieldGroup($model,'children_count',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5')))); ?>
                </div>
                </div>
                <div class="col-md-12">
                <div class="col-md-6">
				<?php echo $form->textFieldGroup($model,'father_name',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>
                </div>                     
                <div class="col-md-6">
				<?php echo $form->textFieldGroup($model,'mother_name',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>
                </div>
                </div>
                 <div class="col-md-12">
                <div class="col-md-6">
				<?php echo $form->textFieldGroup($model,'husband_name',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>
                </div>
                </div>
                
                
           </div>
           </div>
           
           <div class="panel">
			<div class="panel-heading">
				<span class="panel-title"> Contact Details </span>
			</div>
			<div class="panel-body">  
			    <div class="col-md-12">   
                <div class="col-md-6">
				<?php echo $form->textFieldGroup($model,'home_address',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>
                </div>
				<div class="col-md-6">
				<?php echo $form->textFieldGroup($model,'home_city',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>
                </div>
                </div>
                 <div class="col-md-12">
                <div class="col-md-6">
				<?php echo $form->dropDownListGroup(
						$model,
						'country_id',
						array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
						'widgetOptions' => array(
						'data' => CHtml::listData(Countries::model()->findAll(),'id','name'),
						'htmlOptions' =>array('empty' => 'Select Nationality','class'=>'span2'),

						)
					)
				);
			 ?>
                </div>
                <div class="col-md-6">
				<?php echo $form->textFieldGroup($model,'office_address',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>
                </div>
               </div>
                <div class="col-md-12"> 
                <div class="col-md-6">
				<?php echo $form->textFieldGroup($model,'office_phone',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>
                </div>
                <div class="col-md-6">
				<?php echo $form->textFieldGroup($model,'mobile_phone',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>
               </div>
               </div>
                <div class="col-md-12">
               <div class="col-md-6">
				<?php echo $form->textFieldGroup($model,'home_phone',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>
               </div>
               <div class="col-md-6">
				<?php echo $form->textFieldGroup($model,'email',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>
               </div>
               </div>
                <div class="col-md-12">
               <div class="col-md-6">
				<?php echo $form->textFieldGroup($model,'fax',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>
               </div>
               </div>
               
              
                 </div>
		</div>
				<div class="form-actions">
					<?php $this->widget('booster.widgets.TbButton', array(
							'buttonType'=>'submit',
							'context'=>'primary',
							'label'=>$model->isNewRecord ? 'Add' : 'Save',
		)); ?>
				</div>
			
		
	</div>

	<?php $this->endWidget(); ?>
</div>

<?php
$this->breadcrumbs=array(
	'Students'=>array('studentlist'),
	'Create',
);

$this->menu=array(
array('label'=>'List Student','url'=>array('index')),
array('label'=>'Manage Student','url'=>array('admin')),
);
?>

<h1>New Admission</h1>
<header id="topbar" class="ph10">
<div class="topbar-left">
			<ul
				class="nav nav-list nav-list-topbar pull-left ">
				<li>
				<?php  echo CHtml::link('<i class="glyphicons glyphicons-adress_book"></i> Student Details'); ?>
				</li>
				<li  class="active">
				<?php echo CHtml::link('<i class="glyphicons glyphicons-parents"></i> Parent Details'); ?>
				</li>
				<li>
				<?php echo CHtml::link('<i class="glyphicons glyphicons-unshare"></i> Previous Details'); ?>
				</li>
				<li>
				<?php echo CHtml::link('<i class="glyphicons glyphicons-book"></i> Courses'); ?>				
				</li>
		        <li>
				<?php echo CHtml::link('<i class="glyphicons glyphicons-user"></i> Student Profile'); ?>
				</li>
				
			</ul>
			</div>
</header>
<br>
<p class="help-block">
	Fields with <span class="required">*</span> are required.

		<?php
	$this->widget('booster.widgets.TbAlert', array(
    'alerts'=>array( // configurations per alert type
        'fade'=>true, // use transitions?
		'closeText'=>'&times;',
        'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger,
    ),
));
?>
</p>
<div class="admin-form theme-info">
<div class="panel heading-border panel-info">
<div class="panel-body bg-light">
     		<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
			'id'=>'find-guardian_form',
			'enableAjaxValidation'=>false,
			
)); ?>
     			
     				<div class="col-md-3">
					<?php 
                   
                     $this->widget(
    						'booster.widgets.TbSelect2',
                   				 array(
                                       'name' => 'student_id',
                   						'asDropDownList' => false,
                   						'options' => array(
                   								'minimumInputLength'=>'1',              								
                   								'placeholder' => 'Sibiling ',
                   								'width' => '100%',                                                 
                   								'tokenSeparators' => array(',', ' '),
                   								'ajax'       => array(
                   										'url'       => $this->createUrl('site/autocomplete'),
                   										'dataType'  => 'json',
                   										'data'      => 'js:function(term, page) { return {q: term }; }',
                   										'results'   => 'js:function(data) { return {results: data}; }',
                   
                   								),
                   
                   						
                   		)	
                   		)
                   ); 
						?>
						</div>
     				<div class="col-xs-1">
						<p class="form-control-static text-primary"><strong>OR</strong></p>
						</div>
     			<div class="col-md-3">		
                      
                   <?php 
                   
                     $this->widget(
    						'booster.widgets.TbSelect2',
                   				 array(
                                       'name' => 'guardian_id',
                   						'asDropDownList' => false,
                   						'options' => array(
                   								'minimumInputLength'=>'1',              								
                   								'placeholder' => 'Parent Name',
                   								'width' => '100%',                                                 
                   								'tokenSeparators' => array(',', ' '),
                   								'ajax'       => array(
                   										'url'       => $this->createUrl('site/parentautocomplete'),
                   										'dataType'  => 'json',
                   										'data'      => 'js:function(term, page) { return {q: term }; }',
                   										'results'   => 'js:function(data) { return {results: data}; }',
                   
                   								),
                   
                   						
                   		)	
                   		)
                   ); 
						?>
						
						</div>
					
				
		<?php $this->widget('booster.widgets.TbButton', array(
				'buttonType'=>'submit',
				'context'=>'primary',
				'label'=>'Find',
		)); ?>
	
                        <?php $this->endWidget(); ?>
                        
                        </div>
                    </div>
                    </div>
<div class="row">
	<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
			'id'=>'student-form',
			'enableAjaxValidation'=>false,
			'type' => 'vertical',
			'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>



	<?php echo $form->errorSummary($parent_model); ?>
	<div class="col-md-12">

		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title">Guardians Details</span>
			</div>
			<div class="panel-body">
			<div class="col-md-6">
				<?php echo $form->textFieldGroup($parent_model,'name',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5')))); ?>
				<?php echo $form->textFieldGroup($parent_model,'relation',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5')))); ?>
				<?php echo $form->textFieldGroup($parent_model,'education',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5')))); ?>
				<?php echo $form->textFieldGroup($parent_model,'occupation',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5')))); ?>
				<?php echo $form->textFieldGroup($parent_model,'income',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5')))); ?>
              	<?php 
		if($parent_model->isNewRecord){ ?>
 
    	<div class="checkbox-custom checkbox-primary mb5">
		<?php
 		echo $form->checkBox($parent_model,'user_create',array('checked'=>'true'));
 		echo $form->label($parent_model,'user_create',array('label'=>'Don\'t create parent user'));
 		?>
		</div>
		<?php }
		else if($parent_model->uid==NULL){
		
		?>
		<div class="checkbox-custom checkbox-primary mb5">
		<?php
 		echo $form->checkBox($parent_model,'user_create',array('checked'=>'true'));
 		echo $form->label($parent_model,'user_create',array('label'=>'Don\'t create parent user'));
 		?>
		</div>
		
		<?php } ?>
            </div>
             
             
              <div class="col-md-6">
				<?php echo $form->datePickerGroup($parent_model,'dob',array('widgetOptions'=>array('options'=>array( 'dateFormat' => 'yy-mm-dd','changeMonth'=>true,
        'changeYear'=>true,'yearRange'=>'1950:2050',),'htmlOptions'=>array('class'=>'span5')), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>',)); ?>


				<?php echo $form->textFieldGroup($parent_model,'mobile_phone',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5')))); ?>
				<?php echo $form->textFieldGroup($parent_model,'office_phone',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5')))); ?>

				<?php echo $form->textFieldGroup($parent_model,'email',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>300)))); ?>

				<?php echo $form->textAreaGroup(
						$parent_model,
						'office_address',
						array(
				'	wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
					),
					'widgetOptions' => array(
						'htmlOptions' => array('rows' => 5),
						)
						)
				);
				?>

				<?php echo $form->dropDownListGroup(
						$parent_model,
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

		</div>


	</div>
	<div class="col-md-12">
	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton', array(
				'buttonType'=>'submit',
				'context'=>'primary',
				'label'=>'Save',
		)); ?>
	</div>
	</div>
	<?php $this->endWidget(); ?>
</div>
</div>
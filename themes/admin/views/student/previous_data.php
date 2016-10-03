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
		<ul class="nav nav-list nav-list-topbar pull-left ">
			<li><?php  echo CHtml::link('<i class="glyphicons glyphicons-adress_book"></i> Student Details'); ?>
			</li>
			<li><?php echo CHtml::link('<i class="glyphicons glyphicons-parents"></i> Parent Details'); ?>
			</li>
			<li class="active"><?php echo CHtml::link('<i class="glyphicons glyphicons-unshare"></i> Previous Details'); ?>
			</li>
			<li><?php echo CHtml::link('<i class="glyphicons glyphicons-book"></i> Courses'); ?>
			</li>
			<li><?php echo CHtml::link('<i class="glyphicons glyphicons-user"></i> Student Profile'); ?>
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

<div class="row">
	<div class="col-md-12">
		<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
				'id'=>'find-guardian_form',
				'enableAjaxValidation'=>false,


				)); ?>
		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title">Previous Details</span>
			</div>
			<div class="panel-body">
			
               <div class="col-md-12">
               <div class="checkbox-custom checkbox-primary mb5 col-md-3">
				<?php
		 		echo $form->checkBox($model,'has_no_data',array());
		 		echo $form->label($model,'has_no_data',array('label'=>'Don\'t have Previous Record'));
		 		?>
				</div>
				</div>
				<div class="col-md-12">
					<div class="col-md-2">
						<?php echo $form->textFieldGroup($model,'exam1',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','readonly'=>'readonly')))); ?>
					</div>
					<div class="col-md-3">
						<?php echo $form->textFieldGroup($model,'institution1',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5')))); ?>
					</div>

					<div class="col-md-3">
						<?php echo $form->dropDownListGroup(
						$model,
						'board1',
						array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
						'widgetOptions' => array(
						'data' => array('barisal'=>'Barisal','chittagong' => 'Chittagong','comilla'=>'Comilla','dhaka' => 'Dhaka','dinajpur'=>'Dinajpur','jessore'=>'Jessore','rajshahi'=>'Rajshahi','sylhet'=>'Sylhet','madrasah'=>'Madrasah','technical'=>'Technical'),
						'htmlOptions' =>array('empty' => 'Select Board'),
						)
					)
				);
				?>
					</div>

					<div class="col-md-2">
					   <?php echo $form->dropDownListGroup(
						$model,
						'year1',
						array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
						'widgetOptions' => array(
						'data' => $year_data_arr,
						'htmlOptions' =>array('empty' => 'Select Year',),
						)
					)
				);
				?>					
				</div>
					<div class="col-md-2">
						<?php echo $form->textFieldGroup($model,'gpa1',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5')))); ?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="col-md-2">
						<?php echo $form->textFieldGroup($model,'exam2',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','readonly'=>'readonly')))); ?>
					</div>
					<div class="col-md-3">
						<?php echo $form->textFieldGroup($model,'institution2',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5')))); ?>
					</div>

					<div class="col-md-3">
						<?php echo $form->dropDownListGroup(
						$model,
						'board2',
						array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
						'widgetOptions' => array(
						'data' => array('barisal'=>'Barisal','chittagong' => 'Chittagong','comilla'=>'Comilla','dhaka' => 'Dhaka','dinajpur'=>'Dinajpur','jessore'=>'Jessore','rajshahi'=>'Rajshahi','sylhet'=>'Sylhet','madrasah'=>'Madrasah','technical'=>'Technical'),
						'htmlOptions' =>array('empty' => 'Select Board'),
						)
					)
				);
				?>
				</div>

					<div class="col-md-2">
					  <?php echo $form->dropDownListGroup(
						$model,
						'year2',
						array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
						'widgetOptions' => array(
						'data' => $year_data_arr,
						'htmlOptions' =>array('empty' => 'Select Year',),
						)
					)
				);
				?>
					</div>
					<div class="col-md-2">
						<?php echo $form->textFieldGroup($model,'gpa2',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5')))); ?>
					</div>
				</div>
			</div>

			<div class="panel-footer">


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

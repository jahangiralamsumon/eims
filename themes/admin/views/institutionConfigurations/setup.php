<?php
$this->breadcrumbs=array(
	'Setup'=>array(''),
	'Institution Configurations',
);

?>
<div class="row">
	<div class="col-md-12">
		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title">Institution Configurations</span>
			</div>
			<div class="panel-body">
				<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
						'id'=>'institution-config-form',
						'type' => 'horizontal',
						'enableAjaxValidation'=>false,
						'htmlOptions' => array('enctype' => 'multipart/form-data'),
			)); ?>
				<?php echo $form->errorSummary($model); ?>
				<div class="row">
					<div class="col-sm-6">
						<?php echo $form->textFieldGroup($model,'institution_name',array(	
								'wrapperHtmlOptions' => array(
							     'class' => 'col-sm-6',
							    ),
							'widgetOptions'=> array ('htmlOptions'=>array('class'=>'span5')))); ?>

						<?php echo $form->textAreaGroup($model,'institution_address', array(
								'wrapperHtmlOptions' => array(
										'class' => 'col-sm-7',
								),
								'widgetOptions'=>array('htmlOptions'=>array('rows'=>3, 'cols'=>10, 'class'=>'span8')))); ?>

						<?php echo $form->textFieldGroup($model,'institution_email',array(	
								'wrapperHtmlOptions' => array(
							     'class' => 'col-sm-6',
							    ),
							'widgetOptions'=> array ('htmlOptions'=>array('class'=>'span5')))); ?>
						<?php
						$img=InstitutionConfigurations::model()->findByAttributes(array('id'=>7))->config_value;
						//var_dump($img);
						if(strlen($img)>0)
						{
							?>
						<div class="form-group">
							<label class="col-lg-3 control-label">Logo </label>
							<div class="col-sm-6">
								<?php 
									
								echo '<img class="imgbrder" src="'.Yii::app()->request->baseUrl.'/uploadedfiles/institution_logo/'.$img .'" alt="'.$img.'" width="100" height="100" />';
								echo CHtml::link(Yii::t('settings','Remove'), array('InstitutionConfigurations/remove', 'id'=>7));
									
								?>
							</div>
						</div>
						<?php	}

						else {
						?>
						<div class="form-group">
							<?php echo $form->labelEx($model, 'logo',array('class'=>'col-sm-3 control-label')); ?>
							<div class="col-sm-6">
								<?php 
								echo $form->fileField($model, 'logo',array('class'=>'btn btn-success fileinput-button'));
								echo $form->error($model, 'logo');
								?>
							</div>
						</div>
						<?php } ?>

					</div>

					<div class="col-sm-6">
						<?php echo $form->textFieldGroup($model,'institution_code',array(	
								'wrapperHtmlOptions' => array(
							     'class' => 'col-sm-6',
							    ),
							'widgetOptions'=> array ('htmlOptions'=>array('class'=>'span5')))); ?>
						<?php echo $form->textFieldGroup($model,'institution_short_name',array(	
								'wrapperHtmlOptions' => array(
							     'class' => 'col-sm-6',
							    ),
							'widgetOptions'=> array ('htmlOptions'=>array('class'=>'span5')))); ?>	
						<?php echo $form->textFieldGroup($model,'institution_phone',array(	
								'wrapperHtmlOptions' => array(
							     'class' => 'col-sm-6',
							    ),
							'widgetOptions'=> array ('htmlOptions'=>array('class'=>'span5')))); ?>
						<?php echo $form->textFieldGroup($model,'institution_fax',array(	
								'wrapperHtmlOptions' => array(
							     'class' => 'col-sm-6',
							    ),
							'widgetOptions'=> array ('htmlOptions'=>array('class'=>'span5')))); ?>

					</div>
				</div>

				<div class="form-actions">
					<?php $this->widget('booster.widgets.TbButton', array(
							'buttonType'=>'submit',
							'context'=>'primary',
							'label'=>'Save',
					)); ?>
				</div>
				<?php $this->endWidget(); ?>
			</div>
		</div>
	</div>

</div>

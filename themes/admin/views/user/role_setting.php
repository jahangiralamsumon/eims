<?php
$this->breadcrumbs=array(
		'Users'=>array('index'),
		'Role Setting',
);

$this->menu=array(
		array('label'=>'Manage Role','url'=>array('rolemanage')),
);
?>
<div class="tray tray-center p20 va-t posr">
	<div class="panel">
		<div class="panel-heading">
			<span class="panel-title">Role Setting </span>

		</div>
		<div class="panel-body ">

			<?php
		$form=$this->beginWidget('booster.widgets.TbActiveForm',array(
		'id'=>'role-setting-form',
		'type' => 'horizontal',
		'enableAjaxValidation'=>false,
		)); ?>


			<div class="form-group">
				<label for="role" class="col-lg-3 control-label">Role</label>
				<div class="col-lg-4">
					<?php echo CHtml::textField('role','', 
 					array('id'=>'role', 
       				'class'=>'form-control')); ?>

				</div>
			</div>
			<?php 
			$count=0;
			foreach ($tasks as $key=> $task):	
            $count++;
			?>
			<div class="col-md-6 mb5">
				<table class="items table table-bordered">
					<tr>
						<th colspan="2"><?php echo $task->description ?></th>
						<?php 
						$childs=Yii::app()->authManager->getItemChildren($task->name)
						?>

					</tr>
					<?php foreach ($childs as $k=> $child):	 ?>
					<tr>

						<td>
							<div class="checkbox-custom fill checkbox-primary mb5">
								<?php 

								echo CHtml::checkbox('items['.$k.']',isset($items[$k])?(strlen($items[$k])>0?true:false):false,array('id'=>$k,'value'=>$k,/*'class'=>'checkbox_class'*/));
								echo CHtml::label($child->description,$k);
								?>
							</div> <?php //echo $child->description ?>
						</td>

					</tr>
					<?php endforeach; ?>

				</table>
			</div>
			<?php echo (($count%2)==0)?'<div class="clearfix"></div>':''?>
			<?php endforeach;?>
			
			<div class="col-md-12">
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

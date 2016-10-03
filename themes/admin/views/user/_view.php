<div class="panel">
	<div class="panel-heading">
		<span class="panel-title">		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	
		</span>
	</div>
	<div class="panel-body ">

	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('short_name')); ?>:</b>
	<?php echo CHtml::encode($data->short_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_img')); ?>:</b>
	<?php echo CHtml::encode($data->user_img); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reg_date')); ?>:</b>
	<?php echo CHtml::encode($data->reg_date); ?>
	<br />

	

</div>
</div>
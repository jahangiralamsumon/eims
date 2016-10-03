<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('shift_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->shift_id),array('view','id'=>$data->shift_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shift_title')); ?>:</b>
	<?php echo CHtml::encode($data->shift_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shift_name')); ?>:</b>
	<?php echo CHtml::encode($data->shift_name); ?>
	<br />


</div>
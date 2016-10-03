<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('grade_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->grade_id),array('view','id'=>$data->grade_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('grade_point')); ?>:</b>
	<?php echo CHtml::encode($data->grade_point); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mark_from')); ?>:</b>
	<?php echo CHtml::encode($data->mark_from); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mark_upto')); ?>:</b>
	<?php echo CHtml::encode($data->mark_upto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comment')); ?>:</b>
	<?php echo CHtml::encode($data->comment); ?>
	<br />


</div>
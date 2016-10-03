<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('exam_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->exam_id),array('view','id'=>$data->exam_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('start_date')); ?>:</b>
	<?php echo CHtml::encode($data->start_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('end_date')); ?>:</b>
	<?php echo CHtml::encode($data->end_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('year_id')); ?>:</b>
	<?php echo CHtml::encode($data->year_id); ?>
	<br />


</div>
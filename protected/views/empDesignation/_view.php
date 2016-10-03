<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('designation_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->designation_id),array('view','id'=>$data->designation_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('designation_name')); ?>:</b>
	<?php echo CHtml::encode($data->designation_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('designation_order')); ?>:</b>
	<?php echo CHtml::encode($data->designation_order); ?>
	<br />


</div>
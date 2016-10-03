<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('acc_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->acc_id),array('view','id'=>$data->acc_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('acc_code')); ?>:</b>
	<?php echo CHtml::encode($data->acc_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('parent')); ?>:</b>
	<?php echo CHtml::encode($data->parent); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('top_parent')); ?>:</b>
	<?php echo CHtml::encode($data->top_parent); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('category')); ?>:</b>
	<?php echo CHtml::encode($data->category); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('depth')); ?>:</b>
	<?php echo CHtml::encode($data->depth); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('open_date')); ?>:</b>
	<?php echo CHtml::encode($data->open_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lr')); ?>:</b>
	<?php echo CHtml::encode($data->lr); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('acc_order')); ?>:</b>
	<?php echo CHtml::encode($data->acc_order); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	*/ ?>

</div>
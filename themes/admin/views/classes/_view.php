<div class="panel">
	<div class="panel-heading">
		<span class="panel-title"> <b><?php echo CHtml::encode($data->getAttributeLabel('class_id')); ?>:</b>
			<?php echo CHtml::link(CHtml::encode($data->class_id),array('view','id'=>$data->class_id)); ?>
		</span>
	</div>
	<div class="panel-body ">

		<b><?php echo CHtml::encode($data->getAttributeLabel('class_name')); ?>:</b>
		<?php echo CHtml::encode($data->class_name); ?>
		<br />

	</div>

</div>

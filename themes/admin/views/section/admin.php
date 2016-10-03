<?php
$this->breadcrumbs=array(
		'Sections'=>array(''),
		'Manage',
);

$this->menu=array(
		array('label'=>'Create Section','url'=>array('create')),
);


?>
<div class="tray tray-center p20 va-t posr">
	<!-- search-form -->
	<div class="panel">
		<div class="panel-heading">
			<span class="panel-title">Manage Sections
			</span>
			<div class="pull-right"></div>
		</div>
		<div class="panel-body ">
			<?php $this->widget('booster.widgets.TbGridView',array(
					'id'=>'section-grid',
					'dataProvider'=>$model->search(),
					'filter'=>$model,
					'columns'=>array(
		'section_id',
		'section_name',
		array(
		'header'=>'Class',
		'name' => 'class_id',
		'value' => 'Classes::item($data->class_id)',
		'filter'=>  Classes::items(),
),	
array(
		'class'=>'booster.widgets.TbButtonColumn',
),
),
)); ?>
		</div>
	</div>
</div>

<?php
$this->breadcrumbs=array(
		'Subjects'=>array('index'),
		'Manage',
);

$this->menu=array(
		array('label'=>'Create Subjects','url'=>array('create')),
);

?>
<div class="tray tray-center p20 va-t posr">
	

	<div class="panel">
		<div class="panel-heading">
			<span class="panel-title">Manage Subjects
			</span>
			<div class="pull-right"></div>
		</div>
		<div class="panel-body">
			<?php $this->widget('booster.widgets.TbGridView',array(
					'id'=>'subjects-grid',
					'dataProvider'=>$model->search(),
					'filter'=>$model,
					'columns'=>array(
		'id',
		'name',
		'code',
		array(
		'header'=>'Class',
		'name' => 'class_id',
		'value' => 'Classes::item($data->class_id)',
		'filter'=>  Classes::items(),
		'htmlOptions'=>array('width'=>'120px'),
		),
		'is_elective',
		/*
		 'created_at',
			'updated_at',
			*/
							array(
									'class'=>'booster.widgets.TbButtonColumn',
),
),
)); ?>
		</div>
	</div>
</div>

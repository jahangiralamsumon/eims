<?php
$this->breadcrumbs=array(
		'Grades'=>array('create'),
		'Manage',
);

$this->menu=array(
		array('label'=>'Create Grade','url'=>array('create')),
);

?>
<div class="tray tray-center p20 va-t posr">

	<div class="panel">
		<div class="panel-heading">
			<span class="panel-title">Manage Grades</span>
			<div class="pull-right"></div>
		</div>
		<div class="panel-body">
			<?php $this->widget('booster.widgets.TbGridView',array(
					'id'=>'grade-grid',
					'dataProvider'=>$model->search(),
					'filter'=>$model,
					'columns'=>array(
		'grade_id',
		'name',
		'grade_point',
		'mark_from',
		'mark_upto',
		'comment',
array(
		'class'=>'booster.widgets.TbButtonColumn',
),
),
)); ?>
		</div>
	</div>
</div>

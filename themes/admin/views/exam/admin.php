<?php
$this->breadcrumbs=array(
		'Exams'=>array(''),
		'Manage',
);

$this->menu=array(
		array('label'=>'Create Exam','url'=>array('create')),
);

?>
<div class="tray tray-center p20 va-t posr">

	<div class="panel">
		<div class="panel-heading">
			<span class="panel-title"> Manage Exams</span>
			<div class="pull-right"></div>
		</div>
		<div class="panel-body">
			<?php $this->widget('booster.widgets.TbGridView',array(
					'id'=>'exam-grid',
					'dataProvider'=>$model->search(),
					'filter'=>$model,
					'columns'=>array(
		'exam_id',
		'name',
		 array(
		'header'=>'Class',
		'name' => 'class_id',
		'value' => 'Classes::item($data->class_id)',
		'filter'=>  Classes::items(),
		'htmlOptions'=>array('width'=>'120px'),
        ),
		array(
			'header'=>'Result Published',
			 'name' => 'result_published',
			'value' => '$data->result_published==0?"Unpublished":"Published"',
			'filter'=>  array("0"=>"Unpublished","1"=>"Published"),
			'htmlOptions'=>array('class'=>'text-right'),
			),							
       array(
		'header'=>'Year',
		'name' => 'year',
		'value' => '$data->year',
		'htmlOptions'=>array('width'=>'120px'),
),
array(
		'class'=>'booster.widgets.TbButtonColumn',
),
),
)); ?>
		</div>
	</div>
</div>


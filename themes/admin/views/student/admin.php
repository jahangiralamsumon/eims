<?php
$this->breadcrumbs=array(
		'Students'=>array('index'),
		'Manage',
);

$this->menu=array(
		array('label'=>'List Student','url'=>array('index')),
		array('label'=>'Create Student','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
		$('.search-button').click(function(){
		$('.search-form').toggle();
		return false;
});
		$('.search-form form').submit(function(){
		$.fn.yiiGridView.update('student-grid', {
		data: $(this).serialize()
});
		return false;
});
		");
?>

<h1>Manage Students</h1>


<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display: none">
	<?php $this->renderPartial('_search',array(
			'model'=>$model,
)); ?>
</div>
<!-- search-form -->

<div class="panel">
	<div class="panel-heading">
		<span class="panel-title"> <span class="glyphicons glyphicons-table"></span>
		</span>
		<div class="pull-right"></div>
	</div>
	<div class="panel-body pn">
		<?php $this->widget('booster.widgets.TbGridView',array(
				'id'=>'student-grid',
				'dataProvider'=>$model->search(),
				'filter'=>$model,
				'columns'=>array(
						array(
		'header'=>'Reg NO ',
		'name' => 'reg_no',
		'type' => 'raw',
		'value' => 'CHtml::encode($data->reg_no)'
),
array(
		'name' => 'name',
		'type' => 'raw',
		'value' => 'CHtml::encode($data->name)'
),
array(
		'header'=>'Admission NO',
		'name' => 'admission_no',
		'type' => 'raw',
		'value' => 'CHtml::encode($data->admission_no)'
),

		
		/* 'reg_no',
		'name',
		'admission_no',
		'sex',
		 'present_address',
		'permanent_address',
		'phone',
		'mobile',
		'email',
		'sex',
		'birthday',
		'religion',
		'blood_group',
		'nationality_id',
		'img_file',
		'user_id',
		'password',
		'parent_id',
		'created_at',
		'updated_at',
		'status',
		*/
						array(
								'class'=>'booster.widgets.TbButtonColumn',
),
),
)); 

		?>

	</div>
</div>


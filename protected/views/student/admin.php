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

<p>
	You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
		&lt;&gt;</b>
	or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'student-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'student_id',
		'reg_no',
		'admission_date',
		'name',
		'father_name',
		'mother_name',
		/*
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
)); ?>

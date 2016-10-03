<?php
$this->breadcrumbs=array(
	'Employees'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List Employees','url'=>array('index')),
array('label'=>'Create Employees','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('employees-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Manage Employees</h1>

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
'id'=>'employees-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'id',
		'emp_number',
		'emp_attendance_card_id',
		'joining_date',
		'name',
		'name_bn',
		/*
		'gender',
		'blood_group',
		'religion',
		'job_title',
		'emp_designation_id',
		'emp_department_id',
		'employee_category_id',
		'employee_grade_id',
		'qualification',
		'experience_detail',
		'experience_year',
		'experience_month',
		'status_description',
		'date_of_birth',
		'marital_status',
		'children_count',
		'father_name',
		'mother_name',
		'husband_name',
		'nationality_id',
		'home_address_line1',
		'home_address_line2',
		'home_city',
		'country_id',
		'office_address_line1',
		'office_address_line2',
		'office_phone',
		'mobile_phone',
		'home_phone',
		'email',
		'fax',
		'photo_file_name',
		'created_at',
		'updated_at',
		'user_id',
		'is_deleted',
		'status',
		*/
array(
'class'=>'booster.widgets.TbButtonColumn',
),
),
)); ?>

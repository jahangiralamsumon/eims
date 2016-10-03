<?php
$this->breadcrumbs=array(
	'Employees'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List Employees','url'=>array('index')),
array('label'=>'Create Employees','url'=>array('create')),
array('label'=>'Update Employees','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Employees','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Employees','url'=>array('admin')),
);
?>

<h1>View Employees #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'emp_number',
		'emp_attendance_card_id',
		'joining_date',
		'name',
		'name_bn',
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
),
)); ?>

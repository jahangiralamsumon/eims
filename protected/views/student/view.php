<?php
$this->breadcrumbs=array(
	'Students'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List Student','url'=>array('index')),
array('label'=>'Create Student','url'=>array('create')),
array('label'=>'Update Student','url'=>array('update','id'=>$model->student_id)),
array('label'=>'Delete Student','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->student_id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Student','url'=>array('admin')),
);
?>

<h1>View Student #<?php echo $model->student_id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'student_id',
		'reg_no',
		'admission_date',
		'name',
		'father_name',
		'mother_name',
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
),
)); ?>

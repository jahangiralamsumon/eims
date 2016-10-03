<?php
$this->breadcrumbs=array(
	'Employee'=>array('index'),
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

<div class="panel">
                        <div class="panel-heading">
                            <span class="panel-title">
                               Manage Employees
                               </span> 
                           
                        </div>
                        <div class="panel-body">
<?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'employees-grid',
'type'=>'striped bordered condensed',		
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'id',
		'emp_number',
		'name',
		array(
				'header'=>'Department',
				'name' => 'emp_department_id',
				'value' => 'EmpDepartments::item($data->emp_department_id)',
				'filter'=>  EmpDepartments::items(),
		),
		array(
				'name' => 'emp_designation_id',
				'value' => 'EmpDesignation::item($data->emp_designation_id)',
				'filter'=>  EmpDesignation::items(),
		),
		
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
				'template'=>'{view} {update} ',
				'viewButtonUrl'=>'Yii::app()->createUrl("/employees/view", array("id" => $data["id"]))',
				'deleteButtonUrl'=>'Yii::app()->createUrl("/employees/delete", array("id" =>  $data["id"]))',
				'updateButtonUrl'=>'Yii::app()->createUrl("/employees/update", array("id" =>  $data["id"]))',
		),
),
)); ?>
</div>
</div>

<?php
$this->breadcrumbs=array(
		'Employee'=>array('admin'),
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

<h1>
	View Employees #
	<?php echo $model->id; ?>
</h1>
<div class="row">
	<div class="col-md-12">
		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title">Employee Details</span>
			</div>
			<div class="panel-body">
				<div class="col-md-12">

					<table class="table table-hover table-bordered  table-striped ">

						<tr>

							<th width="25%">Employee Number</th>
							<td width="25%"><?php echo $model->emp_number ?></td>
							<th width="25%">Name</th>
							<td width="25%"><?php echo $model->name ?></td>
						</tr>
						<tr>

							<th>Join Date</th>
							<td><?php echo date("d-M-Y",strtotime($model->joining_date)) ?></td>
							<th>Date of Birth</th>
							<td><?php echo date("d-M-Y",strtotime($model->date_of_birth)) ?>
							</td>
						</tr>
						<tr>

							<th>Department</th>
							<td><?php echo EmpDepartments::item($model->emp_department_id)?>
							</td>
							<th>Designation</th>
							<td><?php echo EmpDesignation::item($model->emp_designation_id) ?>
							</td>
						</tr>
						<tr>

							<th>Category</th>
							<td><?php echo EmpCategory::item($model->employee_category_id) ?>
							</td>
							<th>Total Experience</th>
							<td><?php echo $model->experience_year .' Year(s) '.$model->experience_month.' Month(s)' ?>
							</td>
						</tr>
						<tr>

							<th>Blood Group</th>
							<td><?php echo $model->blood_group ?></td>
							<th>Marital status</th>
							<td><?php echo $model->marital_status ?></td>
						</tr>
						<tr>

							<th>Nationality</th>
							<td><?php echo Countries::item($model->country_id) ?></td>
							<th>Religion</th>
							<td><?php echo $model->religion ?></td>
						</tr>


					</table>




				</div>

			</div>
		</div>
	</div>

	<div class="col-md-12">
		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title">Contact Details</span>
			</div>
			<div class="panel-body">
				<div class="col-md-12">

					<table class="table table-hover table-bordered  table-striped ">

						<tr>

							<th width="25%">Home Address</th>
							<td width="25%"><?php echo $model->home_address ?></td>
							<th width="25%">Office Address</th>
							<td width="25%"><?php echo $model->office_address ?></td>
						</tr>
						<tr>

							<th>Home Phone</th>
							<td><?php echo $model->home_phone ?></td>
							<th>Office Phone</th>
							<td><?php echo $model->office_phone ?>
							</td>
						</tr>
						<tr>

							<th>Mobile Number</th>
							<td><?php echo $model->mobile_phone ?>
							</td>
							<th>Email</th>
							<td><?php echo $model->email ?>
							</td>
						</tr>
						

					</table>




				</div>

			</div>
		</div>
	</div>
</div>

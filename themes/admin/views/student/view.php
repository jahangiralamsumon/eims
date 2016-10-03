<?php
$this->breadcrumbs=array(
		'Students'=>array('index'),
		$model->name,
);

$this->menu=array(
		array('label'=>'List Student','url'=>array('studentlist')),
		array('label'=>'Update Student','url'=>array('update','id'=>$model->student_id)),
);
?>

<div class="tray tray-center p20 va-t posr">

<div class="tab-block">


			<ul
				class="nav nav-tabs tabs-bg tabs-border">
				<li class="active">
				<?php  echo CHtml::link('<i class="fa fa-floppy-o pr5"></i>Profile',array('/student/view','id'=>$model->student_id),array()); ?>
				</li>
				<li>
				<?php echo CHtml::link('<i class="glyphicons glyphicons-book"></i>Courses',array('/student/courses','id'=>$model->student_id),array()); ?>
				</li>
				<li>
				<?php echo CHtml::link('<i class="glyphicons glyphicons-calendar"></i>Attendance',array('/student/attendance','id'=>$model->student_id),array()); ?>
				</li>
		        <li>
				<?php echo CHtml::link('<i class="glyphicons glyphicons-usd"></i>Fees',array('/student/fees','id'=>$model->student_id),array()); ?>
				</li>
				<li>
				<?php //echo CHtml::link('<i class="glyphicons glyphicons-gift"></i>Result',array('/student/result','id'=>$model->student_id),array()); ?>
				</li>
			</ul>
			<div class="tab-content">
			<div class="col-md-4">
			     <?php if(empty($model->img_file_name)) {?>
				<div class="fileupload fileupload-new admin-form"
					data-provides="fileupload">
					<div class="fileupload-preview thumbnail mb20">
						<img data-src="holder.js/100%x140" alt="100%x140"
							style="height: 220px; width: 100%; display: block;"
							src=""
							data-holder-rendered="true">
					</div>				
				</div>
				<?php } else {?>
				<div class="fileupload fileupload-new admin-form"
					data-provides="fileupload">
					<div class="fileupload-preview thumbnail mb20">
						<img
							style="height: 220px; width: 100%; display: block;"
							src="<?php echo Yii::app()->baseUrl.'/uploadedfiles/student/'.$model->student_id.'/'.$model->img_file_name?>"
							data-holder-rendered="true">
					</div>				
				</div>
				
				<?php } ?>
			</div>
			<div class="col-md-8">
				<h2>
					<?php echo $model->name ?>
					<small>Profile</small>
				</h2>
			</div>

			<div class="col-md-12">
				<h2 class="page-header mtn">General Information</h2>
				<table class="table table-hover table-bordered  table-striped ">
				
						<tr>

							<th  width="50%">Student ID </th>
							<td  width="50%"><?php echo $model->student_id ?></td>
						</tr>
					
		
						<tr>

							<th>Name</th>
							<td><?php echo $model->name ?></td>
						</tr>
						<tr>

							<th>Admission Date</th>
							<td><?php echo $model->admission_date ?></td>
						</tr>
						<tr>

							<th>Father Name</th>
							<td><?php echo $model->father_name ?></td>
						</tr>
						
						<tr>

							<th>Mother Name </th>
							<td><?php echo $model->mother_name ?></td>
						</tr>
					
						<tr>

							<th>Birthday</th>
							<td><?php echo $model->birthday ?></td>
						</tr>
						<tr>

							<th>Blood Group</th>
							<td><?php echo $model->blood_group ?></td>
						</tr>
						<tr>

							<th>Sex</th>
							<td><?php echo $model->sex!=''?($model->sex=='M'?'Male':'Female'):''; ?></td>
						</tr>
						
						<tr>

							<th>Religion</th>
							<td><?php echo $model->religion ?></td>
						</tr>
						<tr>
						 <th>Nationality</th>
						 <td><?php echo Countries::item($model->nationality_id) ?> </td>
						</tr>

					
				</table>
				<br>
				<h2 class="page-header mtn">Contact Information</h2>
				<table class="table table-hover table-bordered  table-striped ">
				
						<tr>

							<th width="50%">Present Address  </th>
							<td width="50%"><?php echo $model->present_address ?></td>
						</tr>
					
		
						<tr>

							<th>Permanent Address</th>
							<td><?php echo $model->permanent_address ?></td>
						</tr>
						<tr>

							<th>Phone</th>
							<td><?php echo $model->phone ?></td>
						</tr>
						
						<tr>

							<th>Mobile </th>
							<td><?php echo $model->mobile ?></td>
						</tr>
					
						<tr>

							<th>Email</th>
							<td><?php echo $model->email ?></td>
						</tr>
				

					
				</table>
			</div>
		
		
		</div>
	</div>
</div>

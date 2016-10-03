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
				<li>
				<?php  echo CHtml::link('<i class="fa fa-floppy-o pr5"></i>Profile',array('/student/view','id'=>$model->student_id),array()); ?>
				</li>
				<li class="active">
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
					<table class="table table-hover table-bordered  table-striped ">
				
						<tr>

							<th  width="50%">Class </th>
							<td  width="50%"><?php echo $model->class_name?></td>
						</tr>
						<tr>	
							<th>Section</th>
							<td><?php echo $model->section_name ?></td>
							
						</tr>
						<tr>	
							<th>Group</th>
							<td><?php echo ucfirst($model->group); ?></td>
							
						</tr>
						<tr>	
							<th>Roll No</th>
							<td><?php echo $model->roll_no ?></td>
							
						</tr>
						<tr>	
							<th>Year</th>
							<td><?php echo $model->year_name ?></td>
							
						</tr>
					</table>	
			</div>
		

			<div class="col-md-12">
				<h2 class="page-header mtn"> Registered Courses </h2>
				<table class="table table-hover table-bordered  table-striped ">
				
						<tr>

							<th  width="50%">Course Code  </th>
							<th  width="50%">Course Name</th>
						</tr>
					
		               <?php  foreach ( $student_sub as  $row):?>

						<tr>

							<td><?php echo $row->code  ?></td>
							<td><?php echo $row->optional=='1'?$row->subject_name.' <span class="label label-info">Optional</span>':$row->subject_name ; ?></td>
						</tr>
						
						<?php   endforeach;?>
						

					
				</table>
				<br>
				
			</div>
		
		
		</div>
	</div>
</div>

<?php
$this->breadcrumbs=array(
		'Result'=>array('view'),
		'View Result',
);
?>

<?php echo CHtml::link('<i class="fa fa-search pr5"></i>Search Again',array('/site/result'),array("class"=>"btn btn-primary btn-gradient mb20",)); ?>

<div class="row">
<div class="col-md-12">
	<?php if(isset($result)){?>

	<div class="panel invoice-panel">
		<div class="panel-heading">
			<span class="panel-title"> <span class="glyphicons glyphicons-gift"></span>
				Student Result
			</span>
			<div class="panel-header-menu pull-right mr10">
				<a href="javascript:window.print()"
					class="btn btn-xs btn-default btn-gradient mr5"> <i
					class="fa fa-print fs13"></i>
				</a>

			</div>
		</div>
		<div class="panel-body p20" id="invoice-item">

			<div class="row" id="invoice-info">
				<div class="col-md-6">
					<div class="panel panel-alt">
						<div class="panel-heading">
							<span class="panel-title"> <i class="fa fa-user"></i> Student
								Details
							</span>
						</div>
						<div class="panel-body">
							<table class="table table-bordered">
								<tr>
									<th>Student Name</th>
									<td><?php  echo $student_obj->name; ?></td>
								</tr>
								<tr>
									<th>ID</th>
									<td><?php echo $student_obj->student_id;?></td>
								</tr>
								<tr>
									<th>Class</th>
									<td><?php echo $student_obj->class_name ?></td>
								</tr>

								<tr>
									<th>Group</th>
									<td><?php echo ucfirst($student_obj->group); ?></td>

								</tr>
								<tr>
									<th>Section</th>
									<td><?php echo $student_obj->section_name ?></td>

								</tr>
								<tr>
									<th>Roll No</th>
									<td><?php echo $student_obj->roll_no ?></td>

								</tr>

							</table>
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="panel panel-alt">
						<div class="panel-heading">
							<span class="panel-title"> <i class="fa fa-gift"></i> Exam
								Details
							</span>
						</div>
						<div class="panel-body">
							<table class="table table-bordered">
								<tr>
									<th>Exam</th>
									<td><?php  echo Exam::exam_name($exam_id);?></td>
								</tr>
								<tr>
									<th>Year</th>
									<td><?php echo $student_obj->year_name ?></td>

								</tr>

							</table>
						</div>
					</div>
				</div>


			</div>
			<div class="row" id="invoice-table">
				<div class="col-md-12">
					<table class="table table-striped">
						<thead>
							<tr>
								<th><b>Subject</b></th>
								<th><b>Obtained marks</b></th>
								<th><b>Highest mark</b></th>
								<th><b>Grade</b></th>
								<th><b>Grade Point</b></th>
								<th><b>Attendance</b></th>

							</tr>
						</thead>
						<tbody>
							<?php 
							$total_mark=0;
							$gp=0;
							$f_sub=0;
						foreach ($result as $key=>$row):?>
							<tr>
								<td><?php echo $row->subject_name ?></td>
								<td><?php echo $row->mark ?></td>
								<td><?php echo $row->heighest_mark  ?></td>
								<td><?php echo Grade::get_grade($row->written,$row->mcq,$row->practical,$row->mark,$row->sub_id) ?>
								</td>
								<td><?php 
											$total_mark=$total_mark+$row->mark;										
											if($row->is_elective=='1'){
											$elective_sub_gp =Grade::get_grade_point($row->written,$row->mcq,$row->practical,$row->mark,$row->sub_id);
											}
											else{
											$gp=$gp + Grade::get_grade_point($row->written,$row->mcq,$row->practical,$row->mark,$row->sub_id);
											if(Grade::get_grade_point($row->written,$row->mcq,$row->practical,$row->mark,$row->sub_id)==0){
												$f_sub=$f_sub+1;
											}	
											}
			
											echo number_format(Grade::get_grade_point($row->written,$row->mcq,$row->practical,$row->mark,$row->sub_id),2,'.','');
			
										 ?>
								</td>
								<td><?php echo $row->attendance ?></td>
							
							
							<tr>
								<?php endforeach; ?>
						
						</tbody>
					</table>
				</div>
			</div>
			<div class="row" id="invoice-footer">
				<div class="col-md-12">

					<div class="pull-right">
						<table class="table">

							<tr>
								<td><b>Total Marks:</b>
								</td>
								<td><?php echo number_format($total_mark,2,'.','')?></td>
							</tr>
							<tr>
								<td><b>Total GP:</b>
								</td>
								<td><?php echo number_format($gp,2,'.',''); ?></td>
							</tr>

							<tr>
								<td><b>GPA:</b>
								</td>
								<td><?php echo  $f_sub>0?number_format(0,2,'.',''):number_format($gp/($key+1) ,2,'.',''); ?></td>
							</tr>

						</table>
					</div>
					<div class="clearfix"></div>
					<div class="invoice-buttons">						
						<?php //echo CHtml::link('<i class="fa fa-print pr5"></i>Print',array('/marks/resultprint','student_id'=>$result['0']->student_id,'exam_id'=>$result['0']->exam_id,'year_id'=>$year_id),array("class"=>"btn btn-primary btn-gradient","target"=>"_blank")); ?>
					</div>
				</div>
			</div>

		</div>
	</div>
	<?php } else{ 
		
	echo 'RESULT NOT FOUND!';	
	}
	?>
	</div>
	
</div>

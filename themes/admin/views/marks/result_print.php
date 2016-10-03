
<?php if(isset($result)):?>


<?php endif;?>

<html>
<head>
<title><?php  echo  $title ?></title>
<link rel="stylesheet" type="text/css" href="<?php  echo Yii::app()->request->baseUrl;?>/css/print-receipt.css" media="screen, print, projection" />
</head>
<body>

<div id="pcr">

<table class="table table-bordered table-main">
	<tr>
		<td colspan=3 class="text-left padding-left padding-right" style="border-bottom:1px solid #000;height:80px">
		<table>
			<tr>
				<td rowspan=2>  <img src="<?php echo InstitutionConfigurations::ins_logo() ?>" style="width:80px; height:60px "> </td>
				<td class="text-left org-title"><?php echo InstitutionConfigurations::model()->findByAttributes(array('id'=>1))->config_value; ?></td>
			</tr>
			<tr><td class="text-left org-address"><?php echo InstitutionConfigurations::model()->findByAttributes(array('id'=>3))->config_value; ?></td></tr>
		</table>
		</td>
	</tr>
	<tr>
		<th colspan=3 class="border-none"> 
			Student Result
		</th>
	</tr>
	<tr>
		<td class="text-left padding-left"><?php echo "<b>Student No : </b>". $student_obj->student_id;?></td>
		<td></td>
		<td class="text-right padding-right"><?php echo "<b>Exam : </b>". Exam::exam_name($exam_id) ?></td>
	</tr>
	<tr>
		<td colspan=2 class="text-left padding-left"><?php  echo "<b>Name : </b>". $student_obj->name;?></td>
		<td class="text-right padding-right"><?php echo "<b>Year : </b>". $student_obj->year_name ?></td>
	</tr>
	<tr>
		<td colspan=3 class="text-left padding-left"><?php echo "<b>Class : </b>".$student_obj->class_name ?></td>
	</tr>
	<tr>
		<td class="text-left padding-left"><?php echo "<b>Group : </b>". ucfirst($student_obj->group);; ?></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
	<td colspan=3 class="text-left padding-left"><?php echo "<b>Section : </b>".$student_obj->section_name ?></td>
	</tr>
	<tr>
		<th colspan=3 style="padding:1%;" class="border-none"><?php echo "Academic Transcript"; ?></th>
	</tr>
	
	<!---Start payment history of this category--->
	
	<tr>
		<td colspan=3 class="padding-left padding-right" style="padding-bottom:2%;">
		
		<table class="table table-border" style="width:100%;">
			<tr class="header">
				<th>Subject</th>
				<th>Obtained mark</th>
				<th>Highest mark</th>
				<th>Grade</th>
			    <th>Grade Point</th>
				<th>Attendance</th>
			</tr>
						
					<tbody>
										<?php 
										$total_mark=0;
										$gp=0;
										$f_sub=0;
										foreach ($result as $key=>$row):?>
										<tr>
											<td style="border: 1px solid #ddd; padding: 5px"><?php echo $row->subject_name ?>
											</td>
											<td style="border: 1px solid #ddd; padding: 5px"><?php echo $row->mark ?>
											</td>
											<td style="border: 1px solid #ddd; padding: 5px"><?php  echo $row->heighest_mark  ?>
											</td>
											<td style="border: 1px solid #ddd; padding: 5px"><?php echo Grade::get_grade($row->written,$row->mcq,$row->practical,$row->mark,$row->sub_id) ?>
											</td>
											<td style="border: 1px solid #ddd; padding: 5px">
											<?php 
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
											<td style="border: 1px solid #ddd; padding: 5px"><?php echo $row->attendance ?>
											</td>
										
										</tr>
										
										
									<?php endforeach; ?>
								</tbody>
											
	
		</table>
		</td>
	</tr>
	
	<!-----Start fees collection category fees details description---->
	<tr>
		<td colspan=3 class="padding-left padding-right" style="padding-bottom:2%;">
		<table class="table table-border" style="width:100%;">
			<tr class="header">
				<th>Total Marks</th>
				<th>Total GP</th>
				<th>GPA</th>
			</tr>
			
			
			<tr>
				<td class="text-center"><?php echo number_format($total_mark,2,'.','')?></td>
				<td class="text-center">
				<?php echo number_format($gp,2,'.',''); ?>
		        </td>
		        <td class="text-center">
				<?php echo  $f_sub>0?number_format(0,2,'.',''):number_format($gp/($key) ,2,'.',''); ?>
		        </td>
			</tr>
		</table>
		</td>
	</tr>
	<!----End payment history of this category---->
	<!----------Start footer signation------------>
	<tr>
		<td colspan=3 class="text-right vcenter" style="height:80px;padding-right:12%;font-weight:bold;border-top:1px solid #000;">
			Signature
		</td>
	</tr>
	<!----------End footer signation------------>
	

</table>
</div>
</body>
</html>


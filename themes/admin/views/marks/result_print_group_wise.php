<?php 
$subjects=Subjects::class_sub_list($class_id,$group);
?>
<html>
<head>
<title><?php  //echo  $title ?></title>
<link rel="stylesheet" type="text/css"
	href="<?php  echo Yii::app()->request->baseUrl;?>/css/print-receipt.css"
	media="screen, print, projection" />
</head>
<body>
<div id="pcr">

	<!---Start payment history of this category--->


	<table class="table table-border" style="width: 100%;">
	 <thead>
	 <tr>
			<th colspan=35 class="border-none"><img
				src="<?php echo InstitutionConfigurations::ins_logo() ?>"
				style="width: 80px; height: 60px">
			</th>
	</tr>		
		 <tr>	
			<th colspan=35  class="org-title border-none"><?php echo InstitutionConfigurations::model()->findByAttributes(array('id'=>1))->config_value; ?>
			</th>
		</tr>
	 
	  <tr>
	   
			<th colspan=35 class="border-none"><?php echo Classes::item($class_id) ?></th>
		</tr>
	 <tr>
	   
			<th colspan=35 class="border-none"><?php echo ucfirst($group) ?></th>
		</tr>

		<tr>

			<th colspan=35 class="border-none"><?php  echo Exam::exam_name($exam_id);?>
			</th>

		</tr>
		<tr class="header">
			<th rowspan="2">Roll No</th>
			<?php
			$sub_details_arr=array();
			foreach ($subjects as $sub_id=>$sub_name) :
			$col_span=3;
			$sub_details=Subjects::model()->findByPk($sub_id);
			$sub_details_arr[$sub_id]=$sub_details;
			if($sub_details->mcq>0){
								$col_span=$col_span+1;

							}
							if($sub_details->practical>0){
								$col_span=$col_span+1;
							}

							?>
			<th colspan="<?php echo $col_span?>"><?php echo $sub_name ?></th>
			<?php endforeach; ?>
			<th rowspan="2">Total GP</th>
			<th rowspan="2">GPA</th>
			<th rowspan="2">F Sub</th>
		</tr>
		<tr>
			<?php 
			foreach ($subjects as $sub_id=>$sub_name) :
			$sub_details=$sub_details_arr[$sub_id];

			?>
			<?php if($sub_details->written>0) :?>
			<th>CQ</th>
			<?php endif; ?>
			<?php if($sub_details->mcq>0) :?>
			<th>MCQ</th>
			<?php endif; ?>

			<?php if($sub_details->practical>0) :?>
			<th>Prac.</th>
			<?php endif; ?>
			<th>Total Mark</th>
			<th>LG</th>

			<?php endforeach; ?>
		</tr>
       </thead>
       <tfoot class="border-none">
       
        <tr class="border-none">
	   
		  <td colspan="35" class="border-none">&nbsp;</td>

		</tr>
		<tr class="border-none">
	   
		  <td colspan="35" class="border-none">&nbsp;</td>

		</tr>
			
       </tfoot>
		<tbody>

			<?php
			foreach ($students as $student){

                      $command= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
                      ->select("s.student_id student_id,sub.id sub_id,sub.name subject_name,ss.is_elective is_elective,es.*,(SELECT max(mark) FROM exam_score WHERE exam_id='{$exam_id}' AND subject_id=ss.subject_id )heighest_mark")
                      ->from('student s')
                      ->join('students_subjects ss', 'ss.student_id=s.student_id')
                      ->join('academic_year_info year_info', 'ss.year_id=year_info.year_code AND year_info.year_code=:year_id',array(':year_id'=>$year_id))
                      ->leftJoin('subjects sub','sub.id=ss.subject_id')
                      ->leftJoin('exam_score es', 'es.subject_id=ss.subject_id AND es.student_id=:student_id AND es.exam_id=:exam_id',array(':student_id'=>$student->student_id,':exam_id'=>$exam_id))
                      ->where('s.student_id =:student_id ', array(':student_id'=>$student->student_id))
                      ->order('sub.code ASC');
                      $result=$command->queryAll();
                       

                      $total_mark=0;
                      $gp=0;
                      $f_sub=0;
                      foreach ($result as $key=>$row):
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

                      	endforeach;
                       ?>

			<tr>
				<td style="border: 1px solid #000; padding: 25px 5px"><?php echo $student->roll_no ?>
				</td>


				<?php foreach ($subjects as $sub_id=>$sub_name) : ?>

				<?php
				$criteria=new CDbCriteria();
				$criteria->condition='exam_id=:exam_id AND subject_id=:subject_id AND student_id=:student_id';
				$criteria->params=array(':exam_id'=>$exam_id,':subject_id'=>$sub_id,':student_id'=>$student->student_id);
				$row=ExamScore::model()->find($criteria);
					
				$sub_details=$sub_details_arr[$sub_id];
				$col_span=3;
				if($sub_details->mcq>0){
									$col_span=$col_span+1;

								}
								if($sub_details->practical>0){
									$col_span=$col_span+1;
								}

							   if($row!==null){?>
				<?php if($sub_details->written>0) :?>
				<td style="border: 1px solid #000; padding: 25px 5px"><?php echo round($row->written)?>
				</td>
				<?php endif; ?>
				<?php if($sub_details->mcq>0) :?>
				<td style="border: 1px solid #000; padding: 25px 5px"><?php echo round($row->mcq) ?>
				</td>
				<?php endif; ?>
				<?php if($sub_details->practical>0) :?>
				<td style="border: 1px solid #000; padding: 25px 5px"><?php echo round($row->practical) ?>
				</td>
				<?php endif; ?>
				<td style="border: 1px solid #000; padding: 25px 5px"><?php 
				echo round($row->mark);
				?>
				</td>
				<td style="border: 1px solid #000; padding: 25px 5px"><?php 
				echo Grade::get_grade($row->written,$row->mcq,$row->practical,$row->mark,$row->subject_id) ;
				?>
				</td>
				<?php
								}
							   else{?>
				<td colspan="<?php echo $col_span?>"
					style="border: 1px solid #000; padding: 25px 5px"></td>

				<?php 
							   }


							   endforeach;
							   ?>

				<td style="border: 1px solid #000; padding: 25px 5px"><?php echo number_format($gp,2,'.',''); ?>
				</td>
				<td style="border: 1px solid #000; padding: 25px 5px"><?php echo  $f_sub>0?number_format(0,2,'.',''):number_format($gp/($key) ,2,'.',''); ?>
				</td>
				<td style="border: 1px solid #000; padding: 25px 5px"><?php echo  $f_sub>0?$f_sub:''; ?>
				</td>
			</tr>

			<?php } ?>
		</tbody>
		


	</table>
</div>
</body>
</html>


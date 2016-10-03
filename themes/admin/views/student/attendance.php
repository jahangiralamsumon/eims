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
				<li><?php  echo CHtml::link('<i class="fa fa-floppy-o pr5"></i>Profile',array('/student/view','id'=>$model->student_id),array()); ?>
				</li>
				<li><?php echo CHtml::link('<i class="glyphicons glyphicons-book"></i>Courses',array('/student/courses','id'=>$model->student_id),array()); ?>
				</li>
				<li class="active"><?php echo CHtml::link('<i class="glyphicons glyphicons-calendar"></i>Attendance',array('/student/attendance','id'=>$model->student_id),array()); ?>
				</li>
				<li><?php echo CHtml::link('<i class="glyphicons glyphicons-usd"></i>Fees',array('/student/fees','id'=>$model->student_id),array()); ?>
				</li>
				<li><?php //echo CHtml::link('<i class="glyphicons glyphicons-gift"></i>Result',array('/student/result','id'=>$model->student_id),array()); ?>
				</li>
			</ul>
	
	<div class="tab-content">

			<div class="col-md-4">
				<?php if(empty($model->img_file_name)) {?>
				<div class="fileupload fileupload-new admin-form"
					data-provides="fileupload">
					<div class="fileupload-preview thumbnail mb20">
						<img data-src="holder.js/100%x140" alt="100%x140"
							style="height: 220px; width: 100%; display: block;" src=""
							data-holder-rendered="true">
					</div>
				</div>
				<?php } else {?>
				<div class="fileupload fileupload-new admin-form"
					data-provides="fileupload">
					<div class="fileupload-preview thumbnail mb20">
						<img style="height: 220px; width: 100%; display: block;"
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
				<h2 class="page-header mtn">Attendance Report</h2>

<style>

.atnd_Con{
	padding:0px;
	margin:30px 0px 0px 0px;
	width:100%;
	background:#FFF;
}
.atnd_Con table{
	border-left:1px #aec3d3 solid;
	border-top:1px #aec3d3 solid;
}
.atnd_Con td{
	border-right:1px #aec3d3 solid;
	border-bottom:1px #aec3d3 solid;
	padding:0px 0px;
	cursor:pointer;
	background:#FFF;
}
.atnd_Con td:hover{background-color:#fff;}
.atnd_Con td.name{ text-align:center;background:#fff; color:#000; padding:10px 0px; font-size:11px; font-weight:bold; display:block}
.atnd_Con th{
	border-right:1px #aec3d3 solid;
	border-bottom:1px #aec3d3 solid;
	padding:6px 5px;
	background:#fff;
	color:#C30;
	font-size:11px;
	text-align:center;
}
.atnd_Con th span{
	display:block;
	font-size:10px;
	color:#fec429;
	width:15px;
	text-align:center;
}
</style>

				<?php //$batch=Batches::model()->findByAttributes(array('id'=>$_REQUEST['id'])); ?>

				<?php
				function getweek($date,$month,$year)
				{
					$date = mktime(0, 0, 0,$month,$date,$year);
					$week = date('w', $date);
					switch($week) {
						case 0:
							return 'S<br>';
							break;
						case 1:
							return 'M<br>';
							break;
						case 2:
							return 'T<br>';
							break;
						case 3:
							return 'W<br>';
							break;
						case 4:
							return 'T<br>';
							break;
						case 5:
							return 'F<br>';
							break;
						case 6:
							return 'S<br>';
							break;
}
				}
				
				function getMonthname($nextmonth)
				{
					switch($nextmonth)
					{
						case 1 :
							$stringmonth = "January";
							break;
						case 2 :
							$stringmonth = "February";
							break;
						case 3 :
							$stringmonth = "March";
							break;
						case 4 :
							$stringmonth = "April";
							break;
						case 5 :
							$stringmonth = "May";
							break;
						case 6 :
							$stringmonth = "June";
							break;
						case 7 :
							$stringmonth = "July";
							break;
						case 8 :
							$stringmonth = "August";
							break;
						case 9 :
							$stringmonth = "September";
							break;
						case 10 :
							$stringmonth = "October";
							break;
						case 11 :
							$stringmonth = "November";
							break;
						case 12 :
							$stringmonth = "December";
							break;
					}
					return $stringmonth;
				}
				?>
				<?php
				//$subjects=Subjects::model()->findAll("batch_id=:x", array(':x'=>$_REQUEST['id']));

				//echo CHtml::dropDownList('batch_id','',CHtml::listData(Subjects::model()->findAll("batch_id=:x",array(':x'=>$_REQUEST['id'])), 'id', 'name'), array('empty'=>'Select Type'));

				if(isset($_REQUEST['id']))
				{

					if(!isset($_REQUEST['mon']))
					{
						$mon = date('F');
						$mon_num = date('n');
						$curr_year = date('Y');
					}
					else
					{
						$mon =getMonthname($_REQUEST['mon']);
						$mon_num = $_REQUEST['mon'];
						$curr_year = $_REQUEST['year'];
					}
					$num = cal_days_in_month(CAL_GREGORIAN, $mon_num, $curr_year); // 31
					?>
					<div  align="center"  style="top:30px;">
	<h3>
		<?php 
		echo CHtml::link('<span class="glyphicon glyphicon-arrow-left"></span>', array('attendance', 'mon'=>date("m",strtotime($curr_year."-".$mon_num."-01 -1 months")),'year'=>date("Y",strtotime($curr_year."-".$mon_num."-01 -1 months")),'id'=>$_REQUEST['id']),array('class'=>'btn  btn-primary')); 
	 	echo '&nbsp;&nbsp;'. $mon.'&nbsp;&nbsp;'.$curr_year.'&nbsp;&nbsp;';
	 	echo CHtml::link('<span class="glyphicon glyphicon-arrow-right"></span>', array('attendance', 'mon'=>date("m",strtotime($curr_year."-".$mon_num."-01 +1 months")),'year'=>date("Y",strtotime($curr_year."-".$mon_num."-01 +1 months")),'id'=>$_REQUEST['id']),array('class'=>'btn  btn-primary'));
	 ?>
	 </h3>
	 </div>

				 <div class="atnd_Con" style="overflow-x: scroll;">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
                        
							<?php
							for($i=1;$i<=$num;$i++)
							{
								echo '<th>'.getweek($i,$mon_num,$curr_year).'<span>'.$i.'</span></th>';
							}
							?>
						</tr>
						<?php $posts=Student::model()->findAll("student_id=:x", array(':x'=>$_REQUEST['id']));
						$j=0;

						foreach($posts as $posts_1)
						{
							if($j%2==0)
								$class = 'class="odd"';
							else
								$class = 'class="even"';

							?>
						<tr <?php echo $class; ?>>
							
							<?php
							for($i=1;$i<=$num;$i++)
							{
								echo '<td>';
								$find = Attendance::model()->find("date=:x AND student_id=:y", array(':x'=>$curr_year.'-'.$mon_num.'-'.$i,':y'=>$posts_1->student_id));
								if(count($find)==0)
								{
									echo '&nbsp; ';
								}
								else{
									if ($find->status==1)
										echo '<i class="fa fa-check p10 text-success "></i>';
									else
										echo '<i class="fa fa-remove p10 text-danger "></i>';
										
									}
								   

								echo '</td>';
							}
							?>
						</tr>
						<?php $j++; 
}?>
					</table>
					<?php } ?>
				</div>

			</div>


		</div>
	</div>
</div>

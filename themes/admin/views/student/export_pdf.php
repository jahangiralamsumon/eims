<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Voucher Print</title>

<style type="text/css">
/* Take care of image borders and formatting, client hacks */
img {
	max-width: 600px;
	outline: none;
	text-decoration: none;
	-ms-interpolation-mode: bicubic;
}

a img {
	border: none;
}

table {
	border-collapse: collapse !important;
}

#outlook a {
	padding: 0;
}

.ReadMsgBody {
	width: 100%;
}

.ExternalClass {
	width: 100%;
}

.backgroundTable {
	margin: 0 auto;
	padding: 0;
	width: 100% !important;
}

table td {
	border-collapse: collapse;
}

.ExternalClass * {
	line-height: 115%;
}

.container-for-gmail-android {
	min-width: 600px;
}

/* General styling */
* {
	font-family: Helvetica, Arial, sans-serif;
}

body {
	-webkit-font-smoothing: antialiased;
	-webkit-text-size-adjust: none;
	width: 100% !important;
	margin: 0 !important;
	height: 100%;
	color: #676767;
}

td {
	font-family: Helvetica, Arial, sans-serif;
	font-size: 14px;
	color: #777777;
	text-align: center;
	line-height: 21px;
}

a {
	color: #676767;
	text-decoration: none !important;
}

.pull-left {
	text-align: left;
}

.pull-right {
	text-align: right;
}

.header-lg,.header-md,.header-sm {
	font-size: 22px;
	font-weight: 700;
	line-height: normal;
	padding: 20px 0;
	color: #4d4d4d;
}

.header-md {
	font-size: 24px;
}

.header-sm {
	padding: 5px 0;
	font-size: 18px;
	line-height: 1.3;
}

.content-padding {
	padding: 20px 0 5px;
}

.mobile-header-padding-right {
	width: 290px;
	text-align: right;
	padding-left: 10px;
}

.mobile-header-padding-left {
	width: 290px;
	text-align: left;
	padding-left: 10px;
	padding-bottom: 8px;
}

.free-text {
	width: 100% !important;
	padding: 10px 60px 0px;
}

.button {
	padding: 30px 0;
}

.mini-block {
	border: 1px solid #e5e5e5;
	background-color: #ffffff;
	padding: 5px 5px 30px 5px;
	text-align: left;
	width: 253px;
}

.mini-container-left {
	width: 278px;
	padding: 10px 0 10px 15px;
}

.mini-container-right {
	width: 278px;
	padding: 10px 14px 10px 15px;
}

.product {
	text-align: left;
	vertical-align: top;
	width: 175px;
}

.total-space {
	padding-bottom: 8px;
	display: inline-block;
}

.item-table {
	padding: 40px 5px;
	width: 590px;
}

.item {
	width: 300px;
}

.mobile-hide-img {
	text-align: left;
	width: 125px;
}

.mobile-hide-img img {
	border: 1px solid #e6e6e6;
	border-radius: 4px;
}

.title-dark {
	text-align: left;
	border-bottom: 1px solid #cccccc;
	color: #4d4d4d;
	font-weight: 700;
	padding-bottom: 5px;
}

.item-col {
	padding-top: 20px;
	text-align: left;
	vertical-align: top;
	border-bottom: 1px solid #cccccc;
	padding-bottom: 5px;
	font-size: 12px;
}

.particular {
	font-size: 10px;
}

.force-width-gmail {
	min-width: 600px;
	height: 0px !important;
	line-height: 1px !important;
	font-size: 1px !important;
}
</style>

<style type="text/css" media="screen">
@import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
</style>

<style type="text/css" media="screen">
@media screen { /* Thanks Outlook 2013! http://goo.gl/XLxpyl */
	* {
		font-family: 'Oxygen', 'Helvetica Neue', 'Arial',
			'sans-serif' !important;
	}
}
</style>

<style type="text/css" media="only screen and (max-width: 480px)">
/* Mobile styles */
@media only screen and (max-width: 480px) {
	table[class*="container-for-gmail-android"] {
		min-width: 290px !important;
		width: 100% !important;
	}
	img[class="force-width-gmail"] {
		display: none !important;
		width: 0 !important;
		height: 0 !important;
	}
	table[class="w320"] {
		width: 320px !important;
	}
	td[class*="mobile-header-padding-left"] {
		width: 160px !important;
		padding-left: 0 !important;
	}
	td[class*="mobile-header-padding-right"] {
		width: 160px !important;
		padding-right: 0 !important;
	}
	td[class="header-lg"] {
		font-size: 24px !important;
		padding-bottom: 5px !important;
	}
	td[class="content-padding"] {
		padding: 5px 0 5px !important;
	}
	td[class="button"] {
		padding: 5px 5px 30px !important;
	}
	td[class*="free-text"] {
		padding: 10px 18px 30px !important;
	}
	td[class~="mobile-hide-img"] {
		display: none !important;
		height: 0 !important;
		width: 0 !important;
		line-height: 0 !important;
	}
	td[class~="item"] {
		width: 140px !important;
		vertical-align: top !important;
	}
	td[class~="quantity"] {
		width: 50px !important;
	}
	td[class~="price"] {
		width: 90px !important;
	}
	td[class="item-table"] {
		padding: 30px 20px !important;
	}
	td[class="mini-container-left"],td[class="mini-container-right"] {
		padding: 0 15px 15px !important;
		display: block !important;
		width: 290px !important;
	}
}
</style>
</head>

<body>
	<h2 style="text-align: center;">
		 Student List
	</h2>
	<table cellpadding="0" cellspacing="0" width="100%">
		<thead>

			<tr>

				<td class="title-dark" width="100">Student ID</td>
				<td class="title-dark" width="150">Name</td>
				<td class="title-dark" width="100">Class</td>
				<td class="title-dark" width="100">Group</td>
				<td class="title-dark" width="100">Class Roll</td>
				<td class="title-dark" width="300">Subject</td>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($array_data as $row):?>
			<tr>
				<td class="item-col"><?php echo $row["id"] ?></td>
				<td class="item-col particular"><?php echo $row['name']?></td>
				<td class="item-col price"><?php echo Classes::item($row["class_id"])?></td>
				<td class="item-col price"><?php echo $row['group']?></td>
				<td class="item-col price"><?php echo $row['roll_no']?></td>
				<?php 
				$command= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
				->select("ss.subject_id,ss.is_elective optional,sub.name subject_name,code")
				->from('students_subjects ss')
				->join('year_info', 'ss.year_id=year_info.year_code AND year_info.status=:status',array(':status'=>1))
				->join('subjects sub','sub.id=ss.subject_id')
				->where('ss.student_id =:student_id AND sub.class_id =:class_id', array(':student_id'=>$row["id"],':class_id'=>$row["class_id"]))
				->order('code,optional ASC');
				$student_sub=$command->queryAll();
				?>
				<td class="item-col particular">
		
				<?php  foreach ( $student_sub as  $row):?>

							<?php echo $row->optional=='1'?$row->code.'(Optional)|':$row->code.'|' ; ?>						
						
						<?php   endforeach;?>
						
				</td>
				
			</tr>
			<?php endforeach; ?>
	
	</table>

</body>
</html>

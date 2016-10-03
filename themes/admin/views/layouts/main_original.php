<!DOCTYPE html>
<html>

<head>
<!-- Meta, title, CSS, favicons, etc. -->

<meta charset="utf-8">
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Font CSS (Via CDN) -->
<link rel='stylesheet' type='text/css'
	href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700'>
<link rel="stylesheet" type="text/css"
	href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700">

<!-- Theme CSS -->
<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/skin/default_skin/css/theme.css">

<!-- Admin Panels CSS -->
<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/admin-tools/admin-plugins/admin-panels/adminpanels.css">

<!-- Admin Forms CSS -->
<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/admin-tools/admin-forms/css/admin-forms.css">

<!-- Favicon -->
<link rel="shortcut icon"
	href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/favicon.ico">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

</head>

<body class="dashboard-page sb-l-o sb-r-c">

	<!-- Start: Theme Preview Pane -->
	<div id="skin-toolbox">
		<div class="panel">
			<div class="panel-heading">
				<span class="panel-icon"><i class="fa fa-gear text-primary"></i> </span>
				<span class="panel-title"> Theme Options</span>
			</div>
			<div class="panel-body pn">

				<ul class="nav nav-list nav-list-sm pl15 pt10" role="tablist">
					<li class="active"><a href="#toolbox-header" role="tab"
						data-toggle="tab">Navbar</a>
					</li>
					<li><a href="#toolbox-sidebar" role="tab" data-toggle="tab">Sidebar</a>
					</li>
					<li><a href="#toolbox-settings" role="tab" data-toggle="tab">Misc</a>
					</li>
				</ul>

				<div class="tab-content p20 ptn pb15">
					<div role="tabpanel" class="tab-pane active" id="toolbox-header">
						<form id="toolbox-header-skin">
							<h4 class="mv20">Header Skins</h4>

							<!--                             <div class="checkbox-custom checkbox-disabled mb5">
                                <input type="checkbox" name="headerTwoTone" id="headerTwoTone" checked>
                                <label for="headerTwoTone">Two Tone Header</label>
                            </div>

                            <hr class="mv10 alt">
 -->
							<div class="skin-toolbox-swatches">
								<div class="checkbox-custom checkbox-disabled fill mb5">
									<input type="radio" name="headerSkin" id="headerSkin8" checked
										value="bg-light"> <label for="headerSkin8">Light</label>
								</div>
								<div class="checkbox-custom fill checkbox-primary mb5">
									<input type="radio" name="headerSkin" id="headerSkin1"
										value="bg-primary"> <label for="headerSkin1">Primary</label>
								</div>
								<div class="checkbox-custom fill checkbox-info mb5">
									<input type="radio" name="headerSkin" id="headerSkin3"
										value="bg-info"> <label for="headerSkin3">Info</label>
								</div>
								<div class="checkbox-custom fill checkbox-warning mb5">
									<input type="radio" name="headerSkin" id="headerSkin4"
										value="bg-warning"> <label for="headerSkin4">Warning</label>
								</div>
								<div class="checkbox-custom fill checkbox-danger mb5">
									<input type="radio" name="headerSkin" id="headerSkin5"
										value="bg-danger"> <label for="headerSkin5">Danger</label>
								</div>
								<div class="checkbox-custom fill checkbox-alert mb5">
									<input type="radio" name="headerSkin" id="headerSkin6"
										value="bg-alert"> <label for="headerSkin6">Alert</label>
								</div>
								<div class="checkbox-custom fill checkbox-system mb5">
									<input type="radio" name="headerSkin" id="headerSkin7"
										value="bg-system"> <label for="headerSkin7">System</label>
								</div>
								<div class="checkbox-custom fill checkbox-success mb5">
									<input type="radio" name="headerSkin" id="headerSkin2"
										value="bg-success"> <label for="headerSkin2">Success</label>
								</div>
								<div class="checkbox-custom fill mb5">
									<input type="radio" name="headerSkin" id="headerSkin9"
										value="bg-dark"> <label for="headerSkin9">Dark</label>
								</div>
							</div>
						</form>
					</div>
					<div role="tabpanel" class="tab-pane" id="toolbox-sidebar">
						<form id="toolbox-sidebar-skin">

							<h4 class="mv20">Sidebar Skins</h4>
							<div class="skin-toolbox-swatches">
								<div class="checkbox-custom fill mb5">
									<input type="radio" name="sidebarSkin" checked
										id="sidebarSkin3" value=""> <label for="sidebarSkin3">Dark</label>
								</div>
								<div class="checkbox-custom fill checkbox-disabled mb5">
									<input type="radio" name="sidebarSkin" id="sidebarSkin1"
										value="sidebar-light"> <label for="sidebarSkin1">Light</label>
								</div>
								<div class="checkbox-custom fill checkbox-light mb5">
									<input type="radio" name="sidebarSkin" id="sidebarSkin2"
										value="sidebar-light light"> <label for="sidebarSkin2">Lighter</label>
								</div>

							</div>

						</form>
					</div>
					<div role="tabpanel" class="tab-pane" id="toolbox-settings">
						<form id="toolbox-settings-misc">
							<h4 class="mv20 mtn">Layout Options</h4>
							<div class="form-group">
								<div class="checkbox-custom fill mb5">
									<input type="checkbox" checked="" id="header-option"> <label
										for="header-option">Fixed Header</label>
								</div>
							</div>
							<div class="form-group">
								<div class="checkbox-custom fill mb5">
									<input type="checkbox" id="sidebar-option"> <label
										for="sidebar-option">Fixed Sidebar</label>
								</div>
							</div>
							<div class="form-group">
								<div class="checkbox-custom fill mb5">
									<input type="checkbox" id="breadcrumb-option"> <label
										for="breadcrumb-option">Fixed Breadcrumbs</label>
								</div>
							</div>
							<div class="form-group">
								<div class="checkbox-custom fill mb5">
									<input type="checkbox" id="breadcrumb-hidden"> <label
										for="breadcrumb-hidden">Hide Breadcrumbs</label>
								</div>
							</div>
							<h4 class="mv20">Layout Options</h4>
							<div class="form-group">
								<div class="radio-custom mb5">
									<input type="radio" id="fullwidth-option" checked
										name="layout-option"> <label for="fullwidth-option">Fullwidth
										Layout</label>
								</div>
							</div>
							<div class="form-group mb20">
								<div class="radio-custom radio-disabled mb5">
									<input type="radio" id="boxed-option" name="layout-option"
										disabled> <label for="boxed-option">Boxed Layout <b
										class="text-muted">(Coming Soon)</b>
									</label>
								</div>
							</div>

						</form>
					</div>
				</div>
				<div class="form-group mn br-t p15">
					<a href="#" id="clearLocalStorage"
						class="btn btn-primary btn-block pb10 pt10">Clear LocalStorage</a>
				</div>

			</div>
		</div>
	</div>
	<!-- End: Theme Preview Pane -->

	<!-- Start: Main -->
	<div id="main">

		<!-- Start: Header -->
		<header class="navbar navbar-fixed-top bg-light">
			<div class="navbar-branding">
				<a class="navbar-brand" href=""> <b>OSMS</b>
				</a> <span id="toggle_sidemenu_l"
					class="glyphicons glyphicons-show_lines"></span>
				<ul class="nav navbar-nav pull-right hidden">
					<li><a href="#" class="sidebar-menu-toggle"> <span
							class="octicon octicon-ruby fs20 mr10 pull-right "></span>
					</a>
					</li>
				</ul>
			</div>
			<ul class="nav navbar-nav navbar-left">
				<li><a class="sidebar-menu-toggle" href="#"> <span
						class="octicon octicon-ruby fs18"></span>
				</a>
				</li>
				<li><a class="topbar-menu-toggle" href="#"> <span
						class="glyphicons glyphicons-magic fs16"></span>
				</a>
				</li>
				<li><span id="toggle_sidemenu_l2"
					class="glyphicon glyphicon-log-in fa-flip-horizontal hidden"></span>
				</li>
				<li class="dropdown hidden"><a class="dropdown-toggle"
					data-toggle="dropdown" href="#"> <span
						class="glyphicons glyphicons-settings fs14"></span>
				</a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="javascript:void(0);"> <span
								class="fa fa-times-circle-o pr5 text-primary"></span> Reset
								LocalStorage
						</a>
						</li>
						<li><a href="javascript:void(0);"> <span
								class="fa fa-slideshare pr5 text-info"></span> Force Global
								Logout
						</a>
						</li>
						<li class="divider mv5"></li>
						<li><a href="javascript:void(0);"> <span
								class="fa fa-tasks pr5 text-danger"></span> Run Cron Job
						</a>
						</li>
						<li><a href="javascript:void(0);"> <span
								class="fa fa-wrench pr5 text-warning"></span> Maintenance Mode
						</a>
						</li>
					</ul>
				</li>
				<li class="hidden-xs"><a class="request-fullscreen toggle-active"
					href="#"> <span class="octicon octicon-screen-full fs18"></span>
				</a>
				</li>
			</ul>
			<form class="navbar-form navbar-left navbar-search ml5" role="search">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Search..."
						value="Search...">
				</div>
			</form>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown dropdown-item-slide"><a
					class="dropdown-toggle pl10 pr10" data-toggle="dropdown" href="#">
						<span class="octicon octicon-radio-tower fs18"></span>
				</a>
					<ul
						class="dropdown-menu dropdown-hover dropdown-persist pn w350 bg-white animated animated-shorter fadeIn"
						role="menu">
						<li class="bg-light p8"><span class="fw600 pl5 lh30">
								Notifications</span> <span
							class="label label-warning label-sm pull-right lh20 h-20 mt5 mr5">12</span>
						</li>
						<li class="p10 br-t item-1">
							<div class="media">
								<a class="media-left" href="#"> <img
									src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/avatars/2.jpg"
									class="mw40" alt="holder-img">
								</a>
								<div class="media-body va-m">
									<h5 class="media-heading mv5">
										Article <small class="text-muted">- 08/16/22</small>
									</h5>
									Last Updated 36 days ago by <a class="text-system" href="#">
										Max </a>
								</div>
							</div>
						</li>
						<li class="p10 br-t item-2">
							<div class="media">
								<a class="media-left" href="#"> <img
									src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/avatars/3.jpg"
									class="mw40" alt="holder-img">
								</a>
								<div class="media-body va-m">
									<h5 class="media-heading mv5">
										Article <small class="text-muted">- 08/16/22</small>
									</h5>
									Last Updated 36 days ago by <a class="text-system" href="#">
										Max </a>
								</div>
							</div>
						</li>
						<li class="p10 br-t item-3">
							<div class="media">
								<a class="media-left" href="#"> <img
									src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/avatars/4.jpg"
									class="mw40" alt="holder-img">
								</a>
								<div class="media-body va-m">
									<h5 class="media-heading mv5">
										Article <small class="text-muted">- 08/16/22</small>
									</h5>
									Last Updated 36 days ago by <a class="text-system" href="#">
										Max </a>
								</div>
							</div>
						</li>
						<li class="p10 br-t item-4">
							<div class="media">
								<a class="media-left" href="#"> <img
									src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/avatars/5.jpg"
									class="mw40" alt="holder-img">
								</a>
								<div class="media-body va-m">
									<h5 class="media-heading mv5">
										Article <small class="text-muted">- 08/16/22</small>
									</h5>
									Last Updated 36 days ago by <a class="text-system" href="#">
										Max </a>
								</div>
							</div>
						</li>
					</ul>
				</li>
			
				<li class="ph10 pv20 hidden-xs"><i class="fa fa-circle text-tp fs8"></i>
				</li>
				<li class="dropdown"><a href="#" class="dropdown-toggle fw600 p15"
					data-toggle="dropdown"> <img
						src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/avatars/1.jpg"
						alt="avatar" class="mw30 br64 mr15"> <span><?php echo User::get_user_shortname(Yii::app()->user->id) ?></span> <span
						class="caret caret-tp hidden-xs"></span>
				</a>
					<ul class="dropdown-menu dropdown-persist pn w250 bg-white"
						role="menu">
					
						<li class="br-t of-h"><a href="#"
							class="fw600 p12 animated animated-short fadeInDown"> <span
								class="fa fa-gear pr5"></span> Profile and Settings
						</a>
						</li>
						<li class="br-t of-h">
						<?php echo CHtml::link('<span class="fa fa-power-off pr5"></span> Logout',array('/site/logout'),array('class'=>'fw600 p12 animated animated-short fadeInDown')); ?>
						</li>
					</ul>
				</li>
			</ul>

		</header>
		<!-- End: Header -->

		<!-- Start: Sidebar -->
		<aside id="sidebar_left" class="nano nano-primary">
			<div class="nano-content">

				<!-- Start: Sidebar Header -->
				<header class="sidebar-header">
					<div class="user-menu">
						<div class="row text-center mbn">
							<div class="col-xs-4">
								<a href="dashboard.html" class="text-primary"
									data-toggle="tooltip" data-placement="top" title="Dashboard"> <span
									class="glyphicons glyphicons-home"></span>
								</a>
							</div>
							<div class="col-xs-4">
								<a href="pages_messages.html" class="text-info"
									data-toggle="tooltip" data-placement="top" title="Messages"> <span
									class="glyphicons glyphicons-inbox"></span>
								</a>
							</div>
							<div class="col-xs-4">
								<a href="pages_profile.html" class="text-alert"
									data-toggle="tooltip" data-placement="top" title="Tasks"> <span
									class="glyphicons glyphicons-bell"></span>
								</a>
							</div>
							<div class="col-xs-4">
								<a href="pages_timeline.html" class="text-system"
									data-toggle="tooltip" data-placement="top" title="Activity"> <span
									class="glyphicons glyphicons-imac"></span>
								</a>
							</div>
							<div class="col-xs-4">
								<a href="pages_profile.html" class="text-danger"
									data-toggle="tooltip" data-placement="top" title="Settings"> <span
									class="glyphicons glyphicons-settings"></span>
								</a>
							</div>
							<div class="col-xs-4">
								<a href="pages_gallery.html" class="text-warning"
									data-toggle="tooltip" data-placement="top" title="Cron Jobs"> <span
									class="glyphicons glyphicons-restart"></span>
								</a>
							</div>
						</div>
					</div>
				</header>
				<!-- End: Sidebar Header -->

				<!-- sidebar menu -->
				<ul class="nav sidebar-menu">
					<li class="sidebar-label pt20">Menu</li>

					<li class="active"><?php echo CHtml::link('<span class="glyphicons glyphicons-home"></span>
                            <span class="sidebar-title">Dashboard</span>',array('/site/index'),array()); ?>
					</li>


					<li><a class="accordion-toggle" href="#"> <span
							class="glyphicons glyphicons-user"></span> <span
							class="sidebar-title">Student</span> <span class="caret"></span>
					</a>
						<ul class="nav sub-nav">
							<li><?php echo CHtml::link('<span class="glyphicons glyphicons-user_add"></span>Admission New Student',array('/student/create'),array()); ?>
							</li>

							<li><?php echo CHtml::link('<span class="glyphicons glyphicons-show_big_thumbnails"></span>Student List',array('/student/studentlist'),array()); ?>
							</li>
                            <li><?php echo CHtml::link('<span class="glyphicons glyphicons-book"></span>Course Registration',array('/student/subjectreg'),array()); ?>
							</li>
							<li><?php echo CHtml::link('<span class="glyphicons glyphicons-share"></span>Student Promotion',array('/student/promotion'),array()); ?>
							</li>
						</ul>
					</li>

					<li><a class="accordion-toggle" href="#"> <span
							class="glyphicons glyphicons-usd"></span> <span
							class="sidebar-title">Fees</span> <span class="caret"></span>
					</a>
						<ul class="nav sub-nav">
							<li><?php echo CHtml::link('<span class="glyphicons glyphicons-circle_plus"></span>Add Fees Category',array('/feecategories/create'),array()); ?>
							</li>

							<li><?php echo CHtml::link('<span class="glyphicons glyphicons-show_big_thumbnails"></span>Manage Fees Category',array('/feecategories/admin'),array()); ?>
							</li>
					        <li><?php echo CHtml::link('<span class="glyphicons glyphicons-circle_plus"></span>Add Fees Particular',array('/feeParticulars/create'),array()); ?>
							</li>

							<li><?php echo CHtml::link('<span class="glyphicons glyphicons-show_big_thumbnails"></span>Manage Fees Particular',array('/feeParticulars/admin'),array()); ?>
							</li>
                            <li><?php echo CHtml::link('<span class="glyphicons glyphicons-check"></span>Fees Allocation',array('/fees/PreFeeAllocation'),array()); ?>
							</li>
							<li><?php echo CHtml::link('<span class="glyphicons glyphicons-share"></span>Generate Monthly Fees',array('/fees/generate'),array()); ?>
							</li>
							<li><?php echo CHtml::link('<span class="glyphicons glyphicons-list"></span>View Monthly Fees',array('/fees/feesview'),array()); ?>
							</li>
							<li><?php echo CHtml::link('<span class="glyphicons glyphicons-share"></span>Fees Collection',array('/fees/feescollection'),array()); ?>
							</li>
							<li><a class="accordion-toggle" href="#"> <span
									class="glyphicons glyphicons-justify"></span> Report <span
									class="caret"></span>
							</a>
								<ul class="nav sub-nav">
									<li><?php echo CHtml::link('<span class="glyphicons glyphicons-justify"></span>Fees Dues List',array('/fees/due-list'),array()); ?>
									</li>
								</ul>
							</li>


						</ul>
					</li>
					<li><a class="accordion-toggle" href="#"> <span
							class="glyphicons glyphicons-calculator"></span> <span
							class="sidebar-title">Result Processing</span> <span
							class="caret"></span>
					</a>
						<ul class="nav sub-nav">
							<li><?php echo CHtml::link('<span class="glyphicons glyphicons-notes_2"></span>Manage Marksheet',array('/marks/manage'),array()); ?>
							</li>

							<li><?php echo CHtml::link('<span class="glyphicons glyphicons-show_big_thumbnails"></span>View Marksheet',array('/marks/resultview'),array()); ?>
							</li>

						</ul>
					</li>
					
                   

					<li class="sidebar-label pt20">Basic Setup</li>
					<li><a class="accordion-toggle" href="#"> <span
							class="glyphicon glyphicon-align-justify"></span> <span
							class="sidebar-title">Class</span> <span class="caret"></span>
					</a>
						<ul class="nav sub-nav">
							<li><?php echo CHtml::link('<span class="glyphicons glyphicons-circle_plus"></span>Add Class',array('/classes/create'),array()); ?>
							</li>

							<li><?php echo CHtml::link('<span class="glyphicons glyphicons-show_big_thumbnails"></span>Manage Class',array('/classes/admin'),array()); ?>
							</li>

							<li><a class="accordion-toggle" href="#"> <span
									class="glyphicons glyphicons-justify"></span> Section <span
									class="caret"></span>
							</a>
								<ul class="nav sub-nav">
									<li><?php echo CHtml::link('<span class="glyphicons glyphicons-circle_plus"></span>Add Section',array('/section/create'),array()); ?>
									</li>
									<li><?php echo CHtml::link('<span class="glyphicons glyphicons-justify"></span>Manage Section',array('/section/admin'),array()); ?>
									</li>
								</ul>
							</li>


						</ul>
					</li>
					<li><a class="accordion-toggle" href="#"> <span
							class="glyphicons glyphicons-book"></span> <span
							class="sidebar-title">Subject</span> <span class="caret"></span>
					</a>
						<ul class="nav sub-nav">
							<li><?php echo CHtml::link('<span class="glyphicons glyphicons-circle_plus"></span>Add Subject',array('/subjects/create'),array()); ?>
							</li>

							<li><?php echo CHtml::link('<span class="glyphicons glyphicons-show_big_thumbnails"></span>Manage Subject',array('/subjects/admin'),array()); ?>
							</li>
						</ul>
					</li>
					<li><a class="accordion-toggle" href="#"> <span
							class="glyphicons glyphicons-gift"></span> <span
							class="sidebar-title">Examination</span> <span class="caret"></span>
					</a>
						<ul class="nav sub-nav">
							<li><?php echo CHtml::link('<span class="glyphicons glyphicons-circle_plus"></span>Set Grading Levels',array('/grade/create'),array()); ?>
							</li>

							<li><?php echo CHtml::link('<span class="glyphicons glyphicons-show_big_thumbnails"></span>Manage Grade Levels',array('/grade/admin'),array()); ?>
							</li>
							<li><?php echo CHtml::link('<span class="glyphicons glyphicons-circle_plus"></span>Add Exam',array('/exam/create'),array()); ?>
							</li>

							<li><?php echo CHtml::link('<span class="glyphicons glyphicons-show_big_thumbnails"></span>Manage Exam',array('/exam/admin'),array()); ?>
							</li>

						</ul>
					</li>
                    <li><a class="accordion-toggle" href="#"> <span
							class="glyphicons glyphicons-usd"></span> <span
							class="sidebar-title">Fees Setup</span> <span class="caret"></span>
					</a>
						<ul class="nav sub-nav">
							<li><?php echo CHtml::link('<span class="glyphicons glyphicons-circle_plus"></span>Add Fees Category',array('/feecategories/create'),array()); ?>
							</li>

							<li><?php echo CHtml::link('<span class="glyphicons glyphicons-show_big_thumbnails"></span>Manage Fees Category',array('/feecategories/admin'),array()); ?>
							</li>
					        <li><?php echo CHtml::link('<span class="glyphicons glyphicons-circle_plus"></span>Add Fees Particular',array('/feeParticulars/create'),array()); ?>
							</li>

							<li><?php echo CHtml::link('<span class="glyphicons glyphicons-show_big_thumbnails"></span>Manage Fees Particular',array('/feeParticulars/admin'),array()); ?>
							</li>
                     </ul>
					</li>
					
					<!-- sidebar resources -->
					<li class="sidebar-label pt20">Administration</li>
					<li><a class="accordion-toggle" href="#"> <span
							class="glyphicon glyphicon-align-justify"></span> <span
							class="sidebar-title">Accounts</span> <span class="caret"></span>
					</a>
						<ul class="nav sub-nav">

							<li><?php echo CHtml::link('<span class="glyphicons glyphicons-circle_plus"></span>Voucher Entry',array('/accounts/voucherentry'),array()); ?>
							</li>
							<li><?php echo CHtml::link('<span class="glyphicons glyphicons-justify"></span>Voucher Edit Delete',array('/accounts/vouchermanage'),array()); ?>
							</li>
							<li><?php echo CHtml::link('<span class="glyphicons glyphicons-print"></span>Voucher Print',array('/accounts/voucher_print'),array()); ?>
							</li>
							<li><?php echo CHtml::link('<span class="glyphicons glyphicons-adress_book"></span>Student Ledger',array('/accounts/studentledger'),array()); ?>
							</li>
							<li><a class="accordion-toggle" href="#"> <span
									class="glyphicons glyphicons-justify"></span> Report <span
									class="caret"></span>
							</a>
								<ul class="nav sub-nav">
									<li><?php echo CHtml::link('<span class="glyphicons glyphicons-circle_plus"></span>Daily Vouchers',array('/accounts/voucher_entry'),array()); ?>
									</li>
									<li><?php echo CHtml::link('<span class="glyphicons glyphicons-justify"></span>Cash Book',array('/accounts/vouchermanage'),array()); ?>
									</li>
									<li><?php echo CHtml::link('<span class="glyphicons glyphicons-print"></span>Bank Book',array('/accounts/voucher_print'),array()); ?>
									</li>
									<li><?php echo CHtml::link('<span class="glyphicons glyphicons-circle_plus"></span>Ledger',array('/accounts/voucher_entry'),array()); ?>
									</li>
									<li><?php echo CHtml::link('<span class="glyphicons glyphicons-justify"></span>Trial Balance',array('/accounts/voucher_manage'),array()); ?>
									</li>
									<li><?php echo CHtml::link('<span class="glyphicons glyphicons-print"></span>Income Statement',array('/accounts/voucher_print'),array()); ?>
									</li>
									<li><?php echo CHtml::link('<span class="glyphicons glyphicons-print"></span>Balance Sheet',array('/accounts/voucher_print'),array()); ?>
									</li>

								</ul>
							</li>


						</ul>
					</li>

					<li><a class="accordion-toggle" href="#"> <span
							class="glyphicon glyphicons-group"></span> <span
							class="sidebar-title">Human Resource</span> <span class="caret"></span>
					</a>
						<ul class="nav sub-nav">

							<li><a class="accordion-toggle" href="#"> <span
									class="glyphicons glyphicons-justify"></span> Employee
									Management <span class="caret"></span>
							</a>
								<ul class="nav sub-nav">
									<li><?php echo CHtml::link('<span class="glyphicons glyphicons-circle_plus"></span>Add Department',array('/accounts/voucher_entry'),array()); ?>
									</li>
									<li><?php echo CHtml::link('<span class="glyphicons glyphicons-justify"></span>Add Position',array('/accounts/voucher_manage'),array()); ?>
									</li>
									<li><?php echo CHtml::link('<span class="glyphicons glyphicons-print"></span>Add Employee',array('/accounts/voucher_print'),array()); ?>
									</li>
									<li><?php echo CHtml::link('<span class="glyphicons glyphicons-circle_plus"></span>Employee List',array('/accounts/voucher_entry'),array()); ?>
									</li>


								</ul>
							</li>

							<li><a class="accordion-toggle" href="#"> <span
									class="glyphicons glyphicons-euro"></span>Payroll <span
									class="caret"></span>
							</a>
								<ul class="nav sub-nav">
									<li><?php echo CHtml::link('<span class="glyphicons glyphicons-circle_plus"></span>Manage Salary Details',array('/accounts/voucher_entry'),array()); ?>
									</li>
									<li><?php echo CHtml::link('<span class="glyphicons glyphicons-justify"></span>Employee Salary List',array('/accounts/voucher_manage'),array()); ?>
									</li>
									<li><?php echo CHtml::link('<span class="glyphicons glyphicons-shopping_cart"></span>Make Payment',array('/accounts/voucher_print'),array()); ?>
									</li>
									<li><?php echo CHtml::link('<span class="glyphicons glyphicons-sampler"></span>Generate  Payslip',array('/accounts/voucher_entry'),array()); ?>
									</li>


								</ul>
							</li>


						</ul>
					</li>

					<li><a class="accordion-toggle" href="#"> <span
							class="glyphicons glyphicons-building"></span> <span
							class="sidebar-title">Hostel</span> <span class="caret"></span>
					</a>
						<ul class="nav sub-nav">
							<li><?php echo CHtml::link('<span class="glyphicons glyphicons-circle_plus"></span>Add Hostel Details',array('/hostel/add'),array()); ?>
							</li>

							<li><?php echo CHtml::link('<span class="glyphicons glyphicons-adress_book"></span>Add Room',array('/hostel/add_room'),array()); ?>
							</li>

							<li><?php echo CHtml::link('<span class="glyphicons glyphicons-share"></span>Allot Room',array('/hostel/allot_room'),array()); ?>
							</li>
							<li><?php echo CHtml::link('<span class="glyphicons glyphicons-share"></span>Change Room',array('/hostel/change_room'),array()); ?>
							</li>
							<li><?php echo CHtml::link('<span class="glyphicons glyphicons-share"></span>Vacate Room',array('/hostel/vacate_room'),array()); ?>
							</li>


						</ul>
					</li>

					<li><a class="accordion-toggle" href="#"> <span
							class="glyphicons glyphicons-log_book"></span> <span
							class="sidebar-title">Library</span> <span class="caret"></span>
					</a>
						<ul class="nav sub-nav">
							<li><?php echo CHtml::link('<span class="glyphicons glyphicons-circle_plus"></span>Add Book Category',array('/library/add_bookcat'),array()); ?>
							</li>

							<li><?php echo CHtml::link('<span class="glyphicons glyphicons-book"></span>Add Book',array('/library/add_book'),array()); ?>
							</li>

							<li><?php echo CHtml::link('<span class="glyphicons glyphicons-cargo"></span>Book List',array('/library/book_list'),array()); ?>
							</li>
							<li><?php echo CHtml::link('<span class="glyphicons glyphicons-share"></span>Issue Book',array('/library/issue_book'),array()); ?>
							</li>
							<li><?php echo CHtml::link('<span class="glyphicons glyphicons-share"></span>Return Book',array('/library/return_book'),array()); ?>
							</li>

						</ul>
					</li>
					<li><a class="accordion-toggle" href="#"> <span
							class="glyphicons glyphicons-calendar"></span> <span
							class="sidebar-title">Attendance</span> <span class="caret"></span>
					</a>
						<ul class="nav sub-nav">
							<li><?php echo CHtml::link('<span class="glyphicons glyphicons-parents "></span> Student Attendance',array('/library/add_bookcat'),array()); ?>
							</li>

							<li><?php echo CHtml::link('<span class="glyphicons glyphicons-parents"></span>Employee Attendance',array('/library/add_book'),array()); ?>
							</li>



						</ul>
					</li>

					<li><a class="accordion-toggle" href="#"> <span
							class="glyphicons glyphicons-message_full"></span> <span
							class="sidebar-title">SMS Notification</span> <span class="caret"></span>
					</a>
						<ul class="nav sub-nav">
							<li><?php echo CHtml::link('<span class="glyphicons glyphicons-group"></span>Create Group',array('/library/add_bookcat'),array()); ?>
							</li>

							<li><?php echo CHtml::link('<span class="glyphicons glyphicons-parents"></span>Templete',array('/library/add_book'),array()); ?>
							</li>
							<li><?php echo CHtml::link('<span class="glyphicons glyphicons-message_new"></span>Send SMS',array('/library/add_book'),array()); ?>
							</li>
						</ul>
					</li>


					<!-- sidebar bullets -->
					<li class="sidebar-label pt20">Setting</li>
					<li><?php echo CHtml::link('<span class="glyphicons glyphicons-building"></span>
                            <span class="sidebar-title">School Setup</span>',array('/site/index'),array()); ?>
					</li>
					<li><?php echo CHtml::link('<span class="glyphicons glyphicons-calendar"></span>Academic Year',array('/library/add_bookcat'),array()); ?>
					</li>
					
					<li><a class="accordion-toggle" href="#"> <span
							class="glyphicons glyphicons-user"></span> <span
							class="sidebar-title">Web Content</span> <span class="caret"></span>
					</a>
						<ul class="nav sub-nav">
							<li><?php echo CHtml::link('<span class="glyphicons glyphicons-user_add"></span>Create User',array('/student/add'),array()); ?>
							</li>

							<li><?php echo CHtml::link('<span class="glyphicons glyphicons-show_big_thumbnails"></span>Manage User',array('/student/add'),array()); ?>
							</li>

							<li><?php echo CHtml::link('<span class="glyphicons glyphicons-share"></span>Role Assignment',array('/student/add'),array()); ?>
							</li>
						</ul>
					</li>
					
				
					<li><a class="accordion-toggle" href="#"> <span
							class="glyphicons glyphicons-user"></span> <span
							class="sidebar-title">User User Role</span> <span class="caret"></span>
					</a>
						<ul class="nav sub-nav">
							<li><?php echo CHtml::link('<span class="glyphicons glyphicons-user_add"></span>Create User',array('/student/add'),array()); ?>
							</li>

							<li><?php echo CHtml::link('<span class="glyphicons glyphicons-show_big_thumbnails"></span>Manage User',array('/student/add'),array()); ?>
							</li>

							<li><?php echo CHtml::link('<span class="glyphicons glyphicons-share"></span>Role Assignment',array('/student/add'),array()); ?>
							</li>
						</ul>
					</li>
				
		
				</ul>
				<div class="sidebar-toggle-mini">
					<a href="#"> <span class="fa fa-sign-out"></span>
					</a>
				</div>
			</div>
		</aside>

		<!-- Start: Content-Wrapper -->
		<section id="content_wrapper">

			<!-- Start: Topbar-Dropdown -->
			<div id="topbar-dropmenu">
				<div class="topbar-menu row">
					<div class="col-xs-4 col-sm-2">
						<a href="#" class="metro-tile bg-success"> <span
							class="metro-icon glyphicons glyphicons-inbox"></span>
							<p class="metro-title">Messages</p>
						</a>
					</div>
					<div class="col-xs-4 col-sm-2">
						<a href="#" class="metro-tile bg-info"> <span
							class="metro-icon glyphicons glyphicons-parents"></span>
							<p class="metro-title">Users</p>
						</a>
					</div>
					<div class="col-xs-4 col-sm-2">
						<a href="#" class="metro-tile bg-alert"> <span
							class="metro-icon glyphicons glyphicons-headset"></span>
							<p class="metro-title">Support</p>
						</a>
					</div>
					<div class="col-xs-4 col-sm-2">
						<a href="#" class="metro-tile bg-primary"> <span
							class="metro-icon glyphicons glyphicons-cogwheels"></span>
							<p class="metro-title">Settings</p>
						</a>
					</div>
					<div class="col-xs-4 col-sm-2">
						<a href="#" class="metro-tile bg-warning"> <span
							class="metro-icon glyphicons glyphicons-facetime_video"></span>
							<p class="metro-title">Videos</p>
						</a>
					</div>
					<div class="col-xs-4 col-sm-2">
						<a href="#" class="metro-tile bg-system"> <span
							class="metro-icon glyphicons glyphicons-picture"></span>
							<p class="metro-title">Pictures</p>
						</a>
					</div>
				</div>
			</div>
			<!-- End: Topbar-Dropdown -->

			<!-- Start: Topbar -->
			<header id="topbar">
				<div class="topbar-left">
					<?php if(isset($this->breadcrumbs)):?>
					<?php 
					$this->widget(
							'booster.widgets.TbBreadcrumbs',
							array(
									'links' =>$this->breadcrumbs,
							)
					);
					?>
				<?php endif?>	
				</div>

			</header>
			<!-- End: Topbar -->
			<!-- Begin: Content -->
			<section id="content" >
			<?php echo $content; ?>
			</section>
			<!-- End: Content -->
		</section>
		<!-- End: Content-Wrapper -->

		<!-- Start: Right Sidebar -->
	
		<!-- End: Right Sidebar -->

	</div>
	<!-- End: Main -->

	<!-- BEGIN: PAGE SCRIPTS -->

	<!-- jQuery --> 
	
	<!--  
	<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/vendor/jquery/jquery-1.11.1.min.js"></script>
	-->
	<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>		
	<script type="text/javascript"
		src="<?php echo Yii::app()->theme->baseUrl; ?>/vendor/jquery/jquery_ui/jquery-ui.min.js"></script>

	<!-- Bootstrap -->
	<script type="text/javascript"
		src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/bootstrap/bootstrap.min.js"></script>

	<!-- Sparklines CDN -->
	<script type="text/javascript"
		src="http://cdnjs.cloudflare.com/ajax/libs/jquery-sparklines/2.1.2/jquery.sparkline.min.js"></script>

	<!-- Chart Plugins -->
	<script type="text/javascript"
		src="<?php echo Yii::app()->theme->baseUrl; ?>/vendor/plugins/highcharts/highcharts.js"></script>
	<script type="text/javascript"
		src="<?php echo Yii::app()->theme->baseUrl; ?>/vendor/plugins/circles/circles.js"></script>
	<script type="text/javascript"
		src="<?php echo Yii::app()->theme->baseUrl; ?>/vendor/plugins/raphael/raphael.js"></script>

	<!-- Holder js  -->
	<script type="text/javascript"
		src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/bootstrap/holder.min.js"></script>

	<!-- Theme Javascript -->
	<script type="text/javascript"
		src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/utility/utility.js"></script>
	<script type="text/javascript"
		src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/main.js"></script>
	<script type="text/javascript"
		src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/demo.js"></script>

	<!-- Admin Panels  -->
	<script type="text/javascript"
		src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/admin-tools/admin-plugins/admin-panels/json2.js"></script>
	<script type="text/javascript"
		src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/admin-tools/admin-plugins/admin-panels/jquery.ui.touch-punch.min.js"></script>
	<script type="text/javascript"
		src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/admin-tools/admin-plugins/admin-panels/adminpanels.js"></script>

	<!-- Page Javascript -->
	<script type="text/javascript"
		src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/pages/widgets.js"></script>
	<script type="text/javascript">
        jQuery(document).ready(function() {

            "use strict";

            // Init Theme Core      
            Core.init({
                sbm: "sb-l-c",
            });

            // Init Demo JS
            Demo.init();

            // Init Widget Demo JS
            // demoHighCharts.init();

            // Because we are using Admin Panels we use the OnFinish 
            // callback to activate the demoWidgets. It's smoother if
            // we let the panels be moved and organized before 
            // filling them with content from various plugins

            // Init plugins used on this page
            // HighCharts, JvectorMap, Admin Panels

            // Init Admin Panels on widgets inside the ".admin-panels" container
            $('.admin-panels').adminpanel({
                grid: '.admin-grid',
                draggable: true,
                preserveGrid: true,
                mobile: false,
                callback: function() {
                    bootbox.confirm('<h3>A Custom Callback!</h3>', function() {});
                },
                onFinish: function() {
                    $('.admin-panels').addClass('animated fadeIn').removeClass('fade-onload');

                    // Init the rest of the plugins now that the panels
                    // have had a chance to be moved and organized.
                    // It's less taxing to organize empty panels
                    demoHighCharts.init();
                    runVectorMaps();

                    // We also refresh any "in-view" waypoints to ensure
                    // the correct position is being calculated after the 
                    // Admin Panels plugin moved everything
                    Waypoint.refreshAll();

                },
                onSave: function() {
                    $(window).trigger('resize');
                }
            });

            // Widget VectorMap
            function runVectorMaps() {

                // Jvector Map Plugin
                var runJvectorMap = function() {
                    // Data set
                    var mapData = [900, 700, 350, 500];
                    // Init Jvector Map
                    $('#WidgetMap').vectorMap({
                        map: 'us_lcc_en',
                        //regionsSelectable: true,
                        backgroundColor: 'transparent',
                        series: {
                            markers: [{
                                attribute: 'r',
                                scale: [3, 7],
                                values: mapData
                            }]
                        },
                        regionStyle: {
                            initial: {
                                fill: '#E5E5E5'
                            },
                            hover: {
                                "fill-opacity": 0.3
                            }
                        },
                        markers: [{
                            latLng: [37.78, -122.41],
                            name: 'San Francisco,CA'
                        }, {
                            latLng: [36.73, -103.98],
                            name: 'Texas,TX'
                        }, {
                            latLng: [38.62, -90.19],
                            name: 'St. Louis,MO'
                        }, {
                            latLng: [40.67, -73.94],
                            name: 'New York City,NY'
                        }],
                        markerStyle: {
                            initial: {
                                fill: '#a288d5',
                                stroke: '#b49ae0',
                                "fill-opacity": 1,
                                "stroke-width": 10,
                                "stroke-opacity": 0.3,
                                r: 3
                            },
                            hover: {
                                stroke: 'black',
                                "stroke-width": 2
                            },
                            selected: {
                                fill: 'blue'
                            },
                            selectedHover: {}
                        },
                    });
                    // Manual code to alter the Vector map plugin to 
                    // allow for individual coloring of countries
                    var states = ['US-CA', 'US-TX', 'US-MO',
                        'US-NY'
                    ];
                    var colors = [bgWarningLr, bgPrimaryLr, bgInfoLr, bgAlertLr];
                    var colors2 = [bgWarning, bgPrimary, bgInfo, bgAlert];
                    $.each(states, function(i, e) {
                        $("#WidgetMap path[data-code=" + e + "]").css({
                            fill: colors[i]
                        });
                    });
                    $('#WidgetMap').find('.jvectormap-marker')
                        .each(function(i, e) {
                            $(e).css({
                                fill: colors2[i],
                                stroke: colors2[i]
                            });
                        });
                }

                if ($('#WidgetMap').length) {
                    runJvectorMap();
                }
            }

        });
    </script>
   
	<!-- END: PAGE SCRIPTS -->

</body>

</html>

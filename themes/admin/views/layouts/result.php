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

<body class="dashboard-page sb-l-o sb-r-o">


	<!-- Start: Main -->
	<div id="main">

		<!-- Start: Content-Wrapper -->
		<section id="content_wrapper">
			<div class="admin-form theme-info" id="login1">
				<div class="panel panel-info mt10 br-n">

					<div class="panel-heading heading-border bg-white">
						<div class="section row mn">
							<div class="col-sm-4">
								<img src="<?php echo InstitutionConfigurations::ins_logo() ?>"
									class="img-responsive w80 h60 center-block ">
							</div>
							<div class="col-sm-8">
								<h2 class="lh40 mt25">
									<?php echo InstitutionConfigurations::model()->findByAttributes(array('id'=>1))->config_value; ?>
								</h2>
							</div>

						</div>
					</div>
				</div>
			</div>

			<?php echo $content ?>
   
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

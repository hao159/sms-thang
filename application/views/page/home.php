<style>
	.widget-icon-sm {
		line-height: 40px !important;
		font-size: 16px !important;
		width: 40px !important;
		height: 40px !important;
	}
</style>
<!-- Page content -->
<div id="page-content">
	<!-- Dashboard Header -->
	<!-- For an image header add the class 'content-header-media' and an image as in the following example -->
	<div class="content-header content-header-media">
		<div class="header-section">
			<div class="row">
				<!-- Main Title (hidden on small devices for the statistics to fit) -->
				<div class="col-md-3 col-lg-5 hidden-xs hidden-sm">
					<h1>Welcome <strong><?= $this->session->userdata('User'); ?></strong><br><small>You Look
							Awesome!</small></h1>
				</div>
				<!-- END Main Title -->

				<!-- Top Stats -->
				<div class="col-md-9 col-lg-7" title="Số lượng giải còn lại">
					<div class="row text-center">


					</div>
				</div>
				<!-- END Top Stats -->
			</div>
		</div>
		<!-- For best results use an image with a resolution of 2560x248 pixels (You can also use a blurred image with ratio 10:1 - eg: 1000x100 pixels - it will adjust and look great!) -->
		<img src="<?= base_url() ?>public/img/placeholders/headers/dashboard_header.jpg" alt="header image"
			 class="animation-pulseSlow">
	</div>
	<!-- END Dashboard Header -->
	<!-- Widgets Row -->


	<!-- END Widgets Row -->
	<!-- Mini Top Stats Row -->
	<div class="row">

	</div>
	<!-- Widgets Row -->
	<div class="row">
		<div class="col-md-12">
			<!-- Timeline Widget -->
			<div class="widget">
				<div class="widget-extra-full">
					<div class="widget-extra themed-background-dark">

						<h3 class="widget-content-light">
							Statics OTP by month <strong></strong>
						</h3>
					</div>
					<div class="widget-extra-full">

						<div id="clone-ig-chart"></div>
					</div>
				</div>
			</div>
			<!-- END Timeline Widget -->
		</div>

	</div>
	<!-- END Widgets Row -->

</div>
<script src="<?= base_url('public/js/vendor/highcharts.js') ?>"></script>
<script type="text/javascript">
	initsubmittedChart()

	function initsubmittedChart() {
		Highcharts.chart('clone-ig-chart', {

			title: {
				text: 'Statistics OTP of the teams in the last <?= json_encode($data_chart["months"]) ?> months'
			},

			yAxis: {
				title: {
					text: 'Count'
				}
			},

			xAxis: {
				accessibility: {
					rangeDescription: 'Last <?= json_encode($data_chart["months"]) ?> months ago'
				},
				categories: <?= json_encode($data_chart['labels']) ?>
			},

			legend: {
				layout: 'vertical',
				align: 'right',
				verticalAlign: 'middle'
			},

			plotOptions: {
				series: {
					label: {
						connectorAllowed: true
					},
					//pointStart: 2010
				}
			},

			series: [
				<?php
				if($role == 1){
					foreach ($mems as $mem){
						echo json_encode([
							'name'=> 'Count of '.$mem,
							'data'=> $data_chart['counts_'.$mem]
						]).',';
					}
					echo json_encode([
						'name'=> 'Total',
						'data'=> $data_chart['counts']
					]).',';
				}else{
					echo json_encode([
						'name'=> 'Count',
						'data'=> $data_chart['counts']
					]).',';
				}

				?>
			],

			responsive: {
				rules: [{
					condition: {
						maxWidth: 500
					},
					chartOptions: {
						legend: {
							layout: 'horizontal',
							align: 'center',
							verticalAlign: 'bottom'
						}
					}
				}]
			}

		});

	}
</script>

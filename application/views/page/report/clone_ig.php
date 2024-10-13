<!-- Page content -->
<div id="page-content">
	<div class="content-header">
		<div class="header-section">
			<h1>
				<i class="gi gi-briefcase"></i>Report Detail clone ig<br>
				<small>Detail clone ig</small>
			</h1>
		</div>
	</div>

	<!-- START Filter Block -->
	<div class="row">
		<div class="col-md-12">
			<div class="block full">
				<!-- All filter Title -->
				<div class="block-title">
					<h2><strong>Lọc</strong></h2>
				</div>
				<!-- END All filter Title -->
				<div class="row form-horizontal">

					<div class="col-sm-12 col-lg-6">
						<div class="form-group">
							<label class="col-md-3 control-label" for="date_start_filter">From date</label>
							<div class="col-md-9">
								<input type="date" id="date_start_filter" name="date_start_filter" style="width: 100%;"
									   class="form-control filter-date">
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-lg-6">
						<div class="form-group">
							<label class="col-md-3 control-label" for="date_end_filter">To date</label>
							<div class="col-md-9">
								<input type="date" id="date_end_filter" name="date_end_filter" style="width: 100%;"
									   class="form-control filter-date">
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-lg-6">
						<div class="form-group">
							<label class="col-md-3 control-label" for="mem_filter">Team</label>
							<div class="col-md-9">
								<select class="form-control" name="mem_filter" style="width: 100%" id="mem_filter">
									<option value="all">Tất cả</option>
									<?php
									if ($mem) {
										foreach ($mem as $key => $value) {
											echo '<option  value="' . $value . '">' . strtoupper($value) . '</option>';
										}
									}
									?>
								</select>
							</div>
						</div>
					</div>
				</div>
				<!-- All Orders Content -->
				<!-- END All Orders Content -->
			</div>
		</div>

	</div>
	<!-- END Filter Block -->

	<!-- START Grid Block -->
	<div class="block full">
		<!-- All Orders Title -->
		<div class="block-title">
			<h2><strong>Report</strong> detail clone ig</h2>
		</div>
		<!-- END All Orders Title -->

		<!-- All Orders Content -->
		<div id="grid">

		</div>
		<!-- END All Orders Content -->
	</div>
	<!-- END Grid Block -->

	<style type="text/css">
		.k-grid {
			font-size: 13px !important;
			font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
			color: #000000 !important;
		}

		.k-filter-row th, .k-grid-header th.k-header {
			font-weight: 600 !important;
		}

		.k-grid td {
			line-height: 2em !important;
		}

		.delete-row {
			background-color: mistyrose !important;
		}

		.hight-line {
			background-color: #c2e8ec;
		}
	</style>

	<script>

		$(document).ready(function () {
			init_filter_date();

			$('#mem_filter').kendoDropDownList();
			init_grid();

		});
		$('#mem_filter').on('change', function (event) {
			event.preventDefault();
			/* Act on the event */
			$("#grid").data("kendoGrid").dataSource.read();
		});

		function init_filter_date() {
			var startDate = new Date();
			$('#date_start_filter').kendoDatePicker({
				value: startDate,
				culture: "vi-VN",
				min: new Date(2019, 0, 1),
				max: new Date(),
				format: "dd-MM-yyyy",
				change: function (e) {
					$("#grid").data("kendoGrid").dataSource.read();
				},
			});
			$('#date_end_filter').kendoDatePicker({
				value: new Date(),
				culture: "vi-VN",
				min: new Date(2019, 0, 1),
				max: new Date(),
				format: "dd-MM-yyyy",
				change: function (e) {
					$("#grid").data("kendoGrid").dataSource.read();

				},
			});
		}

		function init_grid() {
			$("#grid").kendoGrid({
				dataSource: {
					transport: {
						read: {
							url: "<?= base_url('report-detail-clone-ig/get-grid.html') ?>",
							dataType: "json",
							type: "POST",
							data: function (a) {
								let mem_filter = $('#mem_filter').val();
								let start_date_filter = $('#date_start_filter').val();
								let end_date_filter = $('#date_end_filter').val();
								if (!isNullorEmpty(mem_filter) && mem_filter !== 'all') {
									a.mem_filter = mem_filter;
								}
								if (!isNullorEmpty(start_date_filter)) {
									a.start_date_filter = start_date_filter;
								}
								if (!isNullorEmpty(end_date_filter)) {
									a.end_date_filter = end_date_filter;
								}
								return {
									filters: JSON.stringify(a)
								}
							},
							complete: function (d) {
								console.log(d)
							}
						}
					},
					requestStart: function () {
						NProgress.start();
					},
					requestEnd: function () {
						NProgress.done();
					},
					pageSize: 10,
					serverPaging: true,
					serverSorting: true,
					serverFiltering: true,
					serverAggregates: false,
					sort: { field: "created_time", dir: "desc" },
					schema: {
						data: "data", // records are returned in the "data" field of the response
						total: "total", // total number of records is in the "total" field of the response
						id: "id",
						model: {
							fields: {
								ig_uid: {type: "string"},
								pass: {type: "string"},
								cookie: {type: "string"},
								// "2fa": {type: "number"},
								created_time: {type: "string"},
								mod: {type: "string"},
								novery: {type: "string"},
								geo: {type: "string"},
								sell: {type: "string"},
								live: {type: "string"},
								// "282": {type: "string"},
								serial: {type: "string"},
								sent: {type: "string"},
								phone: {type: "string"},
								hotmail: {type: "string"},
								passhotmail: {type: "string"},
							}
						}
					}// enable server paging
				},
				sortable: true,
				toolbar: ["excel"],
				excel: {
					allPages: true
				},
				filterable: true,
				columnMenu: true,
				resizable: true,
				pageable: {
					refresh: true,
					pageSizes: true,
					buttonCount: 5,
				},
				noRecords: {
					template: "<h2 class='text-center'>Không tìm thấy dữ liệu phù hợp.</h2>"
				},
				columns: [
					{
						field: "i",
						title: "#",
						width: 50,
						filterable: false,
						sortable: false
					},
					{
						field: "ig_uid",
						title: "uid",
						width: 120,
					},
					{
						field: "mod",
						title: "Team",
						width: 90,
					},
					{
						field: "pass",
						title: "pass",
						width: 90,
					},
					{
						field: "cookie",
						title: "cookie",
						width: 100,
					},
					{
						field: "serial",
						title: "serial",
						width: 180,
					},
					{
						field: "sent",
						title: "sent",
						width: 180,
						hidden: true
					},
					{
						field: "phone",
						title: "phone",
						width: 100,
						hidden: true
					},
					{
						field: "hotmail",
						title: "hotmail",
						width: 180,
						hidden: true
					},
					{
						field: "passhotmail",
						title: "passhotmail",
						width: 180,
						hidden: true
					},

					{
						field: "created_time",
						title: "Create time",
						filterable: false,
						width: 180,
					},

				]
			});
		}

	</script>

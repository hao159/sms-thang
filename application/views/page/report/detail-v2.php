<!-- Page content -->
<div id="page-content">
	<div class="content-header">
		<div class="header-section">
			<h1>
				<i class="gi gi-briefcase"></i>Report sms detail<br>
				<small>SMS detail</small>
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
					<div class="col-sm-12 col-lg-6">
						<div class="form-group">
							<label class="col-md-3 control-label" for="server_filter">Server</label>
							<div class="col-md-9">
								<select class="form-control" name="server_filter" style="width: 100%"
										id="server_filter">
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
			<div class="block-options pull-right">
			</div>
			<h2><strong>Report</strong> sms data detail</h2>
		</div>
		<!-- END All Orders Title -->
		<div class="show-total">
			<div class="row text-center">
				<div class="col-xs-2">
					<h3 class="animation-hatch">
						<strong id="aggregates-data">0</strong>
						<br>
						<small>Total SMS</small>
					</h3>
				</div>
			</div>
		</div>
		<!-- All Orders Content -->
		<div id="grid">

		</div>
		<!-- END All Orders Content -->
	</div>
	<!-- END Grid Block -->
	<script id="toolbarGrid" type="text/x-kendo-template">
		<a href="javascript:void(0)" onclick="delete_data()"
		   class="k-button custom-grid-toolbar btn-grid-toolbar-success"
		   title="Delete data"><i class="far fa-trash"></i> Delete data</a>
	</script>
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

	</style>

	<script>

		$(document).ready(function () {
			init_filter_date();
			initServerFilter();
			$('#mem_filter').kendoDropDownList();
			init_grid();

			let grid = $("#grid").data("kendoGrid");

		});

		function delete_data() {
			let mem_filter = $('#mem_filter').val();
			let start_date_filter = $('#date_start_filter').val();
			let end_date_filter = $('#date_end_filter').val();
			let filters = {};
			if (isNullorEmpty(mem_filter) || mem_filter === 'all') {
				filters.mem_filter = 'all';
			} else {
				filters.mem_filter = mem_filter;
			}
			if (isNullorEmpty(start_date_filter)) {
				alert_error('Vui lòng chọn ngày bắt đầu');
				return;
			}
			if (isNullorEmpty(end_date_filter)) {
				alert_error('Vui lòng chọn ngày kết thúc');
				return;
			}
			filters.end_date_filter = end_date_filter;
			filters.start_date_filter = start_date_filter;

			swalWithBootstrapButtons.fire({
				title: `Confirm?`,
				width: 600,
				html: `Delete
				data of
				${filters.mem_filter},
				from
				${filters.start_date_filter}
				to
				${filters.end_date_filter}
				?`,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Ok 👌!',
				cancelButtonText: 'Cancel!',
				reverseButtons: true
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: '/sms-report-detail-v2/delete.html',
						type: 'POST',
						dataType: 'json',
						data: {
							filters: JSON.stringify(filters)
						},
						beforeSend: function () {
							NProgress.start();
						},
						success: function (d) {
							if (d.status === "<?= StatusResponse::_SUCCESS ?>") {
								swalWithBootstrapButtons.fire(
									'Success',
									`Delete success`,
									'success'
								)
							} else {
								// load lỗi
								alert_error(d.error)
							}
							NProgress.done();
							$("#grid").data("kendoGrid").dataSource.read();
						},
						error: function (xhr, status, error) {
							// Handle error
							alert_error(`${status} - Bạn không có quyền truy cập`);
							NProgress.done();
						}
					});


				} else if (result.dismiss === Swal.DismissReason.cancel) {
					swalWithBootstrapButtons.fire(
						'Canceled!',
						'Your data is safe',
						'error'
					)
				}
			})
		}

		//init server filter
		function initServerFilter() {
			$('#server_filter').kendoDropDownList({
				dataTextField: "server",
				dataValueField: "server",
				optionLabel: "All servers",
				dataSource: {
					transport: {
						read: {
							url: "<?= base_url('sms-report-detail-v2/get-server.html') ?>",
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
						}
					},
					schema: {
						data: "data", // records are returned in the "data" field of the response
						total: "total", // total number of records is in the "total" field of the response
					}
				},
				change: function (e) {
					$("#grid").data("kendoGrid").dataSource.read();
				}
			});
		}

		function reloadServerFilter() {
			$('#server_filter').data('kendoDropDownList').dataSource.read();
			$('#server_filter').data('kendoDropDownList').refresh();
		}

		$('#mem_filter').on('change', function (event) {
			event.preventDefault();
			/* Act on the event */
			$("#grid").data("kendoGrid").dataSource.read();
			reloadServerFilter()
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
					reloadServerFilter()
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
					reloadServerFilter()

				},
			});
		}


		let pooling_timestamp = Math.floor(Date.now() / 1000);

		function init_grid() {
			$("#grid").kendoGrid({
				dataSource: {
					transport: {
						read: {
							url: "<?= base_url('sms-report-detail-v2/get-grid.html') ?>",
							dataType: "json",
							type: "POST",
							data: function (a) {
								let mem_filter = $('#mem_filter').val();
								let start_date_filter = $('#date_start_filter').val();
								let end_date_filter = $('#date_end_filter').val();
								//server filter
								let server_filter = $('#server_filter').val();
								if (!isNullorEmpty(mem_filter) && mem_filter !== 'all') {
									a.mem_filter = mem_filter;
								}
								if (!isNullorEmpty(start_date_filter)) {
									a.start_date_filter = start_date_filter;
								}
								if (!isNullorEmpty(end_date_filter)) {
									a.end_date_filter = end_date_filter;
								}
								if (!isNullorEmpty(server_filter) && server_filter !== 'all') {
									a.server_filter = server_filter;
								}
								a.pooling_timestamp = pooling_timestamp;
								return {
									filters: JSON.stringify(a)
								}
							},
							complete: function (d) {
								total_sms = d.responseJSON.total
								pooling_timestamp = parseInt(d?.responseJSON?.pooling_timestamp)
								if (pooling_timestamp == null) {
									pooling_timestamp = Math.floor(Date.now() / 1000);
								}
								$('#aggregates-data').text(total_sms)
							}
						}
					},
					requestStart: function () {
						NProgress.start();
					},
					requestEnd: function () {
						NProgress.done();
					},
					pageSize: 30,
					serverPaging: true,
					serverSorting: true,
					serverFiltering: true,
					serverAggregates: false,
					sort: {field: "time", dir: "desc"},
					schema: {
						data: "data", // records are returned in the "data" field of the response
						total: "total", // total number of records is in the "total" field of the response
						id: "id",
						model: {
							fields: {
								service: {type: "string"},
								otp: {type: "string"},
								mem: {type: "string"},
								count: {type: "number"},
								time: {type: "string"},
								phone: {type: "string"},
								server: {type: "string"},
								note: {type: "string"},
							}
						}
					}// enable server paging
				},
				sortable: true,
				toolbar: [
					{
						template: kendo.template($("#toolbarGrid").html())
					},
					"excel"
				],
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
						field: "service",
						title: "Service name",
						width: 120,
					},
					{
						field: "mem",
						title: "Team",
						width: 90,
					},
					{
						field: "phone",
						title: "Phone",
						width: 90,
					},
					{
						field: "otp",
						title: "Message",
						width: 250,
					},
					{
						field: "server",
						title: "Server",
						width: 120,
					},
					{
						field: "note",
						title: "Note",
						filterable: false,
						width: 180,
					},
					{
						field: "time",
						title: "Create time",
						filterable: false,
						width: 180,
					},
				],
				dataBound: function (e) {
					let grid = e.sender;
					let dataItems = grid.dataSource.view();
					for (let i = 0; i < dataItems.length; i++) {
						let dataItem = dataItems[i];
						console.log(dataItem.is_new)
						let row = grid.tbody.find("tr[data-uid='" + dataItem.uid + "']");
						// Apply your conditions and set the background color accordingly
						if (dataItem.is_new) {
							row.css('background-color', '#aad178 !important');
						}
					}
				}
			});
		}

	</script>

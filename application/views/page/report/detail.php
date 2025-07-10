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
				<a href="javascript:void(0)" id="auto_refresh_btn" class="btn btn-sm btn-default"
				   data-toggle="tooltip" title="Auto refresh"><i id="icon_refresh" class="fas fa-sync"></i></a>
				<a href="javascript:void(0)" id="show_modal_setting" class="btn btn-sm btn-warning"
				   data-toggle="tooltip" title="Config auto refresh"><i class="fas fa-cogs"></i></a>
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
	<div class="modal fade" id="refresh_setting_model" tabindex="-1" role="dialog" aria-labelledby="setting_refresh"
		 aria-hidden="true">
		<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="setting_refresh">Refresh setting</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="refresh_setting_form" class="form-horizontal">
					<div class="modal-body">
						<div class="form-group">
							<label class="col-md-3 control-label" for="interval_setting">Interval time</label>
							<div class="col-md-9">
								<input type="text" class="form-control" placeholder="" name="interval_setting"
									   id="interval_setting">
								<span class="help-block">Millisecond (1s = 1000ms)</span>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-primary">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
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
			let intervalId = '';
			let el_interval_setting_val = $('#interval_setting');
			$('#mem_filter').kendoDropDownList();
			init_grid();
			let interval_time = getCookie('sms_detail_interval_time_refresh');
			if (isNullorEmpty(interval_time)) {
				interval_time = 10000;
				setCookie('sms_detail_interval_time_refresh', interval_time)
			}
			interval_time = Number(interval_time)
			el_interval_setting_val.val(interval_time);
			let auto_refresh = getCookie('sms_detail_interval_auto_refresh');
			if (isNullorEmpty(auto_refresh)) {
				auto_refresh = true;
				setCookie('sms_detail_interval_auto_refresh', auto_refresh)
			}
			let el_auto_refresh_btn = $('#auto_refresh_btn');
			let el_icon_refresh = $('#icon_refresh');
			let grid = $("#grid").data("kendoGrid");
			auto_refresh = Boolean(auto_refresh)
			if (auto_refresh) {
				el_auto_refresh_btn.removeClass('btn-default');
				el_auto_refresh_btn.addClass('btn-success');
				el_icon_refresh.addClass('fa-spin');
				el_auto_refresh_btn.data('autoReloadEnabled', true);
				// Reload datasource on interval
				intervalId = setInterval(function () {
					grid.dataSource.read();
				}, interval_time);


			} else {
				el_auto_refresh_btn.addClass('btn-default');
				el_auto_refresh_btn.removeClass('btn-success');
				el_auto_refresh_btn.data('autoReloadEnabled', false);
				el_icon_refresh.removeClass('fa-spin');
			}


			// Function to enable auto-reload
			function enableAutoReload() {
				// Get interval time from cookie
				interval_time = parseInt(getCookie('sms_detail_interval_time_refresh'))
				if (interval_time) {
					// Reload datasource on interval
					intervalId = setInterval(function () {
						grid.dataSource.read();
					}, interval_time);
					alert_success('Auto refresh : ON ✅');
					// Save auto-reload status to cookie
					setCookie('sms_detail_interval_auto_refresh', true)
				}
			}

			// Function to disable auto-reload
			function disableAutoReload() {
				// Clear auto-reload interval
				clearInterval(intervalId);
				alert_success('Auto refresh : OFF ⛔️');
				// Save auto-reload status to cookie
				setCookie('sms_detail_interval_auto_refresh', false)
			}

			el_auto_refresh_btn.click(function () {
				if ($(this).data('autoReloadEnabled')) {
					// Disable auto-reload
					disableAutoReload();
					el_auto_refresh_btn.addClass('btn-default');
					el_auto_refresh_btn.removeClass('btn-success');
					el_auto_refresh_btn.data('autoReloadEnabled', false);
					el_icon_refresh.removeClass('fa-spin');
				} else {
					// Enable auto-reload
					enableAutoReload();
					el_auto_refresh_btn.removeClass('btn-default');
					el_auto_refresh_btn.addClass('btn-success');
					el_icon_refresh.addClass('fa-spin');
					el_auto_refresh_btn.data('autoReloadEnabled', true);
				}
			});
			let el_modal = $('#refresh_setting_model');
			$('#show_modal_setting').click(function () {
				el_modal.modal('show');
				interval_time = getCookie('sms_detail_interval_time_refresh');
				el_interval_setting_val.val(interval_time);
			})
			$('#refresh_setting_form').on('submit', function (e) {
				e.preventDefault();
				let data_interval_setting = parseInt(el_interval_setting_val.val());
				if (isNullorEmpty(data_interval_setting)) {
					alert_error('Empty Interval time setting')
					return;
				}

				setCookie('sms_detail_interval_time_refresh', data_interval_setting);
				alert_success('Setting Interval time success');
				if (el_auto_refresh_btn.data('autoReloadEnabled')) {
					disableAutoReload();
					enableAutoReload();
				}
				el_modal.modal('hide')
			});
		});

		function delete_data() {
			let mem_filter = $('#mem_filter').val();
			let start_date_filter = $('#date_start_filter').val();
			let end_date_filter = $('#date_end_filter').val();
			let filters = {};
			if (isNullorEmpty(mem_filter) || mem_filter == 'all') {
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
						url: '/sms-report-detail/delete.html',
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
					reloadServerFilter();
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
					reloadServerFilter();
				},
			});
		}

		let pooling_timestamp = Math.floor(Date.now() / 1000);

		function init_grid() {
			$("#grid").kendoGrid({
				dataSource: {
					transport: {
						read: {
							url: "<?= base_url('sms-report-detail/get-grid.html') ?>",
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

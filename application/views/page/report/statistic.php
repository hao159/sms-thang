<!-- Page content -->
<div id="page-content">
	<div class="content-header">
		<div class="header-section">
			<h1>
				<i class="gi gi-briefcase"></i>Report Statistic<br>
				<small>SMS statistic</small>
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
			<h2><strong>Report</strong> sms OTP statistc</h2>
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
	<div class="modal fade" id="edit_model" role="dialog" aria-labelledby="edit_record"
		 aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="edit_record">Edit report</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="edit_form" class="form-horizontal">
					<div class="modal-body">
						<div class="form-group">
							<label class="col-md-3 control-label" for="user_edit">Team</label>
							<div class="col-md-9">
								<input type="hidden" id="id_selected_edit" value="">
								<input type="hidden" id="user_selected_edit" value="">
								<input type="text" width="100%" class="form-control" placeholder="" name="user_edit"
									   id="user_edit">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label" for="count_edit">Count</label>
							<div class="col-md-9">
								<input type="number" class="form-control" placeholder="" name="count_edit"
									   id="count_edit">
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
	<div class="modal fade" id="insert_report_modal" role="dialog" aria-labelledby="insert_modal"
		 aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="insert_modal">Insert report</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="insert_form" class="form-horizontal">
					<div class="modal-body">
						<div class="form-group">
							<label class="col-md-3 control-label" for="file_report">File</label>
							<div class="col-md-9">
								<input type="file" class="form-control" placeholder="" name="file_report"
									   id="file_report">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label" for="team_import">Team</label>
							<div class="col-md-9">
								<input type="text" width="100%" class="form-control" placeholder="" name="team_import"
									   id="team_import">
							</div>
						</div>
						<div class="block full">
							<!-- All Orders Title -->
							<div class="block-title">
								<h2><strong>Show demo data</strong></h2>
							</div>
							<div id="grid-demo">

							</div>
							<!-- END All Orders Content -->
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						<button type="button" onclick="upload_file()" class="btn btn-warning">(1) Upload file</button>
						<button type="submit" class="btn btn-primary">(2) Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
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
	<script id="toolbarGrid" type="text/x-kendo-template">
		<a href="javascript:void(0)" onclick="show_model_insert()"
		   class="k-button custom-grid-toolbar btn-grid-toolbar-success"
		   title="Insert serial"><i class="far fa-plus-hexagon"></i> Insert report</a>
	</script>
	<script id="funcGrid" type="text/x-kendo-template">
		<div class="btn-group btn-group-xs">
			<a href="javascript:void(0)" onclick="delete_data('#=id#')" class="btn btn-sm btn-danger"
			   title="Delete"><i
						class="far fa-trash-alt"></i> Xoá</a>
			<a href="javascript:void(0)" onclick="edit_data('#=id#')" class="btn btn-sm btn-default"
			   title="Edit"><i
						class="far fa-pencil"></i> Sửa</a>
		</div>
	</script>

	<script>

		$(document).ready(function () {
			init_filter_date();

			$('#mem_filter').kendoDropDownList();
			init_grid();

		});
		let el_form_edit = $('#edit_form');
		const el_hidden_selected_edit_mem = $('#user_selected_edit');
		const el_hidden_selected_edit_id = $('#id_selected_edit');


		async function edit_data(id) {
			const select_team_drp = $("#user_edit").data('kendoDropDownList');
			await el_form_edit[0].reset();
			let dataOtp = await getOne(id);
			if (dataOtp !== '') {
				await el_hidden_selected_edit_mem.val(dataOtp.mem);
				await select_team_drp.dataSource.read();
				console.log('change', dataOtp.mem)
				select_team_drp.value(-1);
				select_team_drp.text("");
				select_team_drp.value(dataOtp.mem);
				$('#count_edit').val(dataOtp.count);
				el_hidden_selected_edit_id.val(dataOtp.id);
				$('#edit_model').modal('show');

			}
		}

		let el_form_insert = $('#insert_form');

		function show_model_insert() {
			el_form_insert[0].reset();
			$('#insert_report_modal').modal('show');
		}

		el_form_insert.on('submit', function (e) {
			e.preventDefault();
			const grid_demo = $('#grid-demo').data('kendoGrid');
			if (grid_demo === undefined) {
				alert_error('Vui lòng insert file');
				return;
			}
			let dataSource_demo = grid_demo.dataSource;
			if (dataSource_demo === undefined) {
				alert_error('Vui lòng insert file');
				return;
			}
			let data_demo = dataSource_demo.data();
			if (data_demo === undefined || data_demo.length === 0) {
				alert_error('Vui lòng upload đúng file');
				return;
			}

			swalWithBootstrapButtons.fire({
				title: `Confirm?`,
				width: 600,
				html: `Insert ${data_demo.length} report?`,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Ok 👌!',
				cancelButtonText: 'Cancel!',
				reverseButtons: true
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: '/otp-statistics/insert.html',
						type: 'POST',
						dataType: 'json',
						data: {
							data: JSON.stringify(data_demo)
						},
						beforeSend: function () {
							NProgress.start();
						},
						success: function (d) {
							if (d.status === "<?= StatusResponse::_SUCCESS ?>") {
								swalWithBootstrapButtons.fire(
									'Success',
									`Insert success ${d?.insert?.ok} report`,
									'success'
								)
								$('#insert_report_modal').modal('hide');
							} else {
								// load lỗi
								alert_error(d.error)
							}
							NProgress.done();
							$("#grid").data("kendoGrid").dataSource.read();
							$("#grid-demo").data("kendoGrid").destroy();
						},
						error: function (xhr, status, error) {
							// Handle error
							alert_error(`${status} - Bạn không có quyền truy cập`);
							NProgress.done();
						}
					});


				} else if (result.dismiss === Swal.DismissReason.cancel) {
					swalWithBootstrapButtons.fire(
						'Ok hủy!',
						'Suy nghĩ lại rồi à?🙂',
						'error'
					)
				}
			})

		})

		function upload_file() {
			let fileInput = $('#file_report')[0].files[0];
			let mem = $('#team_import').val();
			if (mem === 'Chọn team...' || mem === '') {
				alert_error('Vui lòng chọn team');
				return;
			}
			const reader = new FileReader();
			reader.onload = function (e) {
				let contents = e.target.result;
				let data = parseFileContents(contents, mem);
				renderGrid(data);
			};

			reader.readAsText(fileInput);
		}

		function parseFileContents(contents, mem) {
			let rows = contents.split('\n');
			let data = [];
			let i = 1;
			rows.forEach(function (row) {
				if (row.trim() !== '') {
					let columns = row.split('|');
					if (columns.length !== 2) {
						alert_error(`Sai định dạng file import ở cột ${i}`);
					}
					let item_count = columns[1];
					if (isNaN(item_count)) {
						alert_error(`Cột count phải là số | ${i}`);
					}

					let rowData = {
						i: i++,
						service: columns[0].trim(),
						count: item_count,
						mem: mem
					};
					data.push(rowData);
				}
			});

			return data;
		}

		function renderGrid(data) {
			$('#grid-demo').kendoGrid({
				dataSource: {
					data: data,
					pageSize: 5,
					page: 1
				},
				pageable: true,
				columns: [
					{field: 'i', title: '#'},
					{field: 'service', title: 'Service name'},
					{field: 'count', title: 'Count'},
					{field: 'mem', title: 'mem'},
				]
			});
		}

		el_form_edit.on('submit', function (e) {
			e.preventDefault();
			if (isNullorEmpty(el_hidden_selected_edit_id.val())) {
				alert_error('error when update data');
				return;
			}
			let team_selected = $("#user_edit").val();
			if (isNullorEmpty(team_selected)) {
				alert_error('Empty team selected');
				return;
			}
			let cout_update = $('#count_edit').val();
			if (isNullorEmpty(cout_update)) {
				alert_error('Empty count updated');
				return;
			}
			let item_update = {
				id: el_hidden_selected_edit_id.val(),
				mem: team_selected,
				count: cout_update
			}
			swalWithBootstrapButtons.fire({
				title: `Confirm?`,
				width: 600,
				html: `Item ${item_update.id} will update?`,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Ok 👌!',
				cancelButtonText: 'Cancel!',
				reverseButtons: true
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: '/otp-statistics/update.html',
						type: 'POST',
						dataType: 'json',
						data: {
							data: JSON.stringify(item_update)
						},
						beforeSend: function () {
							NProgress.start();
						},
						success: function (d) {
							if (d.status === "<?= StatusResponse::_SUCCESS ?>") {
								swalWithBootstrapButtons.fire(
									'Success',
									`Item ${item_update.id} was updated`,
									'success'
								)
								$('#grid').data('kendoGrid').dataSource.read();
								$('#edit_model').modal('hide');
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
						'Ok hủy!',
						'Suy nghĩ lại rồi à?🙂',
						'error'
					)
				}
			})
		})

		function delete_data(id) {
			swalWithBootstrapButtons.fire({
				title: `Confirm?`,
				width: 600,
				html: `Bạn muốn xoá data ${id}?`,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Ok 👌!',
				cancelButtonText: 'Cancel!',
				reverseButtons: true
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: "/otp-statistics/delete.html",
						type: 'POST',
						dataType: 'json',
						data: {
							'id': id
						},
						beforeSend: function () {
							console.log('beforesend');
							NProgress.start();
						},
						success: function (response) {
							NProgress.done();
							let status = response?.status;
							if (!isNullorEmpty(status) && status === '<?=StatusResponse::_SUCCESS?>') {
								alert_success(`Xoá thành công data ${id}`);
								$("#grid").data("kendoGrid").dataSource.read();
							} else {
								let msgErr = response?.error;
								alert_error(!isNullorEmpty(msgErr) ? msgErr : 'Lỗi khi load dữ liệu chỉnh sửa');
							}
						},
						error: function (xhr, status, error) {
							// Handle error
							alert_error(`${status} - Bạn không có quyền truy cập`);
							NProgress.done();
						}
					});
				} else if (result.dismiss === Swal.DismissReason.cancel) {
					swalWithBootstrapButtons.fire(
						'Ok hủy!',
						'Suy nghĩ lại rồi à?🙂',
						'error'
					)
				}
			})

		}

		async function getOne(id) {
			let responseData = null;
			try {
				let response = await $.ajax({
					url: '/otp-statistics/get-one.html',
					type: 'POST',
					dataType: 'json',
					data: {
						'id': id
					},
					beforeSend: function () {
						NProgress.start();
					},
					complete: function () {
						NProgress.done();
					},
					error: function (xhr, status, error) {
						// Handle error
						alert_error(`${status} - Bạn không có quyền truy cập`);
						NProgress.done();
					}
				});

				let dataOtp = response?.data;
				if (!isNullorEmpty(dataOtp)) {
					console.log(dataOtp);
					responseData = dataOtp;
				} else {
					let msgErr = response?.error;
					alert_error(!isNullorEmpty(msgErr) ? msgErr : 'Lỗi khi load dữ liệu chỉnh sửa');
				}
			} catch (error) {
				console.error(error);
				alert_error('Lỗi khi gửi yêu cầu lấy dữ liệu');
			}

			return responseData;
		}

		$("#user_edit").kendoDropDownList({
			height: 310,
			optionLabel: "Chọn team...",
			dataTextField: "mem",
			dataValueField: "mem",
			template: "<span> #=User# - #=mem# </span>",
			noDataTemplate: 'No Data!',
			filter: "contains",
			minLength: 1,
			virtual: {
				itemHeight: 30,
				valueMapper: function (options) {

					$.ajax({
						url: '/user/value-mapper.html',
						type: "GET",
						dataType: "json",
						data: convertValues(options.value),
						success: function (data) {
							options.success(data);
						}
					})
				}
			},
			dataSource: {
				transport: {
					read: function (options) {
						if (!isNullorEmpty(el_hidden_selected_edit_mem.val()) && options.data?.filter === undefined) {
							let filter_custom = {
								'filter': {
									'filters': [
										{
											'value': el_hidden_selected_edit_mem.val(),
											'field': 'mem',
											'operator': 'eq',
											'ignoreCase': true
										}
									],
									'logic': 'and'
								}
							}
							options.data = {...options.data, ...filter_custom}
						}
						$.ajax({
							url: '/user/get-data-dropdown.html',
							contentType: 'application/json',
							dataType: 'json',
							type: 'GET',
							data: options.data,
							success: function (result) {
								options.success(result);
							}
						})
					}
				},
				schema: {
					data: 'data',
					total: 'total',
					fields: [
						{field: 'User', type: 'string'},
						{field: 'mem', type: 'string'},
					]
				},
				pageSize: 10,
				Type: "json",
				serverPaging: true,
				serverFiltering: true
			},
		}).data("kendoDropDownList");

		$("#team_import").kendoDropDownList({
			height: 310,
			optionLabel: "Chọn team...",
			dataTextField: "mem",
			dataValueField: "mem",
			template: "<span> #=User# - #=mem# </span>",
			noDataTemplate: 'No Data!',
			filter: "contains",
			minLength: 1,
			virtual: {
				itemHeight: 30,
				valueMapper: function (options) {

					$.ajax({
						url: '/user/value-mapper.html',
						type: "GET",
						dataType: "json",
						data: convertValues(options.value),
						success: function (data) {
							options.success(data);
						}
					})
				}
			},
			dataSource: {
				transport: {
					read: function (options) {
						$.ajax({
							url: '/user/get-data-dropdown.html',
							contentType: 'application/json',
							dataType: 'json',
							type: 'GET',
							data: options.data,
							success: function (result) {
								options.success(result);
							}
						})
					}
				},
				schema: {
					data: 'data',
					total: 'total',
					fields: [
						{field: 'User', type: 'string'},
						{field: 'mem', type: 'string'},
					]
				},
				pageSize: 10,
				Type: "json",
				serverPaging: true,
				serverFiltering: true
			},
		}).data("kendoDropDownList");

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
							url: "<?= base_url('otp-statistics/get-grid.html') ?>",
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
								let sum_count = d.responseJSON?.aggregates?.count?.sum;

								$('#aggregates-data').text((sum_count != null) ? sum_count : 0)
							}
						}
					},
					requestStart: function () {
						NProgress.start();
					},
					requestEnd: function () {
						NProgress.done();
					},
					pageSize: 200,
					serverPaging: true,
					serverSorting: true,
					serverFiltering: true,
					serverAggregates: true,
					sort: {field: "count", dir: "desc"},
					schema: {
						data: "data", // records are returned in the "data" field of the response
						total: "total", // total number of records is in the "total" field of the response
						id: "id",
						aggregates: "aggregates",
						model: {
							fields: {
								service: {type: "string"},
								mem: {type: "string"},
								count: {type: "number"},
								createtime: {type: "string"},
							}
						}
					},// enable server paging
					aggregate: [
						{field: "count", aggregate: "sum"},
					]
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
						title: "Thao tác",
						width: 70,
						template: kendo.template($("#funcGrid").html())
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
						field: "count",
						title: "Count",
						width: 90,
					},

					{
						field: "createtime",
						title: "Create time",
						filterable: false,
						width: 180,
					},
				]
			});
		}

	</script>

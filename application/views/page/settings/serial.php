<!-- Page content -->
<div id="page-content">
	<div class="content-header">
		<div class="header-section">
			<h1>
				<i class="gi gi-briefcase"></i><?= $template['active_description'] ?> management<br>
				<small><?= $template['active_description'] ?> management</small>
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
							<label class="col-md-3 control-label" for="user_filter">User</label>
							<div class="col-md-9">
								<select class="form-control" name="user_filter" style="width: 100%" id="user_filter">
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
			<h2><strong><?= $template['active_description'] ?> list</strong></h2>
		</div>
		<div id="grid">

		</div>
		<!-- END All Orders Content -->
	</div>
	<!-- END Grid Block -->
	<!-- END Grid Block -->
	<div class="modal fade" id="add_table_model" role="dialog" aria-labelledby="add_table"
		 aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="add_table">Insert serial</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="add_table_form" class="form-horizontal">
					<div class="modal-body">
						<div class="form-group">
							<label class="col-md-3 control-label" for="file_serial">File</label>
							<div class="col-md-9">
								<input type="file" class="form-control" placeholder="" name="file_serial"
									   id="file_serial">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label" for="user_import">User</label>
							<div class="col-md-9">
								<input type="text" width="100%" class="form-control" placeholder="" name="user_import"
									   id="user_import">
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
		<a href="javascript:void(0)" onclick="show_model_add()"
		   class="k-button custom-grid-toolbar btn-grid-toolbar-success"
		   title="Insert serial"><i class="far fa-plus-hexagon"></i> Insert serial</a>
		<a href="javascript:void(0)" onclick="delete_serial_filter()"
		   class="k-button custom-grid-toolbar btn-grid-toolbar-success"
		   title="Delete serial"><i class="far fa-trash"></i> Delete serial</a>
	</script>
	<script id="funcGrid" type="text/x-kendo-template">
		<div class="btn-group btn-group-xs">
			<a href="javascript:void(0)" onclick="delete_item('#=id#', '#=serial#')" class="btn btn-info"
			   title="Delete"><i
						class="far fa-trash-alt"></i></a>
		</div>
	</script>

	<script>

		$(document).ready(function () {
			init_grid();
		});
		$('#user_filter').on('change', function (event) {
			event.preventDefault();
			/* Act on the event */
			$("#grid").data("kendoGrid").dataSource.read();
		});

		function delete_serial_filter() {
			let user_filter = $("#user_filter").data("kendoDropDownList").value();
			if (!isNullorEmpty(user_filter) && user_filter !== 'Chọn user...') {
				swalWithBootstrapButtons.fire({
					title: `Confirm?`,
					width: 600,
					html: `Delete all serial of ${user_filter}?`,
					icon: 'warning',
					showCancelButton: true,
					confirmButtonText: 'Ok 👌!',
					cancelButtonText: 'Cancel!',
					reverseButtons: true
				}).then((result) => {
					if (result.isConfirmed) {
						$.ajax({
							url: '/serial/delete-all.html',
							type: 'POST',
							dataType: 'json',
							data: {
								user: user_filter
							},
							beforeSend: function () {
								NProgress.start();
							},
							success: function (d) {
								if (d.status === "<?= StatusResponse::_SUCCESS ?>") {
									swalWithBootstrapButtons.fire(
										'Success',
										`Delete success, all serial of ${user_filter} are deleted!`,
										'success'
									)
									$('#add_table_model').modal('hide');
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
			} else {
				alert_error('Please chose the user for delete')
			}
		}

		function upload_file() {
			let fileInput = $('#file_serial')[0].files[0];
			let mem = $('#user_import').val();
			if (mem === 'Chọn mem...' || mem === '') {
				alert_error('Vui lòng chọn user');
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

		function delete_item(id, serial) {
			if (id == '') {
				alert_error('Không xác định được serial cần xoá');
				return;
			}

			swalWithBootstrapButtons.fire({
				title: `Confirm?`,
				width: 600,
				html: `Delete serial: ${serial} ?`,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Ok 👌!',
				cancelButtonText: 'Cancel!',
				reverseButtons: true
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: '/serial/delete.html',
						type: 'POST',
						dataType: 'json',
						data: {
							id: id,
							serial: serial
						},
						beforeSend: function () {
							NProgress.start();
						},
						success: function (d) {
							if (d.status === "<?= StatusResponse::_SUCCESS ?>") {
								swalWithBootstrapButtons.fire(
									'Success',
									`Delete success serial: ${serial}`,
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
						'Ok hủy!',
						'Suy nghĩ lại rồi à?🙂',
						'error'
					)
				}
			})
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
					let rowData = {
						count: i++,
						mamay: columns[0].trim(),
						serial: columns[1].trim(),
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
					{field: 'count', title: '#'},
					{field: 'mamay', title: 'MaMay'},
					{field: 'serial', title: 'Serial'},
					{field: 'mem', title: 'mem'},
				]
			});
		}

		let el_form_add = $('#add_table_form');

		function show_model_add() {
			el_form_add[0].reset();
			$('#add_table_model').modal('show');
		}

		//create-clone-table/add.html
		el_form_add.on('submit', function (e) {
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
				html: `Insert ${data_demo.length} serial?`,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Ok 👌!',
				cancelButtonText: 'Cancel!',
				reverseButtons: true
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: '/serial/insert.html',
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
									`Insert success ${d?.insert?.ok} serial | exists ${d?.insert?.exists} serial`,
									'success'
								)
								$('#add_table_model').modal('hide');
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

		$("#user_import").kendoDropDownList({
			height: 310,
			optionLabel: "Chọn user...",
			dataTextField: "User",
			dataValueField: "mem",
			template: "<span> #=User# - #=mem# </span>",
			noDataTemplate: 'No Data!',
			filter: "contains",
			minLength: 2,
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

		$("#user_filter").kendoDropDownList({
			height: 310,
			optionLabel: "Chọn user...",
			dataTextField: "User",
			dataValueField: "mem",
			template: "<span> #=User# - #=mem# </span>",
			valueTemplate: "<span> #=User# - #=mem# </span>",
			noDataTemplate: 'No Data!',
			filter: "contains",
			minLength: 2,
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

		function init_grid() {
			$("#grid").kendoGrid({
				dataSource: {
					transport: {
						read: {
							url: "<?= base_url('serial/get-grid.html') ?>",
							dataType: "json",
							type: "POST",
							data: function (a) {
								let user_filter = $("#user_filter").data("kendoDropDownList").value();
								if (!isNullorEmpty(user_filter) && user_filter !== 'Chọn user...') {
									a.user_filter = user_filter;
								}
								return {
									filters: JSON.stringify(a)
								}
							},
							complete: function (d) {
							},
							error: function (xhr, status, error) {
								// Handle error
								alert_error(`${status} - Bạn không có quyền truy cập`);
								NProgress.done();
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
					schema: {
						data: "data", // records are returned in the "data" field of the response
						total: "total", // total number of records is in the "total" field of the response
						id: "id",
						aggregates: "aggregates",
						model: {
							fields: {
								i: {type: "number"},
								mamay: {type: "string"},
								serial: {type: "string"},
								created_time: {type: "string"},
								mem: {type: "string"},
							}
						}
					},// enable server paging
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
						field: "mamay",
						title: "MaMay",
						width: 120,
					},
					{
						field: "serial",
						title: "serial",
						width: 120,
					},
					{
						field: "mem",
						title: "mem",
						width: 120,
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

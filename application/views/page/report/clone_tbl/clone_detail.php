<!-- Page content -->
<div id="page-content">
	<div class="content-header">
		<div class="header-section">
			<h1>
				<i class="gi gi-briefcase"></i>Report <?= $template['active_description'] ?><br>
				<small><?= $template['active_description'] ?></small>
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
			<h2><strong>Report</strong> <?= $template['active_description'] ?></h2>
		</div>
		<!-- END All Orders Title -->

		<!-- All Orders Content -->
		<div id="grid">

		</div>
		<!-- END All Orders Content -->
	</div>
	<!-- END Grid Block -->
	<div class="modal fade" id="add_table_model" role="dialog" aria-labelledby="add_table"
		 aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="add_table">Insert data</h5>
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
								<span class="help-block">uid|pass|cookie|mod</span>
							</div>
						</div>
						<div class="block full">
							<!-- All Orders Title -->
							<div class="block-title">
								<h2><strong id="title-data-demo">Show demo data</strong></h2>
							</div>
							<div id="grid-demo">

							</div>
							<!-- END All Orders Content -->
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal"><i
									class="far fa-times"></i> Cancel
						</button>
						<button type="button" onclick="upload_file()" class="btn btn-warning"><i
									class="far fa-upload"></i> Upload file
						</button>
						<button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Save</button>
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
		   title="Insert serial"><i class="far fa-plus-hexagon"></i> Insert detail</a>
	</script>
	<script>

		$(document).ready(function () {
			init_filter_date();
			$('#mem_filter').kendoDropDownList();
			init_grid();
		});
		let el_form_add = $('#add_table_form');
		let el_title_data_demo = $('#title-data-demo');

		function show_model_insert() {
			el_form_add[0].reset();
			$('#add_table_model').modal('show');
			el_title_data_demo.text('Show data demo');
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
						url: '/clone/<?=$tbl_name?>/report-detail/insert.html',
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
								if (d?.insert?.exists !== undefined) {
									el_title_data_demo.text('Data trùng uid Không insert được');
									grid_demo.setDataSource(d?.data);
									grid_demo.refresh();
								} else {
									$('#add_table_model').modal('hide');
								}
							} else {
								// load lỗi
								alert_error(d.error)
							}
							NProgress.done();
							$("#grid").data("kendoGrid").dataSource.read();

						},
						error: function () {
							alert_error('Lỗi trong quá trình insert, có thể trùng uid');
							NProgress.done();
						}
					});


				} else if (result.dismiss === Swal.DismissReason.cancel) {
					swalWithBootstrapButtons.fire(
						'Ok hủy!',
						'Your data is safe!',
						'error'
					)
				}
			})

		})

		$('#mem_filter').on('change', function (event) {
			event.preventDefault();
			/* Act on the event */
			$("#grid").data("kendoGrid").dataSource.read();
		});

		function upload_file() {
			let fileInput = $('#file_serial')[0].files[0];
			const reader = new FileReader();
			reader.onload = function (e) {
				let contents = e.target.result;
				let data = parseFileContents(contents);
				renderGrid(data);
			};

			reader.readAsText(fileInput);
		}

		function parseFileContents(contents) {
			let rows = contents.split('\n');
			let data = [];
			let i = 1;
			rows.forEach(function (row) {
				if (row.trim() !== '') {
					let columns = row.split('|');
					if (columns.length !== 4) {
						alert_error(`Sai định dạng file import ở cột ${i}`);
					}
					let rowData = {
						count: i++,
						f_uid: columns[0].trim(),
						pass: columns[1].trim(),
						cookie: columns[2].trim(),
						mod: columns[3].trim(),
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
				toolbar: ["excel"],
				pageable: true,
				columns: [
					{field: 'count', title: '#'},
					{field: 'f_uid', title: 'uid'},
					{field: 'pass', title: 'pass'},
					{field: 'cookie', title: 'cookie'},
					{field: 'mod', title: 'mod'},
				]
			});
		}

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
							url: "<?= base_url('clone/' . $tbl_name . '/report-detail/get-grid.html') ?>",
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
					sort: {field: "created_time", dir: "desc"},
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
						field: "geo",
						title: "geo",
						width: 60,
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

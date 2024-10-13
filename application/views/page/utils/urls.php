<!-- Page content -->
<div id="page-content">
	<div class="content-header">
		<div class="header-section">
			<h1>
				<i class="gi gi-briefcase"></i>Urls download<br>
				<small>List url download</small>
			</h1>
		</div>
	</div>
	<!-- START Grid Block -->
	<div class="block full">
		<!-- All Orders Title -->
		<div class="block-title">
			<h2><strong>List</strong> url</h2>
		</div>
		<!-- END All Orders Title -->
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
					<h5 class="modal-title" id="edit_record">Edit url</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="edit_form" class="form-horizontal">
					<div class="modal-body">
						<input type="hidden" id="id_file_edit" value="">
						<div class="form-group">
							<label class="col-md-3 control-label" for="name_file_edit">Name</label>
							<div class="col-md-9">
								<input type="text" width="100%" class="form-control" placeholder=""
									   name="name_file_edit"
									   id="name_file_edit">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label" for="url_file_edit">Url file</label>
							<div class="col-md-9">
								<textarea type="" cols="3" class="form-control" placeholder="" name="url_file_edit"
										  id="url_file_edit"></textarea>
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
	<div class="modal fade" id="add_modal" role="dialog" aria-labelledby="add_record"
		 aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="add_record">Add url</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="add_form" class="form-horizontal">
					<div class="modal-body">
						<div class="form-group">
							<label class="col-md-3 control-label" for="name_file_add">Name</label>
							<div class="col-md-9">
								<input type="text" width="100%" class="form-control" placeholder="" name="name_file_add"
									   id="name_file_add">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label" for="url_file_add">Url file</label>
							<div class="col-md-9">
								<textarea type="" cols="3" class="form-control" placeholder="" name="url_file_add"
										  id="url_file_add"></textarea>
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
		   title="Thêm url"><i class="far fa-plus-hexagon"></i> Thêm url</a>
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

		async function edit_data(id) {
			await el_form_edit[0].reset();
			let dataUrl = await getOne(id);
			if (dataUrl !== '') {
				$('#name_file_edit').val(dataUrl.name);
				$('#url_file_edit').val(dataUrl.url);
				$('#id_file_edit').val(dataUrl.id);
				$('#edit_model').modal('show');

			}
		}

		let el_form_add = $('#add_form');

		function show_model_add() {
			el_form_add[0].reset();
			$('#add_modal').modal('show');
		}

		el_form_add.on('submit', function (e) {
			e.preventDefault();
			let input_name = $('#name_file_add').val();
			let input_url = $('#url_file_add').val();
			if (isNullorEmpty(input_name)) {
				alert_error('Empty name file');
				return;
			}
			if (isNullorEmpty(input_url)) {
				alert_error('Empty file url');
				return;
			}
			let data_add = {
				name: input_name,
				url: input_url
			};
			swalWithBootstrapButtons.fire({
				title: `Confirm?`,
				width: 600,
				html: `Add url ?`,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Ok 👌!',
				cancelButtonText: 'Cancel!',
				reverseButtons: true
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: '/urls-download/add.html',
						type: 'POST',
						dataType: 'json',
						data: {
							data: JSON.stringify(data_add)
						},
						beforeSend: function () {
							NProgress.start();
						},
						success: function (d) {
							if (d.status === "<?= StatusResponse::_SUCCESS ?>") {
								swalWithBootstrapButtons.fire(
									'Success',
									`Add success url`,
									'success'
								)
								$('#insert_report_modal').modal('hide');
							} else {
								// load lỗi
								alert_error(d.error)
							}
							$('#add_modal').modal('hide');
							el_form_add[0].reset();
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


		el_form_edit.on('submit', function (e) {
			e.preventDefault();
			let input_name = $('#name_file_edit').val();
			let input_url = $('#url_file_edit').val();
			let input_id = $('#id_file_edit').val();
			if (isNullorEmpty(input_name)) {
				alert_error('Empty name file');
				return;
			}
			if (isNullorEmpty(input_url)) {
				alert_error('Empty file url');
				return;
			}
			if (isNullorEmpty(input_id)) {
				alert_error('Invalid edit file');
				return;
			}
			let data_add = {
				name: input_name,
				url: input_url,
				id: input_id
			};
			swalWithBootstrapButtons.fire({
				title: `Confirm?`,
				width: 600,
				html: `Update url ?`,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Ok 👌!',
				cancelButtonText: 'Cancel!',
				reverseButtons: true
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: '/urls-download/update.html',
						type: 'POST',
						dataType: 'json',
						data: {
							data: JSON.stringify(data_add)
						},
						beforeSend: function () {
							NProgress.start();
						},
						success: function (d) {
							if (d.status === "<?= StatusResponse::_SUCCESS ?>") {
								swalWithBootstrapButtons.fire(
									'Success',
									`Update success url`,
									'success'
								)
								$('#insert_report_modal').modal('hide');
							} else {
								// load lỗi
								alert_error(d.error)
							}
							NProgress.done();
							$("#grid").data("kendoGrid").dataSource.read();
							el_form_edit[0].reset();
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
						url: "/urls-download/delete.html",
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
								alert_error(!isNullorEmpty(msgErr) ? msgErr : 'Lỗi khi xoá');
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
					url: '/urls-download/get-one.html',
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

				let dataUrl = response?.data;
				if (!isNullorEmpty(dataUrl)) {
					console.log(dataUrl);
					responseData = dataUrl;
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

		function init_filter_date() {
			let endDate = new Date();
			let startDate = new Date();

			if (endDate.getDate() > 5) {
				startDate.setDate(endDate.getDate() - 5);
			} else {
				startDate.setDate(1);
			}

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
							url: "/urls-download/get-grid.html",
							dataType: "json",
							type: "POST",
							data: function (a) {
								let start_date_filter = $('#date_start_filter').val();
								let end_date_filter = $('#date_end_filter').val();

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
					serverAggregates: false,
					sort: {field: "created_time", dir: "desc"},
					schema: {
						data: "data", // records are returned in the "data" field of the response
						total: "total", // total number of records is in the "total" field of the response
						id: "id",
						model: {
							fields: {
								name: {type: "string"},
								url: {type: "string"},
								created_time: {type: "string"},
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
						title: "Thao tác",
						width: 70,
						template: kendo.template($("#funcGrid").html())
					},
					{
						field: "name",
						title: "Url name",
						width: 220,
					},
					{
						field: "url",
						title: "Url",
						width: 300,
						template: function (dataItems) {
							return `<a target="_blank" id="externalLink" title="${dataItems.url}" href="${dataItems.url}"><i class='far fa-link'></i> ${dataItems.url}</a>`
						}
					}
				]
			});
		}


	</script>

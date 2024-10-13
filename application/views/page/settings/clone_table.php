<!-- Page content -->
<div id="page-content">
	<div class="content-header">
		<div class="header-section">
			<h1>
				<i class="gi gi-briefcase"></i>Clone table management<br>
				<small>Clone table management</small>
			</h1>
		</div>
	</div>

	<!-- START Grid Block -->
	<div class="block full">
		<!-- All Orders Title -->
		<div class="block-title">
			<h2><strong>Table list</strong></h2>
		</div>
		<div id="grid">

		</div>
		<!-- END All Orders Content -->
	</div>
	<!-- END Grid Block -->
	<!-- END Grid Block -->
	<div class="modal fade" id="add_table_model" tabindex="-1" role="dialog" aria-labelledby="add_table"
		 aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="add_table">Add table</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="add_table_form" class="form-horizontal">
					<div class="modal-body">
						<div class="form-group">
							<label class="col-md-3 control-label" for="name_show">Name</label>
							<div class="col-md-9">
								<input type="text" class="form-control" placeholder="" name="name_show"
									   id="name_show">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label" for="table_name">Table name</label>
							<div class="col-md-9">
								<input type="text" class="form-control" placeholder="" name="table_name"
									   id="table_name">
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
		   title="Add table"><i class="fa fa-plus-hexagon"></i> Add table</a>
	</script>

	<script id="funcGrid" type="text/x-kendo-template">
		<div class="btn-group-vertical btn-group-xs">
			<a href="javascript:void(0)" onclick="drop_table('#=tbl_name#')" class="btn btn-sm btn-warning"
			   title="Delete data"><i
					class="far fa-trash-alt"></i> Xoá data</a>
			<a href="javascript:void(0)" onclick="delete_table('#=tbl_name#')" class="btn btn-sm btn-danger"
			   title="Delete table"><i
					class="far fa-trash-restore-alt"></i> Xoá bảng</a>
			<a href="javascript:void(0)" onclick="download_table('#=tbl_name#')" class="btn btn-sm btn-success"
			   title="Download table"><i
					class="far fa-download"></i> Tải bảng</a>
		</div>
	</script>

	<script>

		$( document ).ready( function () {
			init_grid();

		} );
		let el_form_add = $( '#add_table_form' );

		function drop_table( tbl_name ) {
			swalWithBootstrapButtons.fire( {
				title: `Confirm?`,
				width: 600,
				html: `Table ${ tbl_name } will delete all data?`,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Ok 👌!',
				cancelButtonText: 'Cancel!',
				reverseButtons: true
			} ).then( ( result ) => {
				if ( result.isConfirmed ) {
					$.ajax( {
						url: '/create-clone-table/drop-data.html',
						type: 'POST',
						dataType: 'json',
						data: {
							'tbl_name': tbl_name
						},
						beforeSend: function () {
							NProgress.start();
						},
						success: function ( d ) {
							if ( d.status === "<?= StatusResponse::_SUCCESS ?>" ) {
								swalWithBootstrapButtons.fire(
									'Success',
									`Table ${ tbl_name } was deleted all data`,
									'success'
								)
								$( '#grid' ).data( 'kendoGrid' ).dataSource.read();
								$( '#add_table_model' ).modal( 'hide' );
							} else {
								// load lỗi
								alert_error( d.error )
							}
							NProgress.done();
							$( "#grid" ).data( "kendoGrid" ).dataSource.read();
						},
						error: function ( xhr, status, error ) {
							// Handle error
							alert_error( `${ status } - Bạn không có quyền truy cập` );
							NProgress.done();
						}
					} );


				} else if ( result.dismiss === Swal.DismissReason.cancel ) {
					swalWithBootstrapButtons.fire(
						'Ok hủy!',
						'Suy nghĩ lại rồi à?🙂',
						'error'
					)
				}
			} )
		}


		function download_table( tbl_name ) {
			swalWithBootstrapButtons.fire( {
				title: `Confirm?`,
				width: 600,
				html: `Download all data of table ${ tbl_name } ?`,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Ok 👌!',
				cancelButtonText: 'Cancel!',
				reverseButtons: true
			} ).then( ( result ) => {
				if ( result.isConfirmed ) {
					$.ajax( {
						url: '/create-clone-table/download-table-buffer.html',
						type: 'POST',
						data: {
							'tbl_name': tbl_name
						},
						beforeSend: function () {
							NProgress.start();
						},
						success: function ( d ) {
							swalWithBootstrapButtons.fire(
								'Success',
								`Downloaded data of table ${ tbl_name } `,
								'success'
							)
							let blob = new Blob( [ d ], { type: 'text/csv' } );
							let link = document.createElement( 'a' );
							link.href = window.URL.createObjectURL( blob );
							link.download = tbl_name+'_data.csv';
							document.body.appendChild( link );
							link.click();
							document.body.removeChild( link );
							NProgress.done();
						},
						error: function ( xhr, status, error ) {
							// Handle error
							alert_error( `${ status } - Bạn không có quyền truy cập` );
							NProgress.done();
						}
					} );


				} else if ( result.dismiss === Swal.DismissReason.cancel ) {
					swalWithBootstrapButtons.fire(
						'Ok hủy!',
						'Suy nghĩ lại rồi à?🙂',
						'error'
					)
				}
			} )
		}

		function delete_table( tbl_name ) {
			swalWithBootstrapButtons.fire( {
				title: `Confirm?`,
				width: 600,
				html: `Table ${ tbl_name } will be deleted table and eraser all data?`,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Ok 👌!',
				cancelButtonText: 'Cancel!',
				reverseButtons: true
			} ).then( ( result ) => {
				if ( result.isConfirmed ) {
					$.ajax( {
						url: '/create-clone-table/delete-table.html',
						type: 'POST',
						dataType: 'json',
						data: {
							'tbl_name': tbl_name
						},
						beforeSend: function () {
							NProgress.start();
						},
						success: function ( d ) {
							if ( d.status === "<?= StatusResponse::_SUCCESS ?>" ) {
								swalWithBootstrapButtons.fire(
									'Success',
									`Table ${ tbl_name } and all data was deleted`,
									'success'
								)
								$( '#grid' ).data( 'kendoGrid' ).dataSource.read();
								$( '#add_table_model' ).modal( 'hide' );
							} else {
								// load lỗi
								alert_error( d.error )
							}
							NProgress.done();
							$( "#grid" ).data( "kendoGrid" ).dataSource.read();
						},
						error: function ( xhr, status, error ) {
							// Handle error
							alert_error( `${ status } - Bạn không có quyền truy cập` );
							NProgress.done();
						}
					} );


				} else if ( result.dismiss === Swal.DismissReason.cancel ) {
					swalWithBootstrapButtons.fire(
						'Ok hủy!',
						'Suy nghĩ lại rồi à?🙂',
						'error'
					)
				}
			} )
		}

		function show_model_add() {
			el_form_add[0].reset();
			$( '#add_table_model' ).modal( 'show' );
		}

		//create-clone-table/add.html
		el_form_add.on( 'submit', function ( e ) {
			e.preventDefault();
			let el_name_show = $( '#name_show' );
			let el_table_name = $( '#table_name' );
			if ( el_table_name.val().length > 30 ) {
				alert_error( 'Table name length can\'t over 30' );
				return;
			}
			if ( el_name_show.val().length > 30 ) {
				alert_error( 'Name show length can\'t over 30' );
				return;
			}
			let re = /^[a-zA-Z_][a-zA-Z0-9_]*$/;
			if ( !re.test( el_table_name.val() ) ) {
				alert_error( 'Table name invalid' );
				return;
			}

			let data_submit = {
				name_show: el_name_show.val(),
				tbl_name: el_table_name.val()
			}
			swalWithBootstrapButtons.fire( {
				title: `Confirm?`,
				width: 600,
				html: `Table ${ data_submit.tbl_name } will create?`,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Ok 👌!',
				cancelButtonText: 'Cancel!',
				reverseButtons: true
			} ).then( ( result ) => {
				if ( result.isConfirmed ) {
					$.ajax( {
						url: '/create-clone-table/add.html',
						type: 'POST',
						dataType: 'json',
						data: data_submit,
						beforeSend: function () {
							NProgress.start();
						},
						success: function ( d ) {
							if ( d.status === "<?= StatusResponse::_SUCCESS ?>" ) {
								swalWithBootstrapButtons.fire(
									'Success',
									`Table ${ data_submit.tbl_name } was created`,
									'success'
								)
								$( '#grid' ).data( 'kendoGrid' ).dataSource.read();
								$( '#add_table_model' ).modal( 'hide' );
							} else {
								// load lỗi
								alert_error( d.error )
							}
							NProgress.done();
							$( "#grid" ).data( "kendoGrid" ).dataSource.read();
						},
						error: function ( xhr, status, error ) {
							// Handle error
							alert_error( `${ status } - Bạn không có quyền truy cập` );
							NProgress.done();
						}
					} );


				} else if ( result.dismiss === Swal.DismissReason.cancel ) {
					swalWithBootstrapButtons.fire(
						'Ok hủy!',
						'Suy nghĩ lại rồi à?🙂',
						'error'
					)
				}
			} )

		} )

		function init_grid() {
			$( "#grid" ).kendoGrid( {
				dataSource: {
					transport: {
						read: {
							url: "<?= base_url('create-clone-table/get-grid.html') ?>",
							dataType: "json",
							type: "POST",
							data: function ( a ) {
								return {
									filters: JSON.stringify( a )
								}
							},
							complete: function ( d ) {
							},
							error: function ( xhr, status, error ) {
								// Handle error
								alert_error( `${ status } - Bạn không có quyền truy cập` );
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
					pageSize: 200,
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
								name: { type: "string" },
								tbl_name: { type: "string" },
								count: { type: "number" },
								created_time: { type: "string" },
							}
						}
					},// enable server paging
				},
				sortable: true,
				toolbar: [
					{
						template: kendo.template( $( "#toolbarGrid" ).html() )
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
						template: kendo.template( $( "#funcGrid" ).html() )
					},
					{
						field: "name",
						title: "Name",
						width: 120,
					},
					{
						field: "tbl_name",
						title: "Table name",
						width: 120,
					},
					{
						field: "count",
						title: "Count",
						width: 90,
						template: "#= kendo.toString(count, `n0`)#",
					},
					{
						field: "created_time",
						title: "Create time",
						filterable: false,
						width: 180,
					},
				]
			} );
		}

	</script>

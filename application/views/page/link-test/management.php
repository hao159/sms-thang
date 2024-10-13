<!-- Page content -->
<div id="page-content">
	<div class="content-header">
		<div class="header-section">
			<h1>
				<i class="gi gi-briefcase"></i>Link test<br>
				<small>List link test</small>
			</h1>
		</div>
	</div>
	<!-- START Grid Block -->
	<div class="block full">
		<!-- All Orders Title -->
		<div class="block-title">
			<h2><strong>List</strong> link test</h2>
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
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="edit_record">Edit Link test</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="edit_form" class="form-horizontal">
					<div class="modal-body">
						<input type="hidden" id="id_edit" value="">
						<input type="hidden" id="is_edit_data" value="">
						<div class="form-group">
							<label class="col-md-3 control-label" for="name_file_edit">Name</label>
							<div class="col-md-9">
								<input type="text" width="100%" class="form-control" placeholder=""
									   name="name_file_edit"
									   id="name_file_edit">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label" for="url_link_test_edit">Link test</label>
							<div class="col-md-9">
								<input type="url" width="100%" class="form-control" placeholder=""
									   name="url_link_test_edit"
									   id="url_link_test_edit">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label" for="file_link_edit">File</label>
							<div class="col-md-9">
								<input type="file" class="form-control" placeholder="" name="file_link_edit"
									   accept=".txt"
									   id="file_link_edit">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label"></label>
							<div class="col-md-9">
								<div class="checkbox">
									<label for="add-check-valid-vn-phone_edit" title="">
										<input type="checkbox" id="add-check-valid-vn-phone_edit"
											   name="add-check-valid-vn-phone_edit"
											   value="add-check-vn-phone"> Kiểm tra SĐT VN trong file
									</label>
								</div>
							</div>
						</div>

						<div class="block full">
							<!-- All Orders Title -->
							<div class="block-title">
								<h2><strong>Isdn list</strong></h2>
							</div>
							<div id="grid-edit">

							</div>
							<!-- END All Orders Content -->
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						<button type="button" onclick="upload_file_edit()" class="btn btn-warning">(1) Upload file
						</button>
						<button type="submit" class="btn btn-primary">(2) Save</button>
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
					<h5 class="modal-title" id="add_record">Add Link test </h5>
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
							<label class="col-md-3 control-label" for="url_link_test">Link test</label>
							<div class="col-md-9">
								<input type="url" width="100%" class="form-control" placeholder="" name="url_link_test"
									   id="url_link_test">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label" for="file_link">File</label>
							<div class="col-md-9">
								<input type="file" class="form-control" placeholder="" name="file_link" accept=".txt"
									   id="file_link">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label"></label>
							<div class="col-md-9">
								<div class="checkbox">
									<label for="add-check-valid-vn-phone" title="">
										<input type="checkbox" id="add-check-valid-vn-phone"
											   name="add-check-valid-vn-phone"
											   value="add-check-vn-phone"> Kiểm tra SĐT VN trong file
									</label>
								</div>
							</div>
						</div>

						<div class="block full">
							<!-- All Orders Title -->
							<div class="block-title">
								<h2><strong>Isdn list</strong></h2>
							</div>
							<div id="grid-demo">

							</div>
							<!-- END All Orders Content -->
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						<button type="button" onclick="upload_file()" class="btn btn-warning">(1) Upload file
						</button>
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
		   title="Thêm url"><i class="far fa-plus-hexagon"></i> Thêm Link test</a>
	</script>
	<script id="toolbarExportTxt" type="text/x-kendo-template">
		<a href="javascript:void(0)" onclick="export_isdn_txt_grid_edit()"
		   class="k-button custom-grid-toolbar btn-grid-toolbar-success"
		   title="Xuất txt Isdn"><i class="far fa-file-export"></i> Xuất txt Isdn</a>
	</script>
	<script id="funcGrid" type="text/x-kendo-template">
		<div class="btn-group btn-group-xs">
			<a href="javascript:void(0)" onclick="delete_data('#=id#', '#=name#')" class="btn btn-sm btn-danger"
			   title="Delete"><i
					class="far fa-trash-alt"></i> Xoá</a>
			<a href="javascript:void(0)" onclick="edit_data('#=id#')" class="btn btn-sm btn-default"
			   title="Edit"><i
					class="far fa-pencil"></i> Sửa</a>
		</div>
	</script>

	<script>

		$( document ).ready( function () {
			init_filter_date();

			$( '#mem_filter' ).kendoDropDownList();
			init_grid();


		} );
		const el_grid_edit = $( '#grid-edit' );

		function upload_file() {
			let fileInput = $( '#file_link' )[0].files[0];
			let fileName = fileInput.name;
			let isCheckVNPhone = $( '#add-check-valid-vn-phone' ).is( ':checked' );

			const reader = new FileReader();
			reader.onload = function ( e ) {
				let contents = e.target.result;
				let data = parseFileContents( contents, fileName, isCheckVNPhone );
				renderGrid( data );
			};

			reader.readAsText( fileInput );
		}

		function upload_file_edit() {
			swalWithBootstrapButtons.fire( {
				title: `Xác nhận?`,
				width: 600,
				html: `Việc upload file mới sẽ làm mất hết dữ liệu cũ sau khi lưu ?`,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Ok 👌!',
				cancelButtonText: 'Cancel!',
				reverseButtons: true
			} ).then( ( result ) => {
				if ( result.isConfirmed ) {
					let fileInput = $( '#file_link_edit' )[0].files[0];
					let fileName = fileInput.name;
					let isCheckVNPhone = $( '#add-check-valid-vn-phone_edit' ).is( ':checked' );

					const reader = new FileReader();
					reader.onload = function ( e ) {
						let contents = e.target.result;
						let data = parseFileContents( contents, fileName, isCheckVNPhone );
						renderGridEdit( data );
					};

					reader.readAsText( fileInput );
				}
			} )
		}


		function parseFileContents( contents, fileName, isCheckVNPhone = false ) {
			let rows = contents.split( '\n' );
			let data = [];
			let i = 1;
			rows.forEach( function ( row ) {
				if ( row.trim() !== '' ) {
					let rowData = {
						count: i++,
						isdn: row.trim(),
						fileName: fileName
					};
					if ( isCheckVNPhone ) {
						if ( validVNPhoneNumber( rowData.isdn ) ) {
							data.push( rowData );
						}
					} else {
						data.push( rowData );
					}
				}
			} );

			return data;
		}

		function renderGridEdit( data ) {
			var grid = el_grid_edit.data( 'kendoGrid' );
			if ( grid ) {
				grid.destroy();
				el_grid_edit.empty(); // Clear the grid container
			}
			$( '#is_edit_data' ).val( 1 )
			el_grid_edit.kendoGrid( {
				dataSource: {
					data: data,
					pageSize: 5,
					page: 1
				},
				pageable: true,
				noRecords: {
					template: "<h2 class='text-center'>Không có dữ liệu.</h2>"
				},
				columns: [
					{ field: 'count', title: '#' },
					{ field: 'isdn', title: 'isdn' },
					{ field: 'fileName', title: 'File Name' }
				]
			} );
		}

		function renderGrid( data ) {
			$( '#grid-demo' ).kendoGrid( {
				dataSource: {
					data: data,
					pageSize: 5,
					page: 1
				},
				pageable: true,
				noRecords: {
					template: "<h2 class='text-center'>Không có dữ liệu.</h2>"
				},
				columns: [
					{ field: 'count', title: '#' },
					{ field: 'isdn', title: 'isdn' },
					{ field: 'fileName', title: 'File Name' }
				]
			} );
		}

		let el_form_edit = $( '#edit_form' );


		async function edit_data( id ) {
			await el_form_edit[0].reset();
			let dataUrl = await getOne( id );
			if ( dataUrl !== '' ) {
				$( '#is_edit_data' ).val( 0 )
				$( '#name_file_edit' ).val( dataUrl.name );
				$( '#url_link_test_edit' ).val( dataUrl.link );
				$( '#id_edit' ).val( dataUrl.id );
				var grid = el_grid_edit.data( 'kendoGrid' );
				if ( grid ) {
					grid.destroy();
					el_grid_edit.empty(); // Clear the grid container
				}
				el_grid_edit.kendoGrid( {
					dataSource: {
						data: dataUrl?.detail ?? [],
						pageSize: 5,
						page: 1,
						schema: {
							model: {
								id: "id",
								fields: {
									id: { type: "number", editable: false, nullable: true },
									count: { type: "number", editable: false, nullable: true },
									isdn: { type: "string", validation: { required: true } },
									used_times: { type: "number", editable: false },
									createOn: { type: "date", editable: false },
									modifyOn: { type: "date", editable: false }
								}
							}
						},
					},
					noRecords: {
						template: "<h2 class='text-center'>Không tìm thấy dữ liệu phù hợp.</h2>"
					},
					pageable: true,
					editable: "inline", // Enables inline editing
					toolbar: [
						"create",
						{
							template: kendo.template( $( "#toolbarExportTxt" ).html() )
						},
						"excel"
					],
					excel: {
						allPages: true
					},
					columns: [
						{ field: 'id', title: '#', width: '50px', hidden: true },
						{ field: 'count', title: '#', width: '50px' },
						{ field: 'isdn', title: 'Phone Number' },
						{ field: 'used_times', title: 'Số lần test' },
						{ field: 'createOn', title: 'Thêm lúc', format: "{0:MM/dd/yyyy}" },
						{ field: 'modifyOn', title: 'Sửa lúc', format: "{0:MM/dd/yyyy}" },
						{
							command: [ "edit", "destroy" ], // Adds Edit and Delete buttons
							title: "&nbsp;",
							width: "200px"
						}
					]
				} );

				$( '#edit_model' ).modal( 'show' );
			}
		}

		function export_isdn_txt_grid_edit() {
			//export_isdn_txt_grid_edit
			let grid = el_grid_edit.data( 'kendoGrid' );
			if ( grid ) {
				let data = grid.dataSource.data();
				let isdnList = data.map( item => item.isdn ).join( '\n' );
				let blob = new Blob( [ isdnList ], { type: 'text/plain' } );
				let url = URL.createObjectURL( blob );
				let a = document.createElement( 'a' );
				a.href = url;
				a.download = 'isdn_list.txt';
				document.body.appendChild( a );
				a.click();
				window.URL.revokeObjectURL( url );
			} else {
				alert_error( 'Không có dữ liệu để xuất' );
			}
		}


		let el_form_add = $( '#add_form' );

		function show_model_add() {
			el_form_add[0].reset();
			$( '#add_modal' ).modal( 'show' );
		}

		el_form_add.on( 'submit', function ( e ) {
			e.preventDefault();
			let input_name = $( '#name_file_add' ).val();
			let input_url = $( '#url_link_test' ).val();

			const grid_demo = $( '#grid-demo' ).data( 'kendoGrid' );
			if ( grid_demo === undefined ) {
				alert_error( 'Vui lòng insert file' );
				return;
			}
			let dataSource_demo = grid_demo.dataSource;
			if ( dataSource_demo === undefined ) {
				alert_error( 'Vui lòng insert file' );
				return;
			}
			let data_demo = dataSource_demo.data();
			if ( data_demo === undefined || data_demo.length === 0 ) {
				alert_error( 'Vui lòng upload đúng file' );
				return;
			}

			let fileInput = $( '#file_link' )[0].files[0];
			let fileName = fileInput?.name ?? '';
			if ( isNullorEmpty( input_name ) ) {
				alert_error( 'Empty name file' );
				return;
			}
			if ( isNullorEmpty( input_url ) ) {
				alert_error( 'Empty file url' );
				return;
			}
			if ( isNullorEmpty( fileName ) ) {
				alert_error( 'Empty file' );
				return;
			}

			let data_add = {
				name: input_name,
				url: input_url,
				file_name: fileName,
				data_demo: data_demo
			};
			swalWithBootstrapButtons.fire( {
				title: `Confirm?`,
				width: 600,
				html: `Đồng ý thêm ${ data_add.name } với ${ data_add.data_demo.length } số điện thoại?`,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Ok 👌!',
				cancelButtonText: 'Cancel!',
				reverseButtons: true
			} ).then( ( result ) => {
				if ( result.isConfirmed ) {
					$.ajax( {
						url: '/management-link-test/add.html',
						type: 'POST',
						dataType: 'json',
						data: {
							data: JSON.stringify( data_add )
						},
						beforeSend: function () {
							NProgress.start();
						},
						success: function ( d ) {
							if ( d.status === "<?= StatusResponse::_SUCCESS ?>" ) {
								swalWithBootstrapButtons.fire(
									'Success',
									`Add success url`,
									'success'
								)
							} else {
								// load lỗi
								alert_error( d.error )
							}
							$( '#add_modal' ).modal( 'hide' );
							el_form_add[0].reset();
							NProgress.done();
							$( "#grid" ).data( "kendoGrid" ).dataSource.read();
							//empty grid demo
							let grid_demo = $( '#grid-demo' ).data( 'kendoGrid' );
							grid_demo.dataSource.data( [] );
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


		el_form_edit.on( 'submit', function ( e ) {
			e.preventDefault();
			let input_name = $( '#name_file_edit' ).val();
			let input_url = $( '#url_link_test_edit' ).val();
			let input_id = $( '#id_edit' ).val();
			let is_edit_data = $( '#is_edit_data' ).val();
			if ( isNullorEmpty( input_name ) ) {
				alert_error( 'Empty name' );
				return;
			}
			if ( isNullorEmpty( input_url ) ) {
				alert_error( 'Empty link test' );
				return;
			}
			if ( isNullorEmpty( input_id ) ) {
				alert_error( 'Invalid edit id' );
				return;
			}
			let data_edit = {
				id: input_id,
				name: input_name,
				url: input_url,
			};
			if ( is_edit_data === '1' ) {
				let fileInput = $( '#file_link_edit' )[0].files[0];
				let fileName = fileInput?.name ?? '';
				//upload file mới
				if ( isNullorEmpty( fileName ) ) {
					alert_error( 'Empty file' );
					return;
				}
				data_edit.file_name = fileName;
			}
			let grid = el_grid_edit.data( 'kendoGrid' );
			if ( grid ) {
				let dataSource = grid.dataSource;
				if ( dataSource ) {
					let data = dataSource.data();
					if ( data ) {
						data_edit.data_demo = data;
					}
				}
			}

			swalWithBootstrapButtons.fire( {
				title: `Confirm?`,
				width: 600,
				html: `Đồng ý sửa ${ data_edit.name } với ${ data_edit.data_demo?.length ?? 0 } số điện thoại?`,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Ok!',
				cancelButtonText: 'Cancel!',
				reverseButtons: true
			} ).then( ( result ) => {
				if ( result.isConfirmed ) {
					$.ajax( {
						url: '/management-link-test/update.html',
						type: 'POST',
						dataType: 'json',
						data: {
							data: JSON.stringify( data_edit )
						},
						beforeSend: function () {
							NProgress.start();
						},
						success: function ( d ) {
							if ( d.status === "<?= StatusResponse::_SUCCESS ?>" ) {
								swalWithBootstrapButtons.fire(
									'Success',
									`Update success`,
									'success'
								)
							} else {
								// load lỗi
								alert_error( d.error )
							}
							$( '#edit_model' ).modal( 'hide' );
							el_form_edit[0].reset();
							NProgress.done();
							$( "#grid" ).data( "kendoGrid" ).dataSource.read();
							//empty grid demo
							let grid_demo = el_grid_edit.data( 'kendoGrid' );
							grid_demo.dataSource.data( [] );
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
						'Suy nghĩ lại rồi à?',
						'error'
					)
				}
			} )
		} )

		function delete_data( id ,name ) {
			swalWithBootstrapButtons.fire( {
				title: `Confirm?`,
				width: 600,
				html: `Bạn muốn xoá link test và data của ${ name }?`,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Ok 👌!',
				cancelButtonText: 'Cancel!',
				reverseButtons: true
			} ).then( ( result ) => {
				if ( result.isConfirmed ) {
					$.ajax( {
						url: "/management-link-test/delete.html",
						type: 'POST',
						dataType: 'json',
						data: {
							'id': id
						},
						beforeSend: function () {
							console.log( 'beforesend' );
							NProgress.start();
						},
						success: function ( response ) {
							NProgress.done();
							let status = response?.status;
							if ( !isNullorEmpty( status ) && status === '<?=StatusResponse::_SUCCESS?>' ) {
								alert_success( `Xoá thành công data ${ name }` );
								$( "#grid" ).data( "kendoGrid" ).dataSource.read();
							} else {
								let msgErr = response?.error;
								alert_error( !isNullorEmpty( msgErr ) ? msgErr : 'Lỗi khi xoá' );
							}
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

		async function getOne( id ) {
			let responseData = null;
			try {
				let response = await $.ajax( {
					url: '/management-link-test/get-one.html',
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
					error: function ( xhr, status, error ) {
						// Handle error
						alert_error( `${ status } - Bạn không có quyền truy cập` );
						NProgress.done();
					}
				} );

				let dataUrl = response?.data;
				if ( !isNullorEmpty( dataUrl ) ) {
					responseData = dataUrl;
				} else {
					let msgErr = response?.error;
					alert_error( !isNullorEmpty( msgErr ) ? msgErr : 'Lỗi khi load dữ liệu chỉnh sửa' );
				}
			} catch ( error ) {
				console.error( error );
				alert_error( 'Lỗi khi gửi yêu cầu lấy dữ liệu' );
			}

			return responseData;
		}

		function init_filter_date() {
			let endDate = new Date();
			let startDate = new Date();

			if ( endDate.getDate() > 5 ) {
				startDate.setDate( endDate.getDate() - 5 );
			} else {
				startDate.setDate( 1 );
			}

			$( '#date_start_filter' ).kendoDatePicker( {
				value: startDate,
				culture: "vi-VN",
				min: new Date( 2019, 0, 1 ),
				max: new Date(),
				format: "dd-MM-yyyy",
				change: function ( e ) {
					$( "#grid" ).data( "kendoGrid" ).dataSource.read();
				},
			} );
			$( '#date_end_filter' ).kendoDatePicker( {
				value: new Date(),
				culture: "vi-VN",
				min: new Date( 2019, 0, 1 ),
				max: new Date(),
				format: "dd-MM-yyyy",
				change: function ( e ) {
					$( "#grid" ).data( "kendoGrid" ).dataSource.read();

				},
			} );
		}

		function init_grid() {
			$( "#grid" ).kendoGrid( {
				dataSource: {
					transport: {
						read: {
							url: "/management-link-test/get-grid.html",
							dataType: "json",
							type: "POST",
							data: function ( a ) {
								return {
									filters: JSON.stringify( a )
								}
							},
							complete: function ( d ) {

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
						model: {
							fields: {
								link: { type: "string" },
								name: { type: "string" },
								txt: { type: "string" },
							}
						}
					}// enable server paging
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
						field: "link",
						title: "Link",
						width: 220,
					},
					{
						field: "name",
						title: "Name",
						width: 220,
					},
				]
			} );
		}


	</script>

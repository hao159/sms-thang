<!-- Page content -->
<div id="page-content">
	<div class="content-header">
		<div class="header-section">
			<h1>
				<i class="gi gi-briefcase"></i>Test ISDN<br>
				<small>Test ISDN</small>
			</h1>
		</div>
	</div>
	<div class="block full">
		<!-- All Orders Title -->
		<div class="block-title">
			<h2><strong>Chọn mục test</strong></h2>
		</div>
		<!-- END All Orders Title -->
		<!-- All Orders Content -->
		<div class="row form-horizontal">
			<div class="col-sm-12 col-lg-12">
				<div class="form-group">
					<label class="col-md-3 control-label" for="link_test">Chọn mục test</label>
					<div class="col-md-6">
						<select class="form-control" name="link_test" style="width: 100%" id="link_test">
							<?php
							if ($list_link_test) {
								foreach ($list_link_test as $key => $value) {
									echo '<option  value="' . $value['id'] . '">' . strtoupper($value['name']) . '</option>';
								}
							}
							?>
						</select>

					</div>
					<div class="col-md-3">
						<button class="btn btn-success" id="btn_test"><i class="far fa-send-o"></i>Get Test</button>
					</div>
				</div>
			</div>

		</div>
		<!-- END All Orders Content -->
	</div>
	<!-- START Grid Block -->
	<div class="block full">
		<!-- All Orders Title -->
		<div class="block-title">
			<h2><strong>List</strong> OTP test</h2>
		</div>
		<!-- END All Orders Title -->
		<!-- All Orders Content -->
		<div id="grid">

		</div>
		<!-- END All Orders Content -->
	</div>
	<!-- END Grid Block -->
	<div class="modal fade" id="list_otp_model" role="dialog" aria-labelledby="edit_record"
		 aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="list_otp_model_title">List OTP</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div id="grid-message">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				</div>
			</div>
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

	.countdown-timer {
		font-size: 16px;
		color: #fff;
		background-color: #f14242;
		border-radius: 5px;
		padding: 3px 10px;
		font-weight: 600;
		font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
	}

</style>
<script id="toolbarGrid" type="text/x-kendo-template">
	<a href="javascript:void(0)" onclick="exportTxt()"
	   class="k-button custom-grid-toolbar btn-grid-toolbar-success"
	   title="Delete data"><i class="far fa-file-export"></i> Export Txt</a>
</script>
<script id="toolbarGridMain" type="text/x-kendo-template">
	<a href="javascript:void(0)" onclick="readMsg('#=id#')"
	   class="k-button custom-grid-toolbar btn-grid-toolbar-success"
	   title=" Xem/Reload"><i class="far fa-envelope"></i> Xem/Reload</a>
</script>
<script !src="">
	$( document ).ready( function () {
		$( '#link_test' ).kendoDropDownList();
		init_grid()
	} );

	const el_model_list_otp = $( '#list_otp_model' );
	const el_grid_message = $( '#grid-message' );

	function initGridMessage( dataSource ) {
		el_grid_message.kendoGrid( {
			dataSource: {
				data: dataSource,
				pageSize: 5,
				page: 1
			},
			pageable: true,
			noRecords: {
				template: "<h2 class='text-center'>Không có dữ liệu.</h2>"
			},
			toolbar: [
				{
					template: kendo.template( $( "#toolbarGrid" ).html() )
				},
			],
			columns: [
				{ field: 'id', title: 'id' },
				{ field: 'isdn', title: 'Phone' },
				{ field: 'brand', title: 'Brand' },
				{ field: 'message', title: 'Message' },
			]
		} );
	}

	function exportTxt() {
		//export data split by | of this data source
		let grid = el_grid_message.data( 'kendoGrid' );
		if ( grid ) {
			let data = grid.dataSource.data();
			let exportData = data.map( function ( item ) {
				return `${ item.isdn }|${ item.brand }|${ item.message }`;
			} ).join( '\n' );
			let blob = new Blob( [ exportData ], { type: 'text/plain' } );
			let a = document.createElement( "a" );
			document.body.appendChild( a );
			a.style = "display: none";
			let url = window.URL.createObjectURL( blob );
			a.href = url;
			a.download = 'export.txt';
			a.click();
			window.URL.revokeObjectURL( url );
			document.body.removeChild( a );
			alert_success( 'Export thành công' );
		} else {
			alert_error( 'Không có dữ liệu để xuất' );
		}
	}

	$( "#btn_test" ).click( function () {
		let selected_test_id = $( '#link_test' ).val();
		//check empty
		if ( selected_test_id == '' ) {
			alert_error( 'Vui lòng chọn mục test' );
			return;
		}
		$.ajax( {
			url: "<?= base_url('test-isdn/get-rand-isdn.html') ?>",
			type: "POST",
			dataType: "JSON",
			data: {
				id: selected_test_id
			},
			success: function ( data ) {
				if ( data.status == '<?=StatusResponse::_SUCCESS ?>' ) {
					alert_success( data.data?.message );
					init_grid();
				} else {
					alert_error( data?.error );
				}
			},
			error: function ( jqXHR, textStatus, errorThrown ) {
				alert_error( 'Lỗi hệ thống' );
			}
		} );
	} );

	function readMsg( id ) {
		$.ajax( {
			url: "<?= base_url('test-isdn/check-update.html') ?>",
			type: "POST",
			data: { id: id }, // Send id of the record
			dataType: "json",
			success: function ( response ) {
				el_model_list_otp.modal( 'show' );
				el_grid_message.empty();
				initGridMessage( response.data?.data );
				if ( response.is_update ) {
					$( "#grid" ).data( "kendoGrid" ).dataSource.read();
				}
			}
		} );
	}

	function init_grid() {
		let gridElement = $( "#grid" ).kendoGrid( {
			dataSource: {
				transport: {
					read: {
						url: "<?= base_url('test-isdn/get-grid.html') ?>",
						dataType: "json",
						type: "POST",
						data: function ( a ) {
							return {
								filters: JSON.stringify( a )
							};
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
				pageSize: 30,
				serverPaging: true,
				serverSorting: true,
				serverFiltering: true,
				serverAggregates: false,
				sort: { field: "createOn", dir: "desc" },
				schema: {
					data: "data",
					total: "total",
					id: "id",
					model: {
						fields: {
							isdn: { type: "string" },
							id_link_test: { type: "string" },
							user: { type: "string" },
							name: { type: "string" },
							status: { type: "number" },
							message: { type: "string" },
							createOn: { type: "string" },
						}
					}
				}
			},
			sortable: true,
			toolbar: [
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
				{ field: "i", title: "#", width: 50, filterable: false, sortable: false },
				{
					title: "Chức năng",
					template: kendo.template( $( "#toolbarGridMain" ).html() ),
					width: 150,
					filterable: false,
					sortable: false
				},
				{ field: "name", title: "Mục test", width: 120 },
				{ field: "user", title: "Người test", width: 90 },
				{ field: "isdn", title: "Isdn", width: 90 },
				{ field: "message", title: "Status", width: 130, template: statusTemplate },
				{ field: "createOn", title: "Create time", filterable: false, width: 180 },
				{
					field: "countDown",
					title: "Count Down",
					width: 150,
					template: function ( dataItem ) {
						const timeDiff = calculateTimeDiff( dataItem.createOn );
						if ( timeDiff > 0 ) {
							return `<span class="countdown-timer" data-id="${ dataItem.id }" data-time-left="${ timeDiff }">${ formatTime( timeDiff ) }</span>`;
						} else {
							return "N/A";
						}
					}
				}
			],
			dataBound: function () {
				startCountdown();
				setInterval( function () {
					checkApiUpdate();
				}, 20000 ); // Trigger every 20 seconds
			}
		} );

		// Utility function to calculate time difference in seconds
		function calculateTimeDiff( createOn ) {
			const createTime = new Date( createOn ).getTime();
			const fiveMinutesLater = createTime + 5 * 60 * 1000; // 5 minutes in milliseconds
			const now = new Date().getTime();

			// Return the remaining time in seconds if we are within the 5 minute window
			if ( fiveMinutesLater > now ) {
				return Math.floor( ( fiveMinutesLater - now ) / 1000 ); // Difference in seconds
			}

			return 0; // N/A if the time difference is already exceeded
		}

		// Utility function to format seconds into mm:ss
		function formatTime( seconds ) {
			const minutes = Math.floor( seconds / 60 );
			const remainingSeconds = seconds % 60;
			return `${ minutes }:${ remainingSeconds < 10 ? '0' : '' }${ remainingSeconds }`;
		}

		// Start countdown timers
		function startCountdown() {
			$( ".countdown-timer" ).each( function () {
				const $this = $( this );
				let timeLeft = parseInt( $this.data( "time-left" ), 10 );
				if ( timeLeft > 0 ) {
					const intervalId = setInterval( function () {
						timeLeft--;
						$this.text( formatTime( timeLeft ) );
						if ( timeLeft <= 0 ) {
							$this.text( "N/A" );
							console.log( `Stop check update for Interval ID: ${ intervalId }` )
							clearInterval( intervalId );
						}
					}, 1000 );
				}
			} );
		}


		function checkApiUpdate() {
			const gridData = $( "#grid" ).data( "kendoGrid" ).dataSource.data();
			const idsToCheck = [];
			const currentUser = "<?=$this->session->userdata("User")?>"

			gridData.forEach( function ( dataItem ) {
				const timeDiff = calculateTimeDiff( dataItem.createOn );
				if ( timeDiff > 0 && dataItem.user === currentUser ) {
					idsToCheck.push( dataItem.id );
				}
			} );

			const concurrencyLimit = 3; // Maximum number of concurrent requests
			let index = 0;
			let activeRequests = 0;

			function processNext() {
				console.log( "activeRequests: ", activeRequests );
				// Start new requests while under the concurrency limit and more IDs are available
				while ( activeRequests < concurrencyLimit && index < idsToCheck.length ) {
					const id = idsToCheck[index++];
					activeRequests++;

					$.ajax( {
						url: "<?= base_url('test-isdn/check-update.html') ?>",
						type: "POST",
						data: { id: id },
						dataType: "json",
						success: function ( response ) {
							if ( response.is_update ) {
								$( "#grid" ).data( "kendoGrid" ).dataSource.read();
							}
						},
						error: function ( xhr, status, error ) {
							console.error( `Error checking update for ID ${ id }:`, error );
						},
						complete: function () {
							activeRequests--;

							processNext(); // Proceed to the next request when one completes
						}
					} );
				}
			}

			processNext(); // Start processing the first batch of requests
		}


		// Template for status
		function statusTemplate( dataItem ) {
			if ( dataItem.status == 0 ) {
				return `<span class="badge label-success">${ dataItem.message }</span>`;
			} else if ( dataItem.status == 1 ) {
				return `<span class="badge label-warning">${ dataItem.message }</span>`;
			} else {
				return `<span class="badge label-danger">${ dataItem.message }</span>`;
			}
		}
	}

</script>

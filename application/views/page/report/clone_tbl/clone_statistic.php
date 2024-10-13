<!-- Page content -->
<div id="page-content">
	<div class="content-header">
		<div class="header-section">
			<h1>
				<i class="gi gi-briefcase"></i>Statictis <?= $template['active_description'] ?><br>
				<small><?= $template['active_description'] ?></small>
			</h1>
		</div>
	</div>

	<!-- START Grid Block -->
	<div class="block full">
		<!-- All Orders Title -->
		<div class="block-title">
			<h2><strong>Statictis</strong> <?= strtolower($template['active_description']) ?></h2>
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
			init_grid();

			let grid = $("#grid").data("kendoGrid");
			setInterval(function () {
				grid.dataSource.read();
			}, 5000);

		});


		function init_grid() {
			$("#grid").kendoGrid({
				dataSource: {
					transport: {
						read: {
							url: "<?= base_url('clone/' . $tbl_name . '/report-statistic/get-grid.html') ?>",
							dataType: "json",
							type: "POST",
							data: function (a) {
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
					pageSize: 50,
					serverPaging: false,
					serverSorting: false,
					serverFiltering: false,
					serverAggregates: false,
					schema: {
						data: "data", // records are returned in the "data" field of the response
						total: "total", // total number of records is in the "total" field of the response
						id: "id",
						model: {
							fields: {
								count: {type: "number"},
								mamay: {type: "string"},
								serial: {type: "string"},
								total: {type: "number"},
								latest_5m: {type: "number"},

							}
						}
					},// enable server paging
					aggregate: [
						{
							field: "total",
							aggregate: "sum"
						},
						{
							field: "latest_5m",
							aggregate: "sum"
						},
					]
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
						field: "count",
						title: "#",
						width: 50,
						filterable: false,
						sortable: false
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
						field: "total",
						title: "total",
						width: 90,
						template : "#= kendo.toString(total, `n0`)#",
						aggregates: ["sum"],
						footerTemplate: "Total: #=kendo.toString(sum, `n0`)#"
					},
					{
						title: "latest 5 minutes",
						field: "latest_5m",
						width: 90,
						template : "#= kendo.toString(latest_5m, `n0`)#",
						aggregates: ["sum"],
						footerTemplate: "Total: #=kendo.toString(sum, `n0`)#"
					}
				],
				dataBound: function (e) {
					let grid = e.sender;
					let dataItems = grid.dataSource.view();

					for (let i = 0; i < dataItems.length; i++) {
						let dataItem = dataItems[i];
						let keys_dataItem = Object.keys(dataItem);
						let index_latest_5m = keys_dataItem.indexOf('latest_5m');
						console.log(index_latest_5m)
						console.log(typeof dataItem)
						let row = grid.tbody.find("tr[data-uid='" + dataItem.uid + "']");
						let cell = row.children()[index_latest_5m - 1];
						console.log(typeof cell)
						// Apply your conditions and set the background color accordingly
						if (dataItem.latest_5m > 5) {
							cell.style.backgroundColor = "#95efc6";
						} else if (dataItem.latest_5m > 0) {
							cell.style.backgroundColor = "#efe095";
						} else {
							// Set the default background color
							cell.style.backgroundColor = "#ef8787";
						}
					}
				}
			});
		}

	</script>

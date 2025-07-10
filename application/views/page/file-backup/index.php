<!-- Page content -->
<div id="page-content">
	<div class="content-header">
		<div class="header-section">
			<h1>
				<i class="gi gi-briefcase"></i>File backup<br>
				<small>File backup</small>
			</h1>
		</div>
	</div>
	<!-- START Grid Block -->
	<div class="block full">
		<!-- All Orders Title -->
		<div class="block-title">
			<h2><strong>List</strong> file backup</h2>
		</div>
		<!-- END All Orders Title -->
		<!-- All Orders Content -->
		<div id="grid">

		</div>
		<!-- END All Orders Content -->
	</div>
</div>
<script !src="">
	//ready function
	$(document).ready(function () {
		init_grid();
	});

	function init_grid() {
		$('#grid').kendoGrid({
			dataSource: {
				transport: {
					read: {
						url: '/file-backup/get-grid.html',
						dataType: 'json',
						type: 'POST'
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
				sort: {field: "created_at", dir: "desc"},
				schema: {
					data: "data", // records are returned in the "data" field of the response
					total: "total", // total number of records is in the "total" field of the response
					fields: {
						filename: {type: 'string'},
						created_at: {type: 'date'},
						updated_at: {type: 'date'},
						size: {type: 'number'},
						id: {type: 'number'}
					}
				}
			},
			height: 550,
			sortable: true,
			filterable: true,
			pageable: true,
			columns: [
				{
					field: 'id',
					title: '#',
					width: 50,
				},
				{
					field: 'id',
					title: 'Action',
					width: 100,
					template: function (dataItem) {
						//view and download buttons
						return '<a href="/file-backup/view/' + dataItem.filename + '" class="btn btn-xs btn-default" title="View" target="_blank"><i class="fa fa-eye"></i></a> ' +
							'<a href="/file-backup/download/' + dataItem.filename + '" class="btn btn-xs btn-primary" title="Download" target="_blank"><i class="fa fa-download"></i></a>';
					}
				},
				{
					field: 'filename',
					title: 'File Name',
					width: 200,
				},
				{field: 'created_at', title: 'Created At', format: '{0:d}', width: 150},
				{field: 'updated_at', title: 'Updated At', format: '{0:d}', width: 150},
				{
					field: 'size',
					title: 'Size (Kb)',
					width: 140,
					template: function (dataItem) {
						return (dataItem.size / 1024).toFixed(2) + ' Kb';
					}
				}
			]
		});
	}
</script>

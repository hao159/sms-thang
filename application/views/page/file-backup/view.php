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
			<h2><strong>File </strong> <?= $filename ?></h2>
		</div>
		<!--button back to list-->
		<a href="<?= site_url('file-backup.html') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Quay lại
			danh sách</a>

		<!-- END All Orders Title -->
		<!-- All Orders Content -->
		<!--		embedded office iframe-->
		<iframe src="<?= $iframe_link ?>" width="100%" height="800" frameborder="0">
			File không hiển thị được, hãy <a href="<?= htmlspecialchars($file_url) ?>" target="_blank">tải về tại
				đây</a>
		</iframe>
		<!-- END All Orders Content -->
	</div>
</div>

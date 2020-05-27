<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Main content -->
<div class="content">
	<div class="container-fluid">
		<?php
		$attributes = array('class' => 'form-horizontal','id' => 'default_form');
		echo form_open('/request', $attributes);
		?>
		<?php
		echo form_close();
		?>
		<div class="row">
			<div class="col-6">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">분석요청 최근 10건</h3>
					</div>
					<!-- /.card-header -->
					<div class="card-body table-responsive p-0">
						<table class="table table-hover text-nowrap">
							<thead>
							<tr>
								<th>요청일시</th>
								<th>요청번호</th>
								<th>요청자</th>
								<th>요청분석</th>
								<th>분석여부</th>
							</tr>
							</thead>
							<tbody>
							<?php if(@$list) {
								foreach ($list as $row) {
							?>
							<tr>
								<td><?=$row->AR_time?></td>
								<td><?=$row->AR_CD?></td>
								<td><?=$row->user_id?></td>
								<td><?=$row->analysis_type?></td>
								<td><?=$row->analysis_flg?></td>
							</tr>
							<?php
								}
							}
							?>
							</tbody>
						</table>

					</div>
					<!-- /card-body -->
					<div class="card-footer">
						<?php echo $pagination?>
					</div>
					<div class="card-footer clearfix">
						<ul class="pagination pagination-sm m-0 float-right">
							<li class="page-item"><a class="page-link" href="#">«</a></li>
							<li class="page-item"><a class="page-link" href="#">1</a></li>
							<li class="page-item"><a class="page-link" href="#">2</a></li>
							<li class="page-item"><a class="page-link" href="#">3</a></li>
							<li class="page-item"><a class="page-link" href="#">»</a></li>
						</ul>
					</div>
				</div>
				<!-- /.card -->
			</div>
			<div class="col-6">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Responsive Hover Table</h3>

						<div class="card-tools">
							<div class="input-group input-group-sm" style="width: 150px;">
								<input type="text" name="table_search" class="form-control float-right" placeholder="Search">

								<div class="input-group-append">
									<button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
								</div>
							</div>
						</div>
					</div>
					<!-- /.card-header -->
					<div class="card-body table-responsive p-0">
						<table class="table table-hover text-nowrap">
							<thead>
							<tr>
								<th>ID</th>
								<th>User</th>
								<th>Date</th>
								<th>Status</th>
								<th>Reason</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td>183</td>
								<td>John Doe</td>
								<td>11-7-2014</td>
								<td><span class="tag tag-success">Approved</span></td>
								<td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
							</tr>
							<tr>
								<td>219</td>
								<td>Alexander Pierce</td>
								<td>11-7-2014</td>
								<td><span class="tag tag-warning">Pending</span></td>
								<td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
							</tr>
							<tr>
								<td>657</td>
								<td>Bob Doe</td>
								<td>11-7-2014</td>
								<td><span class="tag tag-primary">Approved</span></td>
								<td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
							</tr>
							<tr>
								<td>175</td>
								<td>Mike Doe</td>
								<td>11-7-2014</td>
								<td><span class="tag tag-danger">Denied</span></td>
								<td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
							</tr>
							</tbody>
						</table>
					</div>
					<!-- /.card-body -->
				</div>
				<!-- /.card -->
			</div>
		</div>
	</div>
</div>

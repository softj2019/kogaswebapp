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
						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
							</button>
							<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
							</button>
						</div>

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
				</div>
				<!-- /.card -->
			</div>
			<div class="col-6">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">분석요청 최근 10건</h3>
						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
							</button>
							<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
							</button>
						</div>

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
				</div>
				<!-- /.card -->
			</div>
			<div class="col-4">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">해당 년도 고장모드 비율(현상코드)</h3>

						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
							</button>
							<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
							</button>
						</div>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<div class="chart-responsive">
									<canvas id="pieChart" height="150"></canvas>
								</div>
								<!-- ./chart-responsive -->
							</div>
							<!-- /.col -->
							<div class="col-md-12">
								<ul class="chart-legend clearfix">
								<?php if(@$listA) {
									foreach ($listA as $row) {
								?>
									<li><i class="far fa-circle text-secondary"></i> <?=$row->code_name?>(<?=$row->cnt?>)</li>
								<?php
									}
								}
								?>
								</ul>
							</div>
							<!-- /.col -->
						</div>
						<!-- /.row -->
					</div>
					<!-- /.card-body -->
					<!-- /.footer -->
				</div>

			</div>
			<div class="col-4">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">해당 년도 고장원인 비율(원인코드)</h3>

						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
							</button>
							<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
							</button>
						</div>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<div class="row">
							<div class="col-md-8">
								<div class="chart-responsive">
									<canvas id="pieChart2" height="150"></canvas>
								</div>
								<!-- ./chart-responsive -->
							</div>
							<!-- /.col -->
							<div class="col-md-4">
								<ul class="chart-legend clearfix">
									<li><i class="far fa-circle text-danger"></i> Chrome</li>
									<li><i class="far fa-circle text-success"></i> IE</li>
									<li><i class="far fa-circle text-warning"></i> FireFox</li>
									<li><i class="far fa-circle text-info"></i> Safari</li>
									<li><i class="far fa-circle text-primary"></i> Opera</li>
									<li><i class="far fa-circle text-secondary"></i> Navigator</li>
								</ul>
							</div>
							<!-- /.col -->
						</div>
						<!-- /.row -->
					</div>
					<!-- /.card-body -->
					<!-- /.footer -->
				</div>

			</div>
			<div class="col-4">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">해당 년도 고장 조치 비율(조치코드)</h3>

						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
							</button>
							<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
							</button>
						</div>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<div class="row">
							<div class="col-md-8">
								<div class="chart-responsive">
									<canvas id="pieChart3" height="150"></canvas>
								</div>
								<!-- ./chart-responsive -->
							</div>
							<!-- /.col -->
							<div class="col-md-4">
								<ul class="chart-legend clearfix">
									<li><i class="far fa-circle text-danger"></i> Chrome</li>
									<li><i class="far fa-circle text-success"></i> IE</li>
									<li><i class="far fa-circle text-warning"></i> FireFox</li>
									<li><i class="far fa-circle text-info"></i> Safari</li>
									<li><i class="far fa-circle text-primary"></i> Opera</li>
									<li><i class="far fa-circle text-secondary"></i> Navigator</li>
								</ul>
							</div>
							<!-- /.col -->
						</div>
						<!-- /.row -->
					</div>
					<!-- /.card-body -->

					<!-- /.footer -->
				</div>

			</div>
		</div>
	</div>
</div>
<script>
	var pieDataArr = [
	<?php if(@$listA) {
		foreach ($listA as $row) {
			echo '\''.$row->code_name.'\''.",";
		}
	}
	?>
	];
	var pieDataArr = [
		<?php if(@$listA) {
		foreach ($listA as $row) {
			echo '\''.$row->code_name.'\''.",";
		}
	}
		?>
	];
	var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
	var pieData        = {
		labels: pieDataArr,
		datasets: [
			{
				data: [700,500,400,600,300,100],
				backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
			}
		]
	}
	var pieOptions     = {
		legend: {
			display: false
		}
	}
	//Create pie or douhnut chart
	// You can switch between pie and douhnut using the method below.
	var pieChart = new Chart(pieChartCanvas, {
		type: 'doughnut',
		data: pieData,
		options: pieOptions
	})
</script>

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
				<div class="card collapsed-card">
					<div class="card-header">
						<h3 class="card-title"> 최근 분석 실행 10건</h3>
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
								<th>요청번호</th>
								<th>요청일시</th>
								<th>요청자</th>
								<th>분석종류</th>
								<th>분석여부</th>
							</tr>
							</thead>
							<tbody>
							<?php if(@$list) {
								foreach ($list as $row) {
							?>
							<tr>
								<td><?=$row->ar_cd?></td>
								<td><?=$row->ar_time?></td>
								<td><?=$row->user_id?></td>
								<td><?=$row->analysis_name?></td>
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
<!--					<div class="card-footer">-->
<!--						--><?php //echo $pagination?>
<!--					</div>-->
				</div>
				<!-- /.card -->
			</div>
			<div class="col-6">
				<div class="card collapsed-card">
					<div class="card-header">
						<h3 class="card-title">최근 발생 고장 10건</h3>
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
								<th>플랜트</th>
								<th>위치</th>
								<th>설비 이름</th>
								<th>고장 내역</th>
							</tr>
							</thead>
							<tbody>
							<?php if(@$list2) {
								foreach ($list2 as $row) {
									?>
									<tr>
										<td><?=$row->plant?></td>
										<td><?=$row->prloc?></td>
										<td><?=$row->pr?></td>
										<td><?=$row->probj?></td>
									</tr>
									<?php
								}
							}
							?>
							</tbody>
						</table>

					</div>
					<!-- /card-body -->
<!--					<div class="card-footer">-->
<!--						--><?php //echo $pagination?>
<!--					</div>-->
				</div>
				<!-- /.card -->
			</div>
		</div>
		<div class="row">
			<div class="col-4">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">최근 1년간 고장모드 상위 10건</h3>

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
						<h3 class="card-title">최근 1년간 고장원인 상위 10건</h3>

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
									<canvas id="pieChart2" height="150"></canvas>
								</div>
								<!-- ./chart-responsive -->
							</div>
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
						<h3 class="card-title">최근 1년간 고장 조치 상위 10건</h3>

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
									<canvas id="pieChart3" height="150"></canvas>
								</div>
								<!-- ./chart-responsive -->
							</div>
						</div>
						<!-- /.row -->
					</div>
					<!-- /.card-body -->

					<!-- /.footer -->
				</div>

			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">최근 1년간 월별 고장 발생 차트</h3>

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
									<canvas id="barChart" width="800" height="200"></canvas>
								</div>
								<!-- ./chart-responsive -->
							</div>
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

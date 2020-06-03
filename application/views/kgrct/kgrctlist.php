<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Main content -->
<div class="content">
	<div class="container-fluid">
		<?php
		$attributes = array('class' => 'form-horizonatal', 'id' => 'defaultForm','name' => 'defaultForm');
		echo form_open('email/send',$attributes);
		?>
		<?php form_close()?>
		<div class="card">
			<div class="card-body table-responsive">

				<table class="table table-hover table-striped">
					<thead>
					<tr>
						<th>요청코드</th>
						<th>분석일자</th>
						<th>플랜트</th>
						<th>위치내역</th>
						<th>1차분류</th>
						<th>1-1차분류</th>
						<th>2차분류</th>
						<th>3차분류</th>
						<th>4차분류</th>
						<th>신뢰도분석결과</th>
						<th>기초통계분석결과</th>
						<th>데이터 파일</th>
					</tr>
					</thead>
					<tbody>
					<?php if(@$list) {
						foreach ($list as $row) {
							?>
							<tr>
								<td class="text"><?php echo $row->ar_cd; ?></td>
								<td><?php echo $row->ar_time; ?></td>
								<td class="text-truncate"><?php echo $row->key1_nm; ?></td>
								<td class="text-truncate"><?php echo $row->key2_nm; ?></td>
								<td><?php echo $row->key3_nm; ?></td>
								<td class="text-truncate"><?php echo $row->key4_nm; ?></td>
								<td class="text-truncate"><?php echo $row->key5_nm; ?></td>
								<td class="text-truncate"><?php echo $row->key6_nm; ?></td>
								<td class="text-truncate"><?php echo $row->key3_1_nm; ?></td>
								<td>
									<button class="btn btn-info btn-block" type="button" data-toggle="modal" data-target="#modal-default" data-whatever="<?php echo $row->ar_cd; ?>"><i class="fas fa-search"></i> </button>
								</td>
								<td>
									<button class="btn btn-info btn-block" type="button" data-toggle="modal" data-target="#modal-default2" data-whatever="<?php echo $row->ar_cd; ?>"><i class="fas fa-search"></i> </button>
								</td>
								<td>
									<a class="btn btn-info btn-block" href="/download/getfile/<?php echo $row->ar_cd;?>">download</a>
								</td>
							</tr>
							<?php
						}
					}
					?>
					</tbody>
				</table>

			</div>
			<div class="card-footer">
				<?php echo $pagination?>
			</div>
		</div>
	</div>
</div>

<div class="modal  fade" id="modal-default">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">신뢰도 분석결과</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="card">
					<div class="card-body inHtml">

					</div>
				</div>
				<div class="card">
					<div class="card-body inContent">

					</div>
				</div>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<!--				<button type="button" class="btn btn-primary">Save changes</button>-->
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modal-default2">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">기초통계 분석 결과</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body row">

			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<!--				<button type="button" class="btn btn-primary">Save changes</button>-->
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

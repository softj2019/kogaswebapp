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
			<div class="selectListCard row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="form-group row">
								<label class="col-1">기간선택</label>
								<div class="col-2">
									<div class="input-group">
										<div class="input-group-prepend">
										  <span class="input-group-text">
											<i class="far fa-calendar-alt"></i>
										  </span>
										</div>
										<input type="text" name="startDate" class="form-control float-right startDate">
									</div>
								</div>
								<div class="col-2">
									<div class="input-group">
										<div class="input-group-prepend">
										  <span class="input-group-text">
											<i class="far fa-calendar-alt"></i>
										  </span>
										</div>
										<input type="text" name="endDate" class="form-control float-right endDate">
									</div>
								</div>
								<div class="col-2">
									<button type="button" class="btn btn-success btn-block submitKgArt" data-id="kgbasicsbt">분석 실행</button>
								</div>
							</div>
							<div class="form-group row">
								<label class="text-info offset-1">해당 분석의 시작시점은 2009년 1월 1일 이후로 설정해야 합니다.</label>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-3">
					<div class="card">
						<div class="card-header">

							<div class="icheck-primary d-inline text-truncate">
								<input type="checkbox" id="checkAll_key_1" name='checkAll' value="key1_cd">
								<label for="checkAll_key_1">
									플랜트
								</label>
							</div>

						</div>
						<div class="card-body scroll-300">
							<?php if(@$listKey1) {
								foreach ($listKey1 as $key=>$row) {
									?>
									<div class="form-group clearfix">
										<div class="icheck-primary d-inline">
											<input type="checkbox" id="key1_cd_<?=$key?>" name='key1_cd[]' value="<?php echo $row->key1_cd; ?>" class="key1_cd">
											<label for="key1_cd_<?=$key?>">
												<?php echo $row->key1_nm; ?>
											</label>
										</div>
									</div>
									<?php
								}
							}
							?>
						</div>
					</div>
				</div>

				<div class="col-3 ">
					<!-- Select multiple-->
					<div class="card">
						<div class="card-header">
							<div class="icheck-primary d-inline ">
								<input type="checkbox" id="checkAll_key_3" name='checkAll' value="key3_cd" disabled>
								<label for="checkAll_key_3">
									1차
								</label>
							</div>
						</div>
						<div class="card-body scroll-300 ">
							<?php if(@$kgpbtClass1) {
								foreach ($kgpbtClass1 as $key=>$row) {
									?>
									<div class="form-group clearfix">
										<div class="icheck-primary d-inline text-truncate">
											<input type="checkbox" id="key3_cd_<?=$key?>" name='key3_cd[]' value="<?php echo $row->key3_cd; ?>" class="key3_cd" data-id="kgsbt">
											<label for="key3_cd_<?=$key?>" class="">
												<?php echo $row->key3_nm; ?>
											</label>
										</div>
									</div>
									<?php
								}
							}
							?>
						</div>
					</div>
				</div>
				<div class="col-3">
					<div class="card">
						<div class="card-header">
							<div class="icheck-primary d-inline">
								<input type="checkbox" id="checkAll_key_4" name='checkAll' value="key4_cd">
								<label for="checkAll_key_4">
									2차
								</label>
							</div>
						</div>
						<div class="card-body scroll-300 key4_cd_view">

						</div>
					</div>
				</div>
				<div class="col-3">
					<div class="card">
						<div class="card-header">
							<div class="icheck-primary d-inline">
								<input type="checkbox" id="checkAll_key_5" name='checkAll' value="key5_cd">
								<label for="checkAll_key_5">
									3차
								</label>
							</div>
						</div>
						<div class="card-body scroll-300 key5_cd_view">

						</div>
					</div>
				</div>
			</div>
		<?php echo form_close();?>
		<div class="card">
			<div class="card-body table-responsive">

				<table class="table table-hover table-striped">
					<thead>
					<tr>
						<th>분석 코드</th>
						<th>분석일자</th>
						<th>분석 요청자</th>
						<th>요청구분</th>
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
								<td class="text-truncate"><?php echo $row->user_id; ?></td>
								<td class="text-truncate"><?php echo $row->analysis_name; ?></td>
								<td>
									<button class="btn btn-info btn-block" type="button" data-toggle="modal" data-target="#modal-default" data-whatever="<?php echo $row->ar_cd; ?>"><i class="fas fa-search"></i> </button>
								</td>
								<td>
									<button class="btn btn-info btn-block" type="button" data-toggle="modal" data-target="#modal-default2" data-whatever="<?php echo $row->ar_cd; ?>" ><i class="fas fa-search"></i> </button>
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

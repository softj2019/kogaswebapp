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
				<div class="col-6">
					<div class="card border-0">
						<div class="card-header">
							&nbsp;
						</div>
						<div class="card-body scroll-300">
							<!-- radio -->
							<div class="form-group row">
								<label class="col-2">
									분석타입
								</label>
								<div class="col-8">
									<div class="icheck-primary d-inline">
										<input type="radio" id="anal_type_b" name="anal_type" value="B" checked>
										<label for="anal_type_b">
											기본분석
										</label>
									</div>
									<div class="icheck-primary d-inline">
										<input type="radio" id="anal_type_c" name="anal_type" value="C">
										<label for="anal_type_c">
											심화분석
										</label>
									</div>
								</div>
								<div class="col-2">

										<button type="button" class="btn btn-success btn-block submitKgArt" >분석 실행</button>

								</div>
							</div>
							<!-- radio -->
							<div class="form-group row">
								<label class="col-2">
									모드선택
								</label>
								<div class="col-10">
									<div class="icheck-primary d-inline">
										<input type="radio" id="select_mode_n" name="select_mode" value="checkAll_key_3_1" checked>
										<label for="select_mode_n">
											선택안함
										</label>
									</div>
									<div class="icheck-primary d-inline">
										<input type="radio" id="select_mode_f" name="select_mode" value="fmode">
										<label for="select_mode_f">
											고장모드
										</label>
									</div>
									<div class="icheck-primary d-inline select_mode_s hidden">
										<input type="radio" id="select_mode_s" name="select_mode" value="smode">
										<label for="select_mode_s">
											검정모드
										</label>
									</div>
								</div>

							</div>
							<div class="form-group row">
								<label class="col-2">기간선택</label>
								<div class="col-5">
									<div class="input-group">
										<div class="input-group-prepend">
										  <span class="input-group-text">
											<i class="far fa-calendar-alt"></i>
										  </span>
										</div>
										<input type="text" name="startDate" class="form-control float-right startDate bg-white" readonly="ture">
									</div>
								</div>
								<div class="col-5">
									<div class="input-group">
										<div class="input-group-prepend">
										  <span class="input-group-text">
											<i class="far fa-calendar-alt"></i>
										  </span>
										</div>
										<input type="text" name="endDate" class="form-control float-right endDate bg-white" readonly="ture">
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="text-info offset-2">해당 분석의 시작시점은 2009년 1월 1일 이후로 설정해야 합니다.</label>
							</div>
							<div class="form-group row">
								<label class="col-2" >관심시간 입력 </label>
								<div class="col-10">
									<input class="form-control" name="wvalue" placeholder="" value="1000,5000,10000,50000,100000 ">
								</div>
							</div>

						</div>
					</div>
				</div>
				<div class="col-2">
					<div class="card">
						<div class="card-header">
							<div class="icheck-primary d-inline">
								<input type="checkbox" id="checkAll_fmode" name='checkAll' value="fmode">
								<label for="checkAll_fmode">
									고장모드
								</label>
							</div>
						</div>
						<div class="card-body scroll-300 fmode_view">
							<?php if(@$kgcodList) {
								foreach ($kgcodList as $key=>$row) {
									?>
							<div class="form-group clearfix">
								<div class="icheck-primary d-inline">
									<input type="checkbox" id="fmode_<?php echo $key; ?>" name="fmode[]" value="<?php echo $row->num_cd; ?>" class="fmode">
									<label for="fmode_<?php echo $key; ?>">
										<?php echo $row->num_nm; ?>
									</label>
								</div>
							</div>
									<?php
								}
							}
							?>
						</div>
						<div class="fmodeOverlay overlay">
<!--							<i class="fas fa-2x fa-sync-alt"></i>-->
						</div>
					</div>
				</div>
				<div class="col-2">
					<div class="card">
						<div class="card-header">
							<div class="icheck-primary d-inline">
								<input type="checkbox" id="checkAll_smode" name='checkAll' value="smode">
								<label for="checkAll_smode">
									검정모드 플랜트
								</label>
							</div>
						</div>
						<div class="card-body scroll-300 smode_key1_cd">

						</div>
						<div class="smodeOverlay overlay">
<!--							<i class="fas fa-2x fa-sync-alt"></i>-->
						</div>
					</div>
				</div>
			</div>
			<div class="selectListCard row">
				<div class="col-2">
					<div class="card">
						<div class="card-header">

							<div class="icheck-primary d-inline text-truncate">
								<input type="checkbox" id="checkAll_key_1" name='checkAll' value="key1_cd">
								<label for="checkAll_key_1">
									플랜트 <span class = "text-danger">*필수</span>
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
				<div class="col-2 hidden kgpbtLocale ">
					<div class="card">
						<div class="card-header">
							<div class="icheck-primary d-inline">
								<input type="checkbox" id="checkAll_key_2" name='checkAll' value="key2_cd">
								<label for="checkAll_key_2">
									위치
								</label>
							</div>
						</div>
						<div class="card-body scroll-300 key2_cd_view">

						</div>
					</div>
				</div>
				<div class="col-2 ">
					<!-- Select multiple-->
					<div class="card">
						<div class="card-header">
							<div class="icheck-primary d-inline ">
								<input type="checkbox" id="checkAll_key_3" name='checkAll' value="key3_cd" disabled>
								<label for="checkAll_key_3">
									1차 <span class = "text-danger">*필수</span>
								</label>
							</div>
						</div>
						<div class="card-body scroll-300 ">
							<?php if(@$kgpbtClass1) {
								foreach ($kgpbtClass1 as $key=>$row) {
									?>
									<div class="form-group clearfix">
										<div class="icheck-primary d-inline text-truncate">
											<input type="checkbox" id="key3_cd_<?=$key?>" name='key3_cd[]' value="<?php echo $row->key3_cd; ?>" class="key3_cd">
											<label for="key3_cd_<?=$key?>" class="">
												<?php echo $row->key3_nm; ?>
											</label>
										</div>
									</div>
									<?php
								}
							}
							?>
							<!--					<div class="form-group">-->
							<!--						<label>생산설비 신뢰도 분석 1차분류</label>-->
							<!--						<select multiple name='key3_cd' class="form-control  kgpbtMultiSelect" data-max-options="1">-->
							<!--						</select>-->
							<!--					</div>-->
						</div>
					</div>
				</div>
				<div class="col-2">
					<div class="card">
						<div class="card-header">
							<div class="icheck-primary d-inline">
								<input type="checkbox" id="checkAll_key_3_1" name='checkAll' value="key3_1_cd">
								<label for="checkAll_key_3_1">
									1-1차
								</label>
							</div>
						</div>
						<div class="card-body scroll-300 key3_1_cd_view ">

						</div>
					</div>
				</div>
				<div class="col-2">
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
				<div class="col-2">
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
				<div class="col-2">
					<div class="card">
						<div class="card-header">
							<div class="icheck-primary d-inline">
								<input type="checkbox" id="checkAll_key_6" name='checkAll' value="key6_cd">
								<label for="checkAll_key_6">
									4차
								</label>
							</div>
						</div>
						<div class="card-body scroll-300 key6_cd_view">

						</div>
					</div>
				</div>
			</div>
		<?php echo form_close();?>
		<div class="card">
			<div class="card-body table-responsive">

				<table class="table table-hover table-striped">
<!--					<colgroup>-->
<!--						<col class="w-5">-->
<!--						<col>-->
<!--						<col>-->
<!--						<col>-->
<!--						<col class="w-5">-->
<!--						<col class="w-5">-->
<!--						<col class="w-5">-->
<!---->
<!--					</colgroup>-->

					<thead>
					<tr>
						<th>분석 코드</th>
						<th>분석일자</th>
						<th>사용자</th>
						<th>분석 구분</th>
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

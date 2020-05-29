<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Main content -->
<div class="content">
	<div class="container-fluid">
		<form class="form-horizonatal">
			<div class="card">
				<!--				<div class="card-header">-->
				<!--				</div>-->
				<div class="card-body">
					<div class="row">
						<div class="col-4">
							<!-- radio -->
							<div class="form-group row">
								<div class="col-2">
									분석타입
								</div>
								<div class="col-10">
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
							</div>
							<!-- radio -->
							<div class="form-group row">
								<div class="col-2">
									모드선택
								</div>
								<div class="col-10">
									<div class="icheck-primary d-inline">
										<input type="radio" id="select_mode_n" name="select_mode" value="none">
										<label for="select_mode_n">
											선택안함
										</label>
									</div>
									<div class="icheck-primary d-inline">
										<input type="radio" id="select_mode_f" name="select_mode" checked value="fmode">
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
										<input type="text" name="startDate" class="form-control float-right startDate">
									</div>
								</div>
								<div class="col-5">
									<div class="input-group">
										<div class="input-group-prepend">
								  <span class="input-group-text">
									<i class="far fa-calendar-alt"></i>
								  </span>
										</div>
										<input type="text" name="endDate" class="form-control float-right endDate">
									</div>
								</div>
							</div>
						</div>
						<div class="col-2">
							<div class="form-group">
								<label>고장모드</label>
								<select multiple class="form-control anal_flag" name="fmode">
									<?php if(@$kgcodList) {
										foreach ($kgcodList as $row) {
											?>
											<option value="<?php echo $row->num_cd; ?>"><?php echo $row->num_nm; ?></option>

											<?php
										}
									}
									?>
								</select>
							</div>
							<div class="form-group">
								<input class="form-control" name="wvalue" placeholder="관심시간 : ex) 숫자,숫자" value="1000,5000,10000,50000,100000 ">
							</div>
						</div>

						<div class="col-2">
							<div class="form-group">
								<label>검정모드 플랜트</label>

								<select multiple disabled name='smode' class="form-control anal_flag">
									<?php if(@$listKey1) {
										foreach ($listKey1 as $row) {
											?>
											<option value="<?php echo $row->key1_cd; ?>"><?php echo $row->key1_nm; ?></option>

											<?php
										}
									}
									?>
								</select>

							</div>
							<div class="form-group">
								<button class="btn btn-success btn-block">분석 요청</button>
							</div>
						</div>
						<!--						<div class="col-2">-->
						<!--							<div class="form-group">-->
						<!--								<label>검정모드 위치</label>-->
						<!--								<select multiple disabled class="form-control anal_flag" name="check_mode_key2_cd">-->
						<!--								</select>-->
						<!--							</div>-->
						<!--							<div class="form-group">-->
						<!--								<button class="btn btn-success btn-block">분석 요청</button>-->
						<!--							</div>-->
						<!--						</div>-->



					</div>
				</div>

			</div>
			<div class="card">
				<!--				<div class="card-header"></div>-->
				<div class="card-blue">
					<div class="card-body">
						<div class="row">
							<div class="col-2">
								<!-- Select multiple-->
								<div class="form-group">
									<label>플랜트</label>
									<select multiple name='key1_cd' class="form-control  kgpbtMultiSelect">
										<?php if(@$listKey1) {
											foreach ($listKey1 as $row) {
												?>
												<option value="<?php echo $row->key1_cd; ?>"><?php echo $row->key1_nm; ?></option>

												<?php
											}
										}
										?>
									</select>
								</div>
							</div>
							<div class="col-2 hidden kgpbtLocale">
								<div class="form-group">
									<label>위치</label>
									<select multiple name='key2_cd' class="form-control  kgpbtMultiSelect ">
									</select>
								</div>
							</div>
							<div class="col-2">
								<!-- Select multiple-->
								<div class="form-group">
									<label>생산설비 신뢰도 분석 1차분류</label>
									<select multiple name='key3_cd' class="form-control  kgpbtMultiSelect" data-max-options="1">
										<?php if(@$kgpbtClass1) {
											foreach ($kgpbtClass1 as $row) {
												?>
												<option value="<?php echo $row->key3_cd; ?>"><?php echo $row->key3_nm; ?></option>

												<?php
											}
										}
										?>
									</select>
								</div>
							</div>
							<div class="col-2">
								<div class="form-group">
									<label>생산설비 신뢰도 분석 2차분류</label>
									<select multiple name='key4_cd' class="form-control  kgpbtMultiSelect ">
									</select>
								</div>
							</div>
							<div class="col-2">
								<div class="form-group">
									<label>생산설비 신뢰도 분석 3차분류</label>
									<select multiple name='key5_cd' class="form-control  kgpbtMultiSelect ">
									</select>
								</div>
							</div>
							<div class="col-2">
								<div class="form-group">
									<label>생산설비 신뢰도 분석 4차분류</label>
									<select multiple name='key6_cd' class="form-control  kgpbtMultiSelect ">
									</select>
								</div>
							</div>
						</div>


						<!--					<div class="form-group row">-->
						<!--						<label for="anal_type" class="col-2 col-form-label">분석타입선택</label>-->
						<!--						<div class="col-10">-->
						<!--							<input name="anal_type" id="anal_type" class="form-control">-->
						<!--						</div>-->
						<!--					</div>-->
					</div>
				</div>
			</div>
		</form>
		<div class="card">
			<div class="card-body">

				<table class="table table-striped table-responsive">
					<thead>
					<tr>
						<th>Request No</th>
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
					</tr>
					</thead>
					<tbody>
					<?php if(@$list) {
						foreach ($list as $row) {
							?>
							<tr>
								<td><?php echo $row->AR_CD; ?></td>
								<td><?php echo $row->RC_time; ?></td>
								<td class="text-truncate"><?php echo $row->key1_cd; ?></td>
								<td class="text-truncate"><?php echo $row->key2_cd; ?></td>
								<!--								<td>--><?php //echo $row->key3_nm; ?><!--</td>-->
								<td>&nbsp;</td>
								<td class="text-truncate"><?php echo $row->key4_cd; ?></td>
								<td class="text-truncate"><?php echo $row->key5_cd; ?></td>
								<td class="text-truncate"><?php echo $row->key6_cd; ?></td>
								<td class="text-truncate"><?php echo $row->key3_1_cd; ?></td>
								<td>
									<button class="btn btn-info btn-block" data-toggle="modal" data-target="#modal-default" data-whatever="http://58.181.55.191/<?php echo $row->htm4; ?>"><i class="fas fa-search"></i> </button>
								</td>
								<td>
									<button class="btn btn-info btn-block"><i class="fas fa-search"></i> </button>
								</td>
								<!--								<td class="text-truncate">--><?php //echo $row->analysis_type; ?><!--</td>-->
								<!--								<td class="text-truncate">--><?php //echo $row->analysis_flg; ?><!--</td>-->

								<!--								<td class="text-truncate">--><?php //echo $row->sdate; ?><!--</td>-->
								<!--								<td class="text-truncate">--><?php //echo $row->edate; ?><!--</td>-->
								<!--								<td class="text-truncate">--><?php //echo $row->distri; ?><!--</td>-->
								<!--								<td class="text-truncate">--><?php //echo $row->fmode; ?><!--</td>-->
								<!--								<td class="text-truncate">--><?php //echo $row->smode; ?><!--</td>-->
								<!--								<td class="text-truncate">--><?php //echo $row->wvalue; ?><!--</td>-->
								<!--								<td class="text-truncate">--><?php //echo $row->AR_time; ?><!--</td>-->
								<!--								<td class="text-truncate">--><?php //echo $row->user_id; ?><!--</td>-->
								<!--								<td class="text-truncate">--><?php //echo $row->created_at; ?><!--</td>-->
								<!--								<td class="text-truncate">--><?php //echo $row->updated_at; ?><!--</td>-->
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
				<p>
				</p>
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
<div class="modal  fade" id="modal-default2">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">기초통계 분석 결과</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>
				</p>
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

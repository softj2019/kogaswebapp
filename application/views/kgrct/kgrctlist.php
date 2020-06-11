<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Main content -->
<div class="content">
	<div class="container-fluid">
		<?php
		$attributes = array('class' => 'form-horizonatal', 'id' => 'defaultForm','name' => 'defaultForm');
		echo form_open('kgrct/kgrctSelect',$attributes);
		?>
		<div class="selectListCard row">
			<div class="col-12">
				<div class="card">
					<div class="card-body row" style = "height: 80px">
						<label class="col-1 text-center col-form-label">기간선택</label>
						<div class="col-2">
							<div class="input-group">
								<div class="input-group-prepend">
									  <span class="input-group-text">
										<i class="far fa-calendar-alt"></i>
									  </span>
								</div>
								<input type="text" name="startDate" class="form-control float-right startDateCustom bg-white" readonly="ture">
							</div>
						</div>
						<div class="col-2">
							<div class="input-group">
								<div class="input-group-prepend">
									  <span class="input-group-text">
										<i class="far fa-calendar-alt"></i>
									  </span>
								</div>
								<input type="text" name="endDate" class="form-control float-right endDate bg-white" readonly="ture">
							</div>
						</div>

						<label class="col-1 text-center col-form-label">분석 타입</label>
						<div class="col-2">
							<select name="anal_type" class = "form-control" >
								<option value = ""> 모든 타입 </option>
								<?php if(@$listType) {
									foreach ($listType as $row) {
										?>
										<option value = "<?php echo $row->value; ?>" <?=$this->input->post_get('anal_type')== $row->value?'selected':''?>> <?php echo $row->name; ?> </option>
										<?php
									}
								}
								?>
							</select>
						</div>

						<label class="col-1 text-center col-form-label" >사용자</label>
						<div class="col-2">
							<input type="text" class = "form-control" name="user" placeholder="User Name" data-id="" value="<?=$this->input->post_get('user')?>"><br><br>
						</div>

						<div class="col-2" >
							<button type="submit" class="btn btn-success btn-block" data-id="kgrct"> 결과 조회 </button>
						</div>


					</div>
				</div>
			</div>
		</div>
		<?php
		echo form_close();
		?>
		<div class="card">
			<div class="card-body table-responsive">
				<table class="table table-hover table-striped" id = "kgartList">
					<thead>
					<tr>
						<th>분석 코드</th>
						<th>분석 일자</th>
						<th>사용자</th>
						<th>분석 구분</th>
						<th>신뢰도 분석 결과</th>
						<th>기초통계 분석 결과</th>
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


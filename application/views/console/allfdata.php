<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Main content -->
<div class="content">
	<div class="container-fluid">
		<div class="card">
			<?php
			$attributes = array('class' => 'form-horizonatal', 'id' => 'defaultForm','name' => 'defaultForm');
			echo form_open(current_url(),$attributes);
			?>
			<div class="card-header">
				<div class="form-group row">
					<div class="col-2">
						<input name="pr_nm" type="text" class="form-control" value="<?=$this->input->post('pr_nm')?>">
					</div>
					<div class="col-2">
						<button type="submit" class="btn btn-primary">검색</button>
					</div>
				</div>
			</div>
			<?php echo form_close();?>
			<div class="card-body table-responsive">
				<table class="table table-sm table-striped">
					<thead>
					<tr>
						<th nowrap>통지번호</th>
						<th nowrap>통지유형</th>
						<th nowrap>내역</th>
						<th nowrap>플렌트코드</th>
						<th nowrap>위치코드</th>
						<th nowrap>기능위치</th>
						<th nowrap>설비번호</th>
						<th nowrap>설비이름</th>
						<th nowrap>Tag No</th>
						<th nowrap>최초설치일</th>
						<th nowrap>오작동 시작 날짜</th>
						<th nowrap>오작동 시작 시간</th>
						<th nowrap>오작동 종료 날짜</th>
						<th nowrap>오작동 종료 시간</th>
						<th nowrap>현상 내역</th>
						<th nowrap>문제 송상 코드</th>
						<th nowrap>원인 내역</th>
						<th nowrap>원인 코드</th>
						<th nowrap>조치사항내역</th>
						<th nowrap>조치사항코드</th>
						<th nowrap>오작동시작일(사용)</th>
						<th nowrap>오작동시작시간(사용)</th>
						<th nowrap>오작동종료일(사용)</th>
						<th nowrap>오작동종료시간(사용)</th>
						<th nowrap>고장상태</th>
					</tr>
					</thead>
					<tbody>
					<?php if(@$list) {
						foreach ($list as $key=>$row) {
							?>
							<tr>
								<td nowrap><?php echo $row->pr_num; ?></td>
								<td nowrap><?php echo $row->prm; ?></td>
								<td nowrap><?php echo $row->probj; ?></td>
								<td nowrap><?php echo $row->plant; ?></td>
								<td nowrap><?php echo $row->prloc; ?></td>
								<td nowrap><?php echo $row->fl_cd; ?></td>
								<td nowrap><?php echo $row->pr_cd; ?></td>
								<td nowrap><?php echo $row->pr_nm; ?></td>
								<td nowrap><?php echo $row->fl_tag; ?></td>
								<td nowrap><?php echo $row->prfdate; ?></td>
								<td nowrap><?php echo $row->sdate_old; ?></td>
								<td nowrap><?php echo $row->stime_old; ?></td>
								<td nowrap><?php echo $row->edate_old; ?></td>
								<td nowrap><?php echo $row->etime_old; ?></td>
								<td nowrap><?php echo $row->break_nm; ?></td>
								<td nowrap><?php echo $row->break_cd; ?></td>
								<td nowrap><?php echo $row->cause_nm; ?></td>
								<td nowrap><?php echo $row->cause_cd; ?></td>
								<td nowrap><?php echo $row->action_nm; ?></td>
								<td nowrap><?php echo $row->action_cd; ?></td>
								<td nowrap><?php echo $row->sdate; ?></td>
								<td nowrap><?php echo $row->stime; ?></td>
								<td nowrap><?php echo $row->edate; ?></td>
								<td nowrap><?php echo $row->etime; ?></td>
								<td nowrap><?php echo $row->bstat; ?></td>
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

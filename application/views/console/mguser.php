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

		<div class="card">
			<div class="card-header">
				<button type="button" class="btn btn-danger deleteUser">사용자 삭제</button>
				<button type="button" class="btn btn-default joinApply">가입승인</button>
				<button type="button" class="btn btn-default adminAccessApply">관리자 권한</button>
			</div>

			<div class="card-body table-responsive">

				<table class="table table-hover table-striped">
					<thead>
					<tr>
						<th class="text-center w-5">
							<div class="icheck-primary d-inline">
								<input type="checkbox" id="checkAll_fmode" name='checkAll' value="list_chk">
								<label for="checkAll_fmode">
								</label>
							</div>
						</th>
						<th>이메일</th>
						<th>권한</th>
						<th>이름</th>
						<th>사번</th>
						<th>부서</th>
						<th>등록일</th>
						<th>수정일</th>
					</tr>
					</thead>
					<tbody>
					<?php if(@$list) {
						foreach ($list as $key=>$row) {
							?>
							<tr>
								<td class="text-center">
									<div class="icheck-primary d-inline">
										<input type="checkbox" id="chk_<?php echo $key; ?>" name="chk[]" value="<?php echo $row->id; ?>" class="list_chk">
										<label for="chk_<?php echo $key; ?>">
										</label>
									</div>
								</td>
								<td><?php echo $row->email; ?></td>
								<td><?php echo $row->role_name; ?></td>
								<td><?php echo $row->name; ?></td>
								<td>사번</td>
								<td><?php echo $row->department; ?></td>
								<td><?php echo $row->created_at; ?></td>
								<td><?php echo $row->updated_at; ?></td>
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
		<?php echo form_close();?>
	</div>
</div>

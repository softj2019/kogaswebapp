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
		<?php echo form_close();?>
		<div class="card">
			<div class="card-body table-responsive">

				<table class="table table-hover table-striped">
					<thead>
					<tr>
<!--						<th class="text-center w-5">-->
<!--							<div class="icheck-primary d-inline">-->
<!--								<input type="checkbox" id="checkAll_fmode" name='checkAll' value="list_chk">-->
<!--								<label for="checkAll_fmode">-->
<!--								</label>-->
<!--							</div>-->
<!--						</th>-->
						<th>session data</th>
						<th>ip</th>
<!--						<th>이름</th>-->
<!--						<th>사번</th>-->
<!--						<th>부서</th>-->
<!--						<th>등록일</th>-->
<!--						<th>수정일</th>-->
					</tr>
					</thead>
					<tbody>
					<?php if(@$list) {
						foreach ($list as $key=>$row) {
							?>
							<tr>
<!--								<td class="text-center">-->
<!--									<div class="icheck-primary d-inline">-->
<!--										<input type="checkbox" id="chk_--><?php //echo $key; ?><!--" name="chk[]" value="--><?php //echo $row->id; ?><!--" class="list_chk">-->
<!--										<label for="chk_--><?php //echo $key; ?><!--">-->
<!--										</label>-->
<!--									</div>-->
<!--								</td>-->
								<td><?php echo $row->data; ?></td>
								<td><?php echo $row->ip_address; ?></td>
<!--								<td>--><?php //echo $row->name; ?><!--</td>-->
<!--								<td>사번</td>-->
<!--								<td>--><?php //echo $row->department; ?><!--</td>-->
<!--								<td>--><?php //echo $row->created_at; ?><!--</td>-->
<!--								<td>--><?php //echo $row->updated_at; ?><!--</td>-->
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

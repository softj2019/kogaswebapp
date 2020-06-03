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
						foreach ($list as $row) {
							?>
							<tr>
								<td><?php echo $row->email; ?></td>
								<td><?php echo $row->role; ?></td>
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
	</div>
</div>

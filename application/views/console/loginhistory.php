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
						<th>사용자</th>
						<th>이메일</th>
						<th>운영로그</th>
						<th>날자</th>
					</tr>
					</thead>
					<tbody>
					<?php if(@$list) {
						foreach ($list as $key=>$row) {
							?>
							<tr>
								<td><?php echo $row->user_name; ?></td>
								<td><?php echo $row->email; ?></td>
								<td><?php echo $row->log_data; ?></td>
								<td><?php echo $row->created_at; ?></td>
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

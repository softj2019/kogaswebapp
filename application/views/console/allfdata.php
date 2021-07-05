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

				<table class="table table-sm table-striped">
					<thead>
					<tr>
						<th>pr_num</th>
						<th>prm</th>
						<th>probj</th>
						<th>plant</th>
						<th>prloc</th>
						<th>fl_cd</th>
						<th>pr_cd</th>
						<th>fl_tag</th>
						<th>prfdate</th>
						<th>sdate_old</th>
						<th>stime_old</th>
						<th>edate_old</th>
						<th>etime_old</th>
						<th>break_nm</th>
						<th>break_cd</th>
						<th>cause_nm</th>
						<th>cause_cd</th>
						<th>action_nm</th>
						<th>action_cd</th>
						<th>sdate</th>
						<th>stime</th>
						<th>edate</th>
						<th>etime</th>
						<th>bstat</th>
					</tr>
					</thead>
					<tbody>
					<?php if(@$list) {
						foreach ($list as $key=>$row) {
							?>
							<tr>
								<td><?php echo $row->pr_num; ?></td>
								<td><?php echo $row->prm; ?></td>
								<td><?php echo $row->probj; ?></td>
								<td><?php echo $row->plant; ?></td>
								<td><?php echo $row->prloc; ?></td>
								<td><?php echo $row->fl_cd; ?></td>
								<td><?php echo $row->pr_cd; ?></td>
								<td><?php echo $row->fl_tag; ?></td>
								<td><?php echo $row->prfdate; ?></td>
								<td><?php echo $row->sdate_old; ?></td>
								<td><?php echo $row->stime_old; ?></td>
								<td><?php echo $row->edate_old; ?></td>
								<td><?php echo $row->etime_old; ?></td>
								<td><?php echo $row->break_nm; ?></td>
								<td><?php echo $row->break_cd; ?></td>
								<td><?php echo $row->cause_nm; ?></td>
								<td><?php echo $row->cause_cd; ?></td>
								<td><?php echo $row->action_nm; ?></td>
								<td><?php echo $row->action_cd; ?></td>
								<td><?php echo $row->sdate; ?></td>
								<td><?php echo $row->stime; ?></td>
								<td><?php echo $row->edate; ?></td>
								<td><?php echo $row->etime; ?></td>
								<td><?php echo $row->bstat; ?></td>
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

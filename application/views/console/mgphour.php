<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Main content -->
<div class="content">
	<div class="container-fluid">
		<?php
		$attributes = array('class' => 'form-horizonatal', 'id' => 'defaultForm','name' => 'defaultForm');
		echo form_open('console/mgphoursave',$attributes);
		?>
		<div class="row">
			<div class="col-6">
				<div class="card">
					<div class="card-header row">
						<div class="col-4"><h4 >생산 설비</h4></div>
						<div class="col-4 offset-4">
							<button type="submit" class="btn btn-success btn-block " >저장</button>
						</div>
					</div>
					<div class="card-body">
						<?php if(@$list) {
							foreach ($list as $key=>$row) {
								?>
								<div class="form-group row">
									<input type="hidden" name="id[]" value="<?=$row->id?>">
									<label class="col-sm-8 col-form-label"><?=$row->product_nm?></label>
									<div class="col-sm-4">
										<input type="text"class="form-control"  name="phour[]" value="<?=$row->phour?>">
									</div>
								</div>
								<?php
							}
						}
						?>
					</div>
				</div>
			</div>
			<div class="col-6">
				<div class="card">
					<div class="card-header row">
						<div class="col-4"><h4 >공급 설비</h4></div>
						<div class="col-4 offset-4">
							<button type="submit" class="btn btn-success btn-block " >저장</button>
						</div>
					</div>
					<div class="card-body">
						<?php if(@$list2) {
							foreach ($list2 as $key=>$row) {
								?>
								<div class="form-group row">
									<input type="hidden" name="id[]" value="<?=$row->id?>">
									<label class="col-sm-8 col-form-label"><?=$row->product_nm?></label>
									<div class="col-sm-4">
										<input type="text"class="form-control"  name="phour[]" value="<?=$row->phour?>">
									</div>
								</div>
								<?php
							}
						}
						?>
					</div>
				</div>
			</div>
		</div>

		<?php echo form_close();?>
	</div>
</div>

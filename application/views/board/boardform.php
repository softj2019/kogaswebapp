<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Main content -->
<div class="content">
	<div class="container-fluid">
		<div class="card">
			<div class="card-header">
				<?=$title?>
			</div>
			<div class="card-body" >
				<div class="form-group" style="min-height: 500px">
					<?=$content?>
				</div>

				<div class="form-group">
					<?php
					if(@$boardFileList) {
						foreach($boardFileList as $value) {
							?>
							<p class="mb-1"><a href="/download/getBoardFile/<?= $value->file ?>"><?= $value->file ?></a></p>
							<?php
						}
					}
					?>
				</div>
				<div class="form-group row">
					<div class="col-2">
						<button type="button" class="btn btn-default btn-block" onclick="location.href='/board/boardlist?board_type=<?=$board_type?>'">목록</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


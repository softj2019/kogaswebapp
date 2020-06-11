<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Main content -->
<div class="content">
	<div class="container-fluid">
		<?php
		$attributes = array('class' => 'form-horizonatal', 'id' => 'defaultForm','name' => 'defaultForm');
		echo form_open_multipart('console/boardformproc',$attributes);
		?>
		<div class="card">
			<div class="card-body">
				<input type="hidden" name="board_type" value="<?=$board_type?>">
				<input type="hidden" name="br_cd" value="<?=$br_cd?>">
				<div class="form-group">

					<input type="text" class="form-control" id="title" name="title" placeholder="글 제목" value="<?=$title?>">
					<?php echo form_error('title');?>
				</div>
				<div class="form-group">
					<textarea class="form-control" id="summernote" name="content">
					</textarea>
					<?php echo form_error('content');?>
				</div>
				<div class="form-group">
					<!-- <label for="customFile">Custom File</label> -->

					<div class="custom-file">
						<input type="file" class="custom-file-input" id="customFile" name="file" >
						<label class="custom-file-label" for="customFile"></label>
					</div>
				</div>
				<div class="form-group">
					<?php
					if(@$boardFileList) {
						foreach($boardFileList as $value) {
							?>
							<p class="mb-1"><a href="/download/getBoardFile/<?= $value->file ?>"><?= $value->file ?></a>
								<button type="button" class="btn btn-default" onclick="deleteFile('<?=$value->id?>')"><i class="fas fa-trash"></i></button>
							</p>
							<?php
						}
					}
					?>
				</div>
				<div class="form-group row">
					<div class="col-2">
						<button type="button" class="btn btn-default btn-block" onclick="location.href='/console/boardlist?board_type=<?=$board_type?>'">목록</button>
					</div>
					<div class="offset-6 col-2">
						<button type="button" class="btn btn-primary btn-block" onclick="submitBoardFormSave()">저장</button>
					</div>
					<div class="col-2">
						<button type="button" class="btn btn-danger btn-block" onclick="submitBoardDelete('<?=$br_cd?>')">삭제</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


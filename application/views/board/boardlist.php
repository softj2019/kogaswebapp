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
			<div class="card-body">
				<div class="card-body">
<!--					<h4>Custom Content Below</h4>-->
					<ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
						<li class="nav-item">
							<a class="nav-link <?=$this->input->get("board_type")=="A"?"active":""?> " id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true" onclick="location.href='/board/boardlist?board_type=A'">사용방법</a>
						</li>
						<li class="nav-item">
							<a class="nav-link <?=$this->input->get("board_type")=="B"?"active":""?>" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false" onclick="location.href='/board/boardlist?board_type=B'">신뢰성분석</a>
						</li>
					</ul>
					<div class="tab-content" id="custom-content-below-tabContent">
						<div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
							<table class="table table-hover table-striped">
								<thead>
								<tr>
									<th style="width: 5%">no</th>
									<th style="width: 85%">제목</th>
									<th style="width: 85%">작성자</th>
									<th style="width: 10%">등록일</th>
								</tr>
								</thead>
								<tbody>
								<?php if(@$list) {
									foreach ($list as $row) {
										?>
										<tr>
											<td class="text"><?php echo $row->num; ?></td>
											<td><a href="/board/boardread/<?php echo $row->id; ?>"><?php echo $row->title; ?></a></td>
											<td class="text-truncate"><?php echo $row->name; ?></td>
											<td class="text-truncate"><?php echo $row->created_at; ?></td>
										</tr>
										<?php
									}
								}
								?>
								</tbody>
							</table>
						</div>
						<div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
							<table class="table table-hover table-striped">
								<thead>
								<tr>
									<th style="width: 5%">no</th>
									<th style="width: 85%">제목</th>
									<th style="width: 85%">작성자</th>
									<th style="width: 10%">등록일</th>
								</tr>
								</thead>
								<tbody>
								<?php if(@$list) {
									foreach ($list as $row) {
										?>
										<tr>
											<td class="text"><?php echo $row->num; ?></td>
											<td><a href="/board/boardread/<?php echo $row->id; ?>"><?php echo $row->title; ?></a></td>
											<td class="text-truncate"><?php echo $row->name; ?></td>
											<td class="text-truncate"><?php echo $row->created_at; ?></td>
										</tr>
										<?php
									}
								}
								?>
								</tbody>
							</table>
						</div>

					</div>

				</div>


			</div>
			<div class="card-footer">
				<?php echo $pagination?>
			</div>
		</div>
	</div>
</div>


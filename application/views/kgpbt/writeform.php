<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Main content -->
<div class="content">
	<div class="container-fluid">
		<div class="card">
			<div class="card-header">

			</div>
			<form class="form-horizonatal">
				<div class="card-body">

					<!-- radio -->
					<div class="form-group row">
						<div class="col-2">
							분석타입선택
						</div>
						<div class="col-10">
							<div class="icheck-primary d-inline">
								<input type="radio" id="anal_type_e" name="anal_type" value="E" checked>
								<label for="anal_type_e">
									기본분석
								</label>
							</div>
							<div class="icheck-primary d-inline">
								<input type="radio" id="anal_type_b" name="anal_type" value="B">
								<label for="anal_type_b">
									심화분석
								</label>
							</div>
						</div>
					</div>
					<!-- radio -->
					<div class="form-group row">
						<div class="col-2">
							모드선택
						</div>
						<div class="col-10">
							<div class="icheck-primary d-inline">
								<input type="radio" id="anal_flag_n" name="anal_flag" checked>
								<label for="anal_flag_n">
									선택안함
								</label>
							</div>
							<div class="icheck-primary d-inline">
								<input type="radio" id="anal_flag_b" name="anal_flag">
								<label for="anal_flag_b">
									고장모드
								</label>
							</div>
							<div class="icheck-primary d-inline anal_flag_c hidden">
								<input type="radio" id="anal_flag_c" name="anal_flag">
								<label for="anal_flag_c">
									검정모드
								</label>
							</div>
						</div>

					</div>
					<div class="form-group row">
						<label class="col-2">기간선택</label>
						<div class="col-5">
							<div class="input-group">
								<div class="input-group-prepend">
								  <span class="input-group-text">
									<i class="far fa-calendar-alt"></i>
								  </span>
								</div>
								<input type="text" name="startDate" class="form-control float-right startDate">
							</div>
						</div>
						<div class="col-5">
							<div class="input-group">
								<div class="input-group-prepend">
								  <span class="input-group-text">
									<i class="far fa-calendar-alt"></i>
								  </span>
								</div>
								<input type="text" name="endDate" class="form-control float-right endDate">
							</div>
						</div>
						<!-- /.input group -->
					</div>
					<div class="row">
						<div class="col-2">
							<!-- Select multiple-->
							<div class="form-group">
								<label>플랜트</label>
								<select multiple class="form-control multipleSelect1 kgpbtMultiSelect">
							<?php if(@$listKey1) {
								foreach ($listKey1 as $row) {
									?>
									<option value="<?php echo $row->key1_cd; ?>"><?php echo $row->key1_nm; ?></option>

									<?php
								}
							}
							?>
								</select>
							</div>
						</div>
						<div class="col-2 hidden kgpbtLocale">
							<div class="form-group">
								<label>위치</label>
								<select multiple class="form-control multipleSelect2 kgpbtMultiSelect ">
								</select>
							</div>
						</div>
						<div class="col-2">
							<!-- Select multiple-->
							<div class="form-group">
								<label>생산설비 신뢰도 분석 1차분류</label>
								<select multiple class="form-control multipleSelect3 kgpbtMultiSelect" data-max-options="1">
									<?php if(@$kgpbtClass1) {
										foreach ($kgpbtClass1 as $row) {
											?>
											<option value="<?php echo $row->key3_cd; ?>"><?php echo $row->key3_nm; ?></option>

											<?php
										}
									}
									?>
								</select>
							</div>
						</div>
					</div>


<!--					<div class="form-group row">-->
<!--						<label for="anal_type" class="col-2 col-form-label">분석타입선택</label>-->
<!--						<div class="col-10">-->
<!--							<input name="anal_type" id="anal_type" class="form-control">-->
<!--						</div>-->
<!--					</div>-->
				</div>
			</form>

		</div>
	</div>
</div>

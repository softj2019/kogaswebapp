<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	</div>
	<!-- /.content-wrapper -->

	<!-- Control Sidebar -->
	<aside class="control-sidebar control-sidebar-dark">
		<!-- Control sidebar content goes here -->
		<div class="p-3">
			<h5>Title</h5>
			<p>Sidebar content</p>
		</div>
	</aside>
	<!-- /.control-sidebar -->

	<!-- Main Footer -->
	<footer class="main-footer">
		<!-- To the right -->
		<div class="float-right d-none d-sm-inline">
		</div>
		<!-- Default to the left -->
		<strong>KOGAS 설비 신뢰도 분석 시스템 by Minitab </strong>
	</footer>
</div>
<div class="modal fade" id="modal-user">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">비밀번호변경</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<?php
				$attributes = array('class' => 'form-horizonatal', 'id' => 'passwordChange','name' => 'passwordChange');
				echo form_open('',$attributes);
				?>
				<input type="hidden" name="user_id" value="<?php echo @$this->session->userdata('user_id') ?>">
				<div class="form-group">
					<div>
						<input type="password" name="password" placeholder="기존 비밀번호" class="form-control">
					</div>
					<p class="text-danger password">
						&nbsp;
					</p>
				</div>
				<div class="form-group">
					<div>
						<input type="password" name="new_password" placeholder="신규 비밀번호" class="form-control">
					</div>
					<p class="text-danger new_password">
						&nbsp;
					</p>

				</div>
				<div class="form-group">
					<div>
						<input type="password" name="new_password_proc" placeholder="신규 비밀번호 확인" class="form-control">
					</div>
					<p class="text-danger new_password_proc">
						&nbsp;
					</p>
				</div>
				<?php echo form_close();?>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal">취소</button>
				<button type="button" class="btn btn-primary passwordChange">변경 요청</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modal-adview">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">적합도</h4>
				<!--				<button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
				<!--					<span aria-hidden="true">&times;</span>-->
				<!--				</button>-->
			</div>
			<div class="modal-body row">

			</div>
			<div class="modal-footer justify-content-right">
				<button type="button" class="btn btn-default" id="requestAdRun">분석실행</button>

			</div>
			<div class="modal-body">
				<div class="card collapsed-card">
					<div class="card-header">
						<h3 class="card-title"> 상세보기</h3>
						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
							</button>
							<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
							</button>
						</div>

					</div>
					<div class="card-body">

					</div>
				</div>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modal-kgartRunView">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">분석 실행 정보</h4>
				<!--				<button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
				<!--					<span aria-hidden="true">&times;</span>-->
				<!--				</button>-->
			</div>
			<div class="modal-body row">

			</div>
			<div class="modal-footer justify-content-right">
				<button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- PAGE SCRIPTS -->
<div class="loading-bar-wrap hidden">
	<div class="loading-bar"></div>
</div>
<!-- jQuery -->
<script src="/assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="/assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- ChartJS -->
<script src="/assets/plugins/chart.js/Chart.min.js"></script>
<!-- Select2 -->
<script src="/assets/plugins/select2/js/select2.full.min.js"></script>

<script type="text/javascript" src="/assets/plugins/moment/moment.min.js"></script>
<script type="text/javascript" src="/assets/plugins/moment/locale/ko.js"></script>
<script type="text/javascript" src="/assets/plugins/daterangepicker/daterangepicker.js"></script>

<script src="/assets/plugins/summernote/summernote-bs4.js"></script>
<script src="/assets/dist/js/summernote-ko-KR.js"></script>

<!-- Toast -->
<script src="/assets/plugins/toast/jquery.toast.min.js"></script>
<!-- AdminLTE App -->
<script src="/assets/dist/js/adminlte.min.js"></script>
<!-- OPTIONAL SCRIPTS -->
<script src="/assets/dist/js/demo.js"></script>

<script src="/assets/dist/js/common.js"></script>
<?php
if(@$footerScript){
	?>
	<script src="<?=$footerScript?>"></script>
	<?php
}
?>
<script>
		//sweet toast init https://sweetalert2.github.io/
		// const Toast = Swal.mixin({
		// 	toast: true,
		// 	position: 'top-end',
		// 	showConfirmButton: false,
		// 	timer: 3000
		// });
		//toastr https://codeseven.github.io/toastr/demo.html
		// toastr.options = {
		// 	// "closeButton": false,
		// 	// "debug": false,
		// 	// "newestOnTop": false,
		// 	"progressBar": true,
		// 	"positionClass": "toast-top-right",
		// 	// "preventDuplicates": false,
		// 	// "onclick": null,
		// 	// "showDuration": "300",
		// 	// "hideDuration": "1000",
		// 	// "timeOut": "5000",
		// 	// "extendedTimeOut": "1000",
		// 	// "showEasing": "swing",
		// 	// "hideEasing": "linear",
		// 	// "showMethod": "fadeIn",
		// 	// "hideMethod": "fadeOut"
		// }
		$.toast.option={
			showHideTransition: 'fade', // fade, slide or plain
			allowToastClose: true, // Boolean value true or false
			hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
			stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
			position: 'top-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
			textAlign: 'left',  // Text alignment i.e. left, right or center
			loader: true,  // Whether to show loader or not. True by default
			loaderBg: '#ffffff',  // Background color of the toast loader
			beforeShow: function () {}, // will be triggered before the toast is shown
			afterShown: function () {}, // will be triggered after the toat has been shown
			beforeHide: function () {}, // will be triggered before the toast gets hidden
			afterHidden: function () {}  // will be triggered after the toast has been hidden
		};
	<?php
	if(@$insertEditorCode){
		echo $insertEditorCode;
	}
	?>
</script>

</body>
</html>

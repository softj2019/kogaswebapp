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
			Anything you want
		</div>
		<!-- Default to the left -->
		<strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
	</footer>
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
<!-- ChartJS -->
<script src="/assets/plugins/chart.js/Chart.min.js"></script>
<!-- Select2 -->
<script src="/assets/plugins/select2/js/select2.full.min.js"></script>

<script type="text/javascript" src="/assets/plugins/moment/moment.min.js"></script>
<script type="text/javascript" src="/assets/plugins/moment/locale/ko.js"></script>
<script type="text/javascript" src="/assets/plugins/daterangepicker/daterangepicker.js"></script>

<!-- Toast -->
<script src="/assets/plugins/toast/jquery.toast.min.js"></script>
<!-- AdminLTE App -->
<script src="/assets/dist/js/adminlte.min.js"></script>
<!-- OPTIONAL SCRIPTS -->
<script src="/assets/dist/js/demo.js"></script>

<script src="/assets/dist/js/common.js"></script>

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
</script>


<?php
if(@$footerScript){
	?>
	<script src="<?=$footerScript?>"></script>
	<?php
}
?>

</body>
</html>

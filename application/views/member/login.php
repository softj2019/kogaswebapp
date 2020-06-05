<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta property="og:image" content="/assets/img/ci/kogas_ci.png">
	<title>한국가스공사</title>

	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="/assets/plugins/fontawesome-free/css/all.min.css">

	<!-- Select2 -->
	<link rel="stylesheet" href="/assets/plugins/select2/css/select2.min.css">
	<link rel="stylesheet" href="/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
	<!-- iCheck for checkboxes and radio inputs -->
	<link rel="stylesheet" href="/assets/plugins/icheck-bootstrap/icheck-bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/assets/plugins/daterangepicker/daterangepicker.css" />
	<!-- Toast -->
	<link rel="stylesheet" href="/assets/plugins/toast/jquery.toast.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="/assets/dist/css/adminlte.min.css">
	<!-- Google Font: Source Sans Pro -->
	<!--	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">-->
	<link rel="stylesheet" href="/assets/dist/css/common.css">
	<script>
		var base_url ='<?=base_url()?>';
	</script>
</head>
<body class="hold-transition login-page">
<div class="login-box">
	<div class="login-logo">
<!--		<a href="../../index2.html"><b>한국도시가스</b></a>-->
		<img src="/assets/dist/img/ci/top_logo.png" />
	</div>
	<!-- /.login-logo -->
	<div class="card">
		<div class="card-body login-card-body">
			<p class="login-box-msg login_title">로그인</p>
			<?php
			$attributes = array('class' => 'form-horizontal','id' => 'default_form','name' => 'default_form');
			echo form_open('/member/login_proc', $attributes);
			?>


				<div class="input-group mb-3">
					<input type="email" class="form-control" name="email" placeholder="회사 이메일" value="<?php echo set_value('email'); ?>">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-envelope"></span>
						</div>
					</div>
				</div>
				<div class="input-group mb-3">
					<?php echo form_error('email'); ?>
				</div>
				<div class="input-group mb-3">
					<input type="password" class="form-control" name="password" placeholder="비밀번호">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-lock"></span>
						</div>
					</div>
				</div>
				<div class="input-group mb-3">
					<?php echo form_error('password'); ?>
				</div>
				<div class="row">
<!--					<div class="col-8">-->
<!--						<div class="icheck-primary">-->
<!--							<input type="checkbox" id="remember">-->
<!--							<label for="remember">-->
<!--								Remember Me-->
<!--							</label>-->
<!--						</div>-->
<!--					</div>-->
					<!-- /.col -->
					<div class="col-12">
						<button type="submit" class="btn btn-primary btn-block">로그인</button>
					</div>
					<!-- /.col -->
				</div>
			<?php
				echo form_close();
			?>

<!--			<div class="social-auth-links text-center mb-3">-->
<!--				<p>- OR -</p>-->
<!--				<a href="#" class="btn btn-block btn-primary">-->
<!--					<i class="fab fa-facebook mr-2"></i> Sign in using Facebook-->
<!--				</a>-->
<!--				<a href="#" class="btn btn-block btn-danger">-->
<!--					<i class="fab fa-google-plus mr-2"></i> Sign in using Google+-->
<!--				</a>-->
<!--			</div>-->
			<!-- /.social-auth-links -->
			<p>&nbsp;</p>
			<p class="mb-1">
<!--				<a href="/member/passwordfind" class="pw_find">비밀번호 찾기</a>-->
				<a href="/member/join" class="join">회원가입</a>

			</p>
			<p class="mb-1">
				처음 방문시 회원가입을 해주세요.
			</p>
		</div>
		<!-- /.login-card-body -->
	</div>
</div>

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

	$.toast.option={
		showHideTransition: 'fade', // fade, slide or plain
		allowToastClose: true, // Boolean value true or false
		hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
		stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
		position: 'mid-center', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
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

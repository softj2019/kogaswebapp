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
	<title>신뢰도 분석 시스템</title>
	<link rel="shortcut icon" type="image⁄x-icon" href="assets/dist/img/ci/kogas_ci.ico">

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
	<!-- summernote -->
	<link rel="stylesheet" href="/assets/plugins/summernote/summernote-bs4.css">

	<link rel="stylesheet" href="/assets/dist/css/common.css">
	<script>
		var base_url ='<?=base_url()?>';
	</script>
</head>
<body class="sidebar-mini layout-fixed">
<div class="wrapper">

	<!-- Navbar -->
	<nav class="main-header navbar navbar-expand navbar-white navbar-light">
		<!-- Left navbar links -->
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
			</li>
		</ul>
		<!-- Right navbar links -->
		<ul class="navbar-nav ml-auto">
			<!-- Messages Dropdown Menu -->

			<li class="nav-item">
				<a class="nav-link" href="/member/logout">
					<i class="fas fa-power-off"></i>로그아웃
			</a>
			</li>
		</ul>
	</nav>
	<!-- /.navbar -->

	<!-- Main Sidebar Container -->
	<aside class="main-sidebar sidebar-dark-primary elevation-4">
		<!-- Brand Logo -->
		<a href="/" class="brand-link">

			<span class="brand-text font-weight-light">설비 신뢰도 분석시스템</span>
		</a>

		<!-- Sidebar -->
		<div class="sidebar">
			<!-- Sidebar user panel (optional) -->
<!--			<div class="user-panel mt-3 pb-3 mb-3 d-flex">-->
<!--				<div class="image">-->
<!--					<img src="/assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">-->
<!--				</div>-->


<!--			</div>-->

			<!-- Sidebar Menu -->
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
					<!-- Add icons to the links using the .nav-icon class
						 with font-awesome or any other icon font library -->
<!--					<li class="nav-item has-treeview menu-open">-->
<!--						<a href="#" class="nav-link active">-->
<!--							<i class="nav-icon fas fa-tachometer-alt"></i>-->
<!--							<p>-->
<!--								대시보드-->
<!--								<i class="right fas fa-angle-left"></i>-->
<!--							</p>-->
<!--						</a>-->
<!--						<ul class="nav nav-treeview">-->
<!--							<li class="nav-item">-->
<!--								<a href="#" class="nav-link active">-->
<!--									<i class="far fa-circle nav-icon"></i>-->
<!--									<p>Active Page</p>-->
<!--								</a>-->
<!--							</li>-->
<!--							<li class="nav-item">-->
<!--								<a href="#" class="nav-link">-->
<!--									<i class="far fa-circle nav-icon"></i>-->
<!--									<p>Inactive Page</p>-->
<!--								</a>-->
<!--							</li>-->
<!--						</ul>`-->
<!--					</li>-->

					<li class="nav-item">

						<a href="javascript:void(0);" class="nav-link" data-toggle="modal" data-target="#modal-user">
							<p>
								<?=@$this->session->userdata('name')?>
								<span class="badge badge-info right">
								<i class="fas fa-user"></i> &nbsp;MyPage
						</span>
							</p>
						</a>

					</li>
					<li class="nav-item">
						<a href="/" class="nav-link <?=$menu_code=='001'?'active':''?>">
							<i class="nav-icon fas fa-tachometer-alt"></i>
							<p>
								대시보드
<!--								<span class="right badge badge-danger">New</span>-->
							</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="/kgbasicpbt/writeform" class="nav-link <?=$menu_code=='005'?'active':''?>">
							<i class="nav-icon fas fa-chart-area"></i>
							<p>
								기초 통계 분석(생산)
								<!--								<span class="right badge badge-danger">New</span>-->
							</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="/kgbasicsbt/writeform" class="nav-link <?=$menu_code=='006'?'active':''?>">
							<i class="nav-icon fas fa-chart-area"></i>
							<p>
								기초 통계 분석(공급)
								<!--								<span class="right badge badge-danger">New</span>-->
							</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="/kgpbt/writeform" class="nav-link <?=$menu_code=='003'?'active':''?>">
							<i class=" nav-icon fas fa-chart-line"></i>
							<p>
								신뢰도 분석(생산)
								<!--								<span class="right badge badge-danger">New</span>-->
							</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="/kgsbt/writeform" class="nav-link <?=$menu_code=='004'?'active':''?>">
							<i class="nav-icon fas fa-chart-line"></i>
							<p>
								신뢰도 분석(공급)
								<!--								<span class="right badge badge-danger">New</span>-->
							</p>
						</a>
					</li>

					<li class="nav-item">
						<a href="/kgrct/kgrctlist" class="nav-link <?=$menu_code=='008'?'active':''?>">
							<i class="nav-icon far fa-list-alt"></i>
							<p>
								분석 결과 조회
								<!--								<span class="right badge badge-danger">New</span>-->
							</p>
						</a>
					</li>
					<?php if(@$this->session->userdata('is_admin')) {?>
					<li class="nav-item <?=$menu_code=='009' || $menu_code=='011'|| $menu_code=='012'?'menu-open':''?>">
						<a href="" class="nav-link <?=$menu_code=='009' || $menu_code=='011' ||  $menu_code=='012'?'active':''?>">
							<i class="nav-icon fas fa-cogs"></i>
							<p>
								관리자 메뉴
								<!--								<span class="right badge badge-danger">New</span>-->
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="/console/mguser" class="nav-link <?=$menu_code=='009'?'active':''?>">
									<i class="far fa-circle nav-icon"></i>
									<p>사용자관리</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="/console/loginhistory" class="nav-link <?=$menu_code=='011'?'active':''?>" >
									<i class="far fa-circle nav-icon"></i>
									<p>로그인 이력</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="/console/boardlist?board_type=A" class="nav-link <?=$menu_code=='012'?'active':''?>" >
									<i class="far fa-circle nav-icon"></i>
									<p>도움말 관리</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="/console/allfdata" class="nav-link <?=$menu_code=='021'?'active':''?>" >
									<i class="far fa-circle nav-icon"></i>
									<p>전체 고장 데이터</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="/console/mgphour" class="nav-link <?=$menu_code=='022'?'active':''?>" >
									<i class="far fa-circle nav-icon"></i>
									<p>예방정비주기 설정</p>
								</a>
							</li>
						</ul>
					</li>
					<?php } ?>
					<li class="nav-item">
						<a href="/board/boardlist?board_type=A" class="nav-link <?=$menu_code=='010'?'active':''?>">
							<i class="nav-icon fab fa-hire-a-helper"></i>
							<p>
								도움말
								<!--								<span class="right badge badge-danger">New</span>-->
							</p>
						</a>
					</li>
				</ul>
			</nav>
			<!-- /.sidebar-menu -->
		</div>
		<!-- /.sidebar -->
	</aside>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0 text-dark"><?php echo $page_title; ?></h1>
					</div><!-- /.col -->
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active"><?php echo $page_title; ?></li>
						</ol>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.container-fluid -->
		</div>
		<!-- /.content-header -->

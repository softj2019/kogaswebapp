<?php
/**
 * Created by PhpStorm.
 * User: road
 * Date: 2019-10-11
 * Time: 오전 4:56
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<body class="hold-transition sidebar-mini layout-navbar-fixed" style="height: auto;">
<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-light navbar-white">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" href="<?php echo site_url('main');?>">
                    <i class="fas fa-home"></i>
                </a>
            </li>
            <!-- Notifications Dropdown Menu -->

            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                    <i class="flag-icon flag-icon-kr"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right p-0">
                    <a href="#" class="dropdown-item active">
                        <i class="flag-icon flag-icon-kr mr-2"></i> 한국어
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="flag-icon flag-icon-cn mr-2"></i> 中文
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="flag-icon flag-icon-us mr-2"></i> English
                    </a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> 4 new messages
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-users mr-2"></i> 8 friend requests
                        <span class="float-right text-muted text-sm">12 hours</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-file mr-2"></i> 3 new reports
                        <span class="float-right text-muted text-sm">2 days</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" href="<?php echo site_url('member/logout');?>">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </li>
        </ul>
    </nav>
    <aside class="main-sidebar elevation-3 sidebar-red-red">
        <!-- Brand Logo -->
        <a href="<?php echo base_url('main');?>" class="brand-link elevation-3 navbar-red">
            <img src="<?php echo assets_url();?>img/logo-60x60.png" alt="sat Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Social Algo trading</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item has-treeview">
                        <a  href="<?php echo site_url("admin");?>" class="nav-link <?php if($menu_code=='001'){echo "active";};?>" >
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                대시보드
                                <?php if($menu_code=='001'){echo "<i class=\"right fas fa-angle-right\"></i>";};?>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo site_url("admin/leaderoption");?>" class="nav-link <?php if($menu_code=='002'){echo "active";};?>">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>
                                리더 옵션 관리
                                <?php if($menu_code=='002'){echo "<i class=\"right fas fa-angle-right\"></i>";};?>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="<?php echo site_url("admin/feesetting");?>" class="nav-link <?php if($menu_code=='003'){echo "active";};?>">
                            <i class="nav-icon fas fa-dollar-sign"></i>
                            <p>
                                수수료 관리
                                <?php if($menu_code=='003'){echo "<i class=\"right fas fa-angle-right\"></i>";};?>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="<?php echo site_url("admin/plansetting");?>" class="nav-link <?php if($menu_code=='004'){echo "active";};?>">
                            <i class="nav-icon fas fa-shopping-cart"></i>

                            <p>
                                상품 관리
                                <?php if($menu_code=='004'){echo "<i class=\"right fas fa-angle-right\"></i>";};?>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview ">
                        <a href="<?=base_url('admin/member');?>" class="nav-link <?php if($menu_code=='005'){echo "active";};?>">
                            <i class="nav-icon fas fa-user-friends"></i>
                            <p>
                                회원관리
                                <?php if($menu_code=='005'){echo "<i class=\"right fas fa-angle-right\"></i>";};?>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="<?=base_url('admin/memberfee');?>" class="nav-link <?php if($menu_code=='006'){echo "active";};?>">
                            <i class="nav-icon fas fa-funnel-dollar"></i>
                            <p>
                                회원 수수료 관리
                                <?php if($menu_code=='006'){echo "<i class=\"right fas fa-angle-right\"></i>";};?>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="<?=base_url('admin/paidfeehistory');?>" class="nav-link <?php if($menu_code=='0061'){echo "active";};?>">
                            <i class="nav-icon fas fa-funnel-dollar"></i>
                            <p>
                                회원 수수료 내역
                                <?php if($menu_code=='0061'){echo "<i class=\"right fas fa-angle-right\"></i>";};?>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="<?=base_url('admin/approval');?>" class="nav-link <?php if($menu_code=='007'){echo "active";};?>">
                            <i class="nav-icon fas fa-check-circle"></i>
                            <p>
                                입출금 관리
                                <?php if($menu_code=='007'){echo "<i class=\"right fas fa-angle-right\"></i>";};?>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="<?=base_url('admin/config');?>" class="nav-link <?php if($menu_code=='008'){echo "active";};?>">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>
                                기본설정
                                <?php if($menu_code=='008'){echo "<i class=\"right fas fa-angle-right\"></i>";};?>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="<?=base_url('admin/alert');?>" class="nav-link <?php if($menu_code=='009'){echo "active";};?>">
                            <i class="nav-icon fas fa-bell"></i>
                            <p>
                                알림설정
                                <?php if($menu_code=='009'){echo "<i class=\"right fas fa-angle-right\"></i>";};?>
                            </p>
                        </a>
                    </li>
                    <!--                  <li class="nav-header">EXAMPLES</li>-->
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
    <div class="content-wrapper" style="min-height: 1144.69px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><?php echo $page_title; ?><span class="content-title-k"><?php echo $page_sub_title; ?></span></h1>
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

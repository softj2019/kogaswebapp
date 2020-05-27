<?php
/**
 * Created by PhpStorm.
 * User: road
 * Date: 2019-10-09
 * Time: 오후 11:04
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
                <?php if(@$this->session->userdata('is_admin')){?>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="<?php echo site_url('admin');?>">
                        <i class="fas fa-cog"></i>
                    </a>
                </li>
                <?php } ?>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                        <?=@$this->session->userdata('lang_cd')=='korean'?' <i class="flag-icon flag-icon-kr"></i>':''?>
                        <?=@$this->session->userdata('lang_cd')=='english'?' <i class="flag-icon flag-icon-us"></i>':''?>
                        <?=@$this->session->userdata('lang_cd')=='china'?' <i class="flag-icon flag-icon-cn"></i>':''?>
                        <?=!@$this->session->userdata('lang_cd')?' <i class="flag-icon flag-icon-kr"></i>':''?>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right p-0">
                        <a href="<?=site_url('auth/lang?lang_cd=korean')?>" class="dropdown-item ">
                            <i class="flag-icon flag-icon-kr mr-2"></i> 한국어
                        </a>
                        <a href="<?=site_url('auth/lang?lang_cd=china')?>" class="dropdown-item ">
                            <i class="flag-icon flag-icon-cn mr-2"></i> 中文
                        </a>
                        <a href="<?=site_url('auth/lang?lang_cd=english')?>" class="dropdown-item ">
                            <i class="flag-icon flag-icon-us mr-2"></i> English
                        </a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge"><?=$alert_list?'!':''?></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <?php if($alert_list) {
                            foreach ($alert_list as $row) {
                                ?>
                                <div class="dropdown-divider"></div>
                                <a href="<?=site_url('app/alertmessage?alert_id='.$row->alert_id)?>" class="dropdown-item">
                                    <i class="fas fa-envelope mr-2"></i><?=iconv_substr($row->memo, 0, 5, "utf-8");?>
                                    <span class="float-right text-muted text-sm"></span>
                                </a>
                                <?php
                            }
                        }?>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link" href="<?php echo site_url('user/mypage')?>">
                        <i class="fas fa-user"></i>
                    </a>
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
            <a href="<?php echo site_url('main');?>" class="brand-link elevation-3 navbar-red">
                <img src="<?php echo assets_url();?>img/logo-60x60.png" alt="sat Logo" class="brand-image img-circle elevation-3"
                     style="opacity: .8">
                <span class="brand-text font-weight-light">Social Algo trading</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                             with font-awesome or any other icon font library -->
                        <li class="nav-item has-treeview">
                            <a href="<?php echo site_url('main');?>" class="nav-link <?php if($menu_code=='001'){echo "active";};?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    <?=$this->lang->line('dashboard')?>
                                    <?php if($menu_code=='001'){echo "<i class=\"right fas fa-angle-right\"></i>";};?>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo site_url('app/product');?>" class="nav-link <?php if($menu_code=='002'){echo "active";};?>">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>
                                    <?=$this->lang->line('product_shop')?>
                                    <?php if($menu_code=='002'){echo "<i class=\"right fas fa-angle-right\"></i>";};?>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview menu-open">
                            <a href="<?php echo site_url('app/fee');?>" class="nav-link <?php if($menu_code=='003'){echo "active";};?>">
                                <i class="nav-icon fas fa-check-circle"></i>
                                <p>
                                    <?=$this->lang->line('fee_history')?>
                                    <?php if($menu_code=='003'){echo "<i class=\"right fas fa-angle-right\"></i>";};?>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="<?php echo site_url('app/withdraw');?>" class="nav-link <?php if($menu_code=='004'){echo "active";};?>">
                                <i class="nav-icon fas fa-dollar-sign"></i>
                                <p>
                                    <?=$this->lang->line('withdrawal')?>
                                    <?php if($menu_code=='004'){echo "<i class=\"right fas fa-angle-right\"></i>";};?>
                                </p>
                            </a>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="<?php echo site_url('app/account');?>" class="nav-link <?php if($menu_code=='005'){echo "active";};?>">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    <?=$this->lang->line('account')?>
                                    <?php if($menu_code=='005'){echo "<i class=\"right fas fa-angle-right\"></i>";};?>
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


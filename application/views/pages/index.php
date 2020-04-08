<!doctype html>
<html lang="en"> 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?=$title?></title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?=site_url()?>assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="<?=site_url()?>assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=site_url()?>assets/libs/css/style.css">
    <link rel="stylesheet" href="<?=site_url()?>assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="<?=site_url('assets/vendor/select2/css/select2.css')?>">
    <link rel="stylesheet" href="<?=site_url('assets/vendor/alertify/css/alertify.css')?>">
    <link rel="stylesheet" href="<?=site_url('assets/vendor/jquery-ui/jquery-ui.css')?>">
    <link rel="stylesheet" href="<?=site_url('assets/vendor/summernote/css/summernote-bs4.css')?>">
    <script src="<?=site_url('assets/vendor/alertify/alertify.min.js')?>"></script>
    <script src="<?=site_url('assets/sites/lib.alert.js')?>"></script>
    <script src="<?=site_url('assets/vendor/jquery/jquery-3.3.1.min.js')?>"></script>
    <script src="<?=site_url('assets/vendor/jquery-ui/jquery-ui.js')?>"></script>
    <script src="<?=site_url('assets/vendor/select2/js/select2.min.js')?>"></script>
    <script src="<?=site_url('assets/vendor/summernote/js/summernote-bs4.js')?>"></script>
</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
       <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand text-danger" href="<?=site_url()?>">
                    <i>Sim<span class="text-dark">mas</span>.co.id</i>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        <li class="nav-item">
                            <div id="custom-search" class="top-search-bar">
                                <input class="form-control" type="text" placeholder="Search..">
                            </div>
                        </li>
                        <li class="nav-item dropdown notification">
                            <a class="nav-link nav-icons" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-fw fa-bell"></i> <span class="indicator"></span></a>
                            <ul class="dropdown-menu dropdown-menu-right notification-dropdown">
                                <li>
                                    <div class="notification-title"> Notification</div>
                                    <div class="notification-list">
                                        <div class="list-group">
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="notification-info">
                                                    <div class="notification-list-user-img"><img src="../assets/images/avatar-3.jpg" alt="" class="user-avatar-md rounded-circle"></div>
                                                    <div class="notification-list-user-block"><span class="notification-list-user-name">John Abraham</span>is now following you
                                                        <div class="notification-date">2 days ago</div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="list-footer"> <a href="#">View all notifications</a></div>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown connection">
                            <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-fw fa-th"></i> </a>
                            <ul class="dropdown-menu dropdown-menu-right connection-dropdown">
                                <li class="connection-list">
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                                            <a href="#" target="_blank" class="connection-item">
                                                <i class="fa fa-desktop fa-2x"></i>
                                                <span>SIMDAGA</span>
                                            </a>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                                            <a href="#" target="_blank" class="connection-item">
                                                <i class="fa fa-desktop fa-2x"></i>
                                                <span>SIMDAKEL</span>
                                            </a>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                                            <a href="#" target="_blank" class="connection-item">
                                                <i class="fa fa-desktop fa-2x"></i>
                                                <span>SIMDAKEC</span>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?=site_url('assets/images/avatar-1.jpg')?>" alt="" class="user-avatar-md rounded-circle"></a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name">Safril Sidik</h5>
                                    <span class="status"></span><span class="ml-2">Development Staff</span>
                                </div>
                                <a class="dropdown-item" href="#"><i class="fas fa-user mr-2"></i>Akun</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-cog mr-2"></i>Pengaturan</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-power-off mr-2"></i>Keluar</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="<?=site_url("sites-app/dashboard.aspx")?>"><i>SIMMAS</i></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">App. Version v.0.1.19</li>
                            <li class="nav-item ">
                                <a class="nav-link" href="<?=site_url('sites-app/dashboard.aspx')?>"><i class="fa fa-fw fa-desktop"></i>Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class="fa fa-fw fa-users"></i>Manajemen Clients</a>
                                <div id="submenu-2" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?=site_url('sites-app/dashboard/register.aspx')?>">Registrasi Desa</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?=site_url('sites/systems/requirements/kependudukan')?>">Data Kependudukan</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="fas fa-fw fa-bolt"></i>Manajemen Users</a>
                                <div id="submenu-3" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?=site_url('sites-app/dashboard/access-users.aspx')?>">Users Akses</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1"><i class="fa fa-fw fa-comments"></i>Manajemen Informasi</a>
                                <div id="submenu-1" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?=site_url('sites-app/dashboard/users-info.aspx')?>">Media Informasi</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?=site_url('sites-app/dashboard/user-info-whatsapp.aspx')?>">Whatsapp Informasi</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?=site_url('sites-app/dashboard/user-info-email.aspx')?>">Email Informasi</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-4" aria-controls="submenu-4"><i class="fas fa-fw fa-database"></i>Pengaturan Sistem</a>
                                <div id="submenu-4" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?=site_url('sites-app/dashboard/access-locations.aspx')?>">Penetapan Lokasi</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Engine Set Up</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Database Feature</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-5" aria-controls="submenu-5"><i class="fas fa-fw fa-print"></i>Reporting</a>
                                <div id="submenu-5" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Users Reporting</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Disk Reporting</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content">
                    <!-- ============================================================== -->
                    <!-- pageheader -->
                    <!-- ============================================================== -->
                    <div class="ecommerce-widget">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="page-header">
                                    <h2 class="pageheader-title"><?=$pageTitle?></h2>
                                    <div class="page-breadcrumb">
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <?php foreach ($breadCrumb as $value) { ?>
                                                    <li class="breadcrumb-item"><a href="<?=site_url($value['link'])?>" class="breadcrumb-link"><?=$value['sub']?></a></li>
                                                <?php } ?>
                                                
                                            </ol>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <?=$contents?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer" style="position: fixed;bottom: 0;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-right">
                            <i>Copyright © 2019 @
                                <a href="">
                                    <span class="text-danger">Sim<span class="text-dark">mas</span>.co.id</span>
                                </a> All right reserved. Support by <span style="color:orange">Reshaffa Technology</span>
                            </i>
                        </div>
                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8 text-right">
                            
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <script src="<?=site_url()?>assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="<?=site_url()?>assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <script src="<?=site_url()?>assets/libs/js/main-js.js"></script>
</body>
</html>
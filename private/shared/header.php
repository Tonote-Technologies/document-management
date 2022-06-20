<?php  
require_login() ; 
if(empty($loggedInAdmin)){
    redirect_to(url_for('logout.php'));
}
?>
<?php echo $page_title == 'Edit Document' ? '' : '<Doctype />' ?>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Document Edit.">
    <meta name="keywords" content=" web app">
    <meta name="author" content="TONOTE">
    <title><?php echo $page_title ?></title>
    <link rel="apple-touch-icon" href="apple-icon-120.html">
    <link rel="shortcut icon" type="image/x-icon" href="ico/favicon.ico">
    <link href="css/css219a5.css?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo url_for('assets/css/vendors.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo url_for('assets/css/toastr.min.css') ?>">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo url_for('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo url_for('assets/css/bootstrap-extended.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo url_for('assets/css/colors.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo url_for('assets/css/components.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo url_for('assets/css/dark-layout.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo url_for('assets/css/bordered-layout.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo url_for('assets/css/semi-dark-layout.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo url_for('assets/css/select2.min.css') ?>">


    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo url_for('assets/css/horizontal-menu.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo url_for('assets/css/dashboard-ecommerce.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo url_for('assets/css/ext-component-toastr.min.css') ?>">



    <?php if ($page == 'Dashboard') { ?>
    <link rel="stylesheet" type="text/css" href="<?php echo url_for('assets/css/app-email.min.css') ?>">
    <link rel="stylesheet" type="text/css"
        href="<?php echo url_for('assets/css/ext-component-sweet-alerts.min.css') ?>">
    <?php  } ?>
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo url_for('assets/css/style.css') ?>">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu 1-column navbar-floating footer-static  " data-open="hover"
    data-menu="horizontal-menu" data-col="1-column">

    <!-- BEGIN: Header-->
    <nav style="height: 70px"
        class="header-navbar navbar-expand-lg navbar navbar-fixed align-items-center navbar-shadow navbar-brand-center"
        data-nav="brand-center">
        <div class="navbar-header d-xl-block d-none">
            <ul class="nav navbar-nav">
                <li class="nav-item">
                    <a class="navbar-brand" href="<?php echo url_for('dashboard/') ?>">
                        <img src="<?php echo url_for('assets/images/logo-dark.png') ?>" alt="" height="26">
                        <!-- <span class="brand-logo">Logo Goes here</span> -->
                        <!-- <h2 class="brand-text mb-0">Vuexy</h2> -->
                    </a>
                </li>
            </ul>
        </div>
        <div class="navbar-container d-flex content">
            <div class="bookmark-wrapper d-flex align-items-center">
                <ul class="nav navbar-nav bookmark-icons">
                    <li class="nav-item d-none d-lg-block">
                        <a class="nav-link" href="<?php echo url_for('dashboard/') ?>" data-bs-toggle="tooltip"
                            data-bs-placement="bottom" title="Documents">
                            <i class="ficon" data-feather="mail"></i>
                        </a>
                    </li>

                </ul>

            </div>
            <ul class="nav navbar-nav align-items-center ms-auto">

                <li class="nav-item dropdown dropdown-user">
                    <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none">
                            <span$ class="user-name fw-bolder"><?php echo $loggedInAdmin->full_name(); ?></span$>
                            <span class="user-status">active</span>
                        </div>
                        <span class="avatar">
                            <!-- <img class="round" src="jpg/avatar-s-11.jpg" alt="avatar" height="40" width="40"> -->
                            <span class="avatar-status-online"></span>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                        <a class="dropdown-item" href="<?php echo url_for('dashboard/') ?>">
                            <i class="me-50" data-feather="user"></i>
                            Profile</a><a class="dropdown-item" href="<?php echo url_for('dashboard/') ?>"><i
                                class="me-50" data-feather="mail"></i> Inbox</a>


                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <i class="me-50" data-feather="settings"></i> Settings</a>

                        <a class="dropdown-item" href="#"><i class="me-50" data-feather="credit-card"></i>
                            Pricing</a>

                        <a class="dropdown-item" href="#"><i class="me-50" data-feather="help-circle"></i> FAQ</a>
                        <a class="dropdown-item" href="<?php echo url_for('/logout.php') ?>"><i class="me-50"
                                data-feather="power"></i>
                            Logout</a>
                    </div>
                </li>

            </ul>
        </div>
    </nav>



    <!-- END: Header-->

    <!-- BEGIN: Content-->
    <div class="app-content content <?php echo $page == 'Dashboard' ? 'email-application' : '' ?>">
        <div class="content-overlay"></div>
        <div class="header-navbar shadow-lg"></div>
        <div class="content-wrapper container-xxl p-0">

            <div class="content-body">
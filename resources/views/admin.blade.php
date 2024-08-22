<?php
session_start();
if (!isset($_SESSION['userId'])) {
    echo "<script>
        document.location.href='/';
    </script>";
} else {
    $userId = $_SESSION['userId'];
    $userNm = $_SESSION['userNm'];
    $level = $_SESSION['level'];
    $koperasi_id = $_SESSION['id_koperasi'];
    $nama_koperasi = $_SESSION['nama_koperasi'];
    $toko_id = $_SESSION['id_toko'];
    $nama_toko = $_SESSION['nama_toko'];
    $namaUser = $_SESSION['namaUser'];
    $no_account = $_SESSION['noAccount'];
    $homePrevileges = $_SESSION['homePrevileges'];
    $menuPrevileges = $_SESSION['menuPrevileges'];
    $step1Previleges = $_SESSION['step1Previleges'];

?>

    <!DOCTYPE html>
    <html lang="en">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />

    <head>
        <style>
            .bg-rki {
                background: #2A3B6A !important;
            }

            .pcoded-navbar {
                overflow: auto;
                scrollbar-width: thin;
                scrollbar-color: #56699d transparent;
            }

            /* Custom scrollbar styles */
            .pcoded-navbar::-webkit-scrollbar {
                width: 12px;
            }

            .pcoded-navbar::-webkit-scrollbar-track {
                background: transparent;
            }

            .pcoded-navbar::-webkit-scrollbar-thumb {
                background-color: #56699d;
                border: 3px solid transparent;
                background-clip: padding-box;
            }
        </style>
        <?php
        $kalimat = $_SERVER['HTTP_HOST'];
        //$kalimat = "http://astinfos.com";
        if (strpos($kalimat, "orecoops") == true) {
            echo "<title>CORE @ " . $_SERVER['HTTP_HOST'] . "</title>
         <link rel='icon' href='/template/files/assets/images/logo_corecoops.png' type='image/x-icon'> 
        ";
        } else if (strpos($kalimat, "kiapp") == true) {
            echo "<title>RKI @ " . $_SERVER['HTTP_HOST'] . "</title>
        <link rel='icon' href='/template/files/assets/images/rki_splash_blue.png' type='image/x-icon'>
        ";
        } else if (strpos($kalimat, "astinfos") == true) {
            echo "<title>" . $_SERVER['HTTP_HOST'] . "</title>
        <link rel='icon' href='/template/files/assets/images/astinfos_icon.png' type='image/x-icon'>
        ";
        } else {
            echo "<title> @ " . $_SERVER['HTTP_HOST'] . "</title>
         <link rel='icon' href='/template/files/assets/images/rki_splash_blue.png' type='image/x-icon'> 
        ";
        } ?>
        @include('include')
    </head>
    <script>
        function toDashboard() {
            $(".main-body").load("/template/view/Dashboard.html", function() {
                //alert(menus);
                getDonut();
            });
        }
    </script>

    <body onLoad="toDashboard();">
        <!-- Pre-loader end -->
        <div id="pcoded" class="pcoded">
            <div class="pcoded-overlay-box"></div>
            <div class="pcoded-container navbar-wrapper">

                <nav class="navbar header-navbar pcoded-header bg-rki text-white">
                    <div class="navbar-wrapper">

                        <div class="navbar-logo bg-rki">
                            <a class="mobile-menu" id="mobile-collapse" href="#!">
                                <i class="feather icon-menu text-white " style="font-size:25px;"></i>
                            </a>
                            <a href="#!" onClick="location.reload()">
                                <span style="font-family:calibri;font-size:35px;font-weight:bold;">&nbsp;
                                    <!--<img class="img-fluid rounded" height="35px" width="60px" src="/template/files/assets/images/rki_splash.png" alt="Theme-Logo" /> --></span>
                            </a>
                            <a class="mobile-options">
                                <i class="feather icon-more-horizontal text-white"></i>
                            </a>
                        </div>

                        <div class="navbar-container">
                            <ul class="nav-left">

                                <li class="header-search">
                                    <a href="#!">
                                        <i class="feather  full-screen text-white"> &nbsp; <span id="menuTitle" style="font-family:  Calibri;font-size:20px;font-weight: bold;">DASHBOARD</span></i>
                                    </a>
                                </li>
                                <!--
                            <li class="header-search">
                                <div class="main-search morphsearch-search">
                                    <div class="input-group">
                                        <span class="input-group-addon search-close"><i class="feather icon-x text-white "></i></span>
                                        <input type="text" class="form-control">
                                        <span class="input-group-addon search-btn"><i class="feather icon-search text-white "></i></span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()">
                                    <i class="feather icon-maximize full-screen text-white "></i>
                                </a>
                            </li>
                            -->
                            </ul>
                            <ul class="nav-right">
                                <li onClick="toolBarNew();">
                                    <button id="btnNew" title="NEW" class="btn rounded toolbar_hris"><i class="fa-solid fa-file-circle-plus"></i></button>
                                </li>
                                <li onClick="toolBarInquery();">
                                    <button id="btnInq" title="INQUERY" class="btn rounded toolbar_hris"><i class="fa-solid fa-magnifying-glass"></i></button>
                                </li>

                                <li onClick="toolBarSave();">
                                    <button id="btnSave" title="SAVE" class="btn rounded toolbar_hris"><i class="fa-solid fa-floppy-disk"></i></button>
                                </li>
                                <!--
                                <li onClick="toolBarDelete();">
                                    <button id="btnDelete" title="DELETE" class="btn btn-disabled rounded toolbar_hris_disabled"><i class="fa-solid fa-trash-can"></i></button>
                                </li>
                                <li onClick="toolBarPrint();">
                                    <button id="btnPrint" title="PRINT" class="btn btn-disabled rounded toolbar_hris_disabled"><i class="fa-solid fa-print"></i></button>
                                </li>-->
                                <li>
                                    &nbsp;
                                </li>

                                <!-- notification matiin dl
                            <li class="header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="dropdown-toggle " data-toggle="dropdown">
                                        <i class="feather icon-bell" style="font-size:25px;"></i>
                                        <span class="badge bg-c-pink">1</span>
                                    </div>
                                    
                                    <ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        <li>
                                            <h6>Notifications</h6>
                                            <label class="label label-danger">New</label>
                                        </li>
                                        <li>
                                            <div class="media">
                                                <img class="d-flex align-self-center img-radius" src="/template/files/assets/images/avatar-4.jpg" alt="Generic placeholder image">
                                                <div class="media-body">
                                                    <h5 class="notification-user">Trial Notification </h5>
                                                    <p class="notification-msg text-dark">Lorem ipsum dolor sit amet, consectetuer elit.
                                                    </p>
                                                    <span class="notification-time">30 minutes ago</span>
                                                </div>
                                            </div>
                                        </li>
                                        
                                        <li>
                                            <div class="media">
                                                <img class="d-flex align-self-center img-radius" src="/template/files/assets/images/avatar-3.jpg" alt="Generic placeholder image">
                                                <div class="media-body">
                                                    <h5 class="notification-user">Joseph William</h5>
                                                    <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.
                                                    </p>
                                                    <span class="notification-time">30 minutes ago</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="media">
                                                <img class="d-flex align-self-center img-radius" src="/template/files/assets/images/avatar-4.jpg" alt="Generic placeholder image">
                                                <div class="media-body">
                                                    <h5 class="notification-user">Sara Soudein</h5>
                                                    <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.
                                                    </p>
                                                    <span class="notification-time">30 minutes ago</span>
                                                </div>
                                            </div>
                                        </li> 
                                    </ul>
                                    
                                </div>
                            </li> -->

                                <!--
                            <li class="header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="displayChatbox dropdown-toggle" data-toggle="dropdown">
                                        <i class="feather icon-message-square" style="font-size:25px;"></i>
                                        <span class="badge bg-c-green">3</span>
                                    </div>
                                </div>
                            </li> -->
                                <li class="user-profile header-notification">
                                    <div class="dropdown-primary dropdown">
                                        <div class="dropdown-toggle" data-toggle="dropdown">
                                            <img src="/template/files/assets/images/<?php echo $userId ?>.jpg" class="img-radius" alt="">
                                            <span><?php echo $userNm ?> </span>
                                            <input type="hidden" id="login_userId" name="login_userId" value="<?php echo $userId ?>" readonly>
                                            <input type="hidden" id="login_kop_name" name="login_kop_name" value="<?php echo $nama_koperasi ?>" readonly>
                                            <input type="hidden" id="login_kop_id" name="login_kop_id" value="<?php echo $koperasi_id ?>" readonly>
                                            <input type="hidden" id="login_toko_name" name="login_kop_name" value="<?php echo $nama_toko ?>" readonly>
                                            <input type="hidden" id="login_toko_id" name="login_kop_id" value="<?php echo $toko_id ?>" readonly>
                                            <input type="hidden" id="login_no_account" name="login_no_account" value="<?php echo $no_account ?>" readonly>
                                            <i class="feather icon-chevron-down"></i>
                                        </div>
                                        <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                            <li>
                                                <a href="#">
                                                    <i class="feather icon-home"></i> <?php echo $nama_koperasi  ?>
                                                </a>
                                            </li>

                                            <li onclick=''>
                                                <a href="#">
                                                    <i class="fa fa-usd"></i> <span id="account_saldo">Saldo:</span>
                                                </a>
                                            </li>
                                            <li onclick=''>
                                                <a href="#">
                                                    <i class="fa fa-usd"></i> <span id="account_mobile">Acount:</span>
                                                </a>
                                            </li>

                                            <li onclick="">
                                                <a href="#">
                                                    <i class="feather icon-user"></i> <?php echo $namaUser ?>
                                                </a>
                                            </li>

                                            <?php

                                            for ($x = 0; $x < count($step1Previleges); $x++) {

                                                if ($step1Previleges[$x]->menuClass == "STEP1" && $step1Previleges[$x]->menuAction == "MSA01M12") {
                                            ?>
                                                    <li onclick='changeMenu("/template/view/<?php echo $step1Previleges[$x]->menuLink ?>","<?php echo $step1Previleges[$x]->menuTitle ?>","<?php echo $step1Previleges[$x]->menuAction ?>");'>
                                                        <a href="#">
                                                            <i class="feather <?php echo $step1Previleges[$x]->menuIcon ?>"></i><?php echo $step1Previleges[$x]->menuTitle ?>
                                                        </a>
                                                    </li>
                                            <?php
                                                }
                                            }
                                            ?>


                                            <li onclick="Logout()">
                                                <form name="frmLogout" id="frmLogout" method="POST">
                                                    <a><input type="hidden" name="cmd" value="LOGOUT">
                                                        <i class="feather icon-log-out"></i> Logout
                                                    </a>
                                                </form>
                                            </li>

                                            <!-- 
                                        <li>
                                            <a href="#!">
                                                <i class="feather icon-settings"></i> Settings
                                            </a>
                                        </li>
                                        <li>
                                            <a href="default/email-inbox.html">
                                                <i class="feather icon-mail"></i> My Messages
                                            </a>
                                        </li>
                                        
                                        <li>
                                            <a href="default/auth-lock-screen.html">
                                                <i class="feather icon-lock"></i> Lock Screen
                                            </a>
                                        </li>
                                        -->

                                        </ul>

                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>


                <!-- Sidebar chat start -->
                <!--
            <div id="sidebar" class="users p-chat-user showChat">
                <div class="had-container">
                    <div class="card card_main p-fixed users-main">
                        <div class="user-box">
                            <div class="chat-inner-header">
                                <div class="back_chatBox">
                                    <div class="right-icon-control">
                                        <input type="text" class="form-control  search-text" placeholder="Search Friend" id="search-friends">
                                        <div class="form-icon">
                                            <i class="icofont icofont-search"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="main-friend-list">
                                <div class="media userlist-box" data-id="1" data-status="online" data-username="Josephin Doe" data-toggle="tooltip" data-placement="left" title="Josephin Doe">
                                    <a class="media-left" href="#!">
                                        <img class="media-object img-radius img-radius" src="/template/files/assets/images/avatar-3.jpg" alt="Generic placeholder image ">
                                        <div class="live-status bg-success"></div>
                                    </a>
                                    <div class="media-body">
                                        <div class="f-13 chat-header">Josephin Doe</div>
                                    </div>
                                </div>
                                <div class="media userlist-box" data-id="2" data-status="online" data-username="Lary Doe" data-toggle="tooltip" data-placement="left" title="Lary Doe">
                                    <a class="media-left" href="#!">
                                        <img class="media-object img-radius" src="/template/files/assets/images/avatar-2.jpg" alt="Generic placeholder image">
                                        <div class="live-status bg-success"></div>
                                    </a>
                                    <div class="media-body">
                                        <div class="f-13 chat-header">Lary Doe</div>
                                    </div>
                                </div>
                                <div class="media userlist-box" data-id="3" data-status="online" data-username="Alice" data-toggle="tooltip" data-placement="left" title="Alice">
                                    <a class="media-left" href="#!">
                                        <img class="media-object img-radius" src="/template/files/assets/images/avatar-4.jpg" alt="Generic placeholder image">
                                        <div class="live-status bg-success"></div>
                                    </a>
                                    <div class="media-body">
                                        <div class="f-13 chat-header">Alice</div>
                                    </div>
                                </div>
                                <div class="media userlist-box" data-id="4" data-status="online" data-username="Alia" data-toggle="tooltip" data-placement="left" title="Alia">
                                    <a class="media-left" href="#!">
                                        <img class="media-object img-radius" src="/template/files/assets/images/avatar-3.jpg" alt="Generic placeholder image">
                                        <div class="live-status bg-success"></div>
                                    </a>
                                    <div class="media-body">
                                        <div class="f-13 chat-header">Alia</div>
                                    </div>
                                </div>
                                <div class="media userlist-box" data-id="5" data-status="online" data-username="Suzen" data-toggle="tooltip" data-placement="left" title="Suzen">
                                    <a class="media-left" href="#!">
                                        <img class="media-object img-radius" src="/template/files/assets/images/avatar-2.jpg" alt="Generic placeholder image">
                                        <div class="live-status bg-success"></div>
                                    </a>
                                    <div class="media-body">
                                        <div class="f-13 chat-header">Suzen</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             -->
                <!-- Sidebar inner chat start-->
                <!--
            <div class="showChat_inner">
                <div class="media chat-inner-header">
                    <a class="back_chatBox">
                        <i class="feather icon-chevron-left"></i> Josephin Doe
                    </a>
                </div>
                <div class="media chat-messages">
                    <a class="media-left photo-table" href="#!">
                        <img class="media-object img-radius img-radius m-t-5" src="/template/files/assets/images/avatar-3.jpg" alt="Generic placeholder image">
                    </a>
                    <div class="media-body chat-menu-content">
                        <div class="">
                            <p class="chat-cont">I'm just looking around. Will you tell me something about yourself?</p>
                            <p class="chat-time">8:20 a.m.</p>
                        </div>
                    </div>
                </div>
                <div class="media chat-messages">
                    <div class="media-body chat-menu-reply">
                        <div class="">
                            <p class="chat-cont">I'm just looking around. Will you tell me something about yourself?</p>
                            <p class="chat-time">8:20 a.m.</p>
                        </div>
                    </div>
                    <div class="media-right photo-table">
                        <a href="#!">
                            <img class="media-object img-radius img-radius m-t-5" src="/template/files/assets/images/avatar-4.jpg" alt="Generic placeholder image">
                        </a>
                    </div>
                </div>
                <div class="chat-reply-box p-b-20">
                    <div class="right-icon-control">
                        <input type="text" class="form-control search-text" placeholder="Share Your Thoughts">
                        <div class="form-icon">
                            <i class="feather icon-navigation"></i>
                        </div>
                    </div>
                </div>
            </div>
            -->
                <!-- Sidebar inner chat end-->
                <div class="pcoded-main-container">
                    <div class="pcoded-wrapper">
                        <nav class="pcoded-navbar" style="overflow:auto;scrollbar-color:#56699d transparent;scrollbar-width:thin; ">
                            <div id="menuId" class="pcoded-inner-navbar main-menu bg-baru">
                                <div class="pcoded-navigatio-lavel">All Dashboard</div>
                                <ul class="pcoded-item pcoded-left-item">
                                    <li class="pcoded-hasmenu active pcoded-trigger">
                                        <a href="javascript:void(0)">
                                            <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                                            <span class="pcoded-mtext">DASHBOARD</span>
                                        </a>
                                        <ul class="pcoded-submenu">
                                            <li class="active" style="cursor:pointer;">
                                                <a onClick="location.reload()">
                                                    <span class="pcoded-mtext">ALL</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>

                                <div class="pcoded-navigatio-lavel">Master </div>
                                <ul class="pcoded-item pcoded-left-item">
                                    <?php
                                    for ($x = 0; $x < count($menuPrevileges); $x++) {
                                        if ($menuPrevileges[$x]->menuClass == "MENU" && $menuPrevileges[$x]->menuTipe == "MASTER") {
                                    ?>
                                            <li class="pcoded-hasmenu">
                                                <a href="javascript:void(0)">
                                                    <span class="pcoded-micon"><i class="feather <?php echo $menuPrevileges[$x]->menuIcon ?>"></i></span>
                                                    <span class="pcoded-mtext font-weight-bold"><?php echo $menuPrevileges[$x]->menuName ?></span>
                                                </a>

                                                <ul class="pcoded-submenu">
                                                    <?php
                                                    for ($p = 0; $p < count($step1Previleges); $p++) {
                                                        if ($menuPrevileges[$x]->menuClass == "MENU" && $menuPrevileges[$x]->menuTipe == "MASTER" && $menuPrevileges[$x]->menuOrder == substr($step1Previleges[$p]->menuOrder, 0, 3)) { ?>
                                                            <li class="" onclick=' changeMenu("/template/view/<?php echo $step1Previleges[$p]->menuLink ?> ","<?php echo $step1Previleges[$p]->menuTitle ?>","<?php echo $step1Previleges[$p]->menuAction ?>");'>
                                                                <a href="javascript:void(0)">
                                                                    <span class="pcoded-mtext font-weight-bold"><?php echo $step1Previleges[$p]->menuName ?> </span>
                                                                </a>
                                                            </li>
                                                    <?php
                                                        }
                                                    } ?>
                                                </ul>
                                            </li>
                                    <?php
                                        }
                                    }
                                    ?>
                                </ul>



                                <div class="pcoded-navigatio-lavel">Transaksi </div>
                                <ul class="pcoded-item pcoded-left-item">
                                    <?php
                                    for ($x = 0; $x < count($menuPrevileges); $x++) {
                                        if ($menuPrevileges[$x]->menuClass == "MENU" && $menuPrevileges[$x]->menuTipe == "TRANSAKSI") {
                                    ?>
                                            <li class="pcoded-hasmenu">
                                                <a href="javascript:void(0)">
                                                    <span class="pcoded-micon"><i class="fa-solid <?php echo $menuPrevileges[$x]->menuIcon ?>"></i></span>
                                                    <span class="pcoded-mtext font-weight-bold"><?php echo $menuPrevileges[$x]->menuName ?></span>
                                                </a>

                                                <ul class="pcoded-submenu">
                                                    <?php
                                                    for ($p = 0; $p < count($step1Previleges); $p++) {
                                                        if ($menuPrevileges[$x]->menuClass == "MENU" && $menuPrevileges[$x]->menuTipe == "TRANSAKSI" && $menuPrevileges[$x]->menuOrder == substr($step1Previleges[$p]->menuOrder, 0, 3)) { ?>
                                                            <li class="" onclick=' changeMenu("/template/view/<?php echo $step1Previleges[$p]->menuLink ?> ","<?php echo $step1Previleges[$p]->menuTitle ?>","<?php echo $step1Previleges[$p]->menuAction ?>");'>
                                                                <a href="javascript:void(0)">
                                                                    <span class="pcoded-mtext font-weight-bold"><?php echo $step1Previleges[$p]->menuName ?> </span>
                                                                </a>
                                                            </li>
                                                    <?php
                                                        }
                                                    } ?>
                                                </ul>
                                            </li>
                                    <?php
                                        }
                                    }
                                    ?>

                                </ul>



                                <div class="pcoded-navigatio-lavel">Laporan </div>
                                <ul class="pcoded-item pcoded-left-item">
                                    <?php
                                    for ($x = 0; $x < count($menuPrevileges); $x++) {
                                        if ($menuPrevileges[$x]->menuClass == "MENU" && $menuPrevileges[$x]->menuTipe == "LAPORAN") {
                                    ?>
                                            <li class="pcoded-hasmenu">
                                                <a href="javascript:void(0)">
                                                    <span class="pcoded-micon"><i class="fa-solid <?php echo $menuPrevileges[$x]->menuIcon ?> "></i></span>
                                                    <span class="pcoded-mtext font-weight-bold"><?php echo $menuPrevileges[$x]->menuName ?></span>
                                                </a>

                                                <ul class="pcoded-submenu">
                                                    <?php
                                                    for ($p = 0; $p < count($step1Previleges); $p++) {
                                                        if ($menuPrevileges[$x]->menuClass == "MENU" && $menuPrevileges[$x]->menuTipe == "LAPORAN" && $menuPrevileges[$x]->menuOrder == substr($step1Previleges[$p]->menuOrder, 0, 3)) { ?>
                                                            <li class="" onclick=' changeMenu("/template/view/<?php echo $step1Previleges[$p]->menuLink ?> "," <?php echo $step1Previleges[$p]->menuTitle ?>"," <?php echo $step1Previleges[$p]->menuAction ?>");'>
                                                                <a href="javascript:void(0)">
                                                                    <span class="pcoded-mtext font-weight-bold"><?php echo $step1Previleges[$p]->menuName ?> </span>
                                                                </a>
                                                            </li>
                                                    <?php
                                                        }
                                                    } ?>
                                                </ul>
                                            </li>
                                    <?php
                                        }
                                    }
                                    ?>

                                </ul>
                                <br>
                                <br>
                            </div>




                        </nav>


                        <div id="errorLabel" class="rounded" style="display :none;border:5px outset red;background-color:red;text-align:center;color:#fff;position: absolute;top:40%;left: 25%;width:70%;height:15%;z-index:100;font-size:80px;">
                        </div>

                        <div class="pcoded-content">
                            <div class="pcoded-inner-content" style="padding:0px !important;">
                                <div class="main-body" style="padding-top:10px;margin-left:10px;margin-right:10px;">

                                    <!-- End Content -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>

    </html>
<?php
}
?>
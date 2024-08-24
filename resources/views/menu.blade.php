<?php
session_start();
if (!isset($_SESSION['userId'])) {
    echo "<script>
        window.location.href='/';
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
    $homePrevileges = $_SESSION['homePrevileges'];

    //echo count($menuPrivileges);
    //var_dump($menuPrivileges) ;
    //var_dump($menuPrivileges[0]->menuClass) ;


?>

    <!DOCTYPE html>
    <html lang="en">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />

    <head>
    <?php
        $kalimat = $_SERVER['HTTP_HOST'];
        //$kalimat = "http://astinfos.com";
        if (strpos($kalimat, "orecoops") == true) {
            echo "<title>CORE @ " . $_SERVER['HTTP_HOST'] . "</title>
        <link rel='icon' href='/template/files/assets/images/rspp.png' type='image/x-icon'>
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

    <body onLoad="getDonut();">
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
                                <span style="font-family:calibri;font-size:35px;font-weight:bold;"></span>
                            </a>
                            <a class="mobile-options">
                                <i class="feather icon-more-horizontal text-white"></i>
                            </a>
                        </div>

                        <div class="navbar-container">
                            <ul class="nav-left">

                                <li class="header-search">
                                    <a href="#!">
                                        <i class="feather  full-screen text-white"> &nbsp; <span id="menuTitle" style="font-family:  Calibri;font-size:20px;font-weight: bold;">MENU</span></i>
                                    </a>
                                </li>

                            </ul>

                        </div>
                    </div>
                </nav>



                <!-- Sidebar inner chat end-->
                <div class="pcoded-main-container">
                    <div class="pcoded-wrapper">
                        <nav class="pcoded-navbar" style="overflow:auto;">

                            <div id="menuId" class="pcoded-inner-navbar main-menu">
                                <div class="pcoded-navigatio-lavel text-center "><span class="text-white">Profile</span></div>
                                <ul class="pcoded-item pcoded-left-item">
                                    <li class="pcoded-hasmenu active pcoded-trigger text-center">
                                        <img src="/template/files/assets/images/<?php echo "NOIMAGE" ?>.jpg" class="img-radius " alt="" width="150px" height="150px">
                                    </li>
                                    <li class="pcoded-hasmenu active pcoded-trigger text-center">
                                        &nbsp;
                                    </li>
                                    <li class="pcoded-hasmenu active pcoded-trigger text-center">
                                        <span class="text-white"><?php echo $userNm ?></span>
                                    </li>
                                    <li class="pcoded-hasmenu active pcoded-trigger text-center">
                                        <span class="text-white"><?php echo $nama_koperasi ?></span>
                                    </li>
                                    <li class="pcoded-hasmenu active pcoded-trigger text-center">
                                        <span class="text-white"><?php echo $nama_toko ?></span>
                                    </li>
                                    <li class="pcoded-hasmenu active pcoded-trigger text-center">
                                        <button class="btn btn-danger" onclick="Logout()"><i class="fa-solid fa-right-from-bracket"></i> Log Out</button>
                                    </li>

                                </ul>
                            </div>
                    </div>


                    </nav>


                    <div id="errorLabel" class="rounded" style="display :none;border:5px outset red;background-color:red;text-align:center;color:#fff;position: absolute;top:40%;left: 25%;width:70%;height:15%;z-index:100;font-size:80px;">
                    </div>

                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body" style="margin-left:10px;margin-right:10px;">
                                <div class="row">
                                    <?php
                                    for ($x = 0; $x < count($homePrevileges); $x++) {
                                        if ($homePrevileges[$x]->menuClass == "MODUL") {
                                    ?>
                                            <div class="col-xl-6 col-md-6 col-sm-6 col-xs-12 " style="cursor:pointer" onclick="document.location.href='/admin' ">
                                                <div class="card social-card bg-simple-c-<?php echo $homePrevileges[$x]->menuColor ?> ">
                                                    <div class="card-block">
                                                        <div class="row align-items-center">
                                                            <div class="col-auto">

                                                                <i class="fa-solid <?php echo $homePrevileges[$x]->menuIcon ?> f-34 text-c-<?php echo $homePrevileges[$x]->menuColor ?> social-icon"></i>
                                                            </div>
                                                            <div class="col">
                                                                <h6 class="m-b-2 font-weight-bold "><?php echo $homePrevileges[$x]->menuName ?></h6>
                                                                <p><?php echo $homePrevileges[$x]->menuTitle ?></p>
                                                                <p class="m-b-0"><?php echo $homePrevileges[$x]->menuDesc ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="#!" class="download-icon"><i class="feather icon-arrow-down"></i></a>
                                                </div>
                                            </div>
                                    <?php

                                        }
                                    }
                                    ?>



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
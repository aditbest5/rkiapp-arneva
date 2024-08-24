<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <?php
    $kalimat = $_SERVER['HTTP_HOST'];
    //$kalimat = "http://astinfos.com";
    if (strpos($kalimat, "orecoops") == true) {
        echo "<title>CORE @  " . $_SERVER['HTTP_HOST'] . "</title>
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

    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="#">
    <meta name="keywords" content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="#">

    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="/template/files/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="/template/files/assets/icon/feather/css/feather.css">

    <!-- animation css -->
    <link rel="stylesheet" type="text/css" href="/template/files/bower_components/animate.css/animate.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="/template/files/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="/template/files/assets/css/jquery.mCustomScrollbar.css">

    <script type="text/javascript" src="/template/files/bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="/template/files/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/template/files/assets/js/sweetalert2.js"></script>
    <script src="/template/files/assets/js/umum.js"></script>


    <script>
        function login() {
            var userId = document.getElementById("userId").value;
            var userPwd = document.getElementById("userPwd").value;
            //document.location.href = "/view/jsp/general/login.jsp";
            // api/umum/  
            $.get("api/umum/", {
                    cmd: "selLogin",
                    userId: userId,
                    userPwd: userPwd

                },
                function(data, status) {
                    //alert("Data: " + data + "\nStatus: " + status);
                    //alert("Data: " + data.length);
                    //console.log(myArr.length);
                    const myArr = JSON.parse(data);
                    if (myArr.length == 0) {
                        salert("Tidak Ada Data", 'warning', 'Warning');
                    } else {
                        if (myArr["sts"] == "N") {
                            salert(myArr["msg"], 'error', 'Warning \n' + myArr["desc"]);
                        } else {
                            //alert(myArr["RECORDS"][0]["idname"]);
                            const myArr = JSON.parse(data);
                            //console.log(myArr.length);
                            $('#bodyModal').text("SELAMAT DATANG " + myArr[0]["namaUser"]);
                            //$('#fUserId').val(myArr[0]["userId"]);
                            //$('#formUserNm').val(myArr[0]["userNm"]);
                            //$('#formIdx').val(myArr[0]["idx"]);
                            //$('#formNamaKoperasi').val(myArr[0]["nama_koperasi"]);

                            $('#labelModal').text("    LOGIN BERHASIL");
                            $("#ModalOk").modal("show")
                            //toAdmin();
                        }
                    }

                }).fail(function(e) {
                console.log(e);
                // Handle error here
                $('#bodyModalError').text("ERROR CODE  " + e.statusText);
                $('#labelModalError').text("ERROR " + e.status);
                $("#ModalError").modal("show")
            });

        }

        function fnEnter() {
            if (event.keyCode === 13) {
                // Cancel the default action, if needed
                login();
            }
        }

        function rfEnter() {
            if (event.keyCode === 13) {
                var userid = $('#userId').val()
                if (userid.length > 8) {
                    login();
                }
                // Cancel the default action, if needed
                //login();
            }
        }

        function toAdmin() {
            document.location.href = "/home";
            //$("#ModalOk").modal("hide")
            //$('#formUserId').val($('#fUserId').val())
            //$("#frmLogin").submit();

        }

        function animates() {}
    </script>

</head>




<body class="fix-menu" onload="showLink()">
    <section id="login_background" class="login-block">
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->

                    <form class="md-float-material form-material" name="frmLogin" id="frmLogin" method="POST">
                        <div class="auth-box card">
                            <div id="ic" class="tada animated">
                                <div class="text-center rounded py-2">
                                    <img src="<?php
                                                if (strpos($kalimat, "orecoops") == true) {
                                                    echo "/template/files/assets/images/corecoops.png";
                                                } else if (strpos($kalimat, "kiapp") == true) {
                                                    echo "/template/files/assets/images/rki_splash_blue.png";
                                                } else if (strpos($kalimat, "astinfos") == true) {
                                                    echo "/template/files/assets/images/astinfos_icon.png";
                                                } else {
                                                    echo " /template/files/assets/images/rki_splash_blue.png";
                                                } ?>" width="100px" height="100px" alt="logo.png">
                                    <br>
                                    <h2>LOGIN<h2>
                                </div>
                            </div>
                            <div class="card-block">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-center" style="font-size:30px;font-weight:bold;" id="judul">
                                        </h3>
                                    </div>
                                </div>
                                <div class="form-group form-primary">
                                    <input type="text" name="userId" id="userId" onkeydown="rfEnter();" class="form-control" required="" maxlength="20" placeholder="User ID" title="maximamal 20 character">
                                    <span class="form-bar"></span>
                                </div>
                                <div class="form-group form-primary">
                                    <input type="password" name="userPwd" id="userPwd" class="form-control" required="" autocomplete="on" title="maximamal 20 character" maxlength="20" placeholder="Password" onkeydown="fnEnter();">
                                    <span class="form-bar"></span>
                                </div>
                                <div class="row m-t-10 text-left">
                                    <div class="col-12">
                                        <div class="checkbox-fade fade-in-primary d-">
                                            <a href="auth-reset-password.html" class="text-right f-w-600" style="display: none"> Sign Up ?
                                            </a>
                                        </div>
                                        <div class="forgot-phone text-right f-right">
                                            <a href="auth-reset-password.html" class="text-right f-w-600" style="display: none"> Forgot
                                                Password?</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-10">
                                    <div class="col-md-12">
                                        <button type="button" onclick="login();" class="btn btn-info btn-md btn-block waves-effect waves-light text-center m-b-20 font-weight-bold">Sign
                                            in</button>
                                    </div>
                                </div>
                                <hr />
                                <!--
                                <div class="row">
                                    <div class="col-2">
                                        <div id="ic1" class="shake animated"> <img src="/template/files/assets/icon/carton.png" width="40px" height="40px" alt="logo.png"></div>
                                    </div>
                                    <div class="col-2">
                                        <div id="ic2" class="swing animated"><img src="/template/files/assets/icon/machine.png" width="40px" height="40px" alt="logo.png"></div>
                                    </div>
                                    <div class="col-2">
                                        <div id="ic3" class="shake animated"><img src="/template/files/assets/icon/machine2.png" width="40px" height="40px" alt="logo.png"></div>
                                    </div>
                                    <div class="col-2">
                                        <div id="ic4" class="swing animated"><img src="/template/files/assets/icon/setting.png" width="40px" height="40px" alt="logo.png"></div>
                                    </div>
                                    <div class="col-2">
                                        <div id="ic4" class="shake animated"><img src="/template/files/assets/icon/person.png" width="40px" height="40px" alt="logo.png"></div>
                                    </div>
                                    <div class="col-2">
                                        <div id="ic5" class="swing animated"><img src="/template/files/assets/icon/truck2.png" width="40px" height="40px" alt="logo.png"></div>
                                    </div>
                                </div>-->

                            </div>
                        </div>
                    </form>
                    <!-- end of form -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>



    <!-- Modal -->
    <div class="modal fade" id="ModalOk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="top:35%" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3><i class="feather icon-check-square text-primary  font-weight-bold "></i></h3>
                    <h5 id="labelModal" class="modal-title"> LOGIN SUCCESS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="bodyModal" class="modal-body text-center font-weight-bold ">
                    SELAMAT DATANG
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="fUserId">
                    <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
                    <button type="button" class="btn btn-primary" onclick="toAdmin();">OK</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ModalError" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="top:35%" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3><i class="feather icon-x text-danger  font-weight-bold "></i></h3>
                    <h5 id="labelModalError" class="modal-title"> LOGIN GAGAL</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="bodyModalError" class="modal-body text-center font-weight-bold ">
                    ERROR
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>







</body>

</html>
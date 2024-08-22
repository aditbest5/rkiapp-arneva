<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <title>LOADING</title>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="#">
    <meta name="keywords" content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="#">
    <!-- Favicon icon -->
    <link rel="icon" href="/template/files/assets/images/loading.gif" type="image/x-icon">

    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="/template/files/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="/template/files/assets/icon/feather/css/feather.css">

    <!-- animation css -->
    <link rel="stylesheet" type="text/css" href="/template/files/bower_components/animate.css/animate.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="/template/files/assets/css/style.css">


    <script type="text/javascript" src="/template/files/bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="/template/files/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>




    <script>
        function showLink() {
            document.location.href = "/login";
        }
    </script>

</head>




<body class="fix-menu" onload="showLink()">
    <section id="login_background" class="login-block">
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->

                    <form class="md-float-material form-material" name="frmLogin" id="frmLogin" method="POST" action="corecoops_admin">
                        <div class="auth-box card">
                            <div id="ic" class="tada animated">
                                <div class="text-center rounded py-5">
                                    <span class="font-weight-bold">PLEASE WAIT .......</span>
                                    <br>
                                    <img src="/template/files/assets/images/loading.gif" width="200px" height="200px" alt="logo.png">
                                </div>
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









</body>

</html>
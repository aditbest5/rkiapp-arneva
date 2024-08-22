var d = new Date();
var pktr = d.getFullYear() + "" + d.getMonth() + "" + d.getDate() + "" + d.getHours() + "" + d.getMinutes() + "" + d.getSeconds() + d.getMilliseconds();

function getTokenKaspro(tipe, command) {
    $.ajax({
        url: 'api/kaspro',
        type: 'POST',
        "cors": true,
        "crossDomain": true,
        "crossOrigin": true,
        data: {
            "cmd": "getTokenKasPro",
            "grant_type": "client_credentials",
            "url": 'https://apigw-devel.kaspro.id/authentication-server/oauth/token'
        },
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
            'Accept': 'application/json'
        },
        dataType: 'json',
        success: function (data) {
            //console.log(data);
            const myJsonString = JSON.stringify(data);
            const myArr = JSON.parse(myJsonString);
            var access_token = "Bearer " + myArr["access_token"];
            var hmacSecret = myArr["hmacSecret"];
            var hmacKey = myArr["hmacKey"];
            if (command == "kasProCustomerAccountInquery") {
                kasProCustomerAccountInquery(tipe, access_token, hmacSecret, hmacKey);
            } else if (command == "kasProBillerPayment") {
                kasProBillerPayment(tipe, access_token, hmacSecret, hmacKey);
            }
        }
    });
}

function kasProCustomerAccountInquery(tipe, access_token, hmacSecret, hmacKey) {
    var url = "/customer-account-inquiry/";
    var dateRequest = new Date().toUTCString();
    var signatureContentString = "(request-target): get " + url + "\n";
    signatureContentString = signatureContentString + "date: " + dateRequest;
    var hash = CryptoJS.HmacSHA256(signatureContentString, hmacSecret);
    var hashInBase64 = CryptoJS.enc.Base64.stringify(hash);
    var hashInBase64UrlEncoded = encodeURIComponent(hashInBase64);
    var signature = 'Signature keyId="' + hmacKey + '",algorithm="hmac-sha256",headers="(request-target) date",signature="' + hashInBase64UrlEncoded + '"';
    var storage = window.localStorage;
    var noAccount = storage.getItem("login_no_account");

    $.ajax({
        url: 'api/kaspro',
        type: 'POST',
        data: {
            "cmd": "customerAccountInquery",
            "Authorization": access_token,
            "signature": signature,
            "noAccount": noAccount,
            "date": dateRequest
        }, dataType: 'json',
        success: function (data) {
            const myJsonString = JSON.stringify(data);
            const myArr = JSON.parse(myJsonString);

            if (tipe == "DASHBOARD") {
                if (myArr["code"] == "110005") {
                    $('#saldo').text("Rp 0");
                } else {
                    $('#saldo').text("Rp " + myArr["data"]["balance"]["availableBalance"]);
                    console.log(" Acount:" + myArr["data"]["mobileNumber"] + " Balance: " + myArr["data"]["balance"]["availableBalance"]);
                }
            } else if (tipe == "TOPUP") {
                if (myArr["code"] == "110005") {
                    salert("Nomor Anda Belum Terdaftar !");
                } else {
                    $("#modalTopUpName").text(myArr["data"]["fullName"]);
                    $("#modalTopUpSaldo").text(myArr["data"]["balance"]["availableBalance"]);
                    $("#modalTopUpNoAcount").text(myArr["data"]["mobileNumber"]);
                }
            } else if (tipe == "BAYAR_PPOB") {
                if (myArr["code"] == "110005") {
                    salert("Nomor Anda Belum Terdaftar !");
                    $("#saldo_ewallet").text("Saldo : 0");
                    $("#bayar").css("display", "none");
                } else {
                    $("#nama_ewallet").text("Nama : " + myArr["data"]["fullName"]);
                    $("#saldo_ewallet").text("Saldo : " + myArr["data"]["balance"]["availableBalance"]);
                    $("#nomor_ewallet").text("Nomor : " + myArr["data"]["mobileNumber"]);
                }
            }

        }
    });
}

function kasProBillerPayment(tipe, access_token, hmacSecret, hmacKey) {

    var url = "/biller-payment/";
    var dateRequest = new Date().toUTCString();
    var signatureContentString = "(request-target): post " + url + "\n";
    signatureContentString = signatureContentString + "date: " + dateRequest;
    var hash = CryptoJS.HmacSHA256(signatureContentString, hmacSecret);
    var hashInBase64 = CryptoJS.enc.Base64.stringify(hash);
    var hashInBase64UrlEncoded = encodeURIComponent(hashInBase64);
    var signature = 'Signature keyId="' + hmacKey + '",algorithm="hmac-sha256",headers="(request-target) date",signature="' + hashInBase64UrlEncoded + '"';

    var storage = window.localStorage;
    var noAccount = storage.getItem("login_no_account");
    var ppobid = storage.getItem("PPOB_ID");
    var d = new Date();
    var requestId = "ARV-PPOB-" + d.getFullYear() + "" + d.getMonth() + "" + d.getDate() + "" + d.getHours() + "" + d.getMinutes() + "" + d.getSeconds() + d.getMilliseconds();
    const valPpob = JSON.parse(storage.getItem("valPpob"));
    var productCode="";
    var Account="";
    if (tipe == "MOBILE_BAYAR_PPOB") {
         productCode=valPpob["Code"];
         Account=valPpob["Account"];
    }else if(tipe == "MOBILE_BAYAR_PPOB_TAGIHAN"){
        productCode=valPpob["data"]["productCode"];
        Account=valPpob["data"]["Account"];
    }
    console.log("dd");
    console.log(productCode);

    $.ajax({
        url: 'api/kaspro',
        type: 'POST',
        data: {
            "cmd": "billerPayment",
            "tipe": tipe,
            "productCode":productCode ,
            "Account": Account,
            "ppobid": ppobid,
            "requestId": requestId,
            "Authorization": access_token,
            "signature": signature,
            "noAccount": noAccount,
            "date": dateRequest
        }, dataType: 'json',
        success: function (data) {
            const myJsonString = JSON.stringify(data);
            const myArr = JSON.parse(myJsonString);

            if (tipe == "MOBILE_BAYAR_PPOB" ||tipe == "MOBILE_BAYAR_PPOB_TAGIHAN" ) {
                if (myArr["sts"] == "OK") {
                    $("#myModal").modal('hide');
                    salert("Transaksi Sukses", "success", "Success");
                    if ($("#flexRadioVirtual").prop("checked") == true) {
                        salert("Not Support This Type", "warning", "warning");
                        //salertFunction(myArr["desc"] + "\n", 'success', 'Success', "TunaiKoperasi", param);
                    } else if ($("#flexRadioTunaiKoperasi").prop("checked") == true) {
                        salert("Not Support This Type", "warning", "warning");
                        //salertFunction(myArr["desc"] + "\n", 'success', 'Success', "Va", param);
                    } else if ($("#flexRadioTunai").prop("checked") == true) {
                        salertFunction(myArr["desc"] + "\n", 'success', 'Success', "Tunai", ppobid);
                    }

                } else {
                    //$('#saldo').text("Rp 0");
                }
            }
        }
    }).done(function (msg) {
        $("#myModal").modal('hide');
    }).fail(function (jqXHR, textStatus) {
        salert("Request failed: " + textStatus);
        $("#myModal").modal('hide');
    });

}



function swalStartLoading() {
    Swal.fire({
        title: "Processing...",
        text: "Please, wait",
        html: "<center><h1> <i class='fa-solid fa-arrows-rotate text-info rotate-refresh' ></i></h1><br>Please Wait .... </center>",
        buttons: false,
        confirmButtonColor: '#3085d6',
        closeOnClickOutside: true

    });
}

function swalFinishLoading() {
    Swal.close();
}

function swalStopLoading(txt, icon, sts) {
    Swal.close();
    Swal.fire({
        title: sts,
        text: txt,
        icon: icon,
        closeOnClickOutside: true
    });
}

function salert(txt, icon, sts) {
    var but = "#2dcee3";
    if (icon == "error") {
        but = "#e2445c";
    } else if (icon == "success") {
        but = "#00c874";
    } else if (icon == "warning") {
        but = "#fdaa3d";
    } else if (icon == "info") {
        but = "#0073ea";
    }
    Swal.fire({
        title: sts,
        text: txt,
        icon: icon,
        confirmButtonColor: but,
        closeOnClickOutside: true
    });
}


function salertFunction(txt, icon, title, fct, param) {
    var but = "#2dcee3";
    if (icon == "error") {
        but = "#e2445c";
    } else if (icon == "success") {
        but = "#00c874";
    } else if (icon == "warning") {
        but = "#fdaa3d";
    } else if (icon == "info") {
        but = "#0073ea";
    } else if (icon == "question") {
        but = "#0c5bad";
    }

    Swal.fire({
        title: title,
        text: txt,
        icon: icon,
        showCancelButton: false,
        confirmButtonColor: but,
        cancelButtonColor: '#d33',
        confirmButtonText: 'OK'
    }).then((result) => {
        if (result.isConfirmed) {
            window[fct](param);
        }
    })

}


function salertOptionFunction(txt, icon, title, fct, param) {
    var but = "#2dcee3";
    if (icon == "error") {
        but = "#e2445c";
    } else if (icon == "success") {
        but = "#00c874";
    } else if (icon == "warning") {
        but = "#fdaa3d";
    } else if (icon == "info") {
        but = "#0073ea";
    } else if (icon == "question") {
        but = "#0c5bad";
    }

    Swal.fire({
        title: title,
        text: txt,
        icon: icon,
        showCancelButton: true,
        confirmButtonColor: but,
        cancelButtonColor: '#d33',
        confirmButtonText: 'OK'
    }).then((result) => {
        if (result.isConfirmed) {
            window[fct](param);
        }
    })

}

function goBack() {
    history.back()
}

function goBackDashboard() {
    var a = window.localStorage.getItem("tipe_login");
    if (a == "KOPERASI") {
        document.location.href = "/mobile_dashboard_koperasi";
    } else if (a == "TOKO") {
        document.location.href = "/mobile_dashboard_toko";
    } else if (a == "RSPP") {
        document.location.href = "/mobile_dashboard_anggota";
    } else if (a == "ANGGOTA") {
        document.location.href = "/mobile_dashboard_anggota";
    }
}

function goBackLogin() {
    var a = window.localStorage.getItem("tipe_login");
    window.localStorage.setItem("tipe_login", "");
    if (a == "KOPERASI") {
        document.location.href = "/mobile_login_koperasi";
    } else if (a == "TOKO") {
        document.location.href = "/mobile_login_toko";
    } else if (a == "RSPP") {
        document.location.href = "/mobile_login_anggota";
    } else if (a == "ANGGOTA") {
        document.location.href = "/mobile_login_anggota";
    }
}


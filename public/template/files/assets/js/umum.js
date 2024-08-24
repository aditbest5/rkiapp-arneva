function swalStartLoading() {
    Swal.fire({
        title: "Proses Data...",
        text: "please, wait",
        imageUrl: "/template/files/assets/images/loading.gif",
        buttons: false,
        confirmButtonColor: "#3085d6",
        closeOnClickOutside: true,
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
        closeOnClickOutside: true,
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
        closeOnClickOutside: true,
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
        cancelButtonColor: "#d33",
        confirmButtonText: "OK",
    }).then((result) => {
        if (result.isConfirmed) {
            window[fct](param);
        }
    });
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
        but = "#00c874";
    }

    Swal.fire({
        title: title,
        text: txt,
        icon: icon,
        showCancelButton: true,
        confirmButtonColor: but,
        cancelButtonColor: "#d33",
        confirmButtonText: "OK",
    }).then((result) => {
        if (result.isConfirmed) {
            window[fct](param);
        }
    });
}

function downloadExcell(idxHeader, dataTable) {
    var htmls = "";
    var uri = "data:application/vnd.ms-excel;base64,";
    var template =
        '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>';
    var base64 = function (s) {
        return window.btoa(unescape(encodeURIComponent(s)));
    };

    var format = function (s, c) {
        return s.replace(/{(\w+)}/g, function (m, p) {
            return c[p];
        });
    };

    idxHeader = idxHeader.replace("#", "");
    var header = document.getElementById(idxHeader).innerHTML;

    header = "<table border='1' > <tr bgcolor='#2dcee3' >" + header + "</tr>";
    htmls = header + dataTable + "</table>";
    //console.log(htmls);

    var ctx = {
        worksheet: "Worksheet",
        table: htmls,
    };

    var link = document.createElement("a");
    link.download = "export.xls";
    link.href = uri + base64(format(template, ctx));
    link.click();
}

function openAllGrid(idxDataTable, idxCard, tableId, dataTable) {
    var table = $(idxDataTable).DataTable();
    var screenHeight = $(document).height();
    screenHeight = (screenHeight * 70) / 100;
    //alert(screenHeight);
    $(idxCard).height(screenHeight);
    $(idxCard).css("overflow", "auto");
    table.destroy();
    $(tableId).html(dataTable);
}

function minimizeAllGrid(idxDataTable, tableId, dataTable) {
    var table = $(idxDataTable).DataTable();
    table.destroy();
    $(tableId).html(dataTable);
    $(idxDataTable).DataTable({
        fixedHeader: true,
    });
}

function toolBarInquery() {
    var a = document.getElementById("btnInq").className;
    var position = a.search("_disabled");
    if (position > 0) {
        salert("You Dont Have Acces !!", "error", "Error");
    } else {
        fnInquery();
    }
}

function toolBarNew() {
    var a = document.getElementById("btnNew").className;
    var position = a.search("_disabled");
    if (position > 0) {
        salert("You Dont Have Acces !!", "error", "Error");
    } else {
        fnNew();
    }
}

function toolBarSave() {
    var a = document.getElementById("btnSave").className;
    var position = a.search("_disabled");
    if (position > 0) {
        salert("You Dont Have Acces !!", "error", "Error");
    } else {
        fnSave();
    }
}

function toolBarDelete() {
    var a = document.getElementById("btnDelete").className;
    var position = a.search("_disabled");
    if (position > 0) {
        salert("You Dont Have Acces !!", "error", "Error");
    } else {
        fnDelete();
    }
}

function toolBarPrint() {
    var a = document.getElementById("btnPrint").className;
    var position = a.search("_disabled");
    if (position > 0) {
        salert("You Dont Have Acces !!", "error", "Error");
    } else {
        fnPrint();
    }
}

function changeMenu(menus, title, menuid) {
    if (menus == "") {
        salert(" This Menu is Underconstracted !! ", "warning", "Warning");
        return;
    }
    if (title == "POS" || title == "POS SIMPLE" || title == "PPOB") {
        $("#btnNew").removeClass("toolbar_hris");
        $("#btnInq").removeClass("toolbar_hris");
        $("#btnSave").removeClass("toolbar_hris");
        $("#btnPrint").removeClass("toolbar_hris");
        $("#btnNew").addClass("btn-disabled toolbar_hris_disabled");
        $("#btnInq").addClass("btn-disabled toolbar_hris_disabled");
        $("#btnSave").addClass("btn-disabled toolbar_hris_disabled");
        $("#btnPrint").addClass("btn-disabled toolbar_hris_disabled");

        $("#btnNew").css("display", "none");
        $("#btnInq").css("display", "none");
        $("#btnSave").css("display", "none");
        $("#btnPrint").css("display", "none");
        $("#btnDelete").css("display", "none");

        /*
        $("#btnNew").addClass("btn-disabled toolbar_hris_disabled");
        $("#btnInq").addClass("btn-disabled toolbar_hris_disabled");
        $("#btnSave").addClass("btn-disabled toolbar_hris_disabled");
        $("#btnPrint").addClass("btn-disabled toolbar_hris_disabled");
        */
    } else {
        $("#btnNew").css("display", "block");
        $("#btnInq").css("display", "block");
        $("#btnSave").css("display", "block");
        $("#btnPrint").css("display", "block");
        $("#btnDelete").css("display", "block");

        $("#btnNew").removeClass("btn-disabled toolbar_hris_disabled");
        $("#btnInq").removeClass("btn-disabled toolbar_hris_disabled");
        $("#btnSave").removeClass("btn-disabled toolbar_hris_disabled");
        $("#btnPrint").removeClass("btn-disabled toolbar_hris_disabled");
        $("#btnNew").addClass("toolbar_hris");
        $("#btnInq").addClass("toolbar_hris");
        $("#btnSave").addClass("toolbar_hris");
        $("#btnPrint").addClass("toolbar_hris");
    }
    document.getElementById("menuTitle").innerHTML = title;
    $(".main-body").load(menus, function () {
        //alert(menus);
        setDefault(menuid);
    });
    return false;
}

function startLoading() {
    $("#loadingModal").modal("show");
}

function finishLoading() {
    $("#loadingModal").modal("hide");
    //$("#loadingModal").removeClass("in");
    //$(".modal-backdrop").remove();
    //$("#loadingModal").hide();
}

function Logout() {
    // $("#frmLogout").submit();

    $.get(
        "api/umum/",
        {
            cmd: "logOut",
        },
        function (data, status) {
            const myArr = JSON.parse(data);
            if (myArr.length == 0) {
                salert("Tidak Ada Data", "warning", "Warning");
            } else {
                if (myArr["sts"] == "N") {
                    salert(myArr["msg"], "error", "Warning \n" + myArr["desc"]);
                } else {
                    window.location.href = window.location.origin;
                }
            }
        }
    ).fail(function (e) {
        console.log(e);
        // Handle error here
    });
}

function errorLabel(sts) {
    if (sts == "SHOW") {
        $("#errorLabel").show().delay(3000).fadeOut();
    } else {
        $("#errorLabel").hide(1000);
    }
}

function changeColor(e, idxTable) {
    $(idxTable + " tr").css("color", "black");
    $(idxTable + " tr").css("background-color", "");
    $(e).css("cursor", "pointer");
    $(e).css("background-color", "#6e6e6e");
    $(e).css("color", "white");
}

function clickRow(e, idx) {
    $(idx + " tr").css("background-color", "");
    $(idx + " tr").css("color", "black");
    $(e).css("background-color", "#6e6e6e");
    $(e).css("color", "white");
    $(e).css("font-wiegth", "bold");
}

function backColor() {
    //$('#tableResult tr').css("color", "black");
}

function menuPrevileges(idx) {}

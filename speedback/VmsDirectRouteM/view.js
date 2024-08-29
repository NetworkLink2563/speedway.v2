


async function ShowVms() {
    $.post("Controller.php",
        {
            PrjCode: $("#SelProject").val(),
            VmsMenu: "VmsMenu"
        })
        .done(async function (data) {
            $("#ShowForm").hide();
            $("#SelVms").empty();
            var VmsCode = "";
            const obj = JSON.parse(data);
            for (var i = 0; i < obj.length; i++) {
                VmsCode = obj[i].XVVmsCode;
                var selected = "";
                if (i == 0) {
                    selected = "selected";
                    $("#ShowForm").show();
                }
                $('#SelVms').append('<option ' + selected + ' value="' + obj[i].XVVmsCode + '">' + obj[i].XVVmsName + '</option>');
            }

            ShowData();

        });
}
$("#SelProject").change(function () {
    ShowVms();

});
$("#SelVms").change(function () {
    ShowData();
});
$(function () {
    ShowVms();
   
    $.extend(true, $.fn.dataTable.defaults, {
        "language": {
                  "sProcessing": "กำลังดำเนินการ...",
                  "sLengthMenu": "แสดง_MENU_ แถว",
                  "sZeroRecords": "ไม่พบข้อมูล",
                  "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
                  "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
                  "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
                  "sInfoPostFix": "",
                  "sSearch": "",
                  "sUrl": "",
                  "oPaginate": {
                                "sFirst": "เิริ่มต้น",
                                "sPrevious": "ก่อนหน้า",
                                "sNext": "ถัดไป",
                                "sLast": "สุดท้าย"
                  }
         }
    });

    $('#table').dataTable( {
        "searching": true,
        "bLengthChange": false
      } );
});
$("#BtnLogo").click(function () {
    $("#ModalUploadLogo").modal('toggle');
});
$("#BtnVdo").click(function () {
    $.post("Controller.php",
        {
            SearchVms: "SearchVms",
            VmsCode: $("#SelVms").val(),
        })
        .done(async function (data) {
            const obj = JSON.parse(data);
            $("#XVLinkStream").val(obj[0].XVLinkStream);
            $("#ModalUploadVdo").modal('toggle');
           

        });

});
$("#BtnMap").click(function () {
    $("#ModalUploadMap").modal('toggle');
});
$("#BtnText1").click(function () {
    $.post("Controller.php",
        {
            SearchVms: "SearchVms",
            VmsCode: $("#SelVms").val(),
        })
        .done(async function (data) {
            const obj = JSON.parse(data);
            CKEDITOR.instances.TxtSms1.setData(obj[0].XVSms1);
            $("#myModalSms1").modal('toggle');
            

        });
});
$("#BtnText2").click(function () {
    $.post("Controller.php",
        {
            SearchVms: "SearchVms",
            VmsCode: $("#SelVms").val(),
        })
        .done(async function (data) {
            const obj = JSON.parse(data);
            CKEDITOR.instances.TxtSms2.setData(obj[0].XVSms2);
            $("#myModalSms2").modal('toggle');
            
        });

});
$("#BtnText3").click(function () {
    $.post("Controller.php",
        {
            SearchVms: "SearchVms",
            VmsCode: $("#SelVms").val(),
        })
        .done(async function (data) {
            const obj = JSON.parse(data);
            CKEDITOR.instances.TxtSms3.setData(obj[0].XVSms3);
            $("#myModalSms3").modal('toggle');
            ShowData();
            Swal.fire(
                    "บันทึกสำเร็จ",
                    "",
                    "success"
            )

        });
});
$("#FormActionSms1").submit(function (event) {
    event.preventDefault();
    $.post("Controller.php",
        {
            UpdateSms1: "UpdateSms1",
            VmsCode: $("#SelVms").val(),
            TxtSms1: CKEDITOR.instances.TxtSms1.getData()
        })
        .done(async function (data) {
            if (data.trim() == 1) {
                $("#myModalSms1").modal('toggle');
                ShowData();
                Swal.fire(
                    "บันทึกสำเร็จ",
                    "",
                    "success"
                )
            }
        });
});
$("#FormActionSms2").submit(function (event) {
    event.preventDefault();
    $.post("Controller.php",
        {
            UpdateSms2: "UpdateSms2",
            VmsCode: $("#SelVms").val(),
            TxtSms2: CKEDITOR.instances.TxtSms2.getData()
        })
        .done(async function (data) {

            if (data.trim() == 1) {
                $("#myModalSms2").modal('toggle');
                ShowData();
                Swal.fire(
                    "บันทึกสำเร็จ",
                    "",
                    "success"
                )
            }

        });
});

$("#FormActionSms3").submit(function (event) {
    event.preventDefault();
    $.post("Controller.php",
        {
            UpdateSms3: "UpdateSms3",
            VmsCode: $("#SelVms").val(),
            TxtSms3: CKEDITOR.instances.TxtSms3.getData()
        })
        .done(async function (data) {

            if (data.trim() == 1) {
                $("#myModalSms3").modal('toggle');
                ShowData();
                Swal.fire(
                    "บันทึกสำเร็จ",
                    "",
                    "success"
                )
            }

        });
});

$("#FormActionStream").submit(function (event) {
    event.preventDefault();
    $.post("Controller.php",
        {
            UpdateStream: "UpdateStream",
            VmsCode: $("#SelVms").val(),
            XVLinkStream: $("#XVLinkStream").val()
        })
        .done(async function (data) {
            if (data.trim() == 1) {
                $("#ModalUploadVdo").modal('toggle');
                ShowData();
                Swal.fire(
                    "บันทึกสำเร็จ",
                    "",
                    "success"
                )
            }
        });
});

$("#FormActionLogo").submit(function (event) {
    event.preventDefault();
    var fd = new FormData();
    fd.append('file', $('#file1')[0].files[0]);
    fd.append('VmsCode', $("#SelVms").val());
    fd.append('UploadLogo', 'UploadLogo');
    $.ajax({
        url: 'Controller.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function (data) {
          
            if (data.trim() == 1) {
                $("#ModalUploadLogo").modal('toggle');
                ShowData();
                Swal.fire(
                    "บันทึกสำเร็จ",
                    "",
                    "success"
                )
            }

        },
    });

});

$("#FormActionMap").submit(function (event) {
    event.preventDefault();
    var fd = new FormData();
    fd.append('file', $('#file2')[0].files[0]);
    fd.append('VmsCode', $("#SelVms").val());
    fd.append('UploadMap', 'UploadMap');
    $.ajax({
        url: 'Controller.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function (data) {
            alert(data);
            if (data.trim() == 1) {
                ShowData();
                $("#ModalUploadMap").modal('toggle');
                Swal.fire(
                    "บันทึกสำเร็จ",
                    "",
                    "success"
                )
            }
        },
    });

});
$("#FormActionPoint").submit(function (event) {
    event.preventDefault();
    $.post("Controller.php",
    {
        UpdatePoint: "UpdatePoint",
        VmsCode: $("#SelVms").val(),
        X1: $("#X1").val(),
        Y1: $("#Y1").val(),
        X2: $("#X2").val(),
        Y2: $("#Y2").val(),
        PointNumber:$("#PointNumber").val(),
        Remark:$("#Remark").val()
    })
    .done(async function (data) {
        if (data.trim() == 1) {
            $("#X1").val('');
            $("#Y1").val('');
            $("#X2").val('');
            $("#Y2").val('');
            $("#PointNumber").val('');
            $("#Remark").val('');
            ShowData();
            Swal.fire(
                "บันทึกสำเร็จ",
                "",
                "success"
            )
        }
    });
});


function ShowData(){
    $.post("Controller.php",
    {
        ShowData: "ShowData",
        VmsCode: $("#SelVms").val()
    })
    .done(async function (data) {
        obj = JSON.parse(data);
        $("#Sms1").html(obj[0].XVSms1);
        $("#Sms2").html(obj[0].XVSms2);
        $("#Sms3").html(obj[0].XVSms3);
       
        $("#ImgLogo").attr("src", obj[0].XVVmsCode+"/"+obj[0].XVFileLogo);
        $("#ImgMap").attr("src", obj[0].XVVmsCode+"/"+obj[0].XVFileMap);
        $("#IframeVdo").attr("src", obj[0].XVLinkStream);
      
        
    });
}

function Showpoint(){
    $.post("Controller.php",
    {
        ShowPoint: "ShowPoint",
        VmsCode: $("#SelVms").val()
    })
    .done(async function (data) {
       
        obj = JSON.parse(data);
        $('#table').DataTable({
            data: obj,
            columns: [
                { data: 'A' },
                { data: 'B' },
                { data: 'C' },
                { data: 'D' },
                { data: 'E' }
            ],
            "columnDefs": [
                { "width": "40%", "targets": 0 },
                { "width": "20%", "targets": 1 },
                { "width": "20%", "targets": 2 },
                { "width": "10%", "targets": 3 },
                { "width": "10%", "targets": 4 }
            ],
            lengthChange: false,
            "bDestroy": true
        });
        
    });
}
function FuDelete(VmsCode,XVPointNumber){
    $.post("Controller.php",
    {
        DeletePoint: "DeletePoint",
        VmsCode: VmsCode,
        XVPointNumber : XVPointNumber
    })
    .done(async function (data) {
        Showpoint();
    });
}
function FuEdit(VmsCode,XVPointNumber){
    $.post("Controller.php",
    {
        SerchPoint: "SerchPoint",
        VmsCode: VmsCode,
        XVPointNumber : XVPointNumber
    })
    .done(async function (data) {
        obj = JSON.parse(data);
        $("#X1").val(obj[0].XIX1);
        $("#Y1").val(obj[0].XIY1);
        $("#X2").val(obj[0].XIX2);
        $("#Y2").val(obj[0].XIY2);
        $("#PointNumber").val(obj[0].XVPointNumber);
        $("#Remark").val(obj[0].XVRemark);
        $("#myModalPoint").modal('toggle');
    });
}
$("#BtnShowPoint").click(function () {
    Showpoint();
    $("#myModalPoint").modal('toggle');
});

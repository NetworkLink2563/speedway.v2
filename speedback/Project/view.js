
function ShowDataTable(){
    $( "#TableBody" ).empty();
    $.post("Controller.php",
    {
        CustCode: $("#Sel_Customer").val(),
        Search: "Search"

    })
    .done(async function (data) {
        alert(data);
        obj=JSON.parse(data);
        $('#table').DataTable( {
            data: obj,
            columns: [
                { data: 'A' },
                { data: 'B' },
                { data: 'C' },
                { data: 'D' },
                { data: 'E' },
                { data: 'F' },
                { data: 'G' }
            ],
            "columnDefs": [
                { "width": "10%", "targets": 0 },
                { "width": "40%", "targets": 1 },
                { "width": "10%", "targets": 2 },
                { "width": "10%", "targets": 3 },
                { "width": "10%", "targets": 4 },
                { "width": "10%", "targets": 5 },
                { "width": "10%", "targets": 6 }
              ],
            lengthChange: false,
            "bDestroy": true

        } );
        
    });
}
$("#Sel_Customer").change(function () {
    ShowDataTable();
});
function FuDelete(p) {
    alert(p);
    /*
    Swal.fire({
        title: 'ต้องการลบ ' + p + ' ใช่หรือไม่?',
        showDenyButton: true,
        confirmButtonText: 'ใช่',
        denyButtonText: 'ยกเลิก',
        customClass: {
            actions: 'my-actions',
            confirmButton: 'order-2',
            denyButton: 'order-3',
        }
    }).then((result) => {
        if (result.isConfirmed) {
           
            $.post("Controller.php",
                {
                    Delete: 'Delete',
                    UsrCode: p
                })
                .done(async function (data) {
                    alert(data);
                    ShowDataTable();
                });
        }
    })
        */
}
$("#BtnAdd").click(function () {
    $("#HeaderTitle").text('เพิ่มผู้ใช้ใหม่');
    $("#txtmode").val('0');
    $("#EmaEmail").val('');
    $("#TxtName").val('');
    $("#TxtPhone").val('');
    $("#Selstatus").val('1').change();
    /*
    $("#SelCustomer").prop("disabled", false);
    $("#EmaEmail").prop("disabled", false);
    $("#TxtName").prop("disabled", false);
    $("#TxtPhone").prop("disabled", false);
    $("#password2").prop("disabled", false);
    $("#Selstatus").prop("disabled", false);
  */
    $("#myModal").modal('toggle');
});
function FuPermis(UsrCode, p1, p2, p3) {
   

    const obj1 = JSON.parse(p1);
    const obj2 = JSON.parse(p2);
    const obj3 = JSON.parse(p3);
    
    for (i = 0; i <= 20; i++) {
        x=i+1;
        $("#Sel1-" + x).prop("checked", false);
        $("#Sel2-" + x).prop("checked", false);
        $("#Sel3-" + x).prop("checked", false);
        
        if (obj1[i] == 1) {
            $("#Sel1-" + x).prop("checked", true);
        }
        if (obj2[i] == 1) {
            $("#Sel2-" + x).prop("checked", true);
        }
        if (obj3[i] == 1) {
            $("#Sel3-" + x).prop("checked", true);
        }
    }
    $("#txtUsrCode").val(UsrCode);
    $("#ModalPermis").modal('toggle');
}
function FuProject(UsrCode) {
    $.post("Controller.php",
        {
            UsrPrj: 'UsrPrj',
            UsrCode: UsrCode,
        })
        .done(async function (data) {
            const obj = JSON.parse(data);
            var x = 0;
            $.each($("input[name='txtProjectC[]']"), function () {
                $("#Sel" + x).prop("checked", false);
                x = x + 1;
            });
            x = 0;
            $.each($("input[name='txtProjectC[]']"), function () {
                for (i = 0; i < obj.length; i++) {
                    var PrjCode = obj[i].XVPrjCode;
                    if ($(this).val() == PrjCode) {
                        $("#Sel" + x).prop("checked", true);
                    }
                }
                x = x + 1;
            });
        });
    $("#txt_UsrCode").val(UsrCode);
    $("#ModalProject").modal('toggle');
}
function FuEdit(p1, p2, p3, p4) {
    var Selvalue = "0";
    if (p4 == 1) {
        Selvalue = "1";
    }
    $("#HeaderTitle").text('แก้ไขข้อมูลผู้ใช้');
    $("#txtmode").val('1');
    $("#TxtCstCode").val(p1);

    $("#EmaEmail").val(p1),
        $("#TxtName").val(p2),
        $("#TxtPhone").val(p3),
        $("#Selstatus").val(Selvalue).change();
    /*
    $("#SelCustomer").prop("disabled", true);
    $("#EmaEmail").prop("disabled", true);
    $("#TxtName").prop("disabled", true);
    $("#TxtPhone").prop("disabled", true);
    $("#PasPwd").prop("disabled", true);
    */
    $("#myModal").modal('toggle');
}
function RegisterAccount() {
    $.post("Controller.php",
        {
            Mode: $("#txtmode").val(),
            CstCode: $("#SelCustomer").val(),
            Name: $("#TxtName").val(),
       
            EmaEmail: $("#EmaEmail").val(),
            PasPwd: $("#password2").val(),
            Status: $("#Selstatus").val(),
        })
        .done(async function (data) {
         
         
            if(data.trim()=="Err1"){
                Swal.fire({
                    text: "อีเมลซ้ำ",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "รับทราบ",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                });
               return false;
            }
       
            ShowDataTable();
            $("#myModal").modal('toggle');
        });
}
$("#FormRegister").submit(function (event) {
    event.preventDefault();
    RegisterAccount();
});
$("#FormPermis").submit(function (event) {
   
    event.preventDefault();
    var s1 = [];
    var s2 = [];
    var s3 = [];
    s1.push('');
    s2.push('');
    s3.push('');
    for (i = 1; i <= 21; i++) {

        if ($('#Sel1-' + i).is(':checked')) {
            s1.push('1');
        }
        else {
            s1.push('0');
        }
        if ($('#Sel2-' + i).is(':checked')) {
            s2.push('1');
        }
        else {
            s2.push('0');
        }
        if ($('#Sel3-' + i).is(':checked')) {
            s3.push('1');
        }
        else {
            s3.push('0');
        }
    }
   
    $.post("Controller.php",
        {
            Permission: 'Permission',
            UsrCode: $("#txtUsrCode").val(),
            s1: s1,
            s2: s2,
            s3: s3
        })
        .done(async function (data) {
         
           
            ShowDataTable();
            $("#ModalPermis").modal('toggle');
        });
});
$("#FormProject").submit(function (event) {
    event.preventDefault();
    i = 0;
    var s1 = [];
    $.each($("input[name='txtProjectC[]']"), function () {
        if ($('#Sel' + i).is(':checked')) {
            s1.push($(this).val());
        }
        i = i + 1;
    });
    $.post("Controller.php",
        {
            PermisPrj: 'PermisPrj',
            UsrCode: $("#txt_UsrCode").val(),
            s1: s1
        })
        .done(async function (data) {
            ShowDataTable();
            $("#ModalProject").modal('toggle');
        });
});
$(function() {
   
    ShowDataTable();
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


function ShowDataTable(){
    $( "#TableBody" ).empty();
    $.post("Controller.php",
    {
        PrjCode: $("#Sel_PrjCode").val(),
        ShowBodyTable: "ShowBodyTable"

    })
    .done(async function (data) {
        obj=JSON.parse(data);
        $('#table').DataTable( {
            data: obj,
            columns: [
                { data: 'A' },
                { data: 'B' },
                { data: 'C' },
                { data: 'D' },
                { data: 'E' },
                { data: 'F' }
            ],
            "columnDefs": [
                { "width": "10%", "targets": 0 },
                { "width": "40%", "targets": 1 },
                { "width": "20%", "targets": 2 },
                { "width": "10%", "targets": 3 },
                { "width": "10%", "targets": 4 },
                { "width": "10%", "targets": 5 }
               
              ],
            lengthChange: false,
            "bDestroy": true

        } );
    });
}
function SetPoint(SupCode){
    $.post("Controller.php",
    {   PrjCode: $("#Sel_PrjCode").val(),
        SupCode:SupCode,
        SetPoint: "SetPoint"
    })
    .done(async function (data) {
        
        $('#SelSupCode').empty();
        $('#SelSupCode').append(data);
    });
}
function FuDelete(p) {
    Swal.fire({
        title: 'ต้องการลบ ' + p + ' ใช่หรือไม่?',
        showDenyButton: true,
        confirmButtonText: 'Yes',
        denyButtonText: 'No',
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
                    SpeCode: p
                })
                .done(async function (data) {

                    ShowDataTable();
                });
        }
    })
}

$("#Sel_PrjCode").change(function () {
    $.post("Controller.php",
        {
            PrjCode: $("#Sel_PrjCode").val(),
            SearchSpeedEn: "SearchSpeedEn"
        })
        .done(function (data) {
            ShowDataTable();
        });
});
$("#BtnAdd").click(function () {
    $("#HeaderTitle").text('เพิ่มเครื่องครวจจับความเร็วใหม่');
    $("#txtmode").val('0');
    $("#TxtSpeCode").val('SPEYY-XXXXX');
    $("#TxtSpeName").val('');
    $("#TxtSpeSN").val('');
    $("#TxtSpeURL").val('');
    $("#SelIsActive").val("1").change();
    $("#SelSupCode").val("").change();
    SetPoint("");
    $("#myModal").modal('toggle');
});
function FuEdit(SpeCode) {
    $.post("Controller.php",
        {
            Edit: "Edit",
            SpeCode: SpeCode
        })
        .done(async function (data) {
            const obj = JSON.parse(data);
            $("#HeaderTitle").text('แก้ไขข้อมูลเครื่องตรวจจับความเร็ว');
            $("#txtmode").val('1');
            $("#TxtSpeCode").val(obj[0].XVSpeCode);
            $("#TxtSpeName").val(obj[0].XVSpeName);
            $("#TxtSpeSN").val(obj[0].XVSpeSN);
            $("#TxtSpeURL").val(obj[0].XVSpeURL);
            $("#SelIsActive").val(obj[0].XBSpeIsActive).change();
           
            SetPoint(obj[0].XVSupCode);
            $("#myModal").modal('toggle');
        });
}
function InsertUpdate() {

    $.post("Controller.php",
        {
            Mode: $("#txtmode").val(),
            SpeCode: $("#TxtSpeCode").val(),
            SpeName: $("#TxtSpeName").val(),
            SpeSN: $("#TxtSpeSN").val(),
            SpeURL: $("#TxtSpeURL").val(),
            SpeIsActive: $("#SelIsActive").val(),
            SupCode: $("#SelSupCode").val(),
            InsertUpdate: 'InsertUpdate'
        })
        .done(async function (data) {
            ShowDataTable();
            $("#myModal").modal('toggle');
        });
}
$("#FormSpeedEnforce").submit(function (event) {
    event.preventDefault();
    InsertUpdate();
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



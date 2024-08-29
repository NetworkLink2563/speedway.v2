
function ShowDataTable(){
    $( "#TableBody" ).empty();
    $.post("Controller.php",
    {
       
        ShowBodyTable: "ShowBodyTable",
        PrjCode: $("#Sel_PrjCode").val(),

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
function VmsDirect(VmsCode){
    $.post("Controller.php",
    {   PrjCode: $("#Sel_PrjCode").val(),
        VmsCode:VmsCode,
        VmsDirect: "VmsDirect"
    })
    .done(async function (data) {
     
        $('#SelVmsCode').empty();
        $('#SelVmsCode').append(data);
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
                    WssCode: p
                })
                .done(async function (data) {
                    
                    ShowDataTable();
                });
        }
    })
}

$("#Sel_PrjCode").change(function () {
    
    ShowDataTable();

});

$("#BtnAdd").click(function () {
    $("#HeaderTitle").text('เพิ่มเครื่องวัดสภาพอากาศใหม่');
    $("#txtmode").val('0');
    $("#TxtWssCode").val('WSSYY-XXXXX'),
    $("#TxtWssName").val(''),   
    $("#TxtSN").val(''),
    $("#SelIsActive").val(1).change();
  
    SetPoint("");
    VmsDirect("");
    

    $("#myModal").modal('toggle');
});
function FuEdit(WssCode) {
    $.post("Controller.php",
        {
            Edit: "Edit",
            WssCode: WssCode
        })
        .done(async function (data) {
           
            const obj = JSON.parse(data);
            $("#HeaderTitle").text('แก้ไขข้อมูลเครื่องวัดสภาพอากาศ');
            $("#txtmode").val('1');
            $("#TxtWssCode").val(obj[0].XVWssCode),
            $("#TxtWssName").val(obj[0].XVWssName),
            $("#TxtSN").val(obj[0].XVSN),
                
            $("#SelIsActive").val(obj[0].XBIsActive).change();
           

            SetPoint(obj[0].XVSupCode);
            VmsDirect(obj[0].XVVmsCode);
            $("#myModal").modal('toggle');
        });
}
function InsertUpdate() {
  
    $.post("Controller.php",
        {
            Mode: $("#txtmode").val(),
            WssCode: $("#TxtWssCode").val(),
            WssName: $("#TxtWssName").val(),
            SN: $("#TxtSN").val(),
            IsActive: $("#SelIsActive").val(),
            SupCode: $("#SelSupCode").val(),
            VmsCode: $("#SelVmsCode").val(),
            InsertUpdate: 'InsertUpdate'
        })
        .done(async function (data) {
           
            ShowDataTable();
            $("#myModal").modal('toggle');
        });
}
$("#FormSetupPoint").submit(function (event) {
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

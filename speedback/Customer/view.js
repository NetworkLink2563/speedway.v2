
function ShowDataTable(){
    $.post("Controller.php",
    {
       
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
                { data: 'E' }
            ],
            "columnDefs": [
                { "width": "10%", "targets": 0 },
                { "width": "70%", "targets": 1 },
                { "width": "10%", "targets": 2 },
                { "width": "10%", "targets": 3 }
              ],
            lengthChange: false,
            "bDestroy": true

        } );
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
                    CstCode: p
                })
                .done(async function (data) {

                    ShowDataTable();
                });
        }
    })
}
function FuEdit(CstCode) {
    $.post("Controller.php",
        {
            Edit: "Edit",
            CstCode: CstCode
        })
        .done(async function (data) {
            position = data.search("Err1");
            if (position > -1) {
                SmsBoxShow("ไม่สามรถค้นข้อมูลได้");
                return false;
            }
            const obj = JSON.parse(data);
            $("#HeaderTitle").text('แก้ไขข้อมูลลูกค้า');
            $("#txtmode").val('1');
            $("#TxtCstCode").val(obj[0].XVCstCode);
            $("#TxtCstName").val(obj[0].XVCstName);
          
            $("#EmaCstEmail").val(obj[0].XVCstEmail);
            $("#TxtCstPhone").val(obj[0].XVCstPhone);
            $("#Selstatus").val(obj[0].XBCstIsActive).change();
            $("#myModal").modal('toggle');
        });

}
$("#BtnAdd").click(function () {
 
    $("#HeaderTitle").text('เพิ่มลูกค้าใหม่');
    $("#txtmode").val('0');
    $("#TxtCstName").val('');
    $("#TxtCstAddress").val('');
    $("#EmaCstEmail").val('');
    $("#TxtCstPhone").val('');
    $("#Selstatus").val('1').change();
    $("#myModal").modal('toggle');

});
$("#FormCustomer").submit(function (event) {
    event.preventDefault();
    $.post("Controller.php",
        {
            Mode: $("#txtmode").val(),
            CstCode: $("#TxtCstCode").val(),
            CstName: $("#TxtCstName").val(),
         
            CstEmail: $("#EmaCstEmail").val(),
            CstPhone: $("#TxtCstPhone").val(),
            CstIsActive: $("#Selstatus").val(),
            InsertUpdate: "InsertUpdate"

        })
        .done(async function (data) {
            $("#myModal").modal('toggle');
            ShowDataTable();
        });
});
$(function() {
    //window.location.reload();
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
        "bLengthChange": false,
        "bDestroy": true
      } );
});



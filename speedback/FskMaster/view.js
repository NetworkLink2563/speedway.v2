
function ShowDataTable(){
    $( "#TableBody" ).empty();
    $.post("Controller.php",
    {   PrjCode: $("#Sel_PrjCode").val(),
        Search: "Search"
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
            $.post( "Controller.php", 
            {
                Delete:'Delete',
                FskCode:p
            })
            .done(async function( data ) 
            {   
                
                ShowDataTable();
            });
        }
    })
}
$("#Sel_PrjCode").change(function(){
   
    ShowDataTable();
});    
$("#BtnAdd").click(function(){
    $( "#HeaderTitle" ).text('เพิ่มFskใหม่');
    $( "#txtmode" ).val('0');
    $( "#TxtFskCode" ).val('FSKYY-XXXXX');
    $( "#SelSupCode" ).val('').change();
    $( "#TxtFskName" ).val('');
    $( "#TxtFskSN" ).val('');
    SetPoint("");
    $( "#SelIsActive" ).val('1').change();
    $("#myModal").modal('toggle');
 });

 function FuEdit(FskCode){
    $.post( "Controller.php", 
    {
        Edit:"Edit",
        FskCode:FskCode
    })
    .done(async function( data ) 
    {   
       
        const obj = JSON.parse(data); 
        $( "#HeaderTitle" ).text('แก้ไขข้อมูลFsk');
        $( "#txtmode" ).val('1');
        $( "#TxtFskCode" ).val(obj[0].XVFskCode);
        $( "#TxtFskName" ).val(obj[0].XVFskName);
        $( "#TxtFskSN" ).val(obj[0].XVFskSN);
        $( "#SelIsActive" ).val(obj[0].XBFskIsActive).change();
        SetPoint(obj[0].XVSupCode);
        $("#myModal").modal('toggle');
    });
    
}
 function InsertUpdate(){
   
    $.post( "Controller.php", 
    {
        Mode:$( "#txtmode" ).val(),
        FskCode:$( "#TxtFskCode" ).val(),
        FskName:$( "#TxtFskName" ).val(),
        FskSN:$( "#TxtFskSN" ).val(),
        FskIsActive:$( "#SelIsActive" ).val(),
        SupCode:$( "#SelSupCode" ).val(),
        InsertUpdate:'InsertUpdate'
    })
    .done(async function( data ) 
    { 
       
        ShowDataTable();
        $("#myModal").modal('toggle');
    });
}
$( "#FormFsk" ).submit(function( event ) {
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

function ShowDataTable(){
    $( "#TableBody" ).empty();
    $.post("Controller.php",
    {
        PrjCode: $("#Sel_PrjCode").val(),
        ShowBodyTable: "ShowBodyTable"

    })
    .done(async function (data) {
        console.log(data);
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
                { "width": "60%", "targets": 1 },
                { "width": "10%", "targets": 2 },
                { "width": "10%", "targets": 3 },
                { "width": "10%", "targets": 4 }
               
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
            $.post( "Controller.php", 
            {
                Delete:'Delete',
                SupCode:p
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
    $( "#HeaderTitle" ).text('เพิ่มจุดติดตั้งใหม่');
    $( "#txtmode" ).val('0');
    $( "#TxtSupCode" ).val('SUPYY-XXXXX');
    $( "#SelPrjCode" ).val('').change();
    $( "#TxtSupName" ).val('');
    $( "#TxtSupSetupPoint" ).val('');
    $( "#NumSupKmPoint" ).val('');
    $( "#NumSupLatitude" ).val('');
    $( "#NumSupLongitude" ).val('');
    $("#myModal").modal('toggle');
 });

 function FuEdit(SupCode){
    $.post( "Controller.php", 
    {
        Edit:"Edit",
        SupCode:SupCode
    })
    .done(async function( data ) 
    { 
        position = data.search("Err1");
        if(position>-1){
            SmsBoxShow("ไม่สามรถค้นข้อมูลได้");
            return false;
        }
        const obj = JSON.parse(data); 
        $( "#HeaderTitle" ).text('แก้ไขข้อมูลจุดติดตั้ง');
        $( "#txtmode" ).val('1');
        $( "#TxtSupCode" ).val(obj[0].XVSupCode);
        $( "#SelPrjCode" ).val(obj[0].XVPrjCode).change();
        $( "#TxtSupName" ).val(obj[0].XVSupName);
        $( "#TxtSupSetupPoint" ).val(obj[0].XVSupSetupPoint);
        $( "#NumSupKmPoint" ).val(obj[0].XFSupKmPoint);
        $( "#NumSupLatitude" ).val(obj[0].XFSupLatitude);
        $( "#NumSupLongitude" ).val(obj[0].XFSupLongitude);
        $("#myModal").modal('toggle');
    });
    
}
 function InsertUpdate(){
  
    $.post( "Controller.php", 
    {
        Mode:$( "#txtmode" ).val(),
        SupCode:$( "#TxtSupCode" ).val(),
        PrjCode:$( "#SelPrjCode" ).val(),
        SupName:$( "#TxtSupName" ).val(),
        SupSetupPoint:$( "#TxtSupSetupPoint" ).val(),
        SupKmPoint:$( "#NumSupKmPoint" ).val(),
        SupLatitude:$( "#NumSupLatitude" ).val(),
        SupLongitude:$( "#NumSupLongitude" ).val(),
        InsertUpdate:'InsertUpdate'
    })
    .done(async function( data ) 
    {   alert(data);
        //ShowDataTable();
        //$("#myModal").modal('toggle');
    });
}
$( "#FormSetupPoint" ).submit(function( event ) {
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
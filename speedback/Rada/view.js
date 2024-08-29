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
function FuDelete(p){
 
    Swal.fire({
        title: 'ต้องการลบ '+p+' ใช่หรือไม่?',
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
                RadaCode:p
            })
            .done(async function( data ) 
            {   
                ShowDataTable();
            });
        }
      })
}


$("#Sel_PrjCode").change(function(){
    $.post( "Controller.php", 
    {
        PrjCode:$("#Sel_PrjCode").val(),
        SearchCamera:"SearchCamera"  
    })
    .done( function( data ) 
    { 
        ShowDataTable();
    });   
});    
$("#BtnAdd").click(function(){
    $( "#HeaderTitle" ).text('เพิ่มเรด้านับรถใหม่');
    $( "#txtmode" ).val('0');
    $( "#TxtRadaCode" ).val('RADYY-XXXXX');
   
    SetPoint("");
    $( "#TxtName" ).val('');
    $( "#TxtSN" ).val('');
    $( "#TxtIp" ).val('');
    $( "#NumPort" ).val('');
    $( "#SelIsActive" ).val('1').change();
    $("#myModal").modal('toggle');
 });

 function FuEdit(CamCode){
    $.post( "Controller.php", 
    {
        Edit:"Edit",
        CamCode:CamCode
    })
    .done(async function( data ) 
    {  
        const obj = JSON.parse(data); 
        $( "#HeaderTitle" ).text('แก้ไขข้อมูลเรด้านับรถ');
        $( "#txtmode" ).val('1');
        $( "#TxtRadaCode" ).val(obj[0].XVRadaCode);
        $( "#TxtName" ).val(obj[0].XVRadaName);
        $( "#TxtSN" ).val(obj[0].XVRadaSN);
        $( "#TxtIp" ).val(obj[0].XVRadaIp);
        $( "#NumPort" ).val(obj[0].XIRadaPort);
        $( "#SelIsActive" ).val(obj[0].XBRadaIsActive).change();
       
        SetPoint(obj[0].XVSupCode);
        $("#myModal").modal('toggle');
        
    });
    
}
 function InsertUpdate(){
    $.post( "Controller.php", 
    {
        Mode:$( "#txtmode" ).val(),
        RadaCode:$( "#TxtRadaCode" ).val(),
        RadaName:$( "#TxtName" ).val(),
        RadaSN:$( "#TxtSN" ).val(),
        RadaIp:$( "#TxtIp" ).val(),
        RadaPort:$( "#NumPort" ).val(),
        RadaIsActive:$( "#SelIsActive" ).val(),
        SupCode:$( "#SelSupCode" ).val(),
        InsertUpdate:'InsertUpdate'
    })
    .done(async function( data ) 
    {   
        ShowDataTable();
        $("#myModal").modal('toggle');
    });
}
$( "#FormRada" ).submit(function( event ) {
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



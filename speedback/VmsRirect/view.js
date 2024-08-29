function ShowDataTable(){
    $( "#TableBody" ).empty();
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
                VmsCode:p
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
        SearchVms:"SearchVms"  
    })
    .done( function( data ) 
    {   
        ShowDataTable();
    });    
});
$("#BtnAdd").click(function(){
    $( "#HeaderTitle" ).text('เพิ่มป้าย VMS ใหม่');
    $( "#txtmode" ).val('0');
    $( "#TxtVmsCode" ).val('VMSYY-XXXXX');
    $( "#TxtVmsName" ).val('');
    $( "#TxtVmsSN" ).val('');
    $( "#TxtVmsURL" ).val('');
    $( "#NumVmsPixelWidth" ).val('');
    $( "#NumVmsPixelHeight" ).val('');
    $( "#NumVmsSizeWidth" ).val('');
    $( "#NumXIVmsSizeHeight" ).val('');
    $( "#TxtVmsSize" ).val('');
  
    SetPoint("");
    $( "#SelIsActive" ).val('1').change();
    $( "#SelType" ).val('').change();
    $("#myModal").modal('toggle');
 });

 function FuEdit(VmsCode){
    $.post( "Controller.php", 
    {
        Edit:"Edit",
        VmsCode:VmsCode
    })
    .done(async function( data ) 
    { 
      
       
        const obj = JSON.parse(data); 

        $( "#HeaderTitle" ).text('แก้ไขข้อมูลป้าย VMS');
        $( "#txtmode" ).val('1');
        
        $( "#TxtVmsCode" ).val(obj[0].XVVmsCode);
        $( "#TxtVmsName" ).val(obj[0].XVVmsName);
        $( "#TxtVmsSN" ).val(obj[0].XVVmsSN);
        $( "#TxtVmsURL" ).val(obj[0].XVVmsURL);
        $( "#NumVmsPixelWidth" ).val(obj[0].XIVmsPixelWidth);
        $( "#NumVmsPixelHeight" ).val(obj[0].XIVmsPixelHeight);
        $( "#NumVmsSizeWidth" ).val(obj[0].XIVmsSizeWidth);
        $( "#NumVmsSizeHeight" ).val(obj[0].XIVmsSizeHeight);
        $( "#TxtVmsSize" ).val(obj[0].XVVmsSize);
      
        SetPoint(obj[0].XVSupCode);
        $( "#SelIsActive" ).val(obj[0].XBVmsIsActive).change();
        $( "#SelType" ).val(obj[0].XVTYPE).change();
        $( "#SelIsActiveGoogleMap" ).val(obj[0].XBGoogleMap).change();
        $( "#SelIsActiveWeatherSensor" ).val(obj[0].XBWeatherSensor).change();
        
        $("#myModal").modal('toggle');
    });
    
}

 function InsertUpdate(){
    
    $.post( "Controller.php", 
    {
        Mode:$( "#txtmode" ).val(),
        VmsCode:$( "#TxtVmsCode" ).val(),
        VmsName:$( "#TxtVmsName" ).val(),
        VmsSN:$( "#TxtVmsSN" ).val(),
        VmsURL:$( "#TxtVmsURL" ).val(),
        VmsPixelWidth:$( "#NumVmsPixelWidth" ).val(),
        VmsPixelHeight:$( "#NumVmsPixelHeight" ).val(),
        VmsSizeWidth:$( "#NumVmsSizeWidth" ).val(),
        VmsSizeHeight:$( "#NumVmsSizeHeight" ).val(),
        VmsSize:$( "#TxtVmsSize" ).val(),
        SupCode:$( "#SelSupCode" ).val(),
        VmsIsActive:$( "#SelIsActive" ).val(),
        VmsType:$( "#SelType" ).val(),
        IsActiveGoogleMap:$( "#SelIsActiveGoogleMap" ).val(),
        IsActiveWeatherSensor:$( "#SelIsActiveWeatherSensor" ).val(),
        InsertUpdate:'InsertUpdate'
    })
    .done(async function( data ) 
    {  
        ShowDataTable();
        $("#myModal").modal('toggle');
    });
}
$( "#FormVms" ).submit(function( event ) {
    event.preventDefault();
    InsertUpdate();
});


function SetMonitro(){
    
}

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



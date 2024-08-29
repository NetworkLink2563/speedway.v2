
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
                RouteCode:p
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
        ShowPoint:"ShowPoint"  
    })
    .done( function( data ) 
    {  
        ShowDataTable();
    });   
});    
$("#BtnAdd").click(function(){
    $( "#HeaderTitle" ).text('เพิ่มเส้นทางใหม่');
    $( "#txtmode" ).val('0');
    $( "#TxtRouteCode" ).val('ROUYY-XXXXX');
    VmsDirect("");
    SetPoint("");
    $( "#TxtName" ).val('');
    $( "#TxtRoadnumber" ).val('');
    $( "#TxtLa" ).val('');
    $( "#TxtLong" ).val('');
    $( "#TxtLaend" ).val('');
    $( "#TxtLongend" ).val('');
    $( "#SelIsActive" ).val('1').change();
    $("#myModal").modal('toggle');
 });

 function FuEdit(RouteCode){
    $.post( "Controller.php", 
    {
        Edit:"Edit",
        RouteCode:RouteCode
    })
    .done(async function( data ) 
    {  
        
        const obj = JSON.parse(data); 
        $( "#HeaderTitle" ).text('แก้ไขเส้นทาง');
        $( "#txtmode" ).val('1');
        $( "#TxtRouteCode" ).val(obj[0].XVRouteCode);
        $( "#TxtName" ).val(obj[0].XVRouteName);
        $( "#TxtRoadnumber" ).val(obj[0].XVRoadNumber);
        $( "#TxtLa" ).val(obj[0].XVLatitude),
        $( "#TxtLong" ).val(obj[0].XVLongtitude),
        $( "#TxtLaend" ).val(obj[0].XVLatitudeE);
        $( "#TxtLongend" ).val(obj[0].XVLongtitudeE);
        $( "#SelIsActive" ).val(obj[0].XBRouteIsActive).change();
      
        VmsDirect(obj[0].XVVmsCode);
        SetPoint(obj[0].XVSupCode);
        $("#myModal").modal('toggle');
    });
    
}
 function InsertUpdate(){
   
    $.post( "Controller.php", 
    {   
        Mode:$( "#txtmode" ).val(),
        RouteCode:$( "#TxtRouteCode" ).val(),
        RouteName:$( "#TxtName" ).val(),
        RoadNumber:$( "#TxtRoadnumber" ).val(),
        Latitude:$( "#TxtLa" ).val(),
        Longtitude:$( "#TxtLong" ).val(),
       
        Latitudeend:$( "#TxtLaend" ).val(),
        Longtitudend:$( "#TxtLongend" ).val(),
        RouteIsActive:$( "#SelIsActive" ).val(),
        VmsCode:$( "#SelVmsCode" ).val(),
        SupCode:$( "#SelSupCode" ).val(),
        InsertUpdate:'InsertUpdate'
    })
    .done(async function( data ) 
    {   
      
        ShowDataTable();
        $("#myModal").modal('toggle');
    });
}


$( "#Form" ).submit(function( event ) {
    event.preventDefault();
    InsertUpdate();
});
$( "#FormPoint" ).submit(function( event ) {
    event.preventDefault();
    InsertUpdatePoint();
});

$("#BtnYes2").click(function(){
    $.post( "Controller.php", 
    {
        DeletePointDt:'DeletePointDt',
        RoutedtId:$("#SmsBoxConFirmCode2").val()
    })
    .done(async function( data ) 
    {   
        
        ShowPointDT($( "#TxtRouteCodeDt" ).val());
    });
});
function InsertUpdatePoint(){
    $.post( "Controller.php", 
    {
        ModePoint:$( "#txtmodePoint" ).val(),
        RouteCode:$( "#TxtRouteCodeDt" ).val(),
        PointName:$( "#TxtPointName" ).val(),
        Latitude:$( "#NumLa" ).val(),
        Longitude:$( "#NumLo" ).val(),
        InsertUpdatePoint:'InsertUpdatePoint'
    })
    .done(async function( data ) 
    {   
      
        ShowPointDT($( "#TxtRouteCodeDt" ).val());
        $( "#TxtPointName" ).val('');
        $( "#NumLa" ).val('');
        $( "#NumLo" ).val('');
        var RouteCode =$( "#TxtRouteCodeDt" ).val();
    });
}
function DeletePointDT(p){
  SmsBoxShowConFirm2("ต้องการลบไอดี "+p+" ใช่หรือไม่?","เลือกปุ่ม ตกลง ด้านล่างหากคุณต้องการลบ!",p);
}
function ShowPointDT(RouteCode){
    $.post( "Controller.php", 
    {
        ShowPointDT:'ShowPointDT',
        RouteCode:RouteCode
    })
    .done(async function( data ) 
    {   $( "#TableBodyPointDT" ).empty();
        $( "#TableBodyPointDT" ).html(data);
    });
}
function Point(RouteCode){ 
    $("#HeaderTitleP").text('เพิ่มจุดที่ผ่าน')
    $( "#txtmodePoint" ).val(0);
    $( "#TxtRouteCodeDt" ).val(RouteCode);
    $( "#TxtPointName" ).val('');
    $( "#NumLa" ).val('');
    $( "#NumLo" ).val('');
    ShowPointDT(RouteCode);
    $("#myModalPoint").modal('toggle');
}
function SetMonitor(RouteCode){
    
    $.post( "Controller.php", 
    {
        Edit:"Edit",
        RouteCode:RouteCode
    })
    .done(async function( data ) 
    {  
        
        const obj = JSON.parse(data); 
      
        $( "#TxtRoutCode" ).val(RouteCode);
        $( "#NumRouteNameAdjX" ).val(obj[0].XFRouteNameAdjX);
        $( "#NumRouteNameAdjY" ).val(obj[0].XFRouteNameAdjY);
        $( "#NumRoadNumberStartX" ).val(obj[0].XFRoadNumberStartX);
        $( "#NumRoadNumberStartY" ).val(obj[0].XFRoadNumberStartY),
        $( "#NumRoadNumberEndX" ).val(obj[0].XFRoadNumberEndX),
        $( "#NumRoadNumberEndY" ).val(obj[0].XFRoadNumberEndY);
        $("#myModalSetMonitor").modal('toggle');
       
    });
    
}
$( "#FormXY" ).submit(function( event ) {
    event.preventDefault();
    $.post( "Controller.php", 
    {   RoutCode:$( "#TxtRoutCode" ).val(),
        RouteNameAdjX:$( "#NumRouteNameAdjX" ).val(),
        RouteNameAdjY:$( "#NumRouteNameAdjY" ).val(),
        RoadNumberStartX:$( "#NumRoadNumberStartX" ).val(),
        RoadNumberStartY:$( "#NumRoadNumberStartY" ).val(),
        RoadNumberEndX:$( "#NumRoadNumberEndX" ).val(),
        RoadNumberEndY:$( "#NumRoadNumberEndY" ).val(),
        UpdateXY:'UpdateXY'
    })
    .done(async function( data ) 
    {   
      
       
        
        $("#myModalSetMonitor").modal('toggle');
        
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


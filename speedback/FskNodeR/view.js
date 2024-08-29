


function ShowDataTable(){
    $( "#TableBody" ).empty();
    swal.showLoading();
    $.post("Controller.php",
    {   PrjCode: $("#Sel_PrjCode").val(),
        XVFskCode: $("#SelGate").val(),
        ShowTable: "ShowTable"
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
                { "width": "40%", "targets": 1 },
                { "width": "20%", "targets": 2 },
                { "width": "10%", "targets": 3 },
                { "width": "10%", "targets": 4 }
              
               
              ],
            lengthChange: false,
            "bDestroy": true
        } );
        swal.close();
    });
}

function SelGate(){
  
    $.post("Controller.php",
    {   PrjCode: $("#Sel_PrjCode").val(),
        SelGate: "SelGate"
    })
    .done(async function (data) {
        $('#SelGate').empty();
        $('#SelGate').append(data);
        ShowDataTable();
    });
}

$("#Sel_PrjCode").change(function(){
    SelGate();
    
});    
$("#SelGate").change(function(){
    ShowDataTable();
});    



$(function() {
    SelGate(); 
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
    setInterval(function () { ShowDataTable() }, 1000*60);

});
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-4 col-xl-4">
            <div class="bg-secondary rounded h-100 p-4">
            <h6 class="mb-4">กรองข้อมูล</h6>
             
                <table class="table" id="Table1">
                    <thead>
                        <tr>
                            <th>ภาคเรียน</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include "../Database/DBConnect.php";
                            $sql="SELECT  XITermID, XVTermName, CONVERT(VARCHAR, XDStart, 120) AS XDStart, CONVERT(VARCHAR, XDEnd, 120) AS Expr1
                            FROM   dbo.MstTerm
                            ORDER BY XITermID DESC";
                            $query  = sqlsrv_query( $conn, $sql);
                            while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){   
                                   echo '<tr><td ><div style="margin-top:10px;margin-bottom:5px;">'.$row["XVTermName"].'</div></td><td><div style="margin-top:5px;margin-bottom:5px;"><button type="button" class="btn btn-primary btn-sm w-100 " onclick="Search(\''.$row["XITermID"].'\')">แสดงข้อมูล</button></div></td></tr>';
                               
                            }
                            sqlsrv_close($conn);
                        ?>
                      

                    </tbody>
                </table>


                
            </div>
        </div>
        <div class="col-sm-4 col-xl-4">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">วิชา</h6>
                <div id="ShowSubject">
                 </div>
            </div>
        </div>
        <div class="col-sm-4 col-xl-4">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">รายงานเข้าเรียนรายวิชา</h6>
                <div id="ShowData">
                 </div>
            </div>
        </div>
        
    </div>
</div>


<script>
    
function Search(XITermID) {
          
    ShowSubject(XITermID);
}
  
function ShowSubject(XITermID) {
       
       $("#ShowSubject").empty();
       $.ajax({
           type: "POST",
           url: "Controller.php",
           data: {
               XITermID: XITermID,
               ShowSubject: 'ShowSubject'
           }
       }).done(function(result) {

         
           $("#ShowSubject").html(result);
           $('#Table3').DataTable({
               lengthChange: false,
               "bDestroy": true,
               "language": {
                   "sProcessing": "กำลังดำเนินการ...",
                   "sLengthMenu": "แสดง_MENU_ แถว",
                   "sZeroRecords": "ไม่พบข้อมูล",
                   "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
                   "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
                   "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
                   "sInfoPostFix": "",
                   "sSearch": "ค้นหา:",
                   "sUrl": "",
                   "oPaginate": {
                       "sFirst": "เิริ่มต้น",
                       "sPrevious": "ก่อนหน้า",
                       "sNext": "ถัดไป",
                       "sLast": "สุดท้าย"
                   }
               },
           });
       });
 

}
 

function ShowData(XISubjectID,XITermID) {
       
        $("#ShowData").empty();
        $.ajax({
            type: "POST",
            url: "Controller.php",
            data: {
                XITermID: XITermID,
                XISubjectID:XISubjectID,
                ShowData: 'ShowData'
            }
        }).done(function(result) {
             
            
           
            $("#ShowData").html(result);
            $('#Table2').DataTable({
                lengthChange: false,
                "bDestroy": true,
                "language": {
                    "sProcessing": "กำลังดำเนินการ...",
                    "sLengthMenu": "แสดง_MENU_ แถว",
                    "sZeroRecords": "ไม่พบข้อมูล",
                    "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
                    "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
                    "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
                    "sInfoPostFix": "",
                    "sSearch": "ค้นหา:",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "เิริ่มต้น",
                        "sPrevious": "ก่อนหน้า",
                        "sNext": "ถัดไป",
                        "sLast": "สุดท้าย"
                    }
                },
            });
        });
  

}

$('#Table1').dataTable({
    lengthChange: false,
    "bDestroy": true,
    "language": {
        "sProcessing": "กำลังดำเนินการ...",
        "sLengthMenu": "แสดง_MENU_ แถว",
        "sZeroRecords": "ไม่พบข้อมูล",
        "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
        "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
        "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
        "sInfoPostFix": "",
        "sSearch": "ค้นหา:",
        "sUrl": "",
        "oPaginate": {
            "sFirst": "เิริ่มต้น",
            "sPrevious": "ก่อนหน้า",
            "sNext": "ถัดไป",
            "sLast": "สุดท้าย"
        }
    }
});


</script>    

                     

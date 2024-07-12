<?php
function ShowSubject($XITermID){
    include "../Database/DBConnect.php";
    $XIUserID=$_SESSION["XIUserID"];
    if($XITermID==0){
        $sql="SELECT TOP(1) XITermID, XVTermName, CONVERT(VARCHAR, XDStart, 120) AS XDStart, CONVERT(VARCHAR, XDEnd, 120) AS XDEnd
            FROM     dbo.MstTerm
        ORDER BY XITermID DESC";
    }else{
        $sql="SELECT  XITermID, XVTermName, CONVERT(VARCHAR, XDStart, 120) AS XDStart, CONVERT(VARCHAR, XDEnd, 120) AS XDEnd
        FROM     dbo.MstTerm
        WHERE        (XITermID = $XITermID)
        ORDER BY XITermID DESC";
    }
   
    $query  = sqlsrv_query( $conn, $sql);
    while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){  
        $XDStart=$row["XDStart"]." 00:00:00";
        $XDEnd=$row["XDEnd"]." 23:59:59";
        $XVTermName=$row["XVTermName"];
    }
     $data='<p>ภาคเรียนที่ '.$XVTermName.'</p> 
     <table class="table" id="Table2">
     <thead>
         <tr>
             <th class="text-center">รหัสวิชา</th>
             <th class="text-center">ชื่อวิชา</th>
             <th class="text-center"></th>
         </tr>
     </thead>
     <tbody id="TableBody3">
     ';
     $sql="SELECT  dbo.MstSubject.XVSubjectCode, dbo.MstSubject.XVSubjectName, dbo.MstSubject.XISubjectID, dbo.MstStudentClass.XIUserID, dbo.MstSchedule.XITermID
            FROM dbo.MstStudentClass INNER JOIN
                dbo.MstSchedule ON dbo.MstStudentClass.XIClassID = dbo.MstSchedule.XIClassID INNER JOIN
                dbo.MstSubject ON dbo.MstSchedule.XISubjectID = dbo.MstSubject.XISubjectID
            GROUP BY dbo.MstSubject.XVSubjectName, dbo.MstSubject.XISubjectID, dbo.MstStudentClass.XIUserID, dbo.MstSubject.XVSubjectCode, dbo.MstSchedule.XITermID
            HAVING        (dbo.MstStudentClass.XIUserID = $XIUserID) AND (dbo.MstSchedule.XITermID = $XITermID)
            ORDER BY dbo.MstSubject.XISubjectID";
     $query  = sqlsrv_query( $conn, $sql);
     while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){   
                 $data.=  '<tr>
                 <td class="text-center">'.$row["XVSubjectCode"].'</td>
                 <td class="text-center">'.$row["XVSubjectName"].'</td>
                 <td><button type="button" class="btn btn-primary btn-sm w-100 " onclick="ShowData(\''.$row["XISubjectID"].'\',\''.$XITermID.'\')">แสดงเวลาเข้าเรียน</button>
                 ';   
                 $data.='</tr>';
             
     }
     $data.='</tbody>';
     $data.='</table>';
     sqlsrv_close($conn);
     return $data; 

}
function  ShowData($XISubjectID,$XITermID){
    include "../Database/DBConnect.php";
    $XIUserID=$_SESSION["XIUserID"];
    if($XITermID==0){
        $sql="SELECT TOP(1) XITermID, XVTermName, CONVERT(VARCHAR, XDStart, 120) AS XDStart, CONVERT(VARCHAR, XDEnd, 120) AS XDEnd
            FROM     dbo.MstTerm
        ORDER BY XITermID DESC";
    }else{
        $sql="SELECT  XITermID, XVTermName, CONVERT(VARCHAR, XDStart, 120) AS XDStart, CONVERT(VARCHAR, XDEnd, 120) AS XDEnd
        FROM     dbo.MstTerm
        WHERE        (XITermID = $XITermID)
        ORDER BY XITermID DESC";
    }
 
    $query  = sqlsrv_query( $conn, $sql);
    while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){  
        $XDStart=$row["XDStart"]." 00:00:00";
        $XDEnd=$row["XDEnd"]." 23:59:59";
        $XVTermName=$row["XVTermName"];
    }
  
    $sql="SELECT        XISubjectID, XVSubjectName, XVSubjectCode
    FROM            dbo.MstSubject
    WHERE        (XISubjectID = $XISubjectID)";
    $query  = sqlsrv_query( $conn, $sql);
    while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){  
         $XVSubjectName=$row['XVSubjectName'];
         $XVSubjectCode=$row['XVSubjectCode'];
    }
    $data='<p>ภาคเรียนที่ '.$XVTermName.' '.$XVSubjectCode.' '.$XVSubjectName.'</p> 
    <table class="table" id="Table2">
    <thead>
        <tr>
            <th class="text-center">เวลา</th>
            <th class="text-center">ผู้เช็คชื่อ</th>
        </tr>
    </thead>
    <tbody id="TableBody2">
    ';
   
    $sql="SELECT  CONVERT(VARCHAR, dbo.TrFaceTime.XTTIME, 120) AS XTTIME, dbo.TrFaceTime.XITimeTypeID, dbo.TrFaceTime.XIUserID, dbo.TrFaceTime.XTApprove, dbo.TrFaceTime.XIUserID_Approve, 
            ISNULL(dbo.MstUser.XVUserName, '') AS XVUserName
          FROM dbo.TrFaceTime LEFT OUTER JOIN
              dbo.MstUser ON dbo.TrFaceTime.XIUserID_Approve = dbo.MstUser.XIUserID
         
          WHERE    (dbo.TrFaceTime.XITimeTypeID = 2) and  (dbo.TrFaceTime.XISubjectID = $XISubjectID)
and (dbo.TrFaceTime.XTTIME >= CONVERT(DATETIME, '$XDStart', 102)) AND (dbo.TrFaceTime.XTTIME <= CONVERT(DATETIME, '$XDEnd', 102)) AND (dbo.TrFaceTime.XIUserID =  $XIUserID)
          ORDER BY XTTIME DESC";
 
    $query  = sqlsrv_query( $conn, $sql);
    while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){   
                $data.=  '<tr>
                <td class="text-center">'.$row["XTTIME"].'</td>
                <td class="text-center">'.$row["XVUserName"].'</td>
                ';   
                $data.='</tr>';
            
    }
    $data.='</tbody>';
    $data.='</table>';
    sqlsrv_close($conn);
    return $data; 
}





?>
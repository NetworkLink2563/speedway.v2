<?php
function statusUser($status){
    if($status==1){
        echo 'Active';
    }else{
        echo 'Unactive';
    }
}

function changeIconUserActive($usercode){
    include "DatabaseManage.php";
    $stmt = "SELECT XBUsrIsActive FROM TMstMUser WHERE XVUsrCode='".$usercode."'";
    $query = sqlsrv_query($conn, $stmt);
    $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    return $result['XBUsrIsActive'];
    sqlsrv_close( $conn );
}
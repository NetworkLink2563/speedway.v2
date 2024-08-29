<?php
session_start();
header('Content-Type: application/json');
if (!isset($_SESSION["XVUsrCode"])) {
    echo "Session คุณหมดอายุ กรุณาเข้าสู่ระบบอีกครั้ง";
    echo "<meta http-equiv='refresh' content='0; url=http://127.0.0.1/speedback/Dashboard/'>";
    exit();
}

require("../../config/config.NWL_SpeedWayTest2.php");
// Depaertment
if (isset($_POST['load']) and $_POST['load'] == '0001') {
    $val1 = $_POST['val1'];
    $q = "SELECT *  FROM [dbo].[TMstMDepartment]  WHERE XVDptCode='$val1'";
    $cq = sqlsrv_query($conn, $q);
    $qus = sqlsrv_fetch_array($cq, SQLSRV_FETCH_ASSOC);
    $js = json_encode($qus, true);
    print_r($js);
}
// Shift Time 
if (isset($_POST['load']) and $_POST['load'] == '0002') {
    $val1 = $_POST['val1'];
    $q = "SELECT * FROM [dbo].[TMstMShift]  WHERE XVShfCode='$val1'";
    $cq = sqlsrv_query($conn, $q);
    $qus = sqlsrv_fetch_array($cq, SQLSRV_FETCH_ASSOC);
    $js = json_encode($qus, true);
    print_r($js);
}
// project 
if (isset($_POST['load']) and $_POST['load'] == '0003') {

    $val1 = $_POST['val1'];
    $q = "SELECT *  FROM [dbo].[TMstMProject]  WHERE XVCstCode='$val1'";
    $cq = sqlsrv_query($conn, $q);
    while ($qus = sqlsrv_fetch_array($cq, SQLSRV_FETCH_ASSOC)) {
        $dataprj[] = $qus;
    }
    print_r(json_encode($dataprj, true));
}
if (isset($_POST['load']) and $_POST['load'] == '0004') {
    $val1 = $_POST['val1'];
    $q = "SELECT * FROM [dbo].[TMstMUser] 
     LEFT JOIN [dbo].[TMstMProject]  ON TMstMUser.XVUsrDefaultPrj = TMstMProject.XVPrjCode WHERE XVUsrCode='$val1'";
    $cq = sqlsrv_query($conn, $q);
    $qus = sqlsrv_fetch_array($cq, SQLSRV_FETCH_ASSOC);
    $projar[] = $qus;
    print_r(json_encode($projar, true));
}
if (isset($_POST['load']) and $_POST['load'] == '0005') {
    // $arr=array();
    $userval = $_POST['userval'];
    $valmenu = $_POST['valmenu'];
    $pri = "SELECT XBDmnIsRead,XBDmnIsAdd,XBDmnIsDelete,XBDmnIsControl  FROM TMnyMUserMenu WHERE XVMnuCode ='$valmenu' AND XVUsrCode ='$userval'";
    $priq = sqlsrv_query($conn, $pri);
    $qpri = sqlsrv_fetch_array($priq, SQLSRV_FETCH_ASSOC);
    $XBDmnIsRead=$qpri['XBDmnIsRead'];
    $XBDmnIsAdd=$qpri['XBDmnIsAdd'];
    $XBDmnIsDelete=$qpri['XBDmnIsDelete']; 
    $XBDmnIsControl=$qpri['XBDmnIsControl']; 
    $pri = array(
        'XBDmnIsRead' => $XBDmnIsRead,
        'XBDmnIsAdd' => $XBDmnIsAdd,
        'XBDmnIsDelete' => $XBDmnIsDelete,
        'XBDmnIsControl' => $XBDmnIsControl
    );
    
    $result = [];
    
    if (in_array(1, $pri)) {
        $result = [];
        if (in_array(1, $pri)) {
        // Check conditions and assign values accordingly
        if (isset($pri['XBDmnIsRead']) && $pri['XBDmnIsRead'] == 1) { $result[] = '1';}
        if (isset($pri['XBDmnIsAdd']) && $pri['XBDmnIsAdd'] == 1) { $result[] = '2';}
        if (isset($pri['XBDmnIsDelete']) && $pri['XBDmnIsDelete'] == 1) { $result[] = '3';}
        if (isset($pri['XBDmnIsControl']) && $pri['XBDmnIsControl'] == 1) {$result[] = '4';}
        // If all are set to 1, return ['0']
        if (count($result) === 4) {
            $result = ['0'];
        }
        // Convert the result array to the desired JSON string format
        $resultString = json_encode($result);
        echo $resultString;
       }
    }
}

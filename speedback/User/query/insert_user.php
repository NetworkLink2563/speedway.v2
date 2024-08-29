<?php
session_start();

if (!isset($_SESSION["XVUsrCode"])) {
    echo "Session คุณหมดอายุ กรุณาเข้าสู่ระบบอีกครั้ง";
    echo "<meta http-equiv='refresh' content='0; url=http://127.0.0.1/speedback/'>";
    exit();
}

require("../../config/config.NWL_SpeedWayTest2.php");

if (isset($_POST['fn']) and $_POST['fn'] == '0001') {
    $XTWhoCreate = $_SESSION['XVUsrCode'];
    $dnow = date('Y-m-d H:i:s');
    if (isset($_POST['XVDptName'])) { $XVDptName = htmlspecialchars($_POST['XVDptName'], ENT_QUOTES);} else { $XVDptName = "";}
    $qchk = "SELECT *   FROM [dbo].[TMstMDepartment] WHERE XVDptName='$XVDptName'";
    $ql1 = sqlsrv_query($conn, $qchk);
    $row1 = sqlsrv_fetch_array($ql1, SQLSRV_FETCH_ASSOC);
    if ($row1) {
        echo '2';
    } else {
        $pdpt = "SELECT XVDptCode  FROM [dbo].[TMstMDepartment] ORDER BY XVDptCode DESC ";
        $pqdpt = sqlsrv_query($conn, $pdpt);
        $pqarr = sqlsrv_fetch_array($pqdpt, SQLSRV_FETCH_ASSOC);
        $XVDptCode = $pqarr['XVDptCode'];
        $num1 = $XVDptCode;
        $num2 = 1;
        $sum = $num1 + $num2;
        // Format the sum with leading zeros
        $formattedSum = sprintf('%03d', $sum);
        $ndpt = "INSERT INTO [dbo].[TMstMDepartment]
           ([XVDptCode]
           ,[XVDptName]
           ,[XVWhoCreate]
           ,[XTWhenCreate])
     VALUES
           ('$formattedSum'
           ,'$XVDptName'
           ,'$XTWhoCreate '
           ,'$dnow')";
        $qdpt2 = sqlsrv_query($conn, $ndpt);
        if ($qdpt2 == true) {
            $dptall = "SELECT * FROM [dbo].[TMstMDepartment] WHERE XVDptCode='$formattedSum'";
            $qdtpi = sqlsrv_query($conn, $dptall);
            while ($hj = sqlsrv_fetch_array($qdtpi, SQLSRV_FETCH_ASSOC)) {
                echo '<option value="' . $hj['XVDptCode'] . '">' . $hj['XVDptName'] . '</option>';
            }
        } else {
            echo '3';
        }
    }
}




if (isset($_POST['fn']) and $_POST['fn'] == '0002') {
    $XTWhoCreate = $_SESSION['XVUsrCode'];
    $dnow = date('Y-m-d H:i:s');
    if (isset($_POST['XVshiftname'])) {$XVshiftname = htmlspecialchars($_POST['XVshiftname'], ENT_QUOTES);} else { $XVshiftname = "";} // Shift Name
    if (isset($_POST['timestr'])) {$timestr = htmlspecialchars($_POST['timestr'], ENT_QUOTES);} else {$timestr = "";} // time strart
    if (isset($_POST['timeend'])) {$timeend = htmlspecialchars($_POST['timeend'], ENT_QUOTES);} else {$timeend = "";} // time strart

    //echo $timestr.'-'.$timeend;
    $TmStr_conH = date('H', strtotime($timestr));
    $TmStr_conM = date('i', strtotime($timestr));

    $TmEd_conH = date('H', strtotime($timeend));
    $TmEd_conM = date('i', strtotime($timeend));



    $qchk = "SELECT * FROM [dbo].[TMstMShift] WHERE XVShfName='$XVshiftname'";
    $ql1 = sqlsrv_query($conn, $qchk);
    $row1 = sqlsrv_fetch_array($ql1, SQLSRV_FETCH_ASSOC);
    if ($row1) {
        echo '2';
    } else {
        $pdpt = "SELECT XVShfCode FROM [dbo].[TMstMShift] ORDER BY XVshfCode DESC ";
        $pqdpt = sqlsrv_query($conn, $pdpt);
        $pqarr = sqlsrv_fetch_array($pqdpt, SQLSRV_FETCH_ASSOC);
        $XVshfCode = $pqarr['XVShfCode'];
        $num1 = $XVshfCode;
        $num2 = 1;
        $sum = $num1 + $num2;
        // Format the sum with leading zeros
        $formattedSum = sprintf('%03d', $sum);
        $ndshf = "INSERT INTO [dbo].[TMstMShift]
           (
           [XVShfCode],
           [XVShfName],
           [XIShfStartHour],
           [XIShfStartMin],
           [XIShfEndHour],
           [XIShfEndMin],
           [XVWhoCreate],
           [XTWhenCreate] )
     VALUES 
           ('$formattedSum'
           ,'$XVshiftname'
           ,'$TmStr_conH'
           ,'$TmStr_conM'
           ,'$TmEd_conH'
           ,'$TmEd_conM'
           ,'$XTWhoCreate '
           ,'$dnow')";


        $qdshf2 = sqlsrv_query($conn, $ndshf);
        if ($qdshf2 == true) {
            $dptall = "SELECT * FROM [dbo].[TMstMShift] WHERE XVShfCode ='$formattedSum'";
            $qdtpi = sqlsrv_query($conn, $dptall);
            while ($hj = sqlsrv_fetch_array($qdtpi, SQLSRV_FETCH_ASSOC)) {
                $timeshf = '[&nbsp;' . str_pad($hj['XIShfStartHour'], 2, "0", STR_PAD_LEFT) . ':'
                    . str_pad($hj['XIShfStartMin'], 2, "0", STR_PAD_LEFT) . '&nbsp;|&nbsp;'
                    . str_pad($hj['XIShfEndHour'], 2, "0", STR_PAD_LEFT) . ':'
                    . Str_pad($hj['XIShfEndMin'], 2, "0", STR_PAD_LEFT) . '&nbsp;]';
                echo '<option value="' . $hj['XVShfCode'] . '">' . $hj['XVShfName'] . '&nbsp;' . $timeshf . '</option>';
            }
        } else {
            echo '3';
        }
    }
}
if (isset($_POST['fn']) and $_POST['fn'] == '0003') {
    $XTWhoCreate = $_SESSION['XVUsrCode'];
    $dnow = date('Y-m-d H:i:s');
    if (isset($_POST['XVUsrCode'])) {$XVUsrCode = htmlspecialchars($_POST['XVUsrCode'], ENT_QUOTES);} else {$XVUsrCode = ""; }
    if (isset($_POST['XVUsrPwd'])) {$XVUsrPwd = htmlspecialchars(md5(base64_encode(md5(base64_encode($_POST['XVUsrPwd'])))), ENT_QUOTES);} else {$XVUsrPwd = "nwl";} // time strart
    if (isset($_POST['XVUsrName'])) {$XVUsrName = htmlspecialchars($_POST['XVUsrName'], ENT_QUOTES);} else { $XVUsrName = "";}
    if (isset($_POST['XVUsrPhone'])) {$XVUsrPhone = htmlspecialchars($_POST['XVUsrPhone'], ENT_QUOTES);} else {$XVUsrPhone = "";}
    if (isset($_POST['idcust'])) {$idcust = htmlspecialchars($_POST['idcust'], ENT_QUOTES);} else {$idcust = "";}
    if (isset($_POST['XVUsrDefaultPrj'])) { $XVUsrDefaultPrj = htmlspecialchars($_POST['XVUsrDefaultPrj'], ENT_QUOTES);} else {$XVUsrDefaultPrj = "";}
    if (isset($_POST['XVShfCode'])) {$XVShfCode = htmlspecialchars($_POST['XVShfCode'], ENT_QUOTES);} else {$XVShfCode = "";}
    if (isset($_POST['XBUsrIsActive'])) {$XBUsrIsActive = htmlspecialchars($_POST['XBUsrIsActive'], ENT_QUOTES); } else { $XBUsrIsActive = "";}
    if (isset($_POST['XBUsrIsCstAdmin'])) {$XBUsrIsCstAdmin = htmlspecialchars($_POST['XBUsrIsCstAdmin'], ENT_QUOTES); } else {$XBUsrIsCstAdmin = "";}
    if (isset($_POST['XVDptCode'])) {$XVDptCode = htmlspecialchars($_POST['XVDptCode'], ENT_QUOTES);} else {$XVDptCode = "";}
    $qsuer = "INSERT INTO [dbo].[TMstMUser]
           ([XVUsrCode]
           ,[XVUsrPwd]
           ,[XVUsrPwdDef]
           ,[XVUsrName]
           ,[XVUsrPhone]
           ,[XVUsrDefaultPrj]
           ,[XVCstCode]
           ,[XVDptCode]
           ,[XBUsrIsActive]
           ,[XBUsrIsCstAdmin]
           ,[XVShfCode]
           ,[XVWhoCreate]
           ,[XTWhenCreate])
     VALUES
           ('$XVUsrCode'
           ,'$XVUsrPwd'
           ,'$XVUsrPwd'
           ,'$XVUsrName'
           ,'$XVUsrPhone'
           ,'$XVUsrDefaultPrj'
           ,'$idcust'
           ,'$XVDptCode'
           ,'$XBUsrIsActive'
           ,'$XBUsrIsCstAdmin'
           ,'$XVShfCode'
           ,'$XTWhoCreate'
           ,'$dnow')";
    $qnewu = sqlsrv_query($conn, $qsuer);
    if ($qnewu == true) {
        echo '1';
    } else {
        echo 'error';
    }
}
if (isset($_POST['fn']) and $_POST['fn'] == '0004') {
    $data = $_POST['idpri'];
    $idmenu = $_POST['idmenu'];
    $usrpri = $_POST['usrpri'];
    $dnow = date('Y-m-d H:i:s');
    $arrpri = array(); // เก็บข้อมูล สิทธิ์การใช้งาน
    // check ค่าซ้ำ กรณี user มีสิทธิ์การใช้งานเดิมอยู่แล้ว
    $arrk = array(
        '0' => 'XBDmnIsRead,XBDmnIsAdd,XBDmnIsDelete,XBDmnIsControl',
        '1' => 'XBDmnIsReadx',
        '2' => 'XBDmnIsAddx',
        '3' => 'XBDmnIsDeletex',
        '4' => 'XBDmnIsControlx'
    );
    $qcodepri = explode(',', $data);
    $results = [];
    $arrnum_ = array();
    $arrall = array();
    foreach ($qcodepri as $k) {
        $k = trim($k); // Trim any whitespace
        if ($k !== '') { // Check if the key is not empty
            if ($k == '0') {
                $result = preg_replace('/(?<=x)(?=[A-Z])/', ',', $arrk[$k]);  // Add commas between each entry in the first element
            } else {
                $v = substr("$arrk[$k]", 0, -1);
                $result = $v;   // For other entries, just get the result directly
            }
            $results[] = $result; // Store the result in the results array 
        }
    }
    $arrnum = array('1' => "'1'", '2' => "'1'", '3' => "'1'", '4' => "'1'");
    foreach ($qcodepri as $jk) {
        $arrnum_[] = $arrnum[$jk];
    }
    $outnum = implode(',', $arrnum_); // Use a comma to combine results
    // Combine results into a single string
    $output = implode(',', $results); // Use a comma to combine results
    $outputArray = explode(',',  $output); // Split the combined string into an array
    $value = [];

    $value = ["'1','1','1','1'"];
    $ov = implode(',', $value); // Use a comma to combine value
    /// case value $arrk inside เป็นค่าซ้ำ ต้องทำการตรวจสอบ Parameter และ UserCode 
    $qchk="SELECT XVMnuCode,XVUsrCode, $output FROM TMnyMUserMenu WHERE XVUsrCode ='$usrpri' AND XVMnuCode ='$idmenu'";
    $q1t=sqlsrv_query($conn, $qchk);
    $arr=sqlsrv_fetch_array($q1t,SQLSRV_FETCH_ASSOC);
    if($arr){
    $arrup1= array();
      foreach($results as $val){
        $arrup1[]= $val."='1'";
      }
      $output1 = implode(',', $arrup1); // Use a comma to combine results -> บางรายการสิทธิ์การใช้งาน
      if ($data == '0') { 
        foreach($outputArray  as $valall){
            $arrall[]= $valall."='1'";
          }
      $output2 = implode(',', $arrall); // Use a comma to combine results -> all สิทธิ์การใช้งาน 
      $Q2 = "UPDATE TMnyMUserMenu 
      SET  $output2 ,XVWhoCreate='".$_SESSION['XVUsrCode'] ."',XTWhenCreate='" . $dnow . "'
      WHERE XVMnuCode ='$idmenu' AND XVUsrCode ='$usrpri'";
      $Ql2=sqlsrv_query($conn,$Q2);
      if($Ql2===false){ echo 'Error';}else{ echo '1';}
      }else{
      $Q1 = "UPDATE TMnyMUserMenu 
      SET $output1,XVWhoCreate='".$_SESSION['XVUsrCode'] ."',XTWhenCreate='" . $dnow . "'
      WHERE XVMnuCode ='$idmenu' AND XVUsrCode ='$usrpri'";

      $Ql1=sqlsrv_query($conn,$Q1);
      if($Ql1===false){ echo 'Error';}else{ echo '1';}
      }
    //  if($Ql1=== false){ echo 'Error';}else{ echo '1';}
    }else{
        if ($data == '0') {
        if ($idmenu == 'AllMenu') {
            $value = 1; // Value to insert
            $quser = "SELECT * FROM TSysSMenu ";
            $pri1 = sqlsrv_query($conn,  $quser);
            while ($pq1 = sqlsrv_fetch_array($pri1, SQLSRV_FETCH_ASSOC)) {
                $u = $pq1['XVMnuCode'];
                $qsp = "INSERT INTO TMnyMUserMenu  
                                  ( [XVUsrCode]
                                   ,[XVMnuCode]
                                   ,$output
                                   ,[XVWhoCreate]
                                   ,[XTWhenCreate])
                                    VALUES 
                                   ('$usrpri'
                                    ,'" . $u . "'
                                    ,$ov
                                    ,'" . $_SESSION['XVUsrCode'] . "'
                                    ,'" . $dnow . "' )";
               // echo $qsp;
                $chkq = sqlsrv_query($conn, $qsp);
            } // End while loop TSysSMenu
            if ($chkq === false) {  echo 'Error';} else {  echo '1';}
        } else {
        $qspx = "INSERT INTO TMnyMUserMenu  
        ( [XVUsrCode]
        ,[XVMnuCode]
        ,$output
        ,[XVWhoCreate]
        ,[XTWhenCreate])
        VALUES (
        '$usrpri'
        ,'" .$idmenu. "'
        ,$ov
        ,'" . $_SESSION['XVUsrCode'] . "'
        ,'" . $dnow . "' )";
        $cj = sqlsrv_query($conn, $qspx);
        if ($cj === false) { echo 'Error';} else { echo '1';}
        }
    } else {
 
        if ($idmenu == 'AllMenu') {
            $q7 = "SELECT * FROM TSysSMenu ";
            $pl7 = sqlsrv_query($conn, $q7);
            while ($pk7 = sqlsrv_fetch_array($pl7, SQLSRV_FETCH_ASSOC)) {
                $ul = $pk7['XVMnuCode'];
                $sql7 = "INSERT INTO TMnyMUserMenu (XVUsrCode,$output,XVMnuCode,XVWhoCreate,XTWhenCreate) VALUES ( '$usrpri',$outnum,'$ul','" . $_SESSION['XVUsrCode'] ."','" . $dnow . "')";
                $iy = sqlsrv_query($conn, $sql7);
            }
            if ($iy === false) {echo 'Error';} else { echo '1';}
        } else {
                $sql = "INSERT INTO TMnyMUserMenu (XVUsrCode,$output,XVMnuCode,XVWhoCreate,XTWhenCreate) VALUES ( '$usrpri',$outnum,'$idmenu','" . $_SESSION['XVUsrCode'] ."','" . $dnow . "')";
                $t = sqlsrv_query($conn, $sql);
                if ($t === false) { echo 'Error';} else {echo '1'; }
        } // END if AllMenu

    }
}
}


if (isset($_POST['fn']) and $_POST['fn'] == '0005') {
    $data = $_POST['idpri'];
    $idmenu = $_POST['idmenu'];
    $usrpri = $_POST['usrpri'];
    $dnow = date('Y-m-d H:i:s');
    $arrpri = array(); // เก็บข้อมูล สิทธิ์การใช้งาน
    // check ค่าซ้ำ กรณี user มีสิทธิ์การใช้งานเดิมอยู่แล้ว
    $arrk = array(
        '0' => 'XBDmnIsRead,XBDmnIsAdd,XBDmnIsDelete,XBDmnIsControl',
        '1' => 'XBDmnIsReadx',
        '2' => 'XBDmnIsAddx',
        '3' => 'XBDmnIsDeletex',
        '4' => 'XBDmnIsControlx'
    );
    $qcodepri = explode(',', $data);
    $results = [];
    $arrnum_ = array();
    $arrall = array();
    foreach ($qcodepri as $k) {
        $k = trim($k); // Trim any whitespace
        if ($k !== '') { // Check if the key is not empty
            if ($k == '0') {
                $result = preg_replace('/(?<=x)(?=[A-Z])/', ',', $arrk[$k]);  // Add commas between each entry in the first element
            } else {
                $v = substr("$arrk[$k]", 0, -1);
                $result = $v;   // For other entries, just get the result directly
            }
            $results[] = $result; // Store the result in the results array 
        }
    }
    $arrnum = array('1' => "'1'", '2' => "'1'", '3' => "'1'", '4' => "'1'");
    foreach ($qcodepri as $jk) {
        $arrnum_[] = $arrnum[$jk];
    }
    $outnum = implode(',', $arrnum_); // Use a comma to combine results
    // Combine results into a single string
    $output = implode(',', $results); // Use a comma to combine results
    $outputArray = explode(',',  $output); // Split the combined string into an array
    $value = [];
    $value = ["'1','1','1','1'"];
    $ov = implode(',', $value); // Use a comma to combine value
    /// case value $arrk inside เป็นค่าซ้ำ ต้องทำการตรวจสอบ Parameter และ UserCode 
    $DEL = "DELETE FROM TMnyMUserMenu WHERE XVMnuCode ='$idmenu'";
    $upq=sqlsrv_query($conn, $DEL);
    if($upq===false){ 
    echo 'Error';
    }else{
    $qchk="SELECT XVMnuCode,XVUsrCode, $output FROM TMnyMUserMenu WHERE XVUsrCode ='$usrpri' AND XVMnuCode ='$idmenu'";
    $q1t=sqlsrv_query($conn, $qchk);
    $arr=sqlsrv_fetch_array($q1t,SQLSRV_FETCH_ASSOC);
    if($arr){
    
       $arrup1= array();
       foreach($results as $val){
        $arrup1[]= $val."='1'";
      }
      $output1 = implode(',', $arrup1); // Use a comma to combine results -> บางรายการสิทธิ์การใช้งาน
      if ($data == '0') { 
        foreach($outputArray  as $valall){
            $arrall[]= $valall."='1'";
          }
      $output2 = implode(',', $arrall); // Use a comma to combine results -> all สิทธิ์การใช้งาน 
      $Q2 = "UPDATE TMnyMUserMenu 
      SET  $output2 ,XVWhoCreate='".$_SESSION['XVUsrCode'] ."',XTWhenCreate='" . $dnow . "'
      WHERE XVMnuCode ='$idmenu' AND XVUsrCode ='$usrpri'";
      $Ql2=sqlsrv_query($conn,$Q2);
      if($Ql2===false){ echo 'Error';}else{ echo '1';}
      }else{
      $Q1 = "UPDATE TMnyMUserMenu 
      SET $output1,XVWhoCreate='".$_SESSION['XVUsrCode'] ."',XTWhenCreate='" . $dnow . "'
      WHERE XVMnuCode ='$idmenu' AND XVUsrCode ='$usrpri'";

      $Ql1=sqlsrv_query($conn,$Q1);
      if($Ql1===false){ echo 'Error';}else{ echo '1';}
      }
    //  if($Ql1=== false){ echo 'Error';}else{ echo '1';}
    
    }else{
        if ($data == '0') {
        if ($idmenu == 'AllMenu') {
            $value = 1; // Value to insert
            $quser = "SELECT * FROM TSysSMenu ";
            $pri1 = sqlsrv_query($conn,  $quser);
            while ($pq1 = sqlsrv_fetch_array($pri1, SQLSRV_FETCH_ASSOC)) {
                $u = $pq1['XVMnuCode'];
                $qsp = "INSERT INTO TMnyMUserMenu  
                                  ( [XVUsrCode]
                                   ,[XVMnuCode]
                                   ,$output
                                   ,[XVWhoCreate]
                                   ,[XTWhenCreate])
                                    VALUES 
                                   ('$usrpri'
                                    ,'$u'
                                    ,$ov
                                    ,'" . $_SESSION['XVUsrCode'] . "'
                                    ,'" . $dnow . "' )";
               // echo $qsp;
                $chkq = sqlsrv_query($conn, $qsp);
            } // End while loop TSysSMenu
            if ($chkq === false) {  echo 'Error';} else {  echo '1';}
        } else {
        $qspx = "INSERT INTO TMnyMUserMenu  
        ( [XVUsrCode]
        ,[XVMnuCode]
        ,$output
        ,[XVWhoCreate]
        ,[XTWhenCreate])
        VALUES (
        '$usrpri'
        ,'$idmenu'
        ,$ov
        ,'" . $_SESSION['XVUsrCode'] . "'
        ,'" . $dnow . "' )";
        $cj = sqlsrv_query($conn, $qspx);
        if ($cj === false) { echo 'Error';} else { echo '1';}
        }
    } else {
 
        if ($idmenu == 'AllMenu') {
            $q7 = "SELECT * FROM TSysSMenu ";
            $pl7 = sqlsrv_query($conn, $q7);
            while ($pk7 = sqlsrv_fetch_array($pl7, SQLSRV_FETCH_ASSOC)) {
                $ul = $pk7['XVMnuCode'];
                $sql7 = "INSERT INTO TMnyMUserMenu (XVUsrCode,$output,XVMnuCode,XVWhoCreate,XTWhenCreate) VALUES ( '$usrpri',$outnum,'$ul','" . $_SESSION['XVUsrCode'] ."','" . $dnow . "')";
                $iy = sqlsrv_query($conn, $sql7);
            }
            if ($iy === false) {echo 'Error';} else { echo '1';}
        } else {
                $sql = "INSERT INTO TMnyMUserMenu (XVUsrCode,$output,XVMnuCode,XVWhoCreate,XTWhenCreate) VALUES ( '$usrpri',$outnum,'$idmenu','" . $_SESSION['XVUsrCode'] ."','" . $dnow . "')";
                $t = sqlsrv_query($conn, $sql);
                if ($t === false) { echo 'Error';} else {echo '1'; }
        } // END if AllMenu
    }
   }
 }
}
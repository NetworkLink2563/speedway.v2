
 


<?php
ob_start();
session_start();


include "lib/DatabaseManage.php";
$hidtr = "SELECT * FROM [NWL_SpeedWayTest2].[dbo].[TMstMUserDashboard] WHERE XVUsrCode='" . $_SESSION['user'] . "' AND XIShowColumn = '1'";
$lh = sqlsrv_query($conn, $hidtr);
$dt = sqlsrv_fetch_array($lh, SQLSRV_FETCH_ASSOC);
if ($dt['XIShowColumn'] == 1) {
    $tx1 = 'style="display:"';
} else {
    $tx1 = 'style="display:none"';
}

$l1 = "SELECT * FROM [NWL_SpeedWayTest2].[dbo].[TMstMUserDashboard] WHERE XVUsrCode='" . $_SESSION['user'] . "' AND XIShowColumn = '2'";
$l1q = sqlsrv_query($conn, $l1);
$l2qr = sqlsrv_fetch_array($l1q, SQLSRV_FETCH_ASSOC);
if ($l2qr['XIShowColumn'] == 2) {
    $tx2 = 'style="display:"';
} else {
    $tx2 = 'style="display:none"';
}


$l3 = "SELECT * FROM [NWL_SpeedWayTest2].[dbo].[TMstMUserDashboard] WHERE XVUsrCode='" . $_SESSION['user'] . "' AND XIShowColumn = '3'";
$l3q = sqlsrv_query($conn, $l3);
$l3qr = sqlsrv_fetch_array($l3q, SQLSRV_FETCH_ASSOC);
if ($l3qr['XIShowColumn'] == 3) {
    $tx3 = 'style="display:"';
} else {
    $tx3 = 'style="display:none"';
}

$l4 = "SELECT * FROM [NWL_SpeedWayTest2].[dbo].[TMstMUserDashboard] WHERE XVUsrCode='" . $_SESSION['user'] . "' AND XIShowColumn = '4'";
$l4q = sqlsrv_query($conn, $l4);
$l4qr = sqlsrv_fetch_array($l4q, SQLSRV_FETCH_ASSOC);
if ($l4qr['XIShowColumn'] == 4) {
    $tx4 = 'style="display:"';
} else {
    $tx4 = 'style="display:none"';
}

$l5 = "SELECT * FROM [NWL_SpeedWayTest2].[dbo].[TMstMUserDashboard] WHERE XVUsrCode='" . $_SESSION['user'] . "' AND XIShowColumn = '5'";
$l5q = sqlsrv_query($conn, $l5);
$l5qr = sqlsrv_fetch_array($l5q, SQLSRV_FETCH_ASSOC);
if ($l5qr['XIShowColumn'] == 5) {
    $tx5 = 'style="display:"';
} else {
    $tx5 = 'style="display:none"';
}

$l6 = "SELECT * FROM [NWL_SpeedWayTest2].[dbo].[TMstMUserDashboard] WHERE XVUsrCode='" . $_SESSION['user'] . "' AND XIShowColumn = '6'";
$l6q = sqlsrv_query($conn, $l6);
$l6qr = sqlsrv_fetch_array($l6q, SQLSRV_FETCH_ASSOC);
if ($l6qr['XIShowColumn'] == 6) {
    $tx6 = 'style="display:"';
} else {
    $tx6 = 'style="display:none"';
}

$l7 = "SELECT * FROM [NWL_SpeedWayTest2].[dbo].[TMstMUserDashboard] WHERE XVUsrCode='" . $_SESSION['user'] . "' AND XIShowColumn = '7'";
$l7q = sqlsrv_query($conn, $l7);
$l7qr = sqlsrv_fetch_array($l7q, SQLSRV_FETCH_ASSOC);
if ($l7qr['XIShowColumn'] == 7) {
    $tx7 = 'style="display:"';
} else {
    $tx7 = 'style="display:none"';
}

$l8 = "SELECT * FROM [NWL_SpeedWayTest2].[dbo].[TMstMUserDashboard] WHERE XVUsrCode='" . $_SESSION['user'] . "' AND XIShowColumn = '8'";
$l8q = sqlsrv_query($conn, $l8);
$l8qr = sqlsrv_fetch_array($l8q, SQLSRV_FETCH_ASSOC);
if ($l8qr['XIShowColumn'] == 8) {
    $tx8 = 'style="display:"';
} else {
    $tx8 = 'style="display:none"';
}

$l9 = "SELECT * FROM [NWL_SpeedWayTest2].[dbo].[TMstMUserDashboard] WHERE XVUsrCode='" . $_SESSION['user'] . "' AND XIShowColumn = '9'";
$l9q = sqlsrv_query($conn, $l9);
$l9qr = sqlsrv_fetch_array($l9q, SQLSRV_FETCH_ASSOC);
if ($l9qr['XIShowColumn'] == 9) {
    $tx9 = 'style="display:"';
} else {
    $tx9 = 'style="display:none"';
}

$l10 = "SELECT * FROM [NWL_SpeedWayTest2].[dbo].[TMstMUserDashboard] WHERE XVUsrCode='" . $_SESSION['user'] . "' AND XIShowColumn = '10'";
$l10q = sqlsrv_query($conn, $l10);
$l10qr = sqlsrv_fetch_array($l10q, SQLSRV_FETCH_ASSOC);
if ($l10qr['XIShowColumn'] == 10) {
    $tx10 = 'style="display:"';
} else {
    $tx10 = 'style="display:none"';
}

$l11 = "SELECT * FROM [NWL_SpeedWayTest2].[dbo].[TMstMUserDashboard] WHERE XVUsrCode='" . $_SESSION['user'] . "' AND XIShowColumn = '11'";
$l11q = sqlsrv_query($conn, $l11);
$l11qr = sqlsrv_fetch_array($l11q, SQLSRV_FETCH_ASSOC);
if ($l11qr['XIShowColumn'] == 11) {
    $tx11 = 'style="display:"';
} else {
    $tx11 = 'style="display:none"';
}

$l12 = "SELECT * FROM [NWL_SpeedWayTest2].[dbo].[TMstMUserDashboard] WHERE XVUsrCode='" . $_SESSION['user'] . "' AND XIShowColumn = '12'";
$l12q = sqlsrv_query($conn, $l12);
$l12qr = sqlsrv_fetch_array($l12q, SQLSRV_FETCH_ASSOC);
if ($l12qr['XIShowColumn'] == 12) {
    $tx12 = 'style="display:"';
} else {
    $tx12 = 'style="display:none"';
}

$l13 = "SELECT * FROM [NWL_SpeedWayTest2].[dbo].[TMstMUserDashboard] WHERE XVUsrCode='" . $_SESSION['user'] . "' AND XIShowColumn = '13'";
$l13q = sqlsrv_query($conn, $l13);
$l13qr = sqlsrv_fetch_array($l13q, SQLSRV_FETCH_ASSOC);
if ($l13qr['XIShowColumn'] == 13) {
    $tx13 = 'style="display:"';
} else {
    $tx13 = 'style="display:none"';
}

$l14 = "SELECT * FROM [NWL_SpeedWayTest2].[dbo].[TMstMUserDashboard] WHERE XVUsrCode='" . $_SESSION['user'] . "' AND XIShowColumn = '14'";
$l14q = sqlsrv_query($conn, $l14);
$l14qr = sqlsrv_fetch_array($l14q, SQLSRV_FETCH_ASSOC);
if ($l14qr['XIShowColumn'] == 14) {
    $tx14 = 'style="display:"';
} else {
    $tx14 = 'style="display:none"';
}

$l15 = "SELECT * FROM [NWL_SpeedWayTest2].[dbo].[TMstMUserDashboard] WHERE XVUsrCode='" . $_SESSION['user'] . "' AND XIShowColumn = '15'";
$l15q = sqlsrv_query($conn, $l15);
$l15qr = sqlsrv_fetch_array($l15q, SQLSRV_FETCH_ASSOC);
if ($l15qr['XIShowColumn'] == 14) {
    $tx15 = 'style="display:"';
} else {
    $tx15 = 'style="display:none"';
}

$data = '<table class="table table-striped table-hover">
            <thead>
            <tr style="text-align: center;">
                <th id="th_status1" ' . $tx1 . ' >สถานะ</th>
                <th id="th_status2"  ' . $tx2 . ' >แบบป้าย</th>
                <th id="th_status3" ' . $tx3 . '  >ป้าย</th>
                <th id="th_status4" ' . $tx4 . '   >ไฟฟ้า</th>
                <th id="th_status5" ' . $tx5 . '  >แสดงผล</th>
                <th id="th_status6" ' . $tx6 . '  >ความสว่าง</th>
                <th id="th_status7" ' . $tx7 . '  >อุณหภูมิตู้</th>
                <th id="th_status8" ' . $tx8 . '  >อุณหภูมิป้าย</th>
                <th id="th_status9" ' . $tx9 . '  >พัดลมตู้</th>
                <th id="th_status10" ' . $tx10 . '  >ไฟกระพริบ</th>
                <th id="th_status11" ' . $tx11 . '  >โมดูลเสีย</th>
                <th id="th_status15" ' . $tx15 . '  >ไฟฟ้าคอมพิวเตอร์</th>
                <th id="th_status12" ' . $tx12 . '  >ประเภท</th>
                <th id="th_status13" ' . $tx13 . ' >ข้อความ</th>
                <th id="th_status14" ' . $tx14 . '  >Live</th>
            </tr>
            </thead>
            ';



$firstSQL = "  SELECT  vms.XVVmsCode, vms.XVVmsName, vms.XVSupCode, vms.XBVmsIsActive, vms.XIVmsPixelW, vms.XIVmsPixelH, vms.XIVmsSizeW, vms.XIVmsSizeH, vms.XVVmsSta, vms.XVVmsType, dbo.TMstMCustomer.XVCstCode, 
            dbo.TMstMMsgSize.XIMssWPixel, dbo.TMstMMsgSize.XIMssHPixel
            FROM     dbo.TMstMItmVMS AS vms INNER JOIN
            dbo.TMstMSetupPoint ON dbo.TMstMSetupPoint.XVSupCode = vms.XVSupCode INNER JOIN
            dbo.TMstMProject ON dbo.TMstMProject.XVPrjCode = dbo.TMstMSetupPoint.XVPrjCode INNER JOIN
            dbo.TMstMSubDistrict ON dbo.TMstMSubDistrict.XVSdtCode = dbo.TMstMSetupPoint.XVSdtCode INNER JOIN
            dbo.TMstMCustomer ON dbo.TMstMCustomer.XVCstCode = dbo.TMstMProject.XVCstCode INNER JOIN
            
            dbo.TMstMMsgSize ON dbo.TMstMMsgSize.XVMssCode = vms.XVMssCode   GROUP BY vms.XVVmsCode, vms.XVVmsName, vms.XVSupCode, vms.XBVmsIsActive, vms.XIVmsPixelW, vms.XIVmsPixelH, vms.XIVmsSizeW, vms.XIVmsSizeH, vms.XVVmsSta, vms.XVVmsType, dbo.TMstMCustomer.XVCstCode, 
            dbo.TMstMMsgSize.XIMssWPixel, dbo.TMstMMsgSize.XIMssHPixel";
$querySQL = sqlsrv_query($conn, $firstSQL);
$vmscodearray = "";
$i = 1;
while ($resultSQL = sqlsrv_fetch_array($querySQL, SQLSRV_FETCH_ASSOC)) {

    $XVVmsCode = $resultSQL['XVVmsCode'];
    $vmscodearray .= $XVVmsCode . ",";

    $sql = "SELECT dbo.TLogTItmVMSMessage.XVVmsCode, dbo.TLogTItmVMSMessage.XTWhenEdit, 
    DATEDIFF(Second, dbo.TLogTItmVMSMessage.XTWhenEdit, GETDATE()) AS XiSecDiff, 
    dbo.TLogTItmVMSMessage.XVMsfCode, 
    dbo.TMstMMessageFrame.XVMsfFormat, 
    dbo.TMstMMessageFrame.XVMsgCodeF1, 
    dbo.TMstMMessage.XVMsgFileName, 
    dbo.TMstMMessageFrame.XVMsgCodeF2, 
    dbo.TMstMMessageFrame.XVMsgCodeF3, 
    dbo.TMstMMessageFrame.XVMsgCodeF4, 
    dbo.TMstMMessageFrame.XVMsgCodeF5, 
    dbo.TMstMMsgSize.XIMssWPixel, 
    dbo.TMstMMsgSize.XIMssHPixel, 
    dbo.TMstMMessage.XVMsgHtml, 
    dbo.TMstMMessageFrame.XVMsfType
      FROM        dbo.TLogTItmVMSMessage INNER JOIN
                  dbo.TMstMMessageFrame ON dbo.TLogTItmVMSMessage.XVMsfCode = dbo.TMstMMessageFrame.XVMsfCode INNER JOIN
                  dbo.TMstMMessage ON dbo.TMstMMessageFrame.XVMsgCodeF1 = dbo.TMstMMessage.XVMsgCode INNER JOIN
                  dbo.TMstMMsgSize ON dbo.TMstMMessageFrame.XVMssCode = dbo.TMstMMsgSize.XVMssCode

                WHERE        (dbo.TLogTItmVMSMessage.XVVmsCode = '$XVVmsCode')";
    $query = sqlsrv_query($conn, $sql);
    $XVMsgName = "";
    $XVMsgCode = "";
    while ($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
        $XVMsgName = $row["XVMsgName"];
        $XVMsgCode = $row["XVMsgCode"];
        $type = $row['XVMsfType'];
    }


    if ($resultSQL['XBVmsIsActive'] == True) {
        $colorBannerBG = '#eef8e5';
        $colorBannerStatus = '#00CC00';
        $isActive = 'True';
    } else {
        $colorBannerBG = '#ffe6e6';
        $colorBannerStatus = 'red';
        $isActive = 'False';
    }


    $sqlVmsIsOn = "SELECT XBVmsIsOn FROM TMstMItmVMS_Status WHERE XVVmsCode='" . $resultSQL['XVVmsCode'] . "' AND XISensorType=1";
    $queryVmsIsOn = sqlsrv_query($conn, $sqlVmsIsOn);
    $XBVmsIsOn = "OFF";
    while ($row = sqlsrv_fetch_array($queryVmsIsOn, SQLSRV_FETCH_ASSOC)) {

        if ($row['XBVmsIsOn'] == 1) {
            $XBVmsIsOn = "ON";
        }
    }

    $sqlVmsIsDisplay = "SELECT XBVmsIsDisplay FROM TMstMItmVMS_Status WHERE XVVmsCode='" . $resultSQL['XVVmsCode'] . "' AND XISensorType=2";
    $queryVmsIsDisplay = sqlsrv_query($conn, $sqlVmsIsDisplay);
    $XBVmsIsDisplay = "OffLine";
    while ($row = sqlsrv_fetch_array($queryVmsIsDisplay, SQLSRV_FETCH_ASSOC)) {

        if ($row['XBVmsIsDisplay'] == 1) {
            $XBVmsIsDisplay = "OnLine";
        }
    }



    $sqlVmsBrightness = "SELECT XIVmsBrightness FROM TMstMItmVMS_Status WHERE XVVmsCode='" . $resultSQL['XVVmsCode'] . "' AND XISensorType=3";
    $queryVmsBrightness = sqlsrv_query($conn, $sqlVmsBrightness);
    $resultVmsBrightness = sqlsrv_fetch_array($queryVmsBrightness, SQLSRV_FETCH_ASSOC);

    $sqlVmsRackTemperature = "SELECT XIVmsRackTemperature FROM TMstMItmVMS_Status WHERE XVVmsCode='" . $resultSQL['XVVmsCode'] . "' AND XISensorType=4";
    $queryVmsRackTemperature = sqlsrv_query($conn, $sqlVmsRackTemperature);
    $resultVmsRackTemperature = sqlsrv_fetch_array($queryVmsRackTemperature, SQLSRV_FETCH_ASSOC);

    $sqlVmsBoardTemperature = "SELECT XIVmsBoardTemperature FROM TMstMItmVMS_Status WHERE XVVmsCode='" . $resultSQL['XVVmsCode'] . "' AND XISensorType=5";
    $queryVmsBoardTemperature = sqlsrv_query($conn, $sqlVmsBoardTemperature);
    $resultVmsBoardTemperature = sqlsrv_fetch_array($queryVmsBoardTemperature, SQLSRV_FETCH_ASSOC);


    $sqlVmsFanIsActive = "SELECT        XBVmsFanIsActive
                FROM            dbo.TMstMItmVMS_Status
                WHERE        (XVVmsCode = '" . $resultSQL['XVVmsCode'] . "') AND (XISensorType = 6)";
    $queryVmsFanIsActive = sqlsrv_query($conn, $sqlVmsFanIsActive);

    $XBVmsFanIsActive = "OFF";
    while ($row = sqlsrv_fetch_array($queryVmsFanIsActive, SQLSRV_FETCH_ASSOC)) {

        if ($row['XBVmsFanIsActive'] == 1) {
            $XBVmsFanIsActive = "ON";
        }
    }

    $sqlVmsFanIsActive = "SELECT       XBVmsFlashIsActive
                FROM            dbo.TMstMItmVMS_Status
                WHERE        (XVVmsCode = '" . $resultSQL['XVVmsCode'] . "') AND (XISensorType = 7)";
    $queryVmsFanIsActive = sqlsrv_query($conn, $sqlVmsFanIsActive);

    $XBVmsFlashIsActive = "OFF";
    while ($row = sqlsrv_fetch_array($queryVmsFanIsActive, SQLSRV_FETCH_ASSOC)) {

        if ($row['XBVmsFanIsActive'] == 1) {
            $XBVmsFlashIsActive = "ON";
        }
    }
    $sqlVmsFlashIsActive = "SELECT XBVmsFlashIsActive FROM TMstMItmVMS_Status WHERE XVVmsCode='" . $resultSQL['XVVmsCode'] . "' AND XISensorType=7";
    $queryVmsFlashIsActive = sqlsrv_query($conn, $sqlVmsFlashIsActive);
    $resultVmsFlashIsActive = sqlsrv_fetch_array($queryVmsFlashIsActive, SQLSRV_FETCH_ASSOC);

    $sqlXBVmsComIsActive = "SELECT        XISensorType, XTWhenEdit, DATEDIFF(minute, XTWhenEdit, GEthATE()) AS MinuteDiff, XBVmsComIsActive, XVVmsCode
                FROM            dbo.TMstMItmVMS_Status
                WHERE        (XISensorType = 8) AND (XVVmsCode = '" . $resultSQL['XVVmsCode'] . "')";
    $queryXBVmsComIsActive = sqlsrv_query($conn, $sqlXBVmsComIsActive);
    $XBVmsComIsActive = 0;
    $MinuteDiff = 0;
    while ($row = sqlsrv_fetch_array($queryXBVmsComIsActive, SQLSRV_FETCH_ASSOC)) {

        $XBVmsComIsActive = $row["XBVmsComIsActive"];
        $MinuteDiff = $row["MinuteDiff"];
    }
    if ($XBVmsComIsActive == 0 || $MinuteDiff > 5) {
        $colorBannerStatus = "#ff3300";
    } else {
        $colorBannerStatus = "#39e600";
    }


    $sqlModule = "SELECT XIVdtModuleNo FROM TMstMItmVMS_ModuleStatus WHERE XVVmsCode='" . $resultSQL['XVVmsCode'] . "' AND XBVdtIsGood='False'";
    $queryModule = sqlsrv_query($conn, $sqlModule);
    $falseModule = '';
    while ($resultModule = sqlsrv_fetch_array($queryModule, SQLSRV_FETCH_ASSOC)) {
        $falseModule .= $resultModule['XIVdtModuleNo'] . ', ';
    }
    $falseModule = substr($falseModule, 0, -2);

    $sqlLive = "SELECT XBLiveIsActive FROM TMstMItmVMS_LiveViews WHERE XVVmsCode='" . $resultSQL['XVVmsCode'] . "'";
    $queryLive = sqlsrv_query($conn, $sqlLive);
    $resultLive = sqlsrv_fetch_array($queryLive, SQLSRV_FETCH_ASSOC);
    if ($resultLive['XBLiveIsActive'] == 1) {
        $urlLive = $resultLive['XBLiveIsActive'];
        $thTable = '<th><div align="center""><a href="http://127.0.0.1/speedway/liveviews.php?livecode=' . $urlLive . '" onclick="return show_modal(this);" style="color: #0a0a0a"><span style="color: #00CC00;"><i class="fa fa-video-camera" aria-hidden="true"></i></div></th>';
    } else {
        $urlLive = '';
        $thTable = '<th><div align="center""><span style="color:#CCCCCC;"><i class="fa fa-video-camera" aria-hidden="true" ></i></span></div></th>';
    }






    if ($isActive != 'False') {
        if ($resultVmsBrightness['XIVmsBrightness'] == 200) {
            $XBVmsBrightness = "AUTO";
        } elseif ($resultVmsBrightness['XIVmsBrightness'] >= 0 && $resultVmsBrightness['XIVmsBrightness'] <= 100) {
            $XBVmsBrightness = $resultVmsBrightness['XIVmsBrightness'];
        }
    }
    if ($isActive != 'False') {
        if ($resultVmsRackTemperature['XIVmsRackTemperature'] == 0) {
            $XIVmsRackTemperature = "";
        } else {
            $XIVmsRackTemperature = $resultVmsRackTemperature['XIVmsRackTemperature'] . "° C";
        }
    }
    if ($isActive != 'False') {
        if ($resultVmsBoardTemperature['XIVmsBoardTemperature'] == 0) {
            $XIVmsBoardTemperature = "";
        } else {
            $XIVmsBoardTemperature = $resultVmsBoardTemperature['XIVmsBoardTemperature'] . "° C";
        }
    }

    if ($isActive != 'False') {
        if ($resultVmsFlashIsActive['XBVmsFlashIsActive'] == True) {
            $XBVmsFlashIsActive = "ON";
        } elseif ($resultVmsFlashIsActive['XBVmsFlashIsActive'] == False) {
            $XBVmsFlashIsActive = "OFF";
        }
    }

    if ($isActive != 'False') {
        $falseModuleShow = $falseModule;
    }
    if ($isActive != 'False') {
        $VmsType = $resultSQL['XVVmsType'];
    }
    if( $type==1){
        $txtx='ประชาสัมพันธ์';
    }else if($type==2){
        $txtx='สภาพจราจร';
    }

    $data .= '<tr style="text-align: center;">';
    $data .= '<td  ' . $tx1 . ' id="chk' . $i . '"  ><i id="C0' . $XVVmsCode . '"class="fa fa-cloud"aria-hidden="true"></i></td>';
    $data .= '<td ' . $tx2 . '  id="C1' . $XVVmsCode . '"">ป้าย ' . $resultSQL['XIMssWPixel'] . 'x' . $resultSQL['XIMssHPixel'] . ' PX' . '</td>';
    $data .= '<td ' . $tx3 . '  id="C2' . $XVVmsCode . '">' . $resultSQL['XVVmsName'] . '</td>';
    $data .= '<td ' . $tx4 . '  id="C3' . $XVVmsCode . '"></td>';
    $data .= '<td ' . $tx5 . '  id="C4' . $XVVmsCode . '"></td>';
    $data .= '<td ' . $tx6 . '  id="C5' . $XVVmsCode . '"></td>';
    $data .= '<td ' . $tx7 . '  id="C6' . $XVVmsCode . '"></td>';
    $data .= '<td ' . $tx8 . '  id="C7' . $XVVmsCode . '"></td>';
    $data .= '<td ' . $tx9 . '  id="C8' . $XVVmsCode . '"></td>';
    $data .= '<td ' . $tx10 . ' id="C9' . $XVVmsCode . '"></td>';
    $data .= '<td ' . $tx11 . ' id="C10' . $XVVmsCode . '"><a style="color:red;" id="link'.$XVVmsCode.'" disabled onclick="newSrc(\'' . $XVVmsCode . '\');">เรียกดู</a></td>';
    $data .= '<td ' . $tx15 . ' id="C15' . $XVVmsCode . '"></td>';
    $data .= '<td ' . $tx12 . ' id="C11' . $XVVmsCode . '"></th>';
    $data .= '<td ' . $tx13 . ' id="C12' . $XVVmsCode . '"></td>';
    $data .= '<td ' . $tx14 . ' id="chkl' . $i . '" ><i style="cursor: pointer;font-size: 2rem;cursor: pointer; padding: 0rem;" class="fa fa-play-circle" onclick="ShowSample(\'' . $XVVmsCode . '\',\'' . $resultSQL['XIMssWPixel'] . '\',\'' . $resultSQL['XIMssHPixel'] . '\')"></i></td>';
    $data .= '</tr>';
    $i++;
}
sqlsrv_close($conn);
$data .= '</table>  <input type="hidden" id="vmscode" value="' . $vmscodearray . '"><input type="hidden" id="XVVmsCode" ><input type="hidden" id="XVMsgCode" >';
echo $data;
?>

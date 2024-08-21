<?php
ob_start();
session_start();
$vms=$_REQUEST['vms'];
include "lib/DatabaseManage.php";
$data='<br> <div style="border-style: solid;border-color:#DCDCDC;margin:5px;padding:5px;border-width: 2px;"><table width="99%" border="1" cellpadding="3" cellspacing="0" style="font-size: 9pt;">
            <tr style="background: #eaeaea">
                <td width="1%"><div align="center">สถานะ</div></td>
                <td width="1%"><div align="center">STA</div></td>
                <td width="7%"><div align="center">แบบป้าย</div></td>
                <td width="3%"><div align="center">ป้าย</div></td>
                <td width="1%"><div align="center">ไฟฟ้า</div></td>
                <td width="1%"><div align="center">แสดง<br>ผล</div></td>
                <td width="2%"><div align="center">ความสว่าง</div></td>
                <td width="1%"><div align="center">อุณหภูมิตู้</div></td>
                <td width="1%"><div align="center">อุณหภูมิป้าย</div></td>
                <td width="2%"><div align="center">พัดลม<br>ตู้</div></td>
                <td width="2%"><div align="center">ไฟกระพริบ</div></td>
                <td width="4%"><div align="center">โมดูลเสีย</div></td>
                <td width="1%"><div align="center">ประเภท</div></td>
                <td width="13%"><div align="center">ข้อความ</div></td>
                <td width="1%"><div align="center">Live</div></td>
            </tr>';
          
            if($vms==0){
                $firstSQL="SELECT  vms.XVVmsCode, vms.XVVmsName, vms.XVSupCode, vms.XBVmsIsActive, vms.XIVmsPixelW, vms.XIVmsPixelH, vms.XIVmsSizeW, vms.XIVmsSizeH, vms.XVVmsSta, vms.XVVmsType, dbo.TMstMCustomer.XVCstCode, 
                dbo.TMstMMsgSize.XIMssWPixel, dbo.TMstMMsgSize.XIMssHPixel, dbo.TMstMUser.XVUsrCode
                FROM            dbo.TMstMItmVMS AS vms INNER JOIN
                dbo.TMstMSetupPoint ON dbo.TMstMSetupPoint.XVSupCode = vms.XVSupCode INNER JOIN
                dbo.TMstMProject ON dbo.TMstMProject.XVPrjCode = dbo.TMstMSetupPoint.XVPrjCode INNER JOIN
                dbo.TMstMSubDistrict ON dbo.TMstMSubDistrict.XVSdtCode = dbo.TMstMSetupPoint.XVSdtCode INNER JOIN
                dbo.TMstMCustomer ON dbo.TMstMCustomer.XVCstCode = dbo.TMstMProject.XVCstCode INNER JOIN
                dbo.TMstMUser ON dbo.TMstMUser.XVCstCode = dbo.TMstMCustomer.XVCstCode INNER JOIN
                dbo.TMstMMsgSize ON dbo.TMstMMsgSize.XVMssCode = vms.XVMssCode
                WHERE  (dbo.TMstMUser.XVUsrCode = '".$_SESSION['user']."') ";
            }else{
                $firstSQL="SELECT  vms.XVVmsCode, vms.XVVmsName, vms.XVSupCode, vms.XBVmsIsActive, vms.XIVmsPixelW, vms.XIVmsPixelH, vms.XIVmsSizeW, vms.XIVmsSizeH, vms.XVVmsSta, vms.XVVmsType, dbo.TMstMCustomer.XVCstCode, 
                dbo.TMstMMsgSize.XIMssWPixel, dbo.TMstMMsgSize.XIMssHPixel, dbo.TMstMUser.XVUsrCode
                FROM            dbo.TMstMItmVMS AS vms INNER JOIN
                dbo.TMstMSetupPoint ON dbo.TMstMSetupPoint.XVSupCode = vms.XVSupCode INNER JOIN
                dbo.TMstMProject ON dbo.TMstMProject.XVPrjCode = dbo.TMstMSetupPoint.XVPrjCode INNER JOIN
                dbo.TMstMSubDistrict ON dbo.TMstMSubDistrict.XVSdtCode = dbo.TMstMSetupPoint.XVSdtCode INNER JOIN
                dbo.TMstMCustomer ON dbo.TMstMCustomer.XVCstCode = dbo.TMstMProject.XVCstCode INNER JOIN
                dbo.TMstMUser ON dbo.TMstMUser.XVCstCode = dbo.TMstMCustomer.XVCstCode INNER JOIN
                dbo.TMstMMsgSize ON dbo.TMstMMsgSize.XVMssCode = vms.XVMssCode
                WHERE  (dbo.TMstMUser.XVUsrCode = '".$_SESSION['user']."') and  (vms.XVVmsCode = '$vms')";
            }
            $querySQL = sqlsrv_query($conn, $firstSQL);
            while($resultSQL = sqlsrv_fetch_array($querySQL, SQLSRV_FETCH_ASSOC))
            {
                $XVVmsCode=$resultSQL['XVVmsCode'];
                if($resultSQL['XBVmsIsActive']==True){
                    $colorBannerBG='#eef8e5';
                    $colorBannerStatus='#00CC00';
                    $isActive='True';
                }else{
                    $colorBannerBG='#ffe6e6';
                    $colorBannerStatus='red';
                    $isActive='False';

                }

                $sqlVmsIsOn = "SELECT XBVmsIsOn FROM TMstMItmVMS_Status WHERE XVVmsCode='".$resultSQL['XVVmsCode']."' AND XISensorType=1";
                $queryVmsIsOn = sqlsrv_query($conn, $sqlVmsIsOn);
                $XBVmsIsOn="OFF";
                while($row = sqlsrv_fetch_array( $queryVmsIsOn, SQLSRV_FETCH_ASSOC)){
                
                    if($row['XBVmsIsOn']==1){
                        $XBVmsIsOn="ON";
                    }
                }

                $sqlVmsIsDisplay = "SELECT XBVmsIsDisplay FROM TMstMItmVMS_Status WHERE XVVmsCode='".$resultSQL['XVVmsCode']."' AND XISensorType=2";
                $queryVmsIsDisplay= sqlsrv_query($conn, $sqlVmsIsDisplay);
                $XBVmsIsDisplay="OffLine";
                while($row = sqlsrv_fetch_array( $queryVmsIsDisplay, SQLSRV_FETCH_ASSOC)){
                
                    if($row['XBVmsIsDisplay']==1){
                        $XBVmsIsDisplay="OnLine";
                    }
                }
               
              

                $sqlVmsBrightness = "SELECT XIVmsBrightness FROM TMstMItmVMS_Status WHERE XVVmsCode='".$resultSQL['XVVmsCode']."' AND XISensorType=3";
                $queryVmsBrightness= sqlsrv_query($conn, $sqlVmsBrightness);
                $resultVmsBrightness = sqlsrv_fetch_array($queryVmsBrightness, SQLSRV_FETCH_ASSOC);

                $sqlVmsRackTemperature = "SELECT XIVmsRackTemperature FROM TMstMItmVMS_Status WHERE XVVmsCode='".$resultSQL['XVVmsCode']."' AND XISensorType=4";
                $queryVmsRackTemperature= sqlsrv_query($conn, $sqlVmsRackTemperature);
                $resultVmsRackTemperature = sqlsrv_fetch_array($queryVmsRackTemperature, SQLSRV_FETCH_ASSOC);

                $sqlVmsBoardTemperature = "SELECT XIVmsBoardTemperature FROM TMstMItmVMS_Status WHERE XVVmsCode='".$resultSQL['XVVmsCode']."' AND XISensorType=5";
                $queryVmsBoardTemperature= sqlsrv_query($conn, $sqlVmsBoardTemperature);
                $resultVmsBoardTemperature = sqlsrv_fetch_array($queryVmsBoardTemperature, SQLSRV_FETCH_ASSOC);


                $sqlVmsFanIsActive = "SELECT        XBVmsFanIsActive
                FROM            dbo.TMstMItmVMS_Status
                WHERE        (XVVmsCode = '".$resultSQL['XVVmsCode']."') AND (XISensorType = 6)";
                $queryVmsFanIsActive= sqlsrv_query($conn, $sqlVmsFanIsActive);
             
                $XBVmsFanIsActive="OFF";
                while($row = sqlsrv_fetch_array($queryVmsFanIsActive, SQLSRV_FETCH_ASSOC)){

                    if($row['XBVmsFanIsActive']==1){
                        $XBVmsFanIsActive="ON";
                    }
                }

                $sqlVmsFlashIsActive = "SELECT XBVmsFlashIsActive FROM TMstMItmVMS_Status WHERE XVVmsCode='".$resultSQL['XVVmsCode']."' AND XISensorType=7";
                $queryVmsFlashIsActive= sqlsrv_query($conn, $sqlVmsFlashIsActive);
                $resultVmsFlashIsActive = sqlsrv_fetch_array($queryVmsFlashIsActive, SQLSRV_FETCH_ASSOC);
               
                $sqlXBVmsComIsActive = "SELECT        XISensorType, XTWhenEdit, DATEDIFF(minute, XTWhenEdit, GETDATE()) AS MinuteDiff, XBVmsComIsActive, XVVmsCode
                FROM            dbo.TMstMItmVMS_Status
                WHERE        (XISensorType = 8) AND (XVVmsCode = '".$resultSQL['XVVmsCode']."')";
                $queryXBVmsComIsActive= sqlsrv_query($conn, $sqlXBVmsComIsActive);
                $XBVmsComIsActive=0;
                $MinuteDiff=0;
                while($row = sqlsrv_fetch_array($queryXBVmsComIsActive, SQLSRV_FETCH_ASSOC)){
                
                    $XBVmsComIsActive=$row["XBVmsComIsActive"];
                    $MinuteDiff=$row["MinuteDiff"];
                }
                if($XBVmsComIsActive==0||$MinuteDiff>5){
                    $colorBannerStatus="#ff3300";
                }else{
                    $colorBannerStatus="#39e600";
                }


                $sqlModule = "SELECT XIVdtModuleNo FROM TMstMItmVMS_ModuleStatus WHERE XVVmsCode='".$resultSQL['XVVmsCode']."' AND XBVdtIsGood='False'";
                $queryModule = sqlsrv_query($conn, $sqlModule);
                $falseModule = '';
                while($resultModule = sqlsrv_fetch_array($queryModule, SQLSRV_FETCH_ASSOC))
                {
                    $falseModule.=$resultModule['XIVdtModuleNo'].', ';
                }
                $falseModule = substr($falseModule, 0, -2);

                $sqlLive = "SELECT XBLiveIsActive FROM TMstMItmVMS_LiveViews WHERE XVVmsCode='".$resultSQL['XVVmsCode']."'";
                $queryLive = sqlsrv_query($conn, $sqlLive);
                $resultLive = sqlsrv_fetch_array($queryLive, SQLSRV_FETCH_ASSOC);
                if($resultLive['XBLiveIsActive']==1){
                    $urlLive=$resultLive['XBLiveIsActive'];
                    $tdTable='<td><div align="center" style="margin-left: 2;margin-right: 2"><a href="/liveviews.php?livecode='.$urlLive.'" onclick="return show_modal(this);" style="color: #0a0a0a"><span style="color: #00CC00;"><i class="fa fa-video-camera" aria-hidden="true"></i></div></td>';
                }else{
                    $urlLive='';
                    $tdTable='<td><div align="center" style="margin-left: 2;margin-right: 2"><span style="color:#CCCCCC;"><i class="fa fa-video-camera" aria-hidden="true" ></i></span></div></td>';
                }
             

                

                

                if($isActive!='False'){
                    if($resultVmsBrightness['XIVmsBrightness']==200){ $XBVmsBrightness="AUTO"; }elseif($resultVmsBrightness['XIVmsBrightness']>=0 && $resultVmsBrightness['XIVmsBrightness']<=100){ $XBVmsBrightness=$resultVmsBrightness['XIVmsBrightness']; }
                }
                if($isActive!='False'){
                    if($resultVmsRackTemperature['XIVmsRackTemperature']==0){ $XIVmsRackTemperature=""; }else{ $XIVmsRackTemperature=$resultVmsRackTemperature['XIVmsRackTemperature']."° C"; }
                }
                if($isActive!='False'){
                    if($resultVmsBoardTemperature['XIVmsBoardTemperature']==0){ $XIVmsBoardTemperature=""; }else{ $XIVmsBoardTemperature=$resultVmsBoardTemperature['XIVmsBoardTemperature']."° C"; }
                }

                if($isActive!='False'){
                    if($resultVmsFlashIsActive['XBVmsFlashIsActive']==True){ $XBVmsFlashIsActive="ON"; }elseif($resultVmsFlashIsActive['XBVmsFlashIsActive']==False){ $XBVmsFlashIsActive="OFF"; }
                }

                if($isActive!='False'){
                    $falseModuleShow=$falseModule;
                }
                if($isActive!='False'){
                    $VmsType=$resultSQL['XVVmsType'];
                }
              
                
                
                $data.='<tr style="background:'.$colorBannerBG.'">';
                $data.='<td ><div align="center" style="margin-left: 2;margin-right: 2"><span ><i style="color:'.$colorBannerStatus.'" class="fa fa-cloud" aria-hidden="true"></i></span></div></td>';
                $data.='<td><div align="center" style="margin-left: 2;margin-right: 2">'.$resultSQL['XVVmsSta'].'</div></td>';
                $data.='<td><div style="margin-left: 2;margin-right: 2">ป้าย '.$resultSQL['XIMssWPixel'].'x'.$resultSQL['XIMssHPixel'] .' '. $resultSQL['XIVmsSizeW'].'x'. $resultSQL['XIVmsSizeH'].' เมตร)</div></td>';
                $data.='<td><div align="center" style="margin-left: 2;margin-right: 2">'.$resultSQL['XVVmsName'].'</div></td>';
                $data.='<td><div align="center" style="margin-left: 2;margin-right: 2">'. $XBVmsIsOn.'</div></td>';
                $data.='<td><div align="center" style="margin-left: 2;margin-right: 2">'.$XBVmsIsDisplay.'</div></td>';
                $data.='<td><div align="center" style="margin-left: 2;margin-right: 2">'.$XBVmsBrightness.'</div></td>';
                $data.='<td><div align="center" style="margin-left: 2;margin-right: 2">'.number_format($XIVmsRackTemperature,1).'</div></td>';
                $data.='<td><div align="center" style="margin-left: 2;margin-right: 2">'.number_format($XIVmsBoardTemperature,1).'</div></td>';
                $data.='<td><div align="center" style="margin-left: 2;margin-right: 2; ">'. $XBVmsFanIsActive.'</div></td>';
                $data.='<td><div align="center" style="margin-left: 2;margin-right: 2; ">'. $XBVmsFlashIsActive.'</div></td>';
                $data.='<td><div style="margin-left: 2;margin-right: 2"></div>'. $falseModuleShow.'</td>';
                $data.='<td><div align="center" style="margin-left: 2;margin-right: 2">'. $VmsType.'</div></td>';
                $data.='<td ></td>';
                $data.=$tdTable;
                $data.='</tr>';
          
              
                
            }
            $data.='</table></div>';
    echo $data;
?>
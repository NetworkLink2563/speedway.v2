<?php

include "lib/DatabaseManage.php";
$vmscode=$_REQUEST['code'];


$data='<table id="TableShowList" class="table" style="font-size: 10pt">
    <thead>
        <tr>
         
            <th width="120" scope="col">คำสั่งที่ส่ง</th>
            <th width="20" scope="col">วันที่สร้างคำสั่ง</th>
            <th width="20" scope="col">เวลา</th>
            <th width="70" scope="col">วัน</th>
            <th width="5" scope="col"></th>

        </tr>
    </thead>
    <tbody>';        
                          
                   $sql="SELECT      dbo.TDocTCmdSchedule.XVVmsCode, dbo.TSysSCommand.XVCmdCode, dbo.TSysSCommand.XVCmdName, dbo.TDocTCmdSchedule.XBSccIsSun, dbo.TDocTCmdSchedule.XBSccIsMon, 
                                        dbo.TDocTCmdSchedule.XBSccIsTue, dbo.TDocTCmdSchedule.XBSccIsWed, dbo.TDocTCmdSchedule.XBSccIsThu, dbo.TDocTCmdSchedule.XBSccIsFri, dbo.TDocTCmdSchedule.XBSccIsSat, CONVERT(varchar, 
                                        dbo.TDocTCmdSchedule.XTWhenCreate,23) AS XTWhenCreate, dbo.TDocTCmdSchedule.XVSccActiveTime, dbo.TDocTCmdSchedule.XVSccValue, dbo.TDocTCmdSchedule.XVSccDocNo
                        FROM            dbo.TDocTCmdSchedule INNER JOIN
                                        dbo.TSysSCommand ON dbo.TSysSCommand.XVCmdCode = dbo.TDocTCmdSchedule.XVCmdCode
                        WHERE        ((dbo.TDocTCmdSchedule.XVVmsCode = '$vmscode') and (dbo.TDocTCmdSchedule.XBSccIsSchedule = 1))
                        ORDER BY XTWhenCreate DESC";
                   $query = sqlsrv_query($conn,  $sql);
                    
                    while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))  {
                     
                     
                        $row_value="";
                        if($result["XVCmdCode"]=='001'){
                            if($result["XVSccValue"]==0){
                            $row_value="เซ็ตค่าความสว่าง อัตโนมัติ";
                            }else{
                                $row_value="เซ็ตค่าความสว่าง ".$result["XVSccValue"];
                            }
                        }else if($result["XVCmdCode"]=="002"){
                            if($result["XVSccValue"]==0){
                                $row_value="ปิดระบบไฟป้าย";
                            }else{
                                $row_value="เปิดระบบไฟป้าย";
                            }
                        }else if($result["XVCmdCode"]=="003"){
                            if($result["XVSccValue"]==0){
                                $row_value="ปิดระบบการแสดงผล";
                            }else{
                                $row_value="เปิดระบบการแสดงผล";
                            }
                        }
                      
                        if($result["XBSccIsMon"]=="1"){ $mon="จ. "; }else{ $mon=""; }
                        if($result["XBSccIsTue"]=="1"){ $tue="อ. "; }else{ $tue=""; }
                        if($result["XBSccIsWed"]=="1"){ $wen="พ. "; }else{ $wen=""; }
                        if($result["XBSccIsThu"]=="1"){ $thu="พฤ. "; }else{ $thu=""; }
                        if($result["XBSccIsFri"]=="1"){ $fri="ศ. "; }else{ $fri=""; }
                        if($result["XBSccIsSat"]=="1"){ $sat="ส. "; }else{ $sat=""; }
                        if($result["XBSccIsSun"]=="1"){ $sun="อา. "; }else{ $sun=""; }
                      
                            $data.='<tr>
                                    <td>'.$row_value.'</td>
                                    <td>'.$result['XTWhenCreate'].'</td>
                                    <td>'.$result['XVSccActiveTime'].'</td>
                                    <td>'.$mon.$tue.$wen.$thu.$fri.$sat.$sun.'</td>
                                    <td>'.'<div align="center" style="margin-top: 4"><a href="#" class="del-item" onclick="delScheule('."'".$result['XVSccDocNo']."'".','."'".$result['XVVmsCode']."'".')"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div></td>
                            </tr>';
                           

                    }
                       
                       

        $data.='        
    </tbody>
</table>';
echo $data;
 <?php
 ob_start();
 session_start();
 
 include "lib/DatabaseManage.php";
 $XVVmsCode=$_REQUEST["vms"] ;

 $html=' <div style="border-style: solid;border-color:#DCDCDC;margin:5px;padding:5px;border-width: 2px;"><table id="UserTable" class="table">
                        <thead>
                            <tr>
                           
                                <th width="20" scope="col">
                                    <div style="text-align: center">ลำดับ</div>
                                </th>
                                <th width="150" scope="col">
                                    <div align="left">ขื่อข้อความ</div>
                                </th>
                                <th class="100" style="text-align: center">ประเภท</th>
                                <th class="300" style="text-align: center">ขนาด</th>
                                <th width="300" scope="col">
                                    <div align="left">เริ่ม</div>
                                </th>
                                <th width="300" scope="col">
                                    <div align="left">สิ้นสุด</div>
                                </th>
                                <th width="100" scope="col">
                                    <div align="center">ระยะเวลา</div>
                                </th>


                            </tr>
                        </thead>
                        <tbody style="font-size: 10pt">
                        ';

                     
                       
                            $sql_row = "SELECT    dbo.TMstMItmVMSMessage.XVVmsCode, dbo.TMstMItmVMSMessage.XIVmgSeqNo, dbo.TMstMItmVMSMessage.XIVmgOrder, dbo.TMstMItmVMSMessage.XVMsgCode, 
                            dbo.TMstMItmVMSMessage.XIVmgDuration, dbo.TMstMItmVMSMessage.XBVmgHasExpiration, dbo.TMstMItmVMSMessage.XVWhoCreate, dbo.TMstMItmVMSMessage.XVWhoEdit, dbo.TMstMItmVMSMessage.XTWhenCreate, 
                            dbo.TMstMItmVMSMessage.XTWhenEdit, dbo.TMstMMessage.XVMsgName, dbo.TMstMMessage.XVMsgHtml, dbo.TMstMMessage.XVMssCode, dbo.TMstMMessage.XVMsgType, dbo.TMstMMessage.XVMsgFileName, 
                            dbo.TMstMMessage.XVMsgStatus, dbo.TMstMMessage.XVMsgBg, CONVERT(varchar, dbo.TMstMItmVMSMessage.XTVmgStart, 120) AS XTVmgStart, CONVERT(varchar, dbo.TMstMItmVMSMessage.XTVmgEnd, 120) 
                            AS XTVmgEnd, dbo.TMstMMsgSize.XIMssWPixel, dbo.TMstMMsgSize.XIMssHPixel,TMstMItmVMSMessage.XBVmgHasExpiration
                            FROM            dbo.TMstMItmVMSMessage INNER JOIN
                            dbo.TMstMMessage ON dbo.TMstMMessage.XVMsgCode = dbo.TMstMItmVMSMessage.XVMsgCode INNER JOIN
                            dbo.TMstMMsgSize ON dbo.TMstMMessage.XVMssCode = dbo.TMstMMsgSize.XVMssCode
                            WHERE        (dbo.TMstMItmVMSMessage.XVVmsCode = '$XVVmsCode')
                            ORDER BY dbo.TMstMItmVMSMessage.XIVmgSeqNo";
                        
                       
                        $query_row = sqlsrv_query($conn, $sql_row);
                        while($result_row = sqlsrv_fetch_array($query_row, SQLSRV_FETCH_ASSOC)){
                            $value2=$result_row['XVMsgCode'];
                            if($result_row['XVMsgType']==1){
                                $XVMsgType='ข้อความ';
                            }elseif($result_row['XVMsgType']==2){
                                $XVMsgType='รูปภาพ';
                            }elseif($result_row['XVMsgType']==3){
                                $XVMsgType='วีดีโอ';
                            }
                            if($result_row['XBVmgHasExpiration']!=0)
                            {
                               $sdate=$result_row['XTVmgStart'];
                               $edate=$result_row['XTVmgEnd'];
                            }else{
                                $sdate="";
                                $edate="";
                            }
                            
                            $html.='<tr><td><div style="text-align: center">'.$result_row['XIVmgSeqNo'].'</td>';
                            $html.='<td>'.$result_row['XVMsgName'].'</td>';
                            $html.='<td style="text-align: center;">'.$XVMsgType.'</td>';
                            $html.='<td style="text-align: center;">กว้าง='.$result_row['XIMssWPixel']."px".' สูง='.$result_row['XIMssHPixel'].'px'.'</td>';
                            $html.='<td style="text-align: left;">'.$sdate.'</td>';
                            $html.='<td style="text-align: left;">'.$edate.'</td>';
                            $html.='<td style="text-align: center;">'.$result_row['XIVmgDuration'].'</td>';
                            $html.='</tr>';
                        }   
                        $html.='
                        </tbody>
                    </table></div>';
echo $html;
?>
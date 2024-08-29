<?php
 
  session_start();
  function Ckmenu($UsrCode,$MnuCode){
    $dbm=new DatabaseManage();
    $sql1="SELECT  [XBUmnIsRead]
    FROM [NWL_VMSControl].[dbo].[TMnyMUserMenu] WHERE XBUmnIsRead=1 and XVUsrCode='$UsrCode' and XVMnuCode='$MnuCode' ORDER BY XVMnuCode";
    $result1=$dbm->QueryDB($sql1);
    $JsonObj1 = json_decode($result1);
    return count($JsonObj1);
  }
  function CustomerName($CstCode){
    $dbm=new DatabaseManage();
    $sql1="SELECT [XVCstName]
    FROM [NWL_VMSControl].[dbo].[TMstMCustomer] where XVCstCode='$CstCode'";
   
    $result1=$dbm->QueryDB($sql1);
    $JsonObj1 = json_decode($result1);
    $CstName="";
    foreach ($JsonObj as $result){
      $CstName=$result->XVCstName;
    }
    return  $CstName;
  }
  function Login($usr,$pwd,$token){
      $errorsms="";
      if ($token != $_SESSION['token']) {
        $errorsms="Err1";
      }else{
          $usr=str_replace("'","''",$usr);
          $pwd=str_replace("'","''",$pwd);
          include '../lib/DatabaseManage.php';
          $dbm=new DatabaseManage();
          $sql="SELECT XVCstName, XBUsrIsCstAdmin, XBUsrIsActive2, XVUsrCode , [TMstMUser].XVCstCode, XVUsrName, XBUsrIsActive, XBUsrIsActive2, [dbo].[FN_GETtDecoding](XVUsrPwd,'$pwd') as XVUsrPwdDecode            
          FROM [TMstMUser],[TMstMCustomer]
          WHERE  [TMstMUser].XVCstCode=[TMstMCustomer].XVCstCode and XVUsrCode='$usr'
          ";
          $result=$dbm->QueryDB($sql);
          $JsonObj = json_decode($result);
          if (count($JsonObj)>0){
              foreach ($JsonObj as $result){
                  if($result->XVUsrPwdDecode==$pwd){
                      if($result->XBUsrIsActive==1){
                       
                              //$ua = strtolower($_SERVER["HTTP_USER_AGENT"]);
                             // $_SESSION["isMob"] = is_numeric(strpos($ua, "mobile"));
                             
                              $_SESSION["UsrIsActive2"]=$result->XBUsrIsActive2;
                              $_SESSION["UsrIsActive"]=$result->XBUsrIsActive;
                              $_SESSION["UsrIsCstAdmin"]=$result->XBUsrIsCstAdmin;
                              $_SESSION["UsrCode"]=$result->XVUsrCode;  
                              $_SESSION["CstCode"]=$result->XVCstCode;  
                              $_SESSION["UsrName"]=$result->XVUsrName; 

                            

                              $errorsms="Success";
                              $UsrCode=$_SESSION["UsrCode"];
                              $_SESSION["CustName"]=$result->XVCstName;
                              $_SESSION["M1"]=Ckmenu($UsrCode,'MNU22-00001');
                              $_SESSION["M2"]=Ckmenu($UsrCode,'MNU22-00002');
                              $_SESSION["M3"]=Ckmenu($UsrCode,'MNU22-00003');
                              $_SESSION["M4"]=Ckmenu($UsrCode,'MNU22-00004');
                              $_SESSION["M5"]=Ckmenu($UsrCode,'MNU22-00005');
                              $_SESSION["M6"]=Ckmenu($UsrCode,'MNU22-00006');
                              $_SESSION["M7"]=Ckmenu($UsrCode,'MNU22-00007');
                              $_SESSION["M8"]=Ckmenu($UsrCode,'MNU22-00008');
                              $_SESSION["M9"]=Ckmenu($UsrCode,'MNU22-00009');
                              $_SESSION["M10"]=Ckmenu($UsrCode,'MNU22-00010');
                              $_SESSION["M11"]=Ckmenu($UsrCode,'MNU22-00011');
                              $_SESSION["M12"]=Ckmenu($UsrCode,'MNU22-00012');
                              $_SESSION["M13"]=Ckmenu($UsrCode,'MNU22-00013');
                              $_SESSION["M14"]=Ckmenu($UsrCode,'MNU22-00014');
                              $_SESSION["M15"]=Ckmenu($UsrCode,'MNU22-00015');
                              $_SESSION["M16"]=Ckmenu($UsrCode,'MNU22-00016');
                              $_SESSION["M17"]=Ckmenu($UsrCode,'MNU22-00017');
                              $_SESSION["M18"]=Ckmenu($UsrCode,'MNU22-00018');
                              $_SESSION["M19"]=Ckmenu($UsrCode,'MNU22-00019');
                              $_SESSION["M20"]=Ckmenu($UsrCode,'MNU22-00020');
                              $_SESSION["M21"]=Ckmenu($UsrCode,'MNU22-00021');

                              $_SESSION["R"][1]=$_SESSION["M1"];
                              $_SESSION["R"][2]=$_SESSION["M2"];
                              $_SESSION["R"][3]=$_SESSION["M3"];
                              $_SESSION["R"][4]=$_SESSION["M4"];
                              $_SESSION["R"][5]=$_SESSION["M5"];
                              $_SESSION["R"][6]=$_SESSION["M6"];
                              $_SESSION["R"][7]=$_SESSION["M7"];
                              $_SESSION["R"][8]=$_SESSION["M8"];
                              $_SESSION["R"][9]=$_SESSION["M9"];
                              $_SESSION["R"][10]=$_SESSION["M10"];
                              $_SESSION["R"][11]=$_SESSION["M11"];
                              $_SESSION["R"][12]=$_SESSION["M12"];
                              $_SESSION["R"][13]=$_SESSION["M13"];
                              $_SESSION["R"][14]=$_SESSION["M14"];
                              $_SESSION["R"][15]=$_SESSION["M15"];
                              $_SESSION["R"][16]=$_SESSION["M16"];
                              $_SESSION["R"][17]=$_SESSION["M17"];
                              $_SESSION["R"][18]=$_SESSION["M18"];
                              $_SESSION["R"][19]=$_SESSION["M19"];
                              $_SESSION["R"][20]=$_SESSION["M20"];
                              $_SESSION["R"][21]=$_SESSION["M21"];
                              /*
                              $UsrCode=$_SESSION["UsrCode"];
                              $sql1="SELECT  [XVMnuCode]
                                  ,[XVUsrCode]
                                  ,[XBUmnIsRead]
                                  ,[XBUmnIsSave]
                                  ,[XBUmnIsDelete]
                                  ,[XBUmnIsCancel]
                                  ,[XBUmnIsApprove]
                                  FROM [NWL_VMSControl].[dbo].[TMnyMUserMenu] WHERE XVUsrCode='$UsrCode' ORDER BY XVMnuCode";    
                             
                              $result1=$dbm->QueryDB($sql1);
                              $JsonObj1 = json_decode($result1);
                              $_SESSION["R"][] ="";
                              $_SESSION["S"][] ="";
                              $_SESSION["D"][] ="";
                              $_SESSION["C"][] ="";
                              $_SESSION["A"][] ="";
                              foreach ($JsonObj1 as $result1){  
                                  $_SESSION["R"][] = $result1->XBUmnIsRead;
                                  $_SESSION["S"][] = $result1->XBUmnIsSave;
                                  $_SESSION["D"][] = $result1->XBUmnIsDelete;
                                  $_SESSION["C"][] = $result1->XBUmnIsCancel;
                                  $_SESSION["A"][] = $result1->XBUmnIsApprove;
                              }
                           */
                      }else{
                        $errorsms="Err4";
                      }
                  }else{
                    $errorsms="Err3";
                  }
              }
          
          }else{
            $errorsms="Err2";
          }
    }
    echo $errorsms;
  }  
 
?>
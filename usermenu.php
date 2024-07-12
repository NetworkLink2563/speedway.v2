<?php
include 'header.php';
include "lib/DatabaseManage.php";
include "permission.php";

if(checkmenu($user,'002')==0){
    session_destroy();
    header( "location: index.php" );
    exit(0);
}

$XVUsrCode=base64_decode($_GET['p']);
function countrecord($XVUsrCode,$XVMnuCode){
    include "lib/DatabaseManage.php";
   

    $countrecord=0;
    $sql="select * from TMnyMUserMenu  where XVUsrCode='$XVUsrCode' and XVMnuCode='$XVMnuCode'";

    $querySQL = sqlsrv_query($conn, $sql);
   
    while($resultSQL = sqlsrv_fetch_array($querySQL, SQLSRV_FETCH_ASSOC))
    {
        $countrecord++;
    }
    
    return $countrecord;
}

if(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
    
   
    $sql="delete from TMnyMUserMenu where  XVUsrCode='$XVUsrCode'";
    $querySQL = sqlsrv_query($conn, $sql);
   
   

    for($i=0;$i<count($_POST["M1"]);$i++)
    {
        $tmp=$_POST["M1"][$i];	
        $tmp = explode(",", $tmp);
        $XVMnuCode=$tmp[0];
        $CK=$tmp[1]; 
        $XBDmnIsRead=0;
        if($CK==1){
            $XBDmnIsRead=1;
        }
        if(countrecord($XVUsrCode,$XVMnuCode)==0){
            $sql="insert into TMnyMUserMenu (XVUsrCode,XVMnuCode,XBDmnIsRead)values('$XVUsrCode','$XVMnuCode',$XBDmnIsRead)";
            sqlsrv_query($conn, $sql);
        }else{
            $sql="update TMnyMUserMenu set XBDmnIsRead=$XBDmnIsRead where XVUsrCode='$XVUsrCode' and XVMnuCode='$XVMnuCode'";
            sqlsrv_query($conn, $sql); 
        }
       
    }
    
    
   
    for($i=0;$i<count($_POST["M2"]);$i++)
    {
        $tmp=$_POST["M2"][$i];	
        $pieces = explode(",", $tmp);
        $tmp = explode(",", $tmp);
        $XVMnuCode=$tmp[0];
        $CK==$tmp[1]; 
        $XBDmnIsAdd=0;
        if($CK==1){
            $XBDmnIsAdd=1;
        }
        if(countrecord($XVUsrCode,$XVMnuCode)==0){
            $sql="insert into TMnyMUserMenu (XVUsrCode,XVMnuCode,XBDmnIsAdd)values('$XVUsrCode','$XVMnuCode',$XBDmnIsAdd)";
            sqlsrv_query($conn, $sql);
        }else{
            $sql="update TMnyMUserMenu set XBDmnIsAdd=$XBDmnIsAdd where XVUsrCode='$XVUsrCode' and XVMnuCode='$XVMnuCode'";
            sqlsrv_query($conn, $sql); 
        }
        
    }
    for($i=0;$i<count($_POST["M3"]);$i++)
    {
        $tmp=$_POST["M3"][$i];
        $pieces = explode(",", $tmp);
        $tmp = explode(",", $tmp);
        $XVMnuCode=$tmp[0];
        $CK==$tmp[1]; 	
        $XBDmnIsDelete=0;
        if($CK==1){
            $XBDmnIsDelete=1;
        }
        if(countrecord($XVUsrCode,$XVMnuCode)==0){
            $sql="insert into TMnyMUserMenu (XVUsrCode,XVMnuCode,XBDmnIsDelete)values('$XVUsrCode','$XVMnuCode',$XBDmnIsDelete)";
            sqlsrv_query($conn, $sql);
        }else{
            $sql="update TMnyMUserMenu set XBDmnIsDelete=$XBDmnIsDelete where XVUsrCode='$XVUsrCode' and XVMnuCode='$XVMnuCode'";
            sqlsrv_query($conn, $sql); 
        }
    }
    for($i=0;$i<count($_POST["M4"]);$i++)
    {
        $tmp=$_POST["M4"][$i];
        $pieces = explode(",", $tmp);
        $tmp = explode(",", $tmp);
        $XVMnuCode=$tmp[0];
        $CK==$tmp[1]; 	
        $XBDmnIsControl=0;
        if($CK==1){
            $XBDmnIsControl=1;
        }
        if(countrecord($XVUsrCode,$XVMnuCode)==0){
            $sql="insert into TMnyMUserMenu (XVUsrCode,XVMnuCode,XBDmnIsControl)values('$XVUsrCode','$XVMnuCode',$XBDmnIsControl)";
            sqlsrv_query($conn, $sql);
        }else{
            $sql="update TMnyMUserMenu set XBDmnIsControl=$XBDmnIsControl where XVUsrCode='$XVUsrCode' and XVMnuCode='$XVMnuCode'";
            sqlsrv_query($conn, $sql); 
        }
    }

  
    
    header( "location: setting.php" );
    exit(0);
}
?>
<div class="container" style="margin-top:100px;">
    <div class="row">
        <div class="col-md-12">
            <form action="" method="post">
                <ul id="tree1">

                    <li>หน้าหลัก

                        <ul>
                            <?php
                  $sql = "SELECT  XVMnuCode, XVMnuName, XVMnuType
                           FROM            dbo.TSysSMenu
                  WHERE        (XVMnuType = N'1')
                  ORDER BY XVMnuCode";
                  $query = sqlsrv_query($conn, $sql);
                  while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
                  {
                        $XVMnuCode=$row['XVMnuCode'];
                        $sql="SELECT XBDmnIsRead ,XBDmnIsAdd, XBDmnIsDelete, XBDmnIsControl FROM TMnyMUserMenu where XVUsrCode='$XVUsrCode' and XVMnuCode='$XVMnuCode'";
                        $querys = sqlsrv_query($conn, $sql);
                        $XBDmnIsRead="";
                        while($rows = sqlsrv_fetch_array($querys, SQLSRV_FETCH_ASSOC))
                        { 
                            if($rows['XBDmnIsRead']==1){
                                $XBDmnIsRead="checked";
                            }
                        }

                          echo '<label style="margin-right: 20px;"><li><input type="checkbox"  name="M1[]"  value="'.$row['XVMnuCode'].',1" '.$XBDmnIsRead.' >'.$row['XVMnuName'].'</label></li>';
                  }
              ?>
                        </ul>
                    </li>
                    <li>การควบคุม
                        <ul>
                            <ul>
                                <?php
                  $sql = "SELECT  XVMnuCode, XVMnuName, XVMnuType
                           FROM            dbo.TSysSMenu
                  WHERE        (XVMnuType = N'2')
                  ORDER BY XVMnuCode";
                  $query = sqlsrv_query($conn, $sql);
                  while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
                  {
                          $XVMnuCode=$row['XVMnuCode'];
                          $sql="SELECT XBDmnIsRead ,XBDmnIsAdd, XBDmnIsDelete, XBDmnIsControl FROM TMnyMUserMenu where XVUsrCode='$XVUsrCode' and XVMnuCode='$XVMnuCode'";
                         
                          $querys = sqlsrv_query($conn, $sql);
                          $XBDmnIsRead="";
                          $XBDmnIsAdd="";
                          $XBDmnIsDelete="";
                          $XBDmnIsControl="";
                          while($rows = sqlsrv_fetch_array($querys, SQLSRV_FETCH_ASSOC))
                          { 
                              if($rows['XBDmnIsRead']==1){
                                $XBDmnIsRead="checked";
                              }
                              if($rows['XBDmnIsAdd']==1){
                                $XBDmnIsAdd="checked";
                              }
                              if($rows['XBDmnIsDelete']==1){
                                $XBDmnIsDelete="checked";
                              }
                              if($rows['XBDmnIsControl']==1){
                                $XBDmnIsControl="checked";
                              }
                          }  
                         
                          echo '<li>'.$row['XVMnuName'].
                          '<label style="margin-left: 20px;"><input type="checkbox"  name="M1[]"  value="'.$row['XVMnuCode'].',1" '.$XBDmnIsRead.'>อ่าน</label>'.
                          '<label style="margin-left: 20px;"><input type="checkbox"  name="M2[]"  value="'.$row['XVMnuCode'].',1" '.$XBDmnIsAdd.'>เขียน</label>'.
                          '<label style="margin-left: 20px;"><input type="checkbox"  name="M3[]"  value="'.$row['XVMnuCode'].',1" '.$XBDmnIsDelete.'>ลบ</label>'.
                          '<label style="margin-left: 20px;"><input type="checkbox"  name="M4[]"  value="'.$row['XVMnuCode'].',1" '.$XBDmnIsControl.'>ควบคุม</label></li></li>';
                  }
              ?>
                            </ul>
                        </ul>
                    </li>
                    <li>การแสดงข้อความ
                        <ul>
                            <ul>
                                <?php
                  $sql = "SELECT  XVMnuCode, XVMnuName, XVMnuType
                           FROM            dbo.TSysSMenu
                  WHERE        (XVMnuType = N'3')
                  ORDER BY XVMnuCode";
                  $query = sqlsrv_query($conn, $sql);
                  while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
                  {
                          
                          $XVMnuCode=$row['XVMnuCode'];
                       
                          $sql="SELECT XBDmnIsRead ,XBDmnIsAdd, XBDmnIsDelete, XBDmnIsControl FROM TMnyMUserMenu where XVUsrCode='$XVUsrCode' and XVMnuCode='$XVMnuCode'";
                     
                          $querys = sqlsrv_query($conn, $sql);
                          $XBDmnIsRead="";
                          $XBDmnIsAdd="";
                          $XBDmnIsDelete="";
                          $XBDmnIsControl="";
                          while($rows = sqlsrv_fetch_array($querys, SQLSRV_FETCH_ASSOC))
                          { 
                              if($rows['XBDmnIsRead']==1){
                                $XBDmnIsRead="checked";
                              }
                              if($rows['XBDmnIsAdd']==1){
                                $XBDmnIsAdd="checked";
                              }
                              if($rows['XBDmnIsDelete']==1){
                                $XBDmnIsDelete="checked";
                              }
                              if($rows['XBDmnIsControl']==1){
                                $XBDmnIsControl="checked";
                              }
                          }       
                           
                    echo '<li>'.$row['XVMnuName'].
                    '<label style="margin-left: 20px;"><input type="checkbox"  name="M1[]"  value="'.$row['XVMnuCode'].',1" '.$XBDmnIsRead.'>อ่าน</label>'.
                    '<label style="margin-left: 20px;"><input type="checkbox"  name="M2[]"  value="'.$row['XVMnuCode'].',1" '.$XBDmnIsAdd.'>เขียน</label>'.
                    '<label style="margin-left: 20px;"><input type="checkbox"  name="M3[]"  value="'.$row['XVMnuCode'].',1" '.$XBDmnIsDelete.'>ลบ</label>'.
                    '<label style="margin-left: 20px;"><input type="checkbox"  name="M4[]"  value="'.$row['XVMnuCode'].',1" '.$XBDmnIsControl.'>ควบคุม</label>
                    </li></li>';
                  }
              ?>
                            </ul>
                        </ul>
                    </li>
                    <li>รายงาน
                        <ul>
                            <ul>
                                <?php
                  $sql = "SELECT  XVMnuCode, XVMnuName, XVMnuType
                           FROM            dbo.TSysSMenu
                  WHERE        (XVMnuType = N'4')
                  ORDER BY XVMnuCode";
                  $query = sqlsrv_query($conn, $sql);
                  while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
                  {
                        $XVMnuCode=$row['XVMnuCode'];
                        $sql="SELECT XBDmnIsRead ,XBDmnIsAdd, XBDmnIsDelete, XBDmnIsControl FROM TMnyMUserMenu where XVUsrCode='$XVUsrCode' and XVMnuCode='$XVMnuCode'";
                        $querys = sqlsrv_query($conn, $sql);
                        $XBDmnIsRead="";
                        while($rows = sqlsrv_fetch_array($querys, SQLSRV_FETCH_ASSOC))
                        { 
                            if($rows['XBDmnIsRead']==1){
                                $XBDmnIsRead="checked";
                            }
                        }
                        echo '<li><label style="margin-right: 20px;"><input type="checkbox"  name="M1[]"  value="'.$row['XVMnuCode'].',1" '.$XBDmnIsRead.'>'.$row['XVMnuName'].'</label></li>';
                  }
              ?>
                            </ul>
                        </ul>
                    </li>
                </ul>
                <div style="padding-left: 250px;"><button type="submit" class="btn btn-primary">บันทึก</button></div>
            </form>
        </div>

    </div>
</div>
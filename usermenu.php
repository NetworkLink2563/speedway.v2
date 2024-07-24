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

<style>
    *{
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }

body {
        background: #e1f0fa;
    }

    .container{
        background-color:  white;
        
    }


</style>

<div class="container" style="position: relative; top: 75;">


<div style=" text-align: center; padding: 1rem; border-bottom: 3px double #cccc; margin: .4rem;">
            <img src="http://43.229.151.103/speedway/img/icon/setting.png" height="25" alt="Responsive image"> ผู้ใช้งาน
        </div>


<div class="flex-container" style="">

        <div class="col-12 shadow" style="display: flex; flex-direction: column; align-items: center; padding: 0.5rem; background-color: #034672; color: white; font-size: 1.2rem; border-radius: 5px; margin-bottom: 1rem; box-shadow: 3px 3px 3px #aaaaaa !important;">
            <a class="tablinks2 active " style="cursor: context-menu;"><i class="fa fa-list-alt" aria-hidden="true"></i> รายการคำสั่งผู้ใช้งาน</a>
        </div>

        
        <table class="table table-striped table-hover">
    <tr>
        <th style="text-align: center;" >ทั้งหมด</th>
        <th >รายละเอียด</th>
        <th style="text-align: center;" >อ่าน</td>
        <th style="text-align: center;" >เขียน</td>
        <th style="text-align: center;" >ลบ</td>
        <th style="text-align: center;" >ควบคุม</td>
    </tr>
    <tr>
        <td class="active1" style="text-align: center;">
            <input type="checkbox" class="select-all1 checkbox select-item1" name="select-all" />
        </td>
        <td >การควบคุมป้าย</th>
        <td style="text-align: center;" ><input type="checkbox" class="select-item1 checkbox select-all1" name="select-item" value="" /></td>
        <td style="text-align: center;" ><input type="checkbox" class="select-item1 checkbox select-all1" name="select-item" value="" /></td>
        <td style="text-align: center;" ><input type="checkbox" class="select-item1 checkbox select-all1" name="select-item" value="" /></td>
        <td style="text-align: center;" ><input type="checkbox" class="select-item1 checkbox select-all1" name="select-item" value="" /></td>
    </tr>
    <tr>
        <td class="active2" style="text-align: center;">
            <input type="checkbox" class="select-all2 checkbox select-item2" name="select-item" value="" />
        </td>
        <td >ตารางการทำงานของป้าย</th>
        <td style="text-align: center;" ><input type="checkbox" class="select-item2 checkbox" name="select-item" value="" /></td>
        <td style="text-align: center;" ><input type="checkbox" class="select-item2 checkbox" name="select-item" value="" /></td>
        <td style="text-align: center;" ><input type="checkbox" class="select-item2 checkbox" name="select-item" value="" /></td>
        <td style="text-align: center;" ><input type="checkbox" class="select-item2 checkbox" name="select-item" value="" /></td>
    </tr>
    <tr>
        <td class="active3" style="text-align: center;">
            <input type="checkbox" class="select-all3 checkbox select-item3" name="select-item" value="" />
        </td>
        <td >จัดการข้อความหลัก</th>
        <td style="text-align: center;" ><input type="checkbox" class="select-item3 checkbox" name="select-item" value="" /></td>
        <td style="text-align: center;" ><input type="checkbox" class="select-item3 checkbox" name="select-item" value="" /></td>
        <td style="text-align: center;" ><input type="checkbox" class="select-item3 checkbox" name="select-item" value="" /></td>
        <td style="text-align: center;" ><input type="checkbox" class="select-item3 checkbox" name="select-item" value="" /></td>
    </tr>
    <tr>
        <td class="active4" style="text-align: center;">
            <input type="checkbox" class="select-all4 checkbox select-item4" name="select-item" value="" />
        </td>
        <td >จัดตารางข้อความประชาสัมพันธ์</th>
        <td style="text-align: center;" ><input type="checkbox" class="select-item4 checkbox" name="select-item" value="" /></td>
        <td style="text-align: center;" ><input type="checkbox" class="select-item4 checkbox" name="select-item" value="" /></td>
        <td style="text-align: center;" ><input type="checkbox" class="select-item4 checkbox" name="select-item" value="" /></td>
        <td style="text-align: center;" ><input type="checkbox" class="select-item4 checkbox" name="select-item" value="" /></td>
    </tr>
</table>

<button id="select-all" class="btn button-default">เลือกทั้งหมด / ยกเลิกทั้งหมด</button>
<!-- <button id="select-invert" class="btn button-default">สลับ</button> -->
<!-- <button id="select-all" class="btn button-default">SelectAll/Cancel</button> -->
<!-- <button id="select-invert" class="btn button-default">Invert</button> -->
<!-- <button id="selected" class="btn button-default">GetSelected</button> -->

<script>
    $(function(){

        //button select all or cancel
        $("#select-all").click(function () {
            var all = $("input.select-all1")[0];
            all.checked = !all.checked
            var checked = all.checked;
            $("input.select-item").each(function (index,item) {
                item.checked = checked;
            });
        });
        
        $("#select-all").click(function () {
            var all = $("input.select-all2")[0];
            all.checked = !all.checked
            var checked = all.checked;
            $("input.select-item").each(function (index,item) {
                item.checked = checked;
            });
        });
        
        $("#select-all").click(function () {
            var all = $("input.select-all3")[0];
            all.checked = !all.checked
            var checked = all.checked;
            $("input.select-item").each(function (index,item) {
                item.checked = checked;
            });
        });

        $("#select-all").click(function () {
            var all = $("input.select-all4")[0];
            all.checked = !all.checked
            var checked = all.checked;
            $("input.select-item").each(function (index,item) {
                item.checked = checked;
            });
        });

        $("#select-all").click(function () {
            var all = $("input.select-all")[0];
            all.checked = !all.checked
            var checked = all.checked;
            $("input.select-item").each(function (index,item) {
                item.checked = checked;
            });
        });

        //button select invert
        $("#select-invert").click(function () {
            $("input.select-item").each(function (index,item) {
                item.checked = !item.checked;
            });
            checkSelected();
        });

        //button get selected info
        $("#selected").click(function () {
            var items=[];
            $("input.select-item:checked:checked").each(function (index,item) {
                items[index] = item.value;
            });
            if (items.length < 1) {
                alert("no selected items!!!");
            }else {
                var values = items.join(',');
                console.log(values);
                var html = $("<div></div>");
                html.html("selected:"+values);
                html.appendTo("body");
            }
        });

        //column checkbox select all or cancel
        $("input.select-all1").click(function () {
            var checked = this.checked;
            $("input.select-item1").each(function (index,item) {
                item.checked = checked;
            });
        });

        $("input.select-all2").click(function () {
            var checked = this.checked;
            $("input.select-item2").each(function (index,item) {
                item.checked = checked;
            });
        });

        $("input.select-all3").click(function () {
            var checked = this.checked;
            $("input.select-item3").each(function (index,item) {
                item.checked = checked;
            });
        });

        $("input.select-all4").click(function () {
            var checked = this.checked;
            $("input.select-item4").each(function (index,item) {
                item.checked = checked;
            });
        });

        //check selected items
        $("input.select-item").click(function () {
            var checked = this.checked;
            console.log(checked);
            checkSelected();
        });

        //check is all selected
        function checkSelected() {
            var all = $("input.select-all")[0];
            var total = $("input.select-item").length;
            var len = $("input.select-item:checked:checked").length;
            console.log("total:"+total);
            console.log("len:"+len);
            all.checked = len===total;
        }
    });
</script>




<!-- original -->
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




</div>
<!-- end div comtainer -->
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
$usercode=$_GET['user'];
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

<script>
    $(function(){


        //button select all or cancel

        // $("#select-all").click(function () {
        //     var all = $("input.select-all1")[0];
        //     all.checked = !all.checked
        //     var checked = all.checked;
        //     $("input.select-item1").each(function (index,item) {
        //         item.checked = all.checked;
        //     });
        // });
        
        $("#select-all").click(function () {
            var checked = this.checked;
            $("input.select-item2").each(function (index,item) {
                item.checked = checked;  
            });
            $("input.select-item3").each(function (index,item) {
                item.checked = checked;
            });
            $("input.select-item4").each(function (index,item) {
                item.checked = checked;
            });
            $("input.select-all1").each(function (index,item) {
                item.checked = checked;
            });
            $("input.select-all2").each(function (index,item) {
                item.checked = checked;
            });
            $("input.select-all3").each(function (index,item) {
                item.checked = checked;
            });
            $("input.select-all4").each(function (index,item) {
                item.checked = checked;
            });
            $("input.select-all-col1").each(function (index,item) {
                item.checked = checked;
            });
            $("input.select-all-col2").each(function (index,item) {
                item.checked = checked;
            });
            $("input.select-all-col3").each(function (index,item) {
                item.checked = checked;
            });
            $("input.select-all-col4").each(function (index,item) {
                item.checked = checked;
            });
            $("input.select-col1").each(function (index,item) {
                item.checked = checked;
            });
            $("input.select-col2").each(function (index,item) {
                item.checked = checked;
            });
            $("input.select-col3").each(function (index,item) {
                item.checked = checked;
            });
            $("input.select-col4").each(function (index,item) {
                item.checked = checked;
            });
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

        //select all col
        $("input.select-all-col1").click(function () {
            var checked = this.checked;
            $("input.select-col1").each(function (index,item) {
                item.checked = checked;
            });
        });

        $("input.select-all-col2").click(function () {
            var checked = this.checked;
            $("input.select-col2").each(function (index,item) {
                item.checked = checked;
            });
        });

        $("input.select-all-col3").click(function () {
            var checked = this.checked;
            $("input.select-col3").each(function (index,item) {
                item.checked = checked;
            });
        });

        $("input.select-all-col4").click(function () {
            var checked = this.checked;
            $("input.select-col4").each(function (index,item) {
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
  function chkitem(idvms){
    var checked = document.getElementById("allitem"+idvms).checked;
    var valall=idvms;
    var use_c ='<?php echo $usercode; ?>';
     var datastring='load=0002'+ '&val=' +valall + '&check='+checked + '&use_c='+use_c;
     $.ajax({type:"POST", url:"service/update_UserMenu.php",
     data: datastring,cache:false,
      success:function(html){
      console.log(html);
 }
}) 
    
    for (let item = 1; item < 4; item++) {
        $("input.select-item"+idvms).each(function (index,item) {
                item.checked = checked;
        });
    }
  }

  function pri(val){
    var chk =document.getElementById("select-all").checked;
     var valall=val;
     var use_c ='<?php echo $usercode; ?>';
     var datastring='load=0001'+ '&val=' +valall + '&check='+chk+'&use_c='+use_c;
     $.ajax({type:"POST", url:"service/update_UserMenu.php",
     data: datastring,cache:false,
      success:function(html){
      console.log(html);
 }
});

  }
  function chkpri_(key,v){
 
    var keychk=key;
    var vmscodechk=v;
    var use_c ='<?php echo $usercode; ?>';
    var chk =document.getElementById(key+v).checked;
     var datastring='load=0003'+ '&keychk=' +keychk + '&vmscodechk='+vmscodechk+'&check='+chk +'&use_c='+use_c;
     $.ajax({type:"POST", url:"service/update_UserMenu.php",
     data: datastring,cache:false,
      success:function(html){
      console.log(html);
 }
}); 
  }

  function chkprix(key,us,k){
    var keychk=key;// alert(keychk);
    var user=us;
    var use_c ='<?php echo $usercode; ?>';
    var chk =document.getElementById(k).checked;
    var datastring='load=0004'+ '&keychk=' +keychk + '&user='+user+'&check='+chk +'&use_c='+use_c;
     $.ajax({type:"POST", url:"service/update_UserMenu.php",
     data: datastring,cache:false,
      success:function(html){
      console.log(html);
 }
}); 
    
}
</script>


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

    .flex-content{
        margin: 1rem;
    }
</style>

<div class="container" style="position: relative; top: 75; ">

 <div class="flex-content">


<div style=" text-align: center; padding: 1rem; border-bottom: 3px double #cccc; margin: .4rem;">
            <img src="http://43.229.151.103/speedway/img/icon/setting.png" height="25" alt="Responsive image"> ผู้ใช้งาน
        </div>


<div class="flex-container" style="">

        <div class="col-12 shadow" style="display: flex; flex-direction: column; align-items: center; padding: 0.5rem; background-color: #034672; color: white; font-size: 1.2rem; border-radius: 5px; margin-bottom: 1rem; box-shadow: 3px 3px 3px #aaaaaa !important;">
            <a class="tablinks2 active " style="cursor: context-menu;"><i class="fa fa-list-alt" aria-hidden="true"></i> รายการคำสั่งผู้ใช้งาน</a>
        </div>

        <?php 
        $arrall=array();
        $a=array();
        $al=array();
        $alld=array();
        $alll=array();
        $Menu="SELECT XBDmnIsRead,XBDmnIsAdd,XBDmnIsDelete,XBDmnIsControl,XBDmnIsDrummy1,XBDmnIsDrummy2 FROM [NWL_SpeedWayTest2].[dbo].[TMnyMUserMenu]  WHERE  XVUsrCode ='".$usercode."'";
        $qme=sqlsrv_query($conn, $Menu ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET));
        while($all=sqlsrv_fetch_array($qme, SQLSRV_FETCH_ASSOC)){
            $arrall[]=$all['XBDmnIsRead'];
            $arrall[]=$all['XBDmnIsAdd'];
            $arrall[]=$all['XBDmnIsDelete'];
            $arrall[]=$all['XBDmnIsControl'];
            $arrall[]=$all['XBDmnIsDrummy1'];
            $arrall[]=$all['XBDmnIsDrummy2'];

            $a[]=$all['XBDmnIsRead'];
            $al[]=$all['XBDmnIsAdd'];
            $alld[]=$all['XBDmnIsDelete'];
            $alll[]=$all['XBDmnIsControl'];


        }
        $allc=count($arrall); // echo $allc;
        $a1=count($a);
        $a2=count($al);
        $a3=count($alld);
        $a4=count($alll);
        ?>
        <table class="table table-striped table-hover">
        <tr>
        <th style="text-align: center;" ><input style="margin: .2rem;" onclick="pri('<?php echo $_SESSION['user']; ?>')" <?php if($allc==66){ echo 'checked';} ?> 
        class="chkall" type="checkbox" id="select-all"/>ทั้งหมด</th>
        <th >รายละเอียด</th>
        <th style="text-align: center;" ><input <?php if($allc==66  && $a1 == 11){ echo 'checked';} ?> id="XBDmnIsRead1"    onclick="chkprix('XBDmnIsRead','<?php echo $_SESSION['user']; ?>','XBDmnIsRead1')" style="margin: .2rem;" type="checkbox" class="select-all-col1 checkbox" name="select-all"/>อ่าน</td>
        <th style="text-align: center;" ><input <?php if($allc==66  && $a2 == 11){ echo 'checked';} ?> id="XBDmnIsAdd2"     onclick="chkprix('XBDmnIsAdd','<?php echo $_SESSION['user']; ?>','XBDmnIsAdd2')" style="margin: .2rem;" type="checkbox" class="select-all-col2 checkbox" name="select-all"/>เขียน</td>
        <th style="text-align: center;" ><input <?php if($allc==66  && $a3 == 11){ echo 'checked';} ?> id="XBDmnIsDelete3"  onclick="chkprix('XBDmnIsDelete','<?php echo $_SESSION['user']; ?>','XBDmnIsDelete3')" style="margin: .2rem;" type="checkbox" class="select-all-col3 checkbox" name="select-all"/>ลบ</td>
        <th style="text-align: center;" ><input <?php if($allc==66  && $a4 == 11){ echo 'checked';} ?> id="XBDmnIsControl4" onclick="chkprix('XBDmnIsControl','<?php echo $_SESSION['user']; ?>','XBDmnIsControl4')"  style="margin: .2rem;" type="checkbox" class="select-all-col4 checkbox" name="select-all"/>ควบคุม</td>
    </tr>
        <?php 

      function ckpri($XVMnuCode){
        include "lib/DatabaseManage.php";
        $io=array();
        $j="SELECT XBDmnIsRead
        FROM [NWL_SpeedWayTest2].[dbo].[TMnyMUserMenu] WHERE XVUsrCode ='".$_SESSION['user']."' AND XVMnuCode  ='$XVMnuCode' ";
        echo $j;
        $jqc=sqlsrv_query($conn, $j ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET));
        $jd=sqlsrv_fetch_array($jqc, SQLSRV_FETCH_ASSOC);

        if($jd['XBDmnIsRead']=='1'){ $ks=1;}

        $io[]=$ks;
        
        return $io;
      }

        $i=1;
       $arr=array();
        $Menu="SELECT * FROM [NWL_SpeedWayTest2].[dbo].[TSysSMenu]"; 
        $qme=sqlsrv_query($conn, $Menu);
        while($hk=sqlsrv_fetch_array($qme, SQLSRV_FETCH_ASSOC)){
            $XVMnuCode=$hk['XVMnuCode'];
            $array=array();
            $array[]=$hk['XVMnuCode'];
            //$j="SELECT $keyu FROM [NWL_SpeedWayTest2].[dbo].[TMnyMUserMenu]  WHERE  XVUsrCode ='".$_SESSION['user']."' AND XVMnuCode ='$XVMnuCode'";
        ?>
    <tr>
        <td class="active1" style="text-align: center;">
            <?php    
            //print_r(ckpri($XVMnuCode));
            ?>
       <input <?php if($allc==66){ echo 'checked';} ?> onclick="chkitem('<?php echo $XVMnuCode; ?>')" type="checkbox" id="allitem<?php echo $XVMnuCode; ?>" class="select-all1 checkbox select-item<?php echo $XVMnuCode; ?>" name="select-all"/>
        </td>
        <td ><?php echo $hk['XVMnuName']; ?></td>
        <td style="text-align: center;" ><input <?php if($allc==66){ echo 'checked';} ?> id="XBDmnIsRead<?php echo $XVMnuCode; ?>" type="checkbox" onclick="chkpri_('XBDmnIsRead','<?php echo $XVMnuCode; ?>')"     class="select-col1 select-item<?php echo $XVMnuCode; ?> checkbox " name="select-item" value="" /></td>
        <td style="text-align: center;" ><input <?php if($allc==66){ echo 'checked';} ?> id="XBDmnIsAdd<?php echo $XVMnuCode; ?>"  type="checkbox"  onclick="chkpri_('XBDmnIsAdd','<?php echo $XVMnuCode; ?>')"     class="select-col2 select-item<?php echo $XVMnuCode; ?> checkbox " name="select-item" value="" /></td>
        <td style="text-align: center;" ><input <?php if($allc==66){ echo 'checked';} ?> id="XBDmnIsDelete<?php echo $XVMnuCode; ?>" type="checkbox" onclick="chkpri_('XBDmnIsDelete','<?php echo $XVMnuCode; ?>')"   class="select-col3 select-item<?php echo $XVMnuCode; ?> checkbox " name="select-item" value="" /></td>
        <td style="text-align: center;" ><input <?php if($allc==66){ echo 'checked';} ?> id="XBDmnIsControl<?php echo $XVMnuCode; ?>"  type="checkbox"onclick="chkpri_('XBDmnIsControl','<?php echo $XVMnuCode; ?>')"  class="select-col4 select-item<?php echo $XVMnuCode; ?> checkbox " name="select-item" value="" /></td>
    </tr>
    <?php  $i++;} ?>
</table>

<button style="display: none;" id="select-all" class="btn button-default">เลือกทั้งหมด / ยกเลิกทั้งหมด</button>
<!-- <button id="select-invert" class="btn button-default">สลับ</button> -->
<!-- <button id="select-all" class="btn button-default">SelectAll/Cancel</button> -->
<!-- <button id="select-invert" class="btn button-default">Invert</button> -->
<!-- <button id="selected" class="btn button-default">GetSelected</button> -->

<br>



<!-- original -->
<!-- <div class="container" style="margin-top:100px;">
    <div class="row">
        <div class="col-md-12">
            <form action="" method="post">
                <ul id="tree1">

                    <li>หน้าหลัก

                        <ul> -->
                            <?php
                //   $sql = "SELECT  XVMnuCode, XVMnuName, XVMnuType
                //            FROM            dbo.TSysSMenu
                //   WHERE        (XVMnuType = N'1')
                //   ORDER BY XVMnuCode";
                //   $query = sqlsrv_query($conn, $sql);
                //   while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
                //   {
                //         $XVMnuCode=$row['XVMnuCode'];
                //         $sql="SELECT XBDmnIsRead ,XBDmnIsAdd, XBDmnIsDelete, XBDmnIsControl FROM TMnyMUserMenu where XVUsrCode='$XVUsrCode' and XVMnuCode='$XVMnuCode'";
                //         $querys = sqlsrv_query($conn, $sql);
                //         $XBDmnIsRead="";
                //         while($rows = sqlsrv_fetch_array($querys, SQLSRV_FETCH_ASSOC))
                //         { 
                //             if($rows['XBDmnIsRead']==1){
                //                 $XBDmnIsRead="checked";
                //             }
                //         }

                //           echo '<label style="margin-right: 20px;"><li><input type="checkbox"  name="M1[]"  value="'.$row['XVMnuCode'].',1" '.$XBDmnIsRead.' >'.$row['XVMnuName'].'</label></li>';
                //   }
              ?>
                        <!-- </ul>
                    </li>
                    <li>การควบคุม
                        <ul>
                            <ul> -->
                                <?php
                //   $sql = "SELECT  XVMnuCode, XVMnuName, XVMnuType
                //            FROM            dbo.TSysSMenu
                //   WHERE        (XVMnuType = N'2')
                //   ORDER BY XVMnuCode";
                //   $query = sqlsrv_query($conn, $sql);
                //   while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
                //   {
                //           $XVMnuCode=$row['XVMnuCode'];
                //           $sql="SELECT XBDmnIsRead ,XBDmnIsAdd, XBDmnIsDelete, XBDmnIsControl FROM TMnyMUserMenu where XVUsrCode='$XVUsrCode' and XVMnuCode='$XVMnuCode'";
                         
                //           $querys = sqlsrv_query($conn, $sql);
                //           $XBDmnIsRead="";
                //           $XBDmnIsAdd="";
                //           $XBDmnIsDelete="";
                //           $XBDmnIsControl="";
                //           while($rows = sqlsrv_fetch_array($querys, SQLSRV_FETCH_ASSOC))
                //           { 
                //               if($rows['XBDmnIsRead']==1){
                //                 $XBDmnIsRead="checked";
                //               }
                //               if($rows['XBDmnIsAdd']==1){
                //                 $XBDmnIsAdd="checked";
                //               }
                //               if($rows['XBDmnIsDelete']==1){
                //                 $XBDmnIsDelete="checked";
                //               }
                //               if($rows['XBDmnIsControl']==1){
                //                 $XBDmnIsControl="checked";
                //               }
                //           }  
                         
                //           echo '<li>'.$row['XVMnuName'].
                //           '<label style="margin-left: 20px;"><input type="checkbox"  name="M1[]"  value="'.$row['XVMnuCode'].',1" '.$XBDmnIsRead.'>อ่าน</label>'.
                //           '<label style="margin-left: 20px;"><input type="checkbox"  name="M2[]"  value="'.$row['XVMnuCode'].',1" '.$XBDmnIsAdd.'>เขียน</label>'.
                //           '<label style="margin-left: 20px;"><input type="checkbox"  name="M3[]"  value="'.$row['XVMnuCode'].',1" '.$XBDmnIsDelete.'>ลบ</label>'.
                //           '<label style="margin-left: 20px;"><input type="checkbox"  name="M4[]"  value="'.$row['XVMnuCode'].',1" '.$XBDmnIsControl.'>ควบคุม</label></li></li>';
                //   }
              ?>
                            <!-- </ul>
                        </ul>
                    </li>
                    <li>การแสดงข้อความ
                        <ul>
                            <ul> -->
                                <?php
            //       $sql = "SELECT  XVMnuCode, XVMnuName, XVMnuType
            //                FROM            dbo.TSysSMenu
            //       WHERE        (XVMnuType = N'3')
            //       ORDER BY XVMnuCode";
            //       $query = sqlsrv_query($conn, $sql);
            //       while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
            //       {
                          
            //               $XVMnuCode=$row['XVMnuCode'];
                       
            //               $sql="SELECT XBDmnIsRead ,XBDmnIsAdd, XBDmnIsDelete, XBDmnIsControl FROM TMnyMUserMenu where XVUsrCode='$XVUsrCode' and XVMnuCode='$XVMnuCode'";
                     
            //               $querys = sqlsrv_query($conn, $sql);
            //               $XBDmnIsRead="";
            //               $XBDmnIsAdd="";
            //               $XBDmnIsDelete="";
            //               $XBDmnIsControl="";
            //               while($rows = sqlsrv_fetch_array($querys, SQLSRV_FETCH_ASSOC))
            //               { 
            //                   if($rows['XBDmnIsRead']==1){
            //                     $XBDmnIsRead="checked";
            //                   }
            //                   if($rows['XBDmnIsAdd']==1){
            //                     $XBDmnIsAdd="checked";
            //                   }
            //                   if($rows['XBDmnIsDelete']==1){
            //                     $XBDmnIsDelete="checked";
            //                   }
            //                   if($rows['XBDmnIsControl']==1){
            //                     $XBDmnIsControl="checked";
            //                   }
            //               }       
                           
            //         echo '<li>'.$row['XVMnuName'].
            //         '<label style="margin-left: 20px;"><input type="checkbox"  name="M1[]"  value="'.$row['XVMnuCode'].',1" '.$XBDmnIsRead.'>อ่าน</label>'.
            //         '<label style="margin-left: 20px;"><input type="checkbox"  name="M2[]"  value="'.$row['XVMnuCode'].',1" '.$XBDmnIsAdd.'>เขียน</label>'.
            //         '<label style="margin-left: 20px;"><input type="checkbox"  name="M3[]"  value="'.$row['XVMnuCode'].',1" '.$XBDmnIsDelete.'>ลบ</label>'.
            //         '<label style="margin-left: 20px;"><input type="checkbox"  name="M4[]"  value="'.$row['XVMnuCode'].',1" '.$XBDmnIsControl.'>ควบคุม</label>
            //         </li></li>';
            //       }
            //   ?>
                            <!-- </ul>
                        </ul>
                    </li>
                    <li>รายงาน
                        <ul>
                            <ul> -->
                                <?php
                //   $sql = "SELECT  XVMnuCode, XVMnuName, XVMnuType
                //            FROM            dbo.TSysSMenu
                //   WHERE        (XVMnuType = N'4')
                //   ORDER BY XVMnuCode";
                //   $query = sqlsrv_query($conn, $sql);
                //   while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
                //   {
                //         $XVMnuCode=$row['XVMnuCode'];
                //         $sql="SELECT XBDmnIsRead ,XBDmnIsAdd, XBDmnIsDelete, XBDmnIsControl FROM TMnyMUserMenu where XVUsrCode='$XVUsrCode' and XVMnuCode='$XVMnuCode'";
                //         $querys = sqlsrv_query($conn, $sql);
                //         $XBDmnIsRead="";
                //         while($rows = sqlsrv_fetch_array($querys, SQLSRV_FETCH_ASSOC))
                //         { 
                //             if($rows['XBDmnIsRead']==1){
                //                 $XBDmnIsRead="checked";
                //             }
                //         }
                //         echo '<li><label style="margin-right: 20px;"><input type="checkbox"  name="M1[]"  value="'.$row['XVMnuCode'].',1" '.$XBDmnIsRead.'>'.$row['XVMnuName'].'</label></li>';
                //   }
              ?>
                            </ul>
                        </ul>
                    </li>
                </ul>


                
                <div style="padding-left: 250px; display: none;"><button type="submit" class="btn btn-primary">บันทึก</button></div>
            </form>
        </div>

    </div>
</div>


</div>
<!-- end div flex-content -->
</div>
<!-- end div container -->
<?php 
ob_start();
session_start();

if(isset($_POST['load']) and $_POST['load']=='0001'){
    include "config_NWL.php";
    $val=$_POST["use_c"]; 
    $check = $_POST['check'];
    $datetime =date("Y-m-d H:i:s");
    
    if($check=='true'){
    $del="DELETE FROM [NWL_SpeedWayTest2].[dbo].[TMnyMUserMenu]  WHERE  XVUsrCode ='$val'";    
     sqlsrv_query($conn,$del);
    $chk="SELECT * FROM [NWL_SpeedWayTest2].[dbo].[TSysSMenu]";
   // echo $chk;
    $qk=sqlsrv_query($conn,$chk);
    while($c=sqlsrv_fetch_array($qk, SQLSRV_FETCH_ASSOC)){
     $kl="INSERT INTO [dbo].[TMnyMUserMenu]
           ([XVUsrCode]
           ,[XVMnuCode]
           ,[XBDmnIsRead]
           ,[XBDmnIsAdd]
           ,[XBDmnIsDelete]
           ,[XBDmnIsControl]
           ,[XBDmnIsDrummy1]
           ,[XBDmnIsDrummy2]
           ,[XVWhoCreate]
           ,[XVWhoEdit]
           ,[XTWhenCreate]
           ,[XTWhenEdit])
     VALUES
           ('$val',
           '".$c['XVMnuCode']."',
           '1',
           '1',
           '1',
           '1',
           '1',
           '1',
           '".$val."',
           '".$val."',
           '".$datetime."',
           '".$datetime."') ";
          // echo $kl;
           sqlsrv_query($conn,$kl);
    }
    }elseif($check=='false'){
        $del="DELETE FROM [NWL_SpeedWayTest2].[dbo].[TMnyMUserMenu]  WHERE  XVUsrCode ='$val'";    
        sqlsrv_query($conn,$del);
   }
  }
  if(isset($_POST['load']) and $_POST['load']=='0002'){
    include "config_NWL.php";
    $val=$_POST['val'];
    $check=$_POST['check'];
    $edit=$_SESSION['user'];
    $valx=$_POST["use_c"]; 
    $datetime =date("Y-m-d H:i:s");
    $chk7="SELECT * FROM [dbo].[TMnyMUserMenu] WHERE XVUsrCode='$valx' AND XVMnuCode='$val'";
    
    $qme=sqlsrv_query($conn, $chk7 ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET));
    $r=sqlsrv_num_rows($qme);
   if($r==0){
    $kk="INSERT INTO [dbo].[TMnyMUserMenu]
           ([XVUsrCode]
           ,[XVMnuCode]
           ,[XBDmnIsRead]
           ,[XBDmnIsAdd]
           ,[XBDmnIsDelete]
           ,[XBDmnIsControl]
           ,[XBDmnIsDrummy1]
           ,[XBDmnIsDrummy2]
           ,[XVWhoCreate]
           ,[XVWhoEdit]
           ,[XTWhenCreate]
           ,[XTWhenEdit])
     VALUES
           ('$valx',
           '".$val."',
           '1',
           '1',
           '1',
           '1',
           '1',
           '1',
           '".$edit."',
           '".$edit."',
           '".$datetime."',
           '".$datetime."') ";
          // echo $kl;
           sqlsrv_query($conn,$kk);
   }else{
   if($check=='false'){
        $Qx="UPDATE [dbo].[TMnyMUserMenu]
        SET
           [XBDmnIsRead] = ''
          ,[XBDmnIsAdd] = ''
          ,[XBDmnIsDelete] = ''
          ,[XBDmnIsControl] = ''
          ,[XBDmnIsDrummy1] = ''
          ,[XBDmnIsDrummy2] = ''
          ,[XVWhoEdit] = '$edit'
          ,[XTWhenEdit] = '$datetime'
     WHERE XVUsrCode='$valx' AND XVMnuCode='$val'";
     echo $Qx;
    sqlsrv_query($conn, $Qx);

    }else{
        $Q="UPDATE [dbo].[TMnyMUserMenu]
    SET
       [XBDmnIsRead] = '1'
      ,[XBDmnIsAdd] = '1'
      ,[XBDmnIsDelete] = '1'
      ,[XBDmnIsControl] = '1'
      ,[XBDmnIsDrummy1] = '1'
      ,[XBDmnIsDrummy2] = '1'
      ,[XVWhoCreate] = '$edit'
      ,[XVWhoEdit] = '$edit'
      ,[XTWhenEdit] = '$datetime'
 WHERE XVUsrCode='$valx' AND XVMnuCode='$val'";
sqlsrv_query($conn,$Q);
    }
    }
  }
  if(isset($_POST['load']) and $_POST['load']=='0003'){
    include "config_NWL.php";
   $key=$_POST['keychk'];
   $vmscode=$_POST['vmscodechk'];
   $edit=$_SESSION['user'];
   $datetime =date("Y-m-d H:i:s");
   $check=$_POST['check'];
   $vj=$_POST["use_c"];
   if($check=='false'){
     $Qu="UPDATE [dbo].[TMnyMUserMenu] SET $key=''  WHERE XVUsrCode='$vj' AND XVMnuCode='$vmscode'"; 
     sqlsrv_query($conn,$Qu);
    
   }else{
    $Qux="UPDATE [dbo].[TMnyMUserMenu] SET $key='1'  WHERE XVUsrCode='$vj' AND XVMnuCode='$vmscode'"; 
    sqlsrv_query($conn,$Qux);
  
   }


  }
  if(isset($_POST['load']) and $_POST['load']=='0004'){
    include "config_NWL.php";
   $key=$_POST['keychk'];
   $user=$_POST['user'];
   $edit=$_SESSION['user'];
   $datetime =date("Y-m-d H:i:s");
   $check=$_POST['check'];
   $vi=$_POST["use_c"];

  
   if($check=='false'){
         $pri1="UPDATE [dbo].[TMnyMUserMenu] SET $key='' WHERE XVUsrCode='$vi'";
         sqlsrv_query($conn,$pri1);
   }else{
    $h="SELECT * FROM  [dbo].[TMnyMUserMenu] WHERE XVUsrCode='$vi'";
    echo $h;
    $w=sqlsrv_query($conn, $h ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET));
    $rw=sqlsrv_num_rows($w); //echo $rw;
    if($rw==0){

      $chk="SELECT * FROM [NWL_SpeedWayTest2].[dbo].[TSysSMenu]";
      $qk=sqlsrv_query($conn,$chk);
      while($c=sqlsrv_fetch_array($qk, SQLSRV_FETCH_ASSOC)){
       $kl="INSERT INTO [dbo].[TMnyMUserMenu]
             ([XVUsrCode]
             ,[XVMnuCode]
             ,$key
             ,[XVWhoCreate]
             ,[XVWhoEdit]
             ,[XTWhenCreate]
             ,[XTWhenEdit])
       VALUES
             ('$vi',
             '".$c['XVMnuCode']."',
             '1',
             '".$edit."',
             '".$edit."',
             '".$datetime."',
             '".$datetime."') ";
           echo $kl;
             sqlsrv_query($conn,$kl);
      }
 
    }else{
    $pri2="UPDATE [dbo].[TMnyMUserMenu] SET $key='1' WHERE XVUsrCode='$vi'";
    sqlsrv_query($conn,$pri2);

    $chk="SELECT * FROM [NWL_SpeedWayTest2].[dbo].[TSysSMenu]";
     $qk=sqlsrv_query($conn,$chk);
     while($c=sqlsrv_fetch_array($qk, SQLSRV_FETCH_ASSOC)){
      $kl="INSERT INTO [dbo].[TMnyMUserMenu]
            ([XVUsrCode]
            ,[XVMnuCode]
            $key,
            ,[XVWhoCreate]
            ,[XVWhoEdit]
            ,[XTWhenCreate]
            ,[XTWhenEdit])
      VALUES
            ('$vi',
            '".$c['XVMnuCode']."',
            '1',
            '".$edit."',
            '".$edit."',
            '".$datetime."',
            '".$datetime."') ";
           // echo $kl;
            sqlsrv_query($conn,$kl);
     }
    }

   }
  }

  
?>
<?php 
// function privilege
// Parameter user-> $_SESSION['user'];
// parameter menu-> codemenu
  function pri_($user,$menucode){
    include "config_NWL.php";
    $pri_=array(); // [XBDmnIsRead]
    $Qpri="SELECT *  FROM TMnyMUserMenu WHERE XVUsrCode='$user' AND XVMnuCode='$menucode'"; 
    $Qpri1=sqlsrv_query($conn,$Qpri);
    $Qpri2=sqlsrv_fetch_array($Qpri1, SQLSRV_FETCH_ASSOC);
    $pri_[]=array("pri_w"=>$Qpri2['XBDmnIsAdd'],"pri_r"=>$Qpri2['XBDmnIsRead'],"pri_del"=>$Qpri2['XBDmnIsDelete']);
    return $pri_;
  }



?>
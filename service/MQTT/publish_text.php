<?php
require('phpMQTT.php');
require('publish.php');
include('../lib/AES-128-CTR.php');
$color1=$_POST["color1"];
$color2=$_POST["color2"];
$color3=$_POST["color3"];
$color4=$_POST["color4"];
$color5=$_POST["color5"];
$color6=$_POST["color6"];
$color7=$_POST["color7"];
$color8=$_POST["color8"];
$sms1=$_POST["sms1"];
$sms2=$_POST["sms2"];
$sms3=$_POST["sms3"];
$sms4=$_POST["sms4"];
$sms5=$_POST["sms5"];
$sms6=$_POST["sms6"];
$sms7=$_POST["sms7"];
$sms8=$_POST["sms8"];
$mode=$_POST["mode"];
$font=$_POST["font"];
$align=$_POST["align"];
$delay=$_POST["delay"];
$sms="";
$R = "";
$G = "";
$B = "";
if($sms1!=""){
	$sms="'".$sms1."'";
	$R.=hexdec(substr($color1,1,2));
    $G.=hexdec(substr($color1,3,2));
    $B.=hexdec(substr($color1,5,2));
}
if($sms2!=""){
	$sms.=",".$sms2."'";
	$R.=",".hexdec(substr($color2,1,2));
    $G.=",".hexdec(substr($color2,3,2));
    $B.=",".hexdec(substr($color2,5,2));
}
if($sms3!=""){
	$sms.=",".$sms3."'";
	$R.=",".hexdec(substr($color3,1,2));
    $G.=",".hexdec(substr($color3,3,2));
    $B.=",".hexdec(substr($color3,5,2));
}
if($sms4!=""){
	$sms.=",".$sms4."'";
	$R.=",".hexdec(substr($color4,1,2));
    $G.=",".hexdec(substr($color4,3,2));
    $B.=",".hexdec(substr($color4,5,2));
}
if($sms5!=""){
	$sms.=",".$sms5."'";
	$R.=",".hexdec(substr($color5,1,2));
    $G.=",".hexdec(substr($color5,3,2));
    $B.=",".hexdec(substr($color5,5,2));
}
if($sms6!=""){
	$sms.=",".$sms6;
    $R.=",".hexdec(substr($color6,1,2));
    $G.=",".hexdec(substr($color6,3,2));
    $B.=",".hexdec(substr($color6,5,2));
}
if($sms7!=""){
	$sms.=",".$sms7."'";
	$R.=",".hexdec(substr($color7,1,2));
    $G.=",".hexdec(substr($color7,3,2));
    $B.=",".hexdec(substr($color7,5,2));
}
if($sms8!=""){
	$sms.=",".$sms8."'";
	$R.=hexdec(substr($color8,1,2)).",";
    $G.=hexdec(substr($color8,5,2)).",";
    $B.=hexdec(substr($color8,5,2));
}
$token=encrypt("TokNwl2022!");
$jsondata="
{
	'TOKEN': '".$token."',
	'SIGN_IP': [
	   '192.168.55.109'
	 ],
	 'SMS': [
	   ".$sms."
	 ],
	 'FONT': ".$font.",    
	 'MODE': ".$mode.",
	 'ALIGN': ".$align.",
	 'DELAY': ".$delay.",
	 'COLOR_R': [
	   ".$R."
	 ],
	 'COLOR_G': [
	   ".$G."
	 ],
	 'COLOR_B': [
	   ".$B."
	 ],
	 'FTP_PICTURE': [  
	 ],
	 'FTP_IP': '',
	 'FTP_USERNAME': '',
	 'FTP_PASSWORD': '',
}
";


echo publish($jsondata);
?>
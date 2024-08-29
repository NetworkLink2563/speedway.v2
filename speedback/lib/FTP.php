<?php
require('../MQTT/phpMQTT.php');
require('../MQTT/publish.php');
include('../lib/AES-128-CTR.php');
include('../lib/DatabaseManage.php');
$mode= $_POST["mode"];
$delay= $_POST["delay"];
$path= $_POST["path"];
$vmscode= $_POST["vmscode"];
function VmsIp($vmscode){
	$dbm=new DatabaseManage();
    $sql="SELECT [XVVmsURL] FROM [NWL_VMSControl].[dbo].[TMstMVms] WHERE XVVmsCode='$vmscode'";
    $result=$dbm->QueryDB($sql);
    $JsonObj = json_decode($result);
    $data='';
    foreach ($JsonObj as $result){ 
        $data=$result->XVVmsURL;
    }
    return $data;
}
$vmsip=VmsIp($vmscode);
function FtpPut($Path,$FileName,$vmsip){
	$ftp_server = "103.13.30.40";
	$ftp_port = "13021";
	$ftp_username ="admindev";
	$ftp_userpass = "@NetWork2022";
	$locfile=$Path."/".$FileName;
	$destination = "ImageVMS/".$vmsip."/".$FileName;
	$conn = ftp_connect($ftp_server, $ftp_port) or die("Could not connect");
	ftp_login($conn,$ftp_username,$ftp_userpass);
	ftp_pasv($conn, true);
	ftp_put($conn,$destination,$locfile,FTP_BINARY);
	ftp_close($conn);
}
function FtpDeleteFolder($vmsip){
	$ftp_server = "103.13.30.40";
	$ftp_port = "13021";
	$ftp_username ="admindev";
	$ftp_userpass = "@NetWork2022";
	$dir = "ImageVMS/".$vmsip."/";
	$conn = ftp_connect($ftp_server, $ftp_port) or die("Could not connect");
	ftp_login($conn,$ftp_username,$ftp_userpass);
	echo "--Start Delete--<br>";
	echo $dir;
	if(ftp_rmdir($conn , $dir)){
		echo "Delete Success";
	}else{
		echo "Delete Fail";
	}
	echo "--End Delete--<br>";
	ftp_close($conn);
}
$picure="";
$countfile=0;
$dir = $path; 

if (is_dir($dir)){
	
    if ($dh = opendir($dir)){
	 
      while (($file = readdir($dh)) !== false){
        if($file!=".."&&$file!="."){
			$countfile++;
			$filepath=explode("/",$file);
			$filename=$filepath[count($filepath)-1] ;
			if($countfile==1){
				$picure="'".$filename."'";
			}else{
                $picure.=",'".$filename."'";
			}
			FtpPut($path,$filename,$vmsip); 
		
        }  
	  }
	}	    
}
closedir($dh);
if($countfile>0){
	
	$token=encrypt("TokNwl2022!");
	$ftp_server = "103.13.30.40";
	$ftp_username = encrypt("admindev");
	$ftp_userpass = encrypt("@NetWork2022");
	$jsondata="
	{
		'TOKEN': '".$token."',
		'SIGN_IP': [
		'".$vmsip."'
		],
		'SMS': [
		],
		'FONT': 0,    
		'MODE': ".$mode.",
		'ALIGN': 0,
		'DELAY': ".$delay.",
		'COLOR_R': [
		],
		'COLOR_G': [
		],
		'COLOR_B': [
		],
		'FTP_PICTURE': [  
			".$picure."
		],
		'FTP_IP': '".$ftp_server."',
		'FTP_USERNAME': '".$ftp_username."',
		'FTP_PASSWORD': '".$ftp_userpass."',
	}
	";
	echo publish($jsondata);
    //echo "Success";
	
}
?>
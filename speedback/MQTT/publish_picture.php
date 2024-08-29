<?php
require('phpMQTT.php');
require('publish.php');
include('../lib/AES-128-CTR.php');

$picure="";
$countfile=0;
$dir = "../Upload/";
if (is_dir($dir)){
    if ($dh = opendir($dir)){
      while (($file = readdir($dh)) !== false){
        if($file!=".."&&$file!="."){
			$filepath=explode("/",$file);
			$filename=$filepath[count($filepath)-1] ;
		    if($countfile==0){
		        $picure=$filename;		
			}else{
				$picure.=",".$filename;
			}			    
			$countfile++;
        }  
	  }
	}	    
}
closedir($dh);
$token=encrypt("TokNwl2022!");
$ftp_server = "103.13.30.43";
$ftp_username = encrypt("admin.n");
$ftp_userpass = encrypt("!Nwl2022");
$jsondata="
{
	'TOKEN': '".$token."',
	'SIGN_IP': [
	   '192.168.55.109'
	 ],
	 'SMS': [
	   
	 ],
	 'FONT': "",    
	 'MODE': ".$mode.",
	 'ALIGN': "",
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
?>
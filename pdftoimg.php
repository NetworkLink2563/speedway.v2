<?php
function  PdfToImg($VmsCode,$SourcePath,$DestinationPath,$PdfFileName){
      $ret=0;
      if(!is_dir($DestinationPath)){
          mkdir($DestinationPath);
      }
      $TmpImgPath=__DIR__."\\TMPIMG\\";
      $tmp=explode(".",$PdfFileName);
      $ImgName=$tmp[0];
      $filein=$SourcePath.$PdfFileName;
      $fileout=$TmpImgPath."OUT.png";
      $width=480;
      $height=320;
      //$cmd='convert '.$filein.' -crop '.$width.'x'.$height.' '.$fileout;
	 
	  //echo shell_exec( $cmd );
	  //echo dirname(__DIR__);
      system('cmd /c "'.dirname(__DIR__) . '\\VMS\\img.bat"');
	 
      $arrFiles = array();
      $files = scandir($TmpImgPath);
      foreach ($files as $file) {
         $filePath = $TmpImgPath. $file;
         if (is_file($filePath)) {
            if($file!="OUT-0.png"){
                  unlink($filePath);
            }else{
               $ret=1;
               $filePathout=$DestinationPath.$ImgName.".png";
               rename($filePath,  $filePathout);
            }
         }
      }
      return $ret;
}
$VMSCODE="VMS001";
$SourcePath=__DIR__."\\TMPPDF\\";
$DestinationPath=__DIR__."\\VMSIMG\\".$VMSCODE."\\";
$PdfFileName="Presentation1.pdf";
$filein=$pathin."Presentation1.pdf";
echo PdfToImg($VmsCode,$SourcePath,$DestinationPath,$PdfFileName);
?>
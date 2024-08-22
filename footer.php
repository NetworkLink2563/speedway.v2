<?php 
  $gitPath = "C:\\Program Files\\Git\\bin\\git.exe";
  $commitVer = trim(exec($gitPath.' rev-parse HEAD')); 
  var_dump($gitPath);
  echo $commitVer;
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.footer {
   position: fixed;
   left: 0;
   bottom: 0;
   height:5%;
   width: 100%;
   background-color: #034672 !important;
   color: white;
   text-align: center;
   z-index: 9999;
}
</style>
<div class="footer">
  <p style="padding: 0.5%;">City Motorway Division Department of Hightways Copyright © 2024; Designed by <a style="color:#979fd4;"target="_blank" href="https://www.networklink.co.th/">Networklink</a><span style="color: #cccc;">&nbsp;<?php echo $commitVer; ?></span></p>
  
</div>
</head>
</html>

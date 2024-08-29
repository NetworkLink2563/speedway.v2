 <?php  
   header('Content-Type: text/html; charset=UTF-8');
   header('X-Frame-Options: DENY');
   header("Access-Control-Allow-Origin: *");
   header('X-XSS-Protection: 1; mode=block');
   header ("Last-Modified: " . gmdate ("D, d M Y H:i:s") . " GMT");
   header('Cache-Control: no-store, no-cache, must-revalidate');
   header('Cache-Control: post-check=0, pre-check=0', FALSE);
   header('Pragma: no-cache');
   session_start();
   
?>   
   
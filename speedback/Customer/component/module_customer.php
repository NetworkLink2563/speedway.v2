<?php /*
//////////// Log Edit ////////////////
 FILE NAME : module_customer.php 
 Create By : Sivadol.J 
 Log Edit  : Create 07/25/2024    
/////////////////////////////////////
*/
?>
<?php session_start(); 

if (!isset($_GET['m'])) { $m = 'default';} else {$m = $_GET['m'];}

?>
    <script src="../lib/gentelella/vendors/jquery/dist/jquery.min.js"></script><!-- jquery v2.2.3 -->
    <script src="../lib/gentelella/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../lib/bootstrap/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../lib/bootstrap/vendor/datatables/js/dataTables.bootstrap.min.js"></script>
    <script src="../lib/gentelella/vendors/moment/min/moment.min.js"></script>
    <script src="../lib/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="../lib/gentelella/vendors/fastclick/lib/fastclick.js"></script>
    <script src="../lib/gentelella/vendors/nprogress/nprogress.js"></script>
    <script src="../lib/gentelella/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="../lib/gentelella/vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="../lib/gentelella/vendors/google-code-prettify/src/prettify.js"></script>
    <script src="../lib/gentelella/build/js/custom.min.js"></script>
    <link href="../lib/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../lib/gentelella/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="../lib/gentelella/vendors/nprogress/nprogress.css" rel="stylesheet">
    <link href="../lib/gentelella/vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <link href="../lib/gentelella/build/css/custom.min.css" rel="stylesheet">
  
 <?php 

   if($m=='customer'){
        include("component_customer.php");
    }?>
    
	

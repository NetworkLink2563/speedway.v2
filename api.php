


<!DOCTYPE html>
<html>
<head>
     <title></title>
     <script type="text/javascript" src="Ckeditor/ckeditor/ckeditor.js"></script>
</head>
<body>
    <?php
       
        $File=$_REQUEST['p'];
        $myfile = fopen($File, "r") or die("Unable to open file!");
        $data=fgets($myfile);
        fclose($myfile);
      
    ?>
   <?php echo $data;?>

</body>
</html>
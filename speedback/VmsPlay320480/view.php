<?php
    $myfile = fopen("Label.json", "r") or die("Unable to open file!");
    $ret = fread($myfile,filesize("Label.json"));
   
    fclose($myfile);
    $obj=json_decode($ret);
   
     $Label='';
    for($i=0;$i<count($obj);$i++){
    
      //$Label.='<p id="Label'.$obj[$i]->XILineNumber.'" style="color:white;font-size: 18px;position:absolute;top:'  .$obj[$i]->XVLabelPosition_Y.';left:280px;">'.$obj[$i]->XVTime.'</p>';
      
      $Label.='<p id="Label'.$obj[$i]->XILineNumber.'" style="color:white;font-size: 18px;left:280px;top:'.$obj[$i]->XVLabelPosition_Y.'px;position:absolute;"</p>'; 
    }
    $Label.='';
?>

<?php
    $myfile = fopen("Media.json", "r") or die("Unable to open file!");
    $ret = fread($myfile,filesize("Media.json"));
    fclose($myfile);
    $obj=json_decode($ret);
?>
<!doctype html>
<html lang="en">
<head>
    <link href="bootstrap-5/css/bootstrap.min.css" rel="stylesheet" />
    <script src="bootstrap-5/js/bootstrap.bundle.min.js"> </script>
    <script src="Jquery/jquery36.js">
    </script>
 
    <script src="bootstrap/js/bootstrap.min.js">
    </script>
    <style>
     @font-face {
       font-family: myFirstFont;
       src: url("SarunThangLuang.ttf");
     }
  
     body {
       font-family: myFirstFont;
       cursor: none;
    }
    </style>
</head>

<body style="background-color: white;cursor: none;">

	
		<div id="carouselExampleSlidesOnly"
			class="carousel "
			data-bs-ride="carousel" data-bs-pause="false">			
			<div class="carousel-inner" style="height: 320px;width: 480px;overflow: hidden;background-color: black;">
                           <?php   
                	       $indexmap='';
                               for($i=0;$i<count($obj);$i++){
                                  $active="";
                                  if($i==0){
                                      $active="active";
                                  }
                                  if($obj[$i]->XVMediaType==1){
                                        $data='<div  style="height: 320px;width: 480px;overflow: hidden;background-color: black;">
                                            <div style="height: 320px;width: 480px;overflow: hidden;background-color: black;">'.$obj[$i]->XVSms.'</div>
                                        </div>';
                                      
                                  }
                                  if($obj[$i]->XVMediaType==2){
                                       $data='<div  style="height: 320px;width: 480px;overflow: hidden;background-color: black;">
                                           <img src="IMG/'.$obj[$i]->XVFileName.'">
                                       </div>';

                                  }
                                  if($obj[$i]->XVMediaType==3){

                                        $data='<div  style="height: 320px;width: 480px;overflow: hidden;background-color: black;">
                                               <video style="height: 320px;width: 480px;overflow: hidden;background-color: black;" controls autoplay><source src="IMG/'.$obj[$i]->XVFileName.'" type="video/mp4"></video>
                                        </div>';

                                  }
                                  if($obj[$i]->XVMediaType==4){
                                    
                                       $data='<div style="height: 320px;width: 480px;overflow: hidden;background-color: black;">
                                              <img src="IMG/'.$obj[$i]->XVFileName.'">'.$Label.'
                                           </div>';
                                   }
                                   if($obj[$i]->XVMediaType==5){
                                        $data='<div style="height: 320px;width: 480px;overflow: hidden;background-color: black;">
                                            <iframe style="height: 320px;width: 480px;overflow: hidden;" class="embed-responsive-item w-100" src="RoadMap.php" allowfullscreen></iframe>
                                        </div>';
                                   }
                                   $delay=$obj[$i]->XIDelay*1000;
                                    echo '<div class="carousel-item bg-light '.$active.'" data-bs-interval="'.$delay.'">'.$data.'</div>';
                                        
                                 }
                                 
                              ?>
				
			</div>
		</div>
<script>
$('#Label1').hide();
$('#Label2').hide();
$('#Label3').hide();
$('#Label4').hide();
$('#MyCarousel').on('slide.bs.carousel', function(e) {
    //e.direction     // The direction in which the carousel is sliding (either "left" or "right").
    //e.relatedTarget // The DOM element that is being slid into place as the active item.
    //e.from          // The index of the current item.     
    //e.to            // The index of the next item.
  
    var indexm = '<?php echo $indexmap;?>';
    $('#divlabel').hide(); 
    if ((e.from)+1 == indexm) {
        $('#divlabel').show(); 
    }
    
});
function CheckNewCommand() { 
        $.post("Controller.php",
        {
            Reload:"Reload"
        })
        .done(async function (data) {
            
            const obj = JSON.parse(data);
            if(obj.Status==1){
                
                location.reload();
            }
        });     
}

setInterval(CheckNewCommand, 3000);
function caltime(s){
    
    var ts=Number(s);
    var s=ts/60;
    var strtime="";
   // if(s > 60){
   //     h=s/60;
        
   //     strtime=h.toFixed(0)+" ชั่วโมง";
   // }else{
        strtime=s.toFixed(0)+" นาที";
    //}
    
    return strtime;
    
}
function ShowTime() { 
  
         $.post("Controller.php",
        {
            GetLabel:"GetLabel"
        })
        .done(async function (data) {
            const obj = JSON.parse(data);
            if(obj[0].XBLineShow==1){
               
                $('#Label1').text( caltime(obj[0].XVTime));
                $('#Label1').show();
            } 
            if(obj[1].XBLineShow==1){
                $('#Label2').text( caltime(obj[1].XVTime));
                $('#Label2').show();
            }
            if(obj[2].XBLineShow==1){
                $('#Label3').text( caltime(obj[2].XVTime));
                $('#Label3').show();
            }
            if(obj[3].XBLineShow==1){
                
               
                $('#Label4').text( caltime(obj[3].XVTime));
                $('#Label4').show();
            }
        });     
}
ShowTime();
setInterval(ShowTime, 3000);
</script>
	
</body>
</html>

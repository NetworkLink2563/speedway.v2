<?php
    $XVFileMap="";
    $XVFileLogo="";
    $XVSms1="";
    $XVSms2="";
    $XVSms3="";
    $XVLinkStream="";
    $myfile = fopen("MediaRout.json", "r") or die("Unable to open file!");
    $ret = fread($myfile,filesize("MediaRout.json"));
    fclose($myfile);
    $obj=json_decode($ret);
    for($i=0;$i<count($obj);$i++){    
        $XVFileMap='img/'.$obj[$i]->XVFileMap;
        $XVFileLogo='img/'.$obj[$i]->XVFileLogo;
        $XVSms1=$obj[$i]->XVSms1;
        $XVSms2=$obj[$i]->XVSms2;
        $XVSms3=$obj[$i]->XVSms3;
        $XVLinkStream=$obj[$i]->XVLinkStream;
    }

    $PM25="";
    $Temperature="";
    $myfile = fopen("WeatherSensor.json", "r") or die("Unable to open file!");
    $ret = fread($myfile,filesize("WeatherSensor.json"));
    fclose($myfile);
    $obj=json_decode($ret);
    for($i=0;$i<count($obj);$i++){    
        $PM25=$obj[$i]->XFWstPM25;
        $Temperature=$obj[$i]->XFWstTemperature;
    }
    
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
        color: white;
    }

    .ImgLogo {
        position: absolute;
        top: 0px;
        left: 0px;
    }

    .sms1 {
        position: absolute;
        top: 5px;
        left: 70px;
        font-size: 16px;
    }

    .sms2 {
        position: absolute;
        top: 30px;
        left: 70px;
        font-size: 16px;
    }

    .temperature {
        position: absolute;
        padding: 5px;
        top: 15px;
        left: 400px;
        font-size: 16px;
        border: 2px solid white;
        border-radius: 5px 5px 5px 5px;
    }

    .pm {
        position: absolute;
        padding: 5px;
        top: 232px;
        left: 345px;
        font-size: 16px;
        border: 2px solid white;
        border-radius: 5px 5px 5px 5px;
    }

    .sms3 {
        position: absolute;
        top: 280px;
        left: 5px;
        font-size: 16px;
    }

    .vdo {
        position: absolute;
        top: 68px;
        left: 300px;
        width: 180px;
        border-style: solid;
        border-color: red;
    }

    .canvasr {
        position: absolute;
        top: 68px;
        left: 0px;
        height: 200px;
        width: 300px;
        border: 2px solid yellow;
        opacity: 0.5;
    }

    .map {
        position: absolute;
        top: 68px;
        left: 0px;
        height: 200px;
        width: 300px;

    }
    </style>
</head>

<body style="background-color: white;">


    <div class="box" style="height: 320px;width: 480px;overflow: hidden;background-color: black;">

        <img class="ImgLogo" style="height:60px;width:60" src="<?php echo $XVFileLogo;?>" class="rounded">
        <div class="sms1"><?php echo  $XVSms1;?></div>
        <div class="sms2"><?php echo  $XVSms2;?></div>
        <div class="temperature">Temp=<?php echo $Temperature;?> ํC</div>
        <div class="pm">PM2.5=<?php echo $PM25;?>AQI</div>
        <div class="vdo">
            <iframe class="embed-responsive-item w-100" src="<?php echo $XVLinkStream;?>" allowfullscreen></iframe>
        </div>
        <img class="map" src="<?php echo $XVFileMap;?>">
        <canvas id="CanvasRoute" class="canvasr"></canvas>
        <div class="sms3"><?php echo  $XVSms3;?></div>
    </div>
    <script>
    
    $.post("Controller.php", {
            GetRouteXY: "GetRouteXY"
        })
        .done(function(data) {
            const obj = JSON.parse(data);
            var canvas = document.getElementById("CanvasRoute");
            var ctx = canvas.getContext("2d");
            for (i = 0; i < obj.length; i++) {
                    var color = obj[i].XVColor;
                  
                    var Xs = obj[i].XIX1;
                    var Ys = obj[i].XIY1;
                    var Xe = obj[i].XIX2;
                    var Ye = obj[i].XIY2;
                    var color = obj[i].XVColor;
                  
                    ctx.beginPath();
                    ctx.lineCap = "round";
                    ctx.strokeStyle = color;
                    ctx.moveTo(Xs, Ys);
                    ctx.lineTo(Xe, Ye);
                    ctx.lineWidth = 10;
                    ctx.stroke();
                    console.log(obj[i].XIX1);
                    console.log(obj[i].XIY1);
            }
        });
        
    </script>

</body>

</html>
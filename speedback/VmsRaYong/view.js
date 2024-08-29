var IP1="";
var IP2="";
var IP3="";
var IP4="";
function IPVMS1(){
   
    $.post("Controller.php", 
    {
        VmsCode:'VMS1',
        GetIP:"GetIP"
    })
    .done( function( data ) 
    {  
        const obj = JSON.parse(data);
        IP1=obj[0].XVIP;
        var url="";
        $('#iframe1').attr('src',url);
    });
 }
 function IPVMS2(){
    $.post("Controller.php", 
    {
        VmsCode:'VMS2',
        GetIP:"GetIP"
    })
    .done( function( data ) 
    {  
        const obj = JSON.parse(data);
        if(IP2!=obj[0].XVIP){
            IP2=obj[0].XVIP;
            var url="";
            $('#iframe2').attr('src',url);
        }
    });
 }
 function IPVMS3(){
    $.post("Controller.php", 
    {
        VmsCode:'VMS3',
        GetIP:"GetIP"
    })
    .done( function( data ) 
    {  
        const obj = JSON.parse(data);
        if(IP3!=obj[0].XVIP){
            IP3=obj[0].XVIP;
            var url="";
            $('#iframe3').attr('src',url);
        }
    });
 }
 function IPVMS4(){
    $.post("Controller.php", 
    {
        VmsCode:'VMS4',
        GetIP:"GetIP"
    })
    .done( function( data ) 
    {  
        const obj = JSON.parse(data);
        if(IP4!=obj[0].XVIP){
            IP4=obj[0].XVIP;
            var url="";
            $('#iframe4').attr('src',url);
        }
    });
 }
 IPVMS1();
 IPVMS2();
 IPVMS3();
 IPVMS4();
 setInterval(IPVMS1, 10000);
 setInterval(IPVMS1, 10000);
 setInterval(IPVMS1, 10000);
 setInterval(IPVMS1, 10000);
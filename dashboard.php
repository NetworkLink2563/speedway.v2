<?php
ob_start();
session_start();
include 'header.php';
include "permission.php";

if(checkmenu($user,'001')==0){
    session_destroy();
    header( "location: index.php" );
    exit(0);
}
?>
<style>
    .modal-dialog {
    max-width: 1000px;
  
}
</style>
<div class="centered" style="margin-top: 60;margin-left: 10;">

    <div class="box" style="margin-top: 30" align="center">
        <div style="margin-top:10;margin-bottom: 10;" id="ShowData">
        
                    <?php
                       include "dashboardshow.php";
                      
                    ?>

        </div>
    </div>
</div>

<div class="modal py-5" id="myModal" role="dialog" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color: rgb(3, 84, 138);color:white;">
            <div class="modal-header">
                <h5 id="Example_Title" class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-center" style="">

                <iframe id="iframe_modal" style="border: 0;text-align: center;" src=""></iframe>

            </div>
          
        </div>
    </div>
</div>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->



<script src="dist/js/jquery-3.7.1.js"></script>
<script src="dist/js/popper.min.js"></script>
<script src="dist/js/main_speed.js"></script>
<script src="dist/js/bootstrap.min.js"></script>


<script>
    
    function ShowData(){
         $('#ShowData').empty();
        $.post("dashboardshow.php", function(data, status){
            $('#ShowData').html(data);
        });
    }
    
    function waitforme(millisec) { 
        return new Promise(resolve => { 
            setTimeout(() => { resolve('') }, millisec); 
        }) 
    } 
    var XVVmsCode="";
    var TMPXVMsgCode="";
    async  function ShowSms(){
        let text =  $('#vmscode').val();
        
        const myArray = text.split(",");
        for (let i = 0; i < myArray.length-1; i++) {
            
            
            $.post("dashboadshowsms.php", {vmscode: myArray[i]}, function(result){
               const obj = JSON.parse(result);
               $('#C12'+myArray[i]).text(obj.XVMsgName);
               if(obj.XiSecDiff>600){
                  $('#C0'+obj.XVVmsCode).css("color", "red"); 
               }else{
                  $('#C0'+obj.XVVmsCode).css("color", "green"); 
               }
               $('#C3'+obj.XVVmsCode).text(obj.XBVmsIsOn); 
               $('#C4'+obj.XVVmsCode).text(obj.XBVmsIsDisplay); 
               $('#C5'+obj.XVVmsCode).text(obj.XIVmsBrightness); 
               $('#C6'+obj.XVVmsCode).text(obj.XIVmsRackTemperature); 
               $('#C7'+obj.XVVmsCode).text(obj.XIVmsBoardTemperature); 
               $('#C8'+obj.XVVmsCode).text(obj.XBVmsFanIsActive); 
               $('#C9'+obj.XVVmsCode).text(obj.XBVmsFanIsActive); 
              // $('#C10'+obj.XVVmsCode).text(obj.XVVdtModuleNo); 
             
               if(obj.XVVmsCode==$("#XVVmsCode").val()){
                    if(obj.XVMsgCode!=""&&obj.XVMsgCode!=$("#XVMsgCode").val()){
                        $("#XVMsgCode").val(obj.XVMsgCode);
                        $("#iframe_modal").attr("src", 'ifarme.php?msg='+btoa(obj.XVMsgCode));
                    }
               }
              
            });
            console.log("Hello world!");
            await waitforme(1000);
        }
        ShowSms();    
       
    }
 
    function ShowSample(XVVmsCode,XVVmsName,XVMsgCode,w,h){
      
        $("#iframe_modal").attr("src", '');
        $("#XVVmsCode").val(XVVmsCode);
        $("#XVMsgCode").val(XVMsgCode);
      
        if(XVMsgCode!=""){
           
            $("#Example_Title").text(XVVmsName);
            $("#XVMsgCode").val(XVMsgCode);  
            document.getElementById("iframe_modal").height = h;
            document.getElementById("iframe_modal").width = w;
            $("#iframe_modal").attr("src", 'ifarme.php?msg='+btoa(XVMsgCode));
            $('#myModal').modal('show');
           
           
        }
        
    }
    $(document).ready(async function(){
         ShowSms();
    });


</script>

</body>
</html>

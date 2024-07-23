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

body {
    background: #e1f0fa;
  width: 100%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

.container{
    background-color: white;
}

    table thead th{
        font-size: 1rem;
        font-weight: 450;
    }

    table  th{
        background-color: #e8f4ff!important;
        /* border: 1px solid #cccc; */
    }

    table td{
        font-size: 0.9rem;
        padding: 0.3rem;
        transition: 0.5s;
        /* border: 1px solid #cccc; */
    }

    .table>:not(caption)>*>*{
    padding: 0.7rem;
}

table{
    border: 1px solid #cccc;
}

table td{
        font-size: 0.9rem;
        transition: 0.5s;
        font-weight: 300;
    }

    table th{
        font-size: 1rem;
        font-weight: 500;
    }

</style>




<div class="container" style="position: relative; top: 70;">


<div style="margin: 1rem; text-align: center; margin-bottom: 1rem; border-bottom: 3px double #cccc; padding: 1rem;">
            <img src="http://43.229.151.103/speedway/img/icon/setting.png" height="25" alt="Responsive image">&nbsp;หน้าแดชบอร์ด
        </div>

        <div style="" id="ShowData">
        
                    <?php
                       include "dashboardshow.php";
                    ?>

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

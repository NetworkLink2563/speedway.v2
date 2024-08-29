

function ShowCamera(VmsCode){ 
     $.post( "Controller.php", 
     {
         ShowCamera:"ShowCamera",
         VmsCode:VmsCode  
     })
     .done( function( data ) 
     {   
         $("#ShowCamera").empty();
         $("#ShowCamera").html(data);
         ShowDataTableImage(VmsCode);
     });
 }
 function ShowVms(){
    $.post("Controller.php", 
    {
        PrjCode:$("#SelProject").val(),
        VmsMenu:"VmsMenu"  
    })
    .done( function( data ) 
    {   $("#ShowForm").hide();
        $("#SelVms").empty();
        var VmsCode="";
        const obj = JSON.parse(data);
        for(var i=0;i<obj.length;i++){
            VmsCode=obj[i].XVVmsCode;
            var selected="";
            if(i==0){
                selected="selected";
                $("#ShowForm").show();
            }
            $('#SelVms').append('<option '+selected+' value="'+obj[i].XVVmsCode+'">'+obj[i].XVVmsName+'</option>');
        }
        ShowCamera(VmsCode);
        ShowCamera($( "#SelVms option:selected" ).val());
        
    });
 }
 $("#SelProject").change(function(){
     ShowVms();
 });
 $("#SelVms").change(function(){
    ShowCamera($( "#SelVms option:selected" ).val());
 });
 $(function() {
    
   $("#ShowForm").hide();
   ShowVms();
   ShowCamera($( "#SelVms option:selected" ).val());
 });

 $("#BtnUpPicTure").click(function() {
     var fd = new FormData();
     var files = $('#file')[0].files[0];
     fd.append('file', files);
     fd.append('VMSC', $("#SelVms").val());
     fd.append('UploadFile', 'UploadFile');
     $.ajax({
         url: 'Controller.php',
         type: 'post',
         data: fd,
         contentType: false,
         processData: false,
         success: function(response) {
             alert(response);
             if(response.trim()=="Err1"){
               
                 Swal.fire(
                    "ไม่สามรถบันทึกข้อมูลได้",
                    "",
                    "warning"
                )
                 return false;
             }
             if(response.trim()=="Err2"){
               
                Swal.fire(
                   "ไม่สามรถอัปโหลดข้อมูลได้",
                   "",
                   "warning"
               )
                return false;
            }
             ShowDataTableImage($( "#SelVms option:selected" ).val());  
         },
     });

 });
 function ShowDataTableImage(VmsCode){ 
     $.post( "Controller.php", 
     {
       ShowDataTableImage:'ShowDataTableImage',
       VmsCode:VmsCode
     })
     .done(async function( data ) 
     {  
         $( "#TableBodyImage" ).empty();
         $( "#TableBodyImage" ).html(data);
     });
 } 
 function DeleteImage(p){
    Swal.fire({
        title: "ต้องการลบใช่หรือไม่?",
        //text: "You wont be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "ใช่, ต้องการลบรายการนี้",
        cancelButtonText: "ไม่, ยกเลิก",
        reverseButtons: true
    }).then(function(result) {
        if (result.value) {
            $.post( "Controller.php", 
            {
                DeleteImage:'DeleteImage',
                VmsPictureDTID:p
            })
            .done(async function( data ) 
            {   console.log(data);
                if (data.trim()=="Err1"){
                    Swal.fire(
                        "ไม่สามารถลบ ไอดี" + p +"สำเร็จ",
                        "",
                        "info"
                    )
                    return false;
                }
                Swal.fire(
                    "ลบ ไอดี" + p +"สำเร็จ",
                    "",
                    "success"
                ) 
                ShowDataTableImage($( "#SelVms option:selected" ).val());  
            });     
        } else if (result.dismiss === "cancel") {
            Swal.fire(
                "ยกเลิกการลบ ไอดี" + p +"สำเร็จ",
                "",
                "info"
            )
        }
    });
  
 }

 
 $("#BtnCreatePictureT").click(function() {
     
     $.post("Controller.php", {
             Mode:$("#TextMode").val(),
             PictureId:$("#TextId").val(),
             sms1: $("#tsms1").val(),
             sms2: $("#tsms2").val(),
             sms3: $("#tsms3").val(),
             sms4: $("#tsms4").val(),
             sms5: $("#tsms5").val(),
             sms6: $("#tsms6").val(),
             sms7: $("#tsms7").val(),
             sms8: $("#tsms8").val(),
             color1: $("#csms1").val(),
             color2: $("#csms2").val(),
             color3: $("#csms3").val(),
             color4: $("#csms4").val(),
             color5: $("#csms5").val(),
             color6: $("#csms6").val(),
             color7: $("#csms7").val(),
             color8: $("#csms8").val(),
             fontsize1:$("#selFONT1").val(),
             fontsize2:$("#selFONT2").val(),
             fontsize3:$("#selFONT3").val(),
             fontsize4:$("#selFONT4").val(),
             fontsize5:$("#selFONT5").val(),
             fontsize6:$("#selFONT6").val(),
             fontsize7:$("#selFONT7").val(),
             fontsize8:$("#selFONT8").val(),
          
             VMSC:$( "#SelVms option:selected" ).val(),
             createimg:'createimg'
     }, function(result, status) {
        
        if(status.trim()=="success"){
        
          
            if(result.trim()=="OK"){
                
                $("#TextMode").val("0");
                $("#tsms1").val("");
                $("#tsms2").val("");
                $("#tsms3").val("");
                $("#tsms4").val("");
                $("#tsms5").val("");
                $("#tsms6").val("");
                $("#tsms7").val("");
                $("#tsms8").val("");
                ShowDataTableImage($( "#SelVms option:selected" ).val());  
                Swal.fire({
                    text: "สร้างข้อความรูปภาพสำเร็จ",
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "รับทราบ",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                });
            }
        }else{
            Swal.fire({
                text: "ขออภัย เกิดข้อผิดพลาดบางอย่าง กรุณาลองใหม่อีกครั้ง",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "รับทราบ",
                customClass: {
                    confirmButton: "btn btn-primary"
                }
            });
        }
     });
 });
 $("#BtnSendToVms").click(function(){
   
     $.post( "Controller.php", 
     {
         VmsCode:$( "#SelVms option:selected" ).val(),
         SendToVms:"SendTovms",
     })
     .done(async function( data ) 
     {   
        if(data.trim()=="Success"){
            Swal.fire({
                text: "สร้างข้อความสำเร็จ",
                icon: "success",
                buttonsStyling: false,
                confirmButtonText: "รับทราบ",
                customClass: {
                    confirmButton: "btn btn-primary"
                }
            });       
        }else{
            Swal.fire({
                text: "เกิดข้อผิดพลาดไม่สามรถส่งข้อความได้",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "รับทราบ",
                customClass: {
                    confirmButton: "btn btn-primary"
                }
            });
        }
        
     });
 });
 $("#BtnCreatePictureClearT").click(function(){
    $("#TextMode").val("0");
    $("#tsms1").val("");
    $("#tsms2").val("");
    $("#tsms3").val("");
    $("#tsms4").val("");
    $("#tsms5").val("");
    $("#tsms6").val("");
    $("#tsms7").val("");
    $("#tsms8").val("");
    $("#selFONT1").val(12).change();
    $("#selFONT2").val(12).change();
    $("#selFONT3").val(12).change();
    $("#selFONT4").val(12).change();
    $("#selFONT5").val(12).change();
    $("#selFONT6").val(12).change();
    $("#selFONT7").val(12).change();
    $("#selFONT8").val(12).change();
    $("#ModalImage").show();
    
 });
 $("#BtnCloseModalImage").click(function(){
    $("#ModalImage").hide(); 
});

 function EditImage($PictureId){
    $.post( "Controller.php", 
    {   Mode:$("#TextMode").val(),
        PictureId:$PictureId,
        EditImage:"EditImage",
    })
    .done(async function( data,status ) 
    {   
        if(status.trim()=="success"){
            const obj = JSON.parse(data);    
           
            $("#TextMode").val("1");
            $("#TextId").val(obj[0].XVVmsPictureDTID),
            $("#tsms1").val(obj[0].XVSmsA);
            $("#tsms2").val(obj[0].XVSmsB);
            $("#tsms3").val(obj[0].XVSmsC);
            $("#tsms4").val(obj[0].XVSmsD);
            $("#tsms5").val(obj[0].XVSmsE);
            $("#tsms6").val(obj[0].XVSmsF);
            $("#tsms7").val(obj[0].XVSmsG);
            $("#tsms8").val(obj[0].XVSmsH);
            $("#selFONT1").val(obj[0].XIFontSizeA).change();
            $("#selFONT2").val(obj[0].XIFontSizeB).change();
            $("#selFONT3").val(obj[0].XIFontSizeC).change();
            $("#selFONT4").val(obj[0].XIFontSizeD).change();
            $("#selFONT5").val(obj[0].XIFontSizeE).change();
            $("#selFONT6").val(obj[0].XIFontSizeF).change();
            $("#selFONT7").val(obj[0].XIFontSizeG).change();
            $("#selFONT8").val(obj[0].XIFontSizeH).change();
            $("#ModalImage").show();
        }
    });
    //alert($PictureId);
    /*
    Swal.fire({
        imageUrl: imgpath,
        imageHeight: 400,
       
        imageAlt: 'A tall image'
      })
    */
 }
 $("#BtnUploadPictureNew").click(function(){
  
    $("#ModalUploadImg").show(); 
});
$("#BtnCloseModalUploadImg").click(function(){
   
    $("#ModalUploadImg").hide(); 
});

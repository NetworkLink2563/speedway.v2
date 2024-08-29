/*
//////////// Log Edit ////////////////
FILE NAME : customer.js 
Create By : Sivadol.J 
Log Edit  : Create 08/05/2024    
/////////////////////////////////////
*/



function newcus(){
    var conf = confirm('คุณต้องการสร้างข้อมูลลูกค้าใช่หรือไม่');
    if(conf==true){
        var XVCstCode =$('#XVCstCode').val(); // รหัสลูกค้า
        var XVCstName =$('#XVCstName').val() // ชื่อลูกค้า
        var XVCstDescription=$('#XVCstDescription').val(); // รายละเอียดลูกค้า
        var XVCstPhone=$('#XVCstPhone').val(); // เบอร์โทรลูกค้า
        var XVCstEmail=$('#XVCstEmail').val(); // Email Customer
        var XBCstIsActive=$('#XBCstIsActive').val(); // 1= Active (ใช้งาน), 2 = Not Active (ไม่ใช้งาน)
        if(XVCstName==""){ alert('กรุณาใส่ชื่อลูกค้าด้วยค่ะ');  return false;}
        if(XVCstPhone==""){alert('กรุณากรอกเบอร์โทรติดต่อลูกค้าด้วยค่ะ'); return false;}
        if(XBCstIsActive==""){alert('กรุณาเลือกสถานะด้วยค่ะ'); return false;}
        var dataString ='fn=0001' + '&XVCstCode='+XVCstCode+'&XVCstName='+XVCstName+'&XVCstDescription='+XVCstDescription+'&XVCstPhone='+XVCstPhone
        +'&XVCstEmail='+XVCstEmail+'&XBCstIsActive='+XBCstIsActive;
        $.ajax({type: "POST", url: "../Customer/query/insert_customer.php",
            data: dataString, cache: false,
            success: function (html)
            { 
             if(html==1){
                 location.reload();
             }else if(html==2){
                  alert('ชื่อลูกค้ามีในระบบแล้วค่ะ');
             }else{   
                alert('กรุณาติดต่อเจ้าหน้าที่ดูแลระบบ');
             }

            }
        });
      
    } // end confirm

}

// funtion ลบข้อมูล Customer 
function delcust(val){
     var cond= confirm("คุณต้องการลบข้อมูลลูกค้าใช่หรือไม่");
     if(cond==true){
         var dlid=val;
         var dataString ='del=0001' + '&dlid='+dlid;
         $.ajax({type: "POST", url: "../Customer/query/delete_customer.php",
            data: dataString, cache: false,
            success: function (html)
            { 
             if(html==1){
              location.reload(); 
            }else if(html==2){ // กรณีมีการใช้ข้อมูลในฐานข้อมูล TMstMUser -> XVCstCode]
                alert('ไม่สามารถลบข้อมูลลูกค้าได้ค่ะ เนื่องจากมีการใช้งาน');
            }

            }
        });
     } // end confirm 
}

function edit(val){
    var XVCstCode=val;
    var dataString ='load=0001' + '&XVCstCode='+XVCstCode;
    $.ajax({type: "POST", url: "../Customer/service/service_customer.php",
        data: dataString, cache: false,
            success: function (html)
            { 
                $("#editcustomer").modal();
                var obj = JSON.parse(html);
                $("#XVCstCodex").val(obj.XVCstCode);
                $("#XVCstNamex").val(obj.XVCstName);
                $("#XVCstNamechkx").val(obj.XVCstName);
                $("#XVCstDescriptionx").val(obj.XVCstDescription);
                $("#XVCstPhonex").val(obj.XVCstPhone);
                $("#XVCstEmailx").val(obj.XVCstEmail);
                //var XBCstIsActive = this.options[this.selectedIndex].getAttribute('XBCstIsActive');
                $("#XBCstIsActivex").val(obj.XBCstIsActive);
    
               
            }
    })
}

function editdetail(){
     var conedit = confirm('คุณต้องการแก้่ไขข้อมูลลูกค้าใช่หรือไม่'); 
    if(conedit==true){
     var XVCstCode =$("#XVCstCodex").val();
     var XVCstName =$("#XVCstNamex").val();
     var XVCstNamechk =$("#XVCstNamechkx").val();
     var XVCstDescription =$("#XVCstDescriptionx").val();
     var XVCstPhone =$("#XVCstPhonex").val();
     var XVCstEmail =$("#XVCstEmailx").val();
     var XBCstIsActive =$("#XBCstIsActivex").val();
     if(XVCstName==""){ alert('กรุณาใส่ชื่อลูกค้าด้วยค่ะ');  return false;}
     if(XVCstPhone==""){alert('กรุณากรอกเบอร์โทรติดต่อลูกค้าด้วยค่ะ'); return false;}
     if(XBCstIsActive==""){alert('กรุณาเลือกสถานะด้วยค่ะ'); return false;}

     var dataString ='edit=0001' + '&XVCstCode='+XVCstCode+'&XVCstName='+XVCstName+'&XVCstDescription='+XVCstDescription+'&XVCstPhone='+XVCstPhone
     +'&XVCstEmail='+XVCstEmail+'&XBCstIsActive='+XBCstIsActive + '&XVCstNamechk='+XVCstNamechk;
     $.ajax({type: "POST", url: "../Customer/query/update_customer.php",
         data: dataString, cache: false,
         success: function (html)
         { 
          if(html==1){
              location.reload();
          }else if(html==2){
               alert('ชื่อลูกค้ามีในระบบแล้วค่ะ');
          }else{   
             alert('กรุณาติดต่อเจ้าหน้าที่ดูแลระบบ');
          }

         }
     });
     }  
    }
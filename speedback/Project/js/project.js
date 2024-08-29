/*
//////////// Log Edit ////////////////
FILE NAME : project.js 
Create By : Sivadol.J 
Log Edit  : Create 08/05/2024    
/////////////////////////////////////
*/

function newproj(){
    var conf=confirm('คุณต้องการสร้างข้อมูลโครงการหรือไม่');
    if(conf==true){
     var XVPrjCode=$('#XVPrjCodex').val();
     var XVCstCode=$('#XVCstCodex').val();
     var XVPrjName=$('#XVPrjNamex').val();
     var XVPrjType=$('#XVPrjTypex').val();
     var XVPrjLineToken1=$('#XVPrjLineToken1x').val();
     var XVPrjLineToken2=$('#XVPrjLineToken2x').val();
     var XVPrjDescription=$('#XVPrjDescriptionx').val();
     var dataString='fn=0001'+'&XVPrjCode='+XVPrjCode+'&XVCstCode='+XVCstCode+'&XVPrjName='+XVPrjName+'&XVPrjType='+XVPrjType
     +'&XVPrjLineToken1='+XVPrjLineToken1+'&XVPrjLineToken2='+XVPrjLineToken2 +'&XVPrjDescription='+XVPrjDescription;
     if(XVCstCode==""){ alert('กรุณาเลือกชื่อลูกค้าด้วยค่ะ');  return false;}
     if(XVPrjName==""){alert('กรุณากรอกชื่อโครงการด้วยค่ะ'); return false;}
     if(XVPrjType==""){alert('กรุณาเลือกประเภทโครงการด้วยค่ะ'); return false;}
     
     $.ajax({type: "POST", url: "../Project/query/insert_project.php",
         data: dataString, cache: false,
         success: function (html)
         { 
          if(html==1){
              location.reload();
          }else if(html==2){
               alert('ชื่อโครงการมีในระบบแล้วค่ะ');
          }else{   
             alert('กรุณาติดต่อเจ้าหน้าที่ดูแลระบบ');
          }

         }
     });
    }
 } // end confirm

function delproj(id){
    var  conf = confirm('คุณต้องการลบข้อมูลโครงการหรือไม่');
    if(conf==true){
    var delid = id;
    var dataString='del=0001'+'&delid='+delid;
    $.ajax({type: "POST", url: "../Project/query/delete_project.php",
        data: dataString, cache: false,
        success: function (html)
        { 
            if(html==1){
                location.reload(); 
              }else if(html==2){ // กรณีมีการใช้ข้อมูลในฐานข้อมูล  FROM [NWL_SpeedWayTest2].[dbo].[TMstMSetupPoint] -> XVPrjCode]
                  alert('ไม่สามารถลบข้อมูลลูกค้าได้ค่ะ เนื่องจากมีการใช้งาน');
              }

        }
    });
    }
}


 function editproj(id){
    var idproj=id;
    var dataString='load=0001'+'&idproj='+idproj;
    $.ajax({type: "POST", url: "../Project/service/service_project.php",
        data: dataString, cache: false,
            success: function (html)
            { 
                $("#editproject").modal();
                var obj = JSON.parse(html);
                console.log(obj);
                $("#XVPrjCode").val(obj.XVPrjCode);
                $("#XVCstCode").val(obj.XVCstCode);
                $("#XVPrjName").val(obj.XVPrjName);
                $("#XVPrjNamechk").val(obj.XVPrjName);
                $("#XVPrjDescription").val(obj.XVPrjDescription);
                $("#XVPrjType").val(obj.XVPrjType);
                $("#XVPrjLineToken1").val(obj.XVPrjLineToken1);
                $("#XVPrjLineToken2").val(obj.XVPrjLineToken2);
    
               
            }
    })

 }
function editprojx(){
    var conf=confirm('คุณต้องการแก้ไขข้อมูลโครงการหรือไม่');
    if(conf==true){
     var XVPrjCode=$('#XVPrjCode').val();
     var XVCstCode=$('#XVCstCode').val();
     var XVPrjName=$('#XVPrjName').val();
     var XVPrjNamechk=$('#XVPrjNamechk').val();
     var XVPrjType=$('#XVPrjType').val();
     var XVPrjLineToken1=$('#XVPrjLineToken1').val();
     var XVPrjLineToken2=$('#XVPrjLineToken2').val();
     var XVPrjDescription=$('#XVPrjDescription').val();
     if(XVCstCode==""){ alert('กรุณาเลือกชื่อลูกค้าด้วยค่ะ');  return false;}
     if(XVPrjName==""){alert('กรุณากรอกชื่อโครงการด้วยค่ะ'); return false;}
     if(XVPrjType==""){alert('กรุณาเลือกประเภทโครงการด้วยค่ะ'); return false;}
     var dataString='edit=0001'+'&XVPrjCode='+XVPrjCode+'&XVCstCode='+XVCstCode+'&XVPrjName='+XVPrjName+'&XVPrjType='+XVPrjType
     +'&XVPrjLineToken1='+XVPrjLineToken1+'&XVPrjLineToken2='+XVPrjLineToken2 +'&XVPrjDescription='+XVPrjDescription + '&XVPrjNamechk='+XVPrjNamechk;

     $.ajax({type: "POST", url: "../Project/query/update_project.php",
         data: dataString, cache: false,
         success: function (html)
         { 
          if(html==1){
              location.reload();
          }else if(html==2){
               alert('ชื่อโครงการมีในระบบแล้วค่ะ');
          }else{   
             alert('กรุณาติดต่อเจ้าหน้าที่ดูแลระบบ');
          }

         }
     });
    }
}
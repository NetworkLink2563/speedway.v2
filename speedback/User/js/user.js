/*
//////////// Log Edit ////////////////
FILE NAME :user.js 
Create By : Sivadol.J 
Log Edit  : Create 13/08/2024  
/////////////////////////////////////
*/

//Department User -> Sivadol.J
$(document).ready(function () {

   $('#XVDptName').click(function () {
      var adddpt = document.getElementById('adddpt');
      var btdel = document.getElementById('deldpt');
      btdel.disabled = true;
      adddpt.disabled = false;
      // alert('TEST');
   })
   $("#dptcode").click(function () {
      var val1 = $(this).val();
      var dataString = 'load=0001' + '&val1=' + val1;
      $.ajax({
         type: "POST", url: "../User/service/service_user.php",
         data: dataString, cache: false,
         success: function (html) {
            var objdpt = JSON.parse(html);
            $('#XVDptcodechk').val(objdpt.XVDptCode);
            var btdel = document.getElementById('deldpt');
            var adddpt = document.getElementById('adddpt');
            btdel.disabled = false;
            adddpt.disabled = true;
         }
      });

   });

   $('#adddpt').click(function () {
      var XVDptName = document.getElementById('XVDptName').value;
      var btdel = document.getElementById('deldpt');
      var adddpt = document.getElementById('adddpt');
      if (XVDptName == '') {
         alert('กรุณากรอกข้อมูลให้ครบถ้วนด้วยค่ะ');
      }

      var dataString = 'fn=0001' + '&XVDptName=' + XVDptName;
      $.ajax({
         type: "POST", url: "../User/query/insert_user.php",
         data: dataString, cache: false,
         success: function (html) {
            if (html == 2) {
               alert('มีชื่อแผนกนี้ในระบบแล้ว กรุณาตรวจสอบข้อมูลค่ะ');
               $('#dptcode').val('');
               btdel.disabled = true;
               adddpt.disabled = true;
            } else if (html == 3) {
               alert('กรุณาติดต่อเจ้าหน้าที่ดูแลระบบค่ะ');
               $('#dptcode').val('');
               btdel.disabled = true;
               adddpt.disabled = true;
            } else {
               $('#dptcode').append(html);
               $('#XVDptName').val("");
               btdel.disabled = true;
               adddpt.disabled = true;
            }
         }
      });
   });

   $('#deldpt').click(function () {
      var val1 = document.getElementById('XVDptcodechk').value;
      var dataString = 'del=0001' + '&val1=' + val1;
      $.ajax({
         type: "POST", url: "../User/query/delete_user.php",
         data: dataString, cache: false,
         success: function (html) {
            if (html == 2) {
               alert('ไม่สามารถลบข้อมูลได้ เนื่องจากมีข้อมูลใช้งานอยู่ค่ะ');
            } else {
               var x = document.getElementById("dptcode");
               x.remove(x.selectedIndex);
            }
         }
      });


   });


   // Shift Time -> Sivadol.J
   $('#XVshiftname').click(function () {
      var addshift = document.getElementById('addshift');
      var delshift = document.getElementById('delshift');
      addshift.disabled = false;
      delshift.disabled = true;
   })

   $("#codeshiftlist").click(function () {
      var val1 = $(this).val();
      var dataString = 'load=0002' + '&val1=' + val1;
      $.ajax({
         type: "POST", url: "../User/service/service_user.php",
         data: dataString, cache: false,
         success: function (html) {
            var objdpt = JSON.parse(html);
            $('#codeshift').val(objdpt.XVShfCode);
            var addshift = document.getElementById('addshift');
            var delshift = document.getElementById('delshift');
            addshift.disabled = true;
            delshift.disabled = false;
         }
      });
   });

   $('#addshift').click(function () {

      var XVshiftname = document.getElementById('XVshiftname').value;
      var addshift = document.getElementById('addshift');
      var delshift = document.getElementById('delshift');
      var timestr = document.getElementById('timestart').value;
      var timeend = document.getElementById('timeend').value;
      if (XVshiftname == '' || timestr == '' || timeend == '') {
         alert('กรุณากรอกข้อมูลให้ครบถ้วนด้วยค่ะ');
         return;
      }

      var dataString = 'fn=0002' + '&XVshiftname=' + XVshiftname + '&timestr=' + timestr + '&timeend=' + timeend;
      $.ajax({
         type: "POST", url: "../User/query/insert_user.php",
         data: dataString, cache: false,
         success: function (html) {
            if (html == 2) {
               alert('มีชื่อกะทำงานนี้ในระบบแล้ว กรุณาตรวจสอบข้อมูลค่ะ');
               $('#XVshiftname').val('');
               delshift.disabled = true;
               addshift.disabled = true;
            } else if (html == 3) {
               alert('กรุณาติดต่อเจ้าหน้าที่ดูแลระบบค่ะ');
               $('#XVshiftname').val('');
               delshift.disabled = true;
               addshift.disabled = true;
            } else {
               $('#codeshiftlist').append(html);
               $('#XVshiftname').val("");
               $('#timestart').val("");
               $('#timeend').val("");
               delshift.disabled = true;
               addshift.disabled = true;
            }
         }
      });
   });

   $('#delshift').click(function () {
      var val1 = document.getElementById('codeshift').value;
      var delshift = document.getElementById('delshift');
      var dataString = 'del=0002' + '&val1=' + val1;
      $.ajax({
         type: "POST", url: "../User/query/delete_user.php",
         data: dataString, cache: false,
         success: function (html) {
            if (html == 2) {
               alert('ไม่สามารถลบข้อมูลได่ เนื่องจากมีข้อมูลใช้งานอยู่ค่ะ');
            } else {
               var x = document.getElementById("codeshiftlist");
               x.remove(x.selectedIndex);
               delshift.disabled = true;
            }
         }
      });


   });

   $('#pri_user').select2({
      placeholder: "Set permissions", 
      allowClear: true,
      templateSelection: function(selection) {
         if(selection.id) {
             return $('<span id="pri' + selection.id + '"  value="'+selection.id+'" onclick="dellist(this.value);" >' + selection.text + '</span>');
         }
         return selection.text;
     }
   
   });

   $('#pri_user').on('change', function() {
      var selectedValues = $(this).val();
      if (selectedValues) {
               if (selectedValues.includes('0')) {
              // If '0' is selected, update with value 0 only
                 var updatedValues = ['0'];
                 $(this).val(updatedValues).trigger('change.select2'); 
                 // Perform AJAX POST request to update with value 0
                 $('#prival').val(updatedValues);
               } else {
                  // Remove '0' from selectedValues
                  var filteredValues = selectedValues.filter(function(value) {
                  return value !== '0';
               });
               // Perform AJAX POST request to update with selected values excluding '0'
               $('#prival').val(filteredValues);
          }
      }
  });
  /// edit 
$('#pri_user_e').on('change', function() {
   var selectedValues = $(this).val();
   if (selectedValues) {
            if (selectedValues.includes('0')) {
           // If '0' is selected, update with value 0 only
              var updatedValues = ['0'];
              $(this).val(updatedValues).trigger('change.select2'); 
              // Perform AJAX POST request to update with value 0
              $('#editprival').val(updatedValues);
            } else {
               // Remove '0' from selectedValues
               var filteredValues = selectedValues.filter(function(value) {
               return value !== '0';
            });
            // Perform AJAX POST request to update with selected values excluding '0'
            $('#editprival').val(filteredValues);
       }
   }
});
  
});



function addpri() {
   var conf = confirm("คุณต้องการเพิืมสิทธิ์การใช้งานใช่หรือไม่");
   if(conf==true){
   var idpri =  $('#prival').val(); 
   var idmenu = $('#menuid').val();
   var usrpri= $('#usrpri').val();
   if(idpri==""){alert('กรุณาเลือกสิทธิ์การใช้งานด้วยค่ะ');return;} // ตรวจสอบค่าว่าง ก่อนบันทึกข้อมูล
   if(idmenu==""){alert('กรุณาเลือกเมนูด้วยค่ะ');return;}
   if(usrpri==""){alert('กรุณาเลือกผู้ขอสิทธิ์การใช้งานด้วยค่ะ');return;}
   var dataString = 'fn=0004'+ '&idmenu='+idmenu+'&idpri='+idpri + '&usrpri=' +usrpri ;
   $.ajax({type: "POST", url: "../User/query/insert_user.php",
      data: dataString, cache: false,
      success: function (html) {
           if(html==1){
              location.reload();
          }
      }
   });
 }
}

function getproj() {
   var selectElement = document.getElementById("XVUsrDefaultPrj");
   $('#XVUsrDefaultPrj').empty();
   var val1 = document.getElementById('idcust').value;
   var dataString = 'load=0003' + '&val1=' + val1;
   $.ajax({
      type: "POST", url: "../User/service/service_user.php",
      data: dataString, cache: false,
      success: function (html) {
         var objdpt = JSON.parse(html);
         var newOptionl = document.createElement("option");
         newOptionl.text = 'เลือกชื่อโครงการ';
         newOptionl.value = '';
         selectElement.appendChild(newOptionl);
         for (var i = 0; i < objdpt.length; i++) {
            var obj = objdpt[i];
            // Create a new option element
            var newOption = document.createElement("option");
            newOption.text = obj.XVPrjName;
            newOption.value = obj.XVPrjCode;
            // Append the new option to the select element
            selectElement.appendChild(newOption);
         }
      }
   });

}
function newuser() {
   var conf = confirm('คุณต้องการสร้างข้อมูลผู้ใช้งานหรือไม่');
   if (conf == true) {
      var XVUsrCode = $('#XVUsrCode').val();
      var XVUsrPwd = $('#XVUsrPwd').val();
      var XVUsrName = $('#XVUsrName').val();
      var XVUsrPhone = $('#XVUsrPhone').val();
      var idcust = $('#idcust').val();
      var XVUsrDefaultPrj = $('#XVUsrDefaultPrj').val();
      var XVShfCode = $('#XVShfCode').val();
      var XBUsrIsActive = $('#XBUsrIsActive').val();
      var XBUsrIsCstAdmin = $('#XBUsrIsCstAdmin').val();
      var XVDptCode = $('#XVDptCode').val();

      if (XVUsrCode == '') { alert('กรุณากรอกข้อมูลอีเมลผู้ใช้งานให้ครบถ้วนด้วยค่ะ'); return; }
      if (XVUsrName == '') { alert('กรุณากรอกข้อมูลชื่อผู้ใช้งานให้ครบถ้วยด้วยค่ะ'); return; }
      if (XVDptCode == '') { alert('กรุณาเลือกแผนกด้วยค่ะ'); return; }
      if (idcust == '') { alert('กรุณากรอกข้อมูลชื่อลูกค้าให้ครบถ้วนด้วยค่ะ'); return; }
      if (XVUsrDefaultPrj == '') { alert('กรุณากรอกข้อมูลชื่อโครงการให้ครบถ้วนด้วยค่ะ'); return; }
      if (XBUsrIsCstAdmin == '') { alert('กรุณากรอกข้อมูลสถานะผู้ใช้งานให้ครบถ้วนด้วยค่ะ'); return; }
      if (XVShfCode == '') { alert('กรุณากรอกข้อมูลกะทำงานให้ครบถ้วนด้วยค่ะ'); return; }
      var dataString = 'fn=0003' + '&XVUsrCode=' + XVUsrCode + '&XVUsrPwd=' + XVUsrPwd + '&XVUsrName=' + XVUsrName + '&XVUsrPhone=' + XVUsrPhone
         + '&idcust=' + idcust + '&XVShfCode=' + XVShfCode + '&XBUsrIsActive=' + XBUsrIsActive + '&XBUsrIsCstAdmin=' + XBUsrIsCstAdmin
         + '&XVDptCode=' + XVDptCode + '&XVUsrDefaultPrj=' + XVUsrDefaultPrj;
      $.ajax({
         type: "POST", url: "../User/query/insert_user.php",
         data: dataString, cache: false,
         success: function (html) {
            if (html == 1) {
               location.reload();
            } else {
               alert('กรุณาติดต่อเจ้าหน้าที่ดูแลระบบ');
            }
         }
      });
   }

}
function edituser(val) {
   var XVUsrCode = val;
   var selectElement = document.getElementById("XVUsrDefaultPrjx");
   var dataString = 'load=0004' + '&val1=' + XVUsrCode;
   $.ajax({
      type: "POST", url: "../User/service/service_user.php",
      data: dataString, cache: false,
      success: function (html) {
         $("#edituser").modal();
         var obj = JSON.parse(html);
         for (var i = 0; i < obj.length; i++) {
            var obj = obj[i];
            $("#idcustx").val(obj.XVCstCode);
            $("#XVDptCodex").val(obj.XVDptCode);
            $("#XVShfCodex").val(obj.XVShfCode);
            $("#XVUsrCodex").val(obj.XVUsrCode);
            var newOption = document.createElement("option");
            if (obj.XVPrjName == null) { var txt = 'เลือกโครงการ'; } else { var txt = obj.XVPrjName; }
            newOption.text = txt;
            newOption.value = obj.XVPrjCode;  // Append the new option to the select element
            selectElement.appendChild(newOption);  // $("#XVUsrDefaultPrjx").val(obj.XVPrjName);
            $("#XVUsrNamex").val(obj.XVUsrName);
            $("#XVUsrPhonex").val(obj.XVUsrPhone);
            $("#XVUsrPwdx").val(obj.XVUsrPwd);
            $("#XBUsrIsActivex").val(obj.XBUsrIsActive);
            $("#XBUsrIsCstAdminx").val(obj.XBUsrIsCstAdmin);
            $('#XVShfCodex').val(obj.XVShfCode);
         }

      }
   })
}
function editgetproj() {
   var selectElement = document.getElementById("XVUsrDefaultPrjx");
   $('#XVUsrDefaultPrjx').empty();
   var val1 = document.getElementById('idcustx').value;
   var dataString = 'load=0003' + '&val1=' + val1;
   $.ajax({
      type: "POST", url: "../User/service/service_user.php",
      data: dataString, cache: false,
      success: function (html) {
         var objdpt = JSON.parse(html);
         var newOptionl = document.createElement("option");
         newOptionl.text = 'เลือกชื่อโครงการ';
         newOptionl.value = '';
         selectElement.appendChild(newOptionl);
         for (var i = 0; i < objdpt.length; i++) {
            var obj = objdpt[i];    //Create a new option element
            var newOption = document.createElement("option");
            newOption.text = obj.XVPrjName;
            newOption.value = obj.XVPrjCode;  //Append the new option to the select element
            selectElement.appendChild(newOption);
         }
      }
   });
}
function editliuser() {
   var conf = confirm("คุณต้องการแก้ไขข้อมูลใช่หรือไม่");
   if (conf == true) {
      var XVUsrCodex = $('#XVUsrCodex').val();
      var XVUsrPwdx = $('#XVUsrPwdx').val();
      var XVUsrNamex = $('#XVUsrNamex').val();
      var XVUsrPhonex = $('#XVUsrPhonex').val();
      var XVDptCodex = $('#XVDptCodex').val();
      var idcustx = $('#idcustx').val();
      var XVUsrDefaultPrjx = $('#XVUsrDefaultPrjx').val();
      var XVShfCodex = $('#XVShfCodex').val();
      var XBUsrIsActivex = $('#XBUsrIsActivex').val();
      var XBUsrIsCstAdminx = $('#XBUsrIsCstAdminx').val();
      var dataString = 'edit=0001' + '&XVUsrCodex=' + XVUsrCodex + '&XVUsrPwdx=' + XVUsrPwdx + '&XVUsrNamex=' + XVUsrNamex + '&XVUsrPhonex=' + XVUsrPhonex
         + '&XVDptCodex=' + XVDptCodex + '&idcustx=' + idcustx + '&XVUsrDefaultPrjx=' + XVUsrDefaultPrjx + '&XVShfCodex=' + XVShfCodex + '&XBUsrIsActivex=' + XBUsrIsActivex
         + '&XBUsrIsCstAdminx=' + XBUsrIsCstAdminx;
      if (XVUsrCodex == '') { alert('กรุณากรอกข้อมูลอีเมลผู้ใช้งานให้ครบถ้วนด้วยค่ะ'); return; }
      if (XVUsrNamex == '') { alert('กรุณากรอกข้อมูลชื่อผู้ใช้งานให้ครบถ้วยด้วยค่ะ'); return; }
      if (XVDptCodex == '') { alert('กรุณาเลือกแผนกด้วยค่ะ'); return; }
      if (idcustx == '') { alert('กรุณากรอกข้อมูลชื่อลูกค้าให้ครบถ้วนด้วยค่ะ'); return; }
      if (XVUsrDefaultPrjx == '') { alert('กรุณากรอกข้อมูลชื่อโครงการให้ครบถ้วนด้วยค่ะ'); return; }
      if (XBUsrIsCstAdminx == '') { alert('กรุณากรอกข้อมูลสถานะผู้ใช้งานให้ครบถ้วนด้วยค่ะ'); return; }
      if (XVShfCodex == '') { alert('กรุณากรอกข้อมูลกะทำงานให้ครบถ้วนด้วยค่ะ'); return; }
      $.ajax({
         type: "POST", url: "../User/query/update_user.php",
         data: dataString, cache: false,
         success: function (html) {
            if (html == 1) {
               alert('แก้ไขข้อมูลผู้ใช้งานสำเร็จ');
               location.reload();
            } else {
               alert('ไม่สามารถแก้ไขข้อมูลผู้ใช้งานได้ กรุณาติดต่อเจ้าหน้าที่ดูแลระบบ');
            }

         }
      })

   }
}

function editpri(userval, valmenu,userpri,menuide){
   var dataString = 'load=0005' + '&userval=' + userval + '&valmenu=' + valmenu;
   $.ajax({
      type: "POST", url: "../User/service/service_user.php",
      data: dataString, cache: false,
      success: function (html) {
         $("#editprivl").modal();
         $('#pri_user_e').select2();
         $('#editprival').val(html);
         $('#usrprie').val(userpri);
         $('#menuide').val(menuide);
         $('#pri_user_e').val(html).trigger('change');
      }
   });
}

function editprix(){
   var confe= confirm("คุณต้องการแก้ไขสิทธิ์การใช้งานใช่หรือไม่");
   if(confe==true){
   var idpri =  $('#editprival').val(); 
   var idmenu = $('#menuide').val();
   var usrpri= $('#usrprie').val();
   if(idpri==""){alert('กรุณาเลือกสิทธิ์การใช้งานด้วยค่ะ');return;} // ตรวจสอบค่าว่าง ก่อนบันทึกข้อมูล
   if(idmenu==""){alert('กรุณาเลือกเมนูด้วยค่ะ');return;}
   if(usrpri==""){alert('กรุณาเลือกผู้ขอสิทธิ์การใช้งานด้วยค่ะ');return;}
   var dataString = 'fn=0005'+ '&idmenu='+idmenu+'&idpri='+idpri + '&usrpri=' +usrpri ;
   $.ajax({type: "POST", url: "../User/query/insert_user.php",
      data: dataString, cache: false,
      success: function (html) {
           if(html==1){
              location.reload();
          }
      }
   });
 }
}
function deltpri(userval, valmenu,userpri,menuide){
   var conf = confirm('คุณต้องการลบสิทธิ์การใช้งานใช่หรือไม่');
   if(conf==true){
   var xvusercode = userval;
   var xvmenucode = valmenu;
   var dataString = 'del=0003'+ '&xvusercode='+xvusercode+'&xvmenucode='+xvmenucode ;
   $.ajax({type: "POST", url: "../User/query/delete_user.php",
      data: dataString, cache: false,
      success: function (html) {
           if(html==1){
              location.reload();
          }
      }
   });
   }
}
function ShowDataTable() {
    $("#TableBody").empty();
    $.post("Controller.php",
        {
            PrjCode: $("#Sel_PrjCode").val(),
            ShowBodyTable: "ShowBodyTable"
        })
        .done(async function (data) {
            obj = JSON.parse(data);
            $('#table').DataTable({
                data: obj,
                columns: [
                    { data: 'A' },
                    { data: 'B' },
                    { data: 'C' },
                    { data: 'D' },
                    { data: 'E' }

                ],
                "columnDefs": [
                    { "width": "10%", "targets": 0 },
                    { "width": "40%", "targets": 1 },
                    { "width": "20%", "targets": 2 },
                    { "width": "10%", "targets": 3 },
                    { "width": "10%", "targets": 4 }
                ],
                lengthChange: false,
                "bDestroy": true
            });
        });
}
function FuDelete(Code, Type) {
    Swal.fire({
        title: 'ต้องการลบ ' + Code + ' ใช่หรือไม่?',
        showDenyButton: true,
        confirmButtonText: 'Yes',
        denyButtonText: 'No',
        customClass: {
            actions: 'my-actions',
            confirmButton: 'order-2',
            denyButton: 'order-3',
        }
    }).then((result) => {
        if (result.isConfirmed) {
            $.post("Controller.php",
                {
                    MediaVmsCode: Code,
                    Type: Type,
                    Delete: "Delete"
                })
                .done(async function (data) {
                    ShowDataTable();
                });
        }
    });

}
function FuEdit(Code, Type) {
    if (Type == 1) {
            $.post("Controller.php",
            {
                MediaVmsCode: Code,
                Search: "Search"
            })

            .done(async function (data) {
                const obj = JSON.parse(data);
                $("#HeaderTitle").text('แก้ไขข้อความ');
                $("#TxtMediaVmsCode").val(obj[0].XVMediaVmsCode);
                $("#TxtMode").val('1');
                $("#TxtType").val(Type);
                $("#TxtMediaName").val(obj[0].XVMediaName);
                CKEDITOR.instances.TxtSms.setData(obj[0].XVSms);
                $("#myModal").modal('toggle');
            });
    }else{
        if (Type == 2||Type == 3||Type == 4||Type == 5) {
          
            $.post("Controller.php",
            {
                MediaVmsCode: Code,
                Search: "Search"
            })

            .done(async function (data) {
                const obj = JSON.parse(data);
            
                var url=obj[0].XVPrjCode+'/'+obj[0].XVFileName;
                
                if(Type == 2||Type==4||Type==5){
                    Swal.fire({
                        title: '',
                        text: obj[0].XVMediaName,
                        imageUrl: url,
                        imageWidth: 400,
                        imageHeight: 200,
                        imageAlt: 'Custom image',
                    })
                }    
                if(Type == 3){
                    Swal.fire({
                        title: '',
                     
                        html:
                          '<iframe style="overflow: hidden;" class="responsive-iframe" src="'+url+'"></iframe>',
                        showCloseButton: false,
                        showCancelButton: false,
                        focusConfirm: false,
                     
                        
                      })
                }
            });
        
        }
     
    }
}


$("#Sel_PrjCode").change(function () {
    ShowDataTable();
});
$("#BtnAdd").click(function () {
    $("#HeaderTitle").text('สร้างข้อความใหม่');
    $("#TxtMediaVmsCode").val('MDVYY-XXXXX');
    $("#TxtMediaName").val('');
    $("#TxtSms").val('');
    $("#TxtMode").val('0');
    $("#TxtType").val('1');
    $("#myModal").modal('toggle');
});
$("#BtnAdd").click(function () {
    $("#myModal").modal('toggle');
   
});   
$("#BtnAddImg").click(function () {
 
    $("#ModalUploadImg").modal('toggle');
   
});
$("#BtnAddVdo").click(function () {
 
    $("#ModalUploadVdo").modal('toggle');
   
});  
$("#BtnAddTemplate").click(function () {
 
    $("#ModalUploadTemplate").modal('toggle');
   
}); 
$("#BtnAddTemplateMap").click(function () {
 
    $("#ModalUploadTemplateMap").modal('toggle');
   
}); 

$("#BtnUpPicTure").click(function() {
    var fd = new FormData();
    fd.append('file', $('#file')[0].files[0]);
    fd.append('PrjCode', $("#Sel_PrjCode").val());
    fd.append('MediaVmsCode', $("#TxtMediaVmsCode").val());
    fd.append('MediaName', $("#TxtMediaName2").val());
    fd.append('UploadFile', 'UploadFile');
    $.ajax({
        url: 'Controller.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response) {
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
                  "ไม่สามรถอัปโหลดรูปภาพได้",
                  "",
                  "warning"
              )
               return false;
           }
           ShowDataTable();
           $("#ModalUploadImg").modal('toggle'); 
           
        },
    });

});
$("#BtnUpVdo").click(function() {
    var fd = new FormData();
    fd.append('file', $('#file3')[0].files[0]);
    fd.append('PrjCode', $("#Sel_PrjCode").val());
    fd.append('MediaVmsCode', $("#TxtMediaVmsCode").val());
    fd.append('MediaName', $("#TxtMediaName3").val());
    fd.append('UploadVdo', 'UploadVdo');
    $.ajax({
        url: 'Controller.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response) {
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
                  "ไม่สามรถอัปโหลดรูปภาพได้",
                  "",
                  "warning"
              )
               return false;
           }
           ShowDataTable();
           $("#ModalUploadVdo").modal('toggle'); 
           
        },
    });

});
$("#BtnUpTemplate").click(function() {
    var fd = new FormData();
    fd.append('file', $('#file4')[0].files[0]);
    fd.append('PrjCode', $("#Sel_PrjCode").val());
    fd.append('MediaVmsCode', $("#TxtMediaVmsCode").val());
    fd.append('MediaName', $("#TxtMediaName4").val());
    fd.append('UploadTemplate', 'UploadTemplate');
    $.ajax({
        url: 'Controller.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response) {
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
                  "ไม่สามรถอัปโหลดรูปภาพได้",
                  "",
                  "warning"
              )
               return false;
           }
           ShowDataTable();
           $("#ModalUploadTemplate").modal('toggle'); 
           
        },
    });
});

$("#BtnUpTemplateMap").click(function() {
  
    var fd = new FormData();
    fd.append('file', $('#file5')[0].files[0]);
    fd.append('PrjCode', $("#Sel_PrjCode").val());
    fd.append('MediaVmsCode', $("#TxtMediaVmsCode").val());
    fd.append('MediaName', $("#TxtMediaName5").val());
    fd.append('UploadTemplateMap', 'UploadTemplateMap');
    $.ajax({
        url: 'Controller.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response) {
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
                  "ไม่สามรถอัปโหลดรูปภาพได้",
                  "",
                  "warning"
              )
               return false;
           }
           ShowDataTable();
           $("#ModalUploadTemplateMap").modal('toggle'); 
           
        },
    });
});
$("#FormAction").submit(function (event) {
    event.preventDefault();

    $.post("Controller.php",
        {
            PrjCode: $("#Sel_PrjCode").val(),
            MediaVmsCode: $("#TxtMediaVmsCode").val(),
            MediaName: $("#TxtMediaName").val(),
            Sms: CKEDITOR.instances.TxtSms.getData(),
            Type: $("#TxtType").val(),
            Mode: $("#TxtMode").val(),
            InserUpdateSms: "InserUpdateSms"
        })
        .done(async function (data) {
            ShowDataTable();
            $("#myModal").modal('toggle');
        });
});

$(function () {
    ShowDataTable();
    $.extend(true, $.fn.dataTable.defaults, {
        "language": {
            "sProcessing": "กำลังดำเนินการ...",
            "sLengthMenu": "แสดง_MENU_ แถว",
            "sZeroRecords": "ไม่พบข้อมูล",
            "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
            "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
            "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
            "sInfoPostFix": "",
            "sSearch": "",
            "sUrl": "",
            "oPaginate": {
                "sFirst": "เิริ่มต้น",
                "sPrevious": "ก่อนหน้า",
                "sNext": "ถัดไป",
                "sLast": "สุดท้าย"
            }
        }
    });

    $('#table').dataTable({
        "searching": true,
        "bLengthChange": false
    });
});



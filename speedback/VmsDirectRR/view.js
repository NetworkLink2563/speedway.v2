


async  function ShowVms() {
    $.post("Controller.php",
        {
            PrjCode: $("#SelProject").val(),
            VmsMenu: "VmsMenu"
        })
        .done(async  function (data) {
            $("#ShowForm").hide();
            $("#SelVms").empty();
            var VmsCode = "";
            const obj = JSON.parse(data);
            for (var i = 0; i < obj.length; i++) {
                VmsCode = obj[i].XVVmsCode;
                var selected = "";
                if (i == 0) {
                    selected = "selected";
                    $("#ShowForm").show();
                }
                $('#SelVms').append('<option ' + selected + ' value="' + obj[i].XVVmsCode + '">' + obj[i].XVVmsName + '</option>');
            }
            waitforme(1000);
            MediaSetTable($('#SelVms').val());
            ShowCamera($( "#SelVms" ).val());
          

        });
}
$("#SelProject").change(function () {
    ShowVms();
    MediaProject();
    MediaSetTable($('#SelVms').val());
    ShowCamera($( "#SelVms" ).val());
});
$("#SelVms").change(function () {
    ShowCamera($( "#SelVms" ).val());
    MediaSetTable($('#SelVms').val());
});
$(function () {
    MediaProject();
    ShowVms();
    
    $('#table2').dataTable( {
        "ordering": false
    });
});
function ShowCamera(){
   
    $.post("Controller.php",
    {
        VmsCode: $("#SelVms").val(),
        ShowCamera: "ShowCamera",
    })
    .done(async function (data) {
       
       $("#iframeID").attr('src',data);
    });
  
}

function SetDelay(ID) {
    Swal.fire({
        title: "บันทึกเวลาที่ต้องการหน่วง(วินาที)",
        input: 'number',
        showCancelButton: true
    }).then((result) => {

        if (result.isConfirmed) {
            $.post("Controller.php",
                {
                    SetMediaDelay:"SetMediaDelay",
                    ID:ID,
                    Delay:result.value
                })
                .done(function (data) {
                    MediaSetTable($('#SelVms').val());
                });
        }
    });

}

function MediaProject() {
    $('#tbodytable1').empty();
    $.post("Controller.php",
        {
            MediaProject: 'MediaProject',
            PrjCode: $("#SelProject").val()
        })
        .done(async function (data) {

            obj = JSON.parse(data);
            $('#table1').DataTable({
                data: obj,
                columns: [
                    { data: 'A' },
                    { data: 'B' },
                    { data: 'C' }
                ],
                "columnDefs": [
                    { "width": "60%", "targets": 0 },
                    { "width": "20%", "targets": 1 },
                    { "width": "20%", "targets": 2 },

                ],
                lengthChange: false,
                "bDestroy": true
            });
        });
}
function MediaSetTable(VmsCode) {
    $('#tbodytable2').empty();
    $.post("Controller.php",
        {
            MediaSetTable: 'MediaSetTable',
            VmsCode: VmsCode
        })
        .done(async function (data) {
          
            obj = JSON.parse(data);
            $('#table2').DataTable({
                data: obj,
                columns: [
                    { data: 'A' },
                    { data: 'B' },
                    { data: 'C' },
                    { data: 'D' }
                ],
                "columnDefs": [
                    { "width": "40%", "targets": 0 },
                    { "width": "20%", "targets": 1 },
                    { "width": "10%", "targets": 2 },
                    { "width": "10%", "targets": 3 }
                ],
                "ordering": false,
                lengthChange: false,
                "bDestroy": true
            });
        });
}

$("#BtnInsert").click(function () {
    const MediaCode = [];
    var i=0
    $('input[name^="Ck"]').each(function () {
        if (this.checked == true){
            MediaCode[i] = $(this).val();
            i=i+1;
        }    
    });
    $.post("Controller.php",
    {
        InsertMediaSet:"InsertMediaSet",
        MediaVmsCode:MediaCode,
        VmsCode:$('#SelVms').val(),
        Delay:5
    })
    .done(function (data) {
        MediaSetTable($('#SelVms').val());
    });
  
});

$("#BtnDelete").click(function () {
    const ID = [];
    var i=0
    $('input[name^="Cks"]').each(function () {
        if (this.checked == true){
            ID[i] = $(this).val();
            i=i+1;
        }
    });
    $.post("Controller.php",
    {   
        DeleteMediaSet:"DeleteMediaSet",
        ID:ID
    })
    .done(function (data) {
        MediaSetTable($('#SelVms').val());
    });
});
$("#BtnView").click(function () { 
   
    $("#myModal").show();
    play();
});
$("#BtnCloseView").click(function () {  
    $("#myModal").hide();
});
$("#BtnShowCamera").click(function () {  
    $("#myModalShowCamera").show();
});
$("#BtnCloseShowCamera").click(function () {  
    $("#myModalShowCamera").hide();
});

function waitforme(millisec) {
    return new Promise(resolve => {
        setTimeout(() => {
            resolve('')
        }, millisec);
    })
}

async function play() {
    $.post("Controller.php",
    {
        SampleMediaSetTable:"SampleMediaSetTable",
        VmsCode:$('#SelVms').val(),
    })
    .done(async function (data) {
        const obj = JSON.parse(data);
        for (let i = 0; i < obj.length; i++) {
            var url="../VmsDirectM/"+obj[i].XVPrjCode+"/"+obj[i].XVFileName;
            console.log(url);
            if(obj[i].XVMediaType>1){
                
                var frame='<iframe id="ShowFrame" style="height: 288px;width: 384px;" class="embed-responsive-item" src="'+url+'" allowfullscreen></iframe>';
                $("#ShowDiv" ).html(frame);
                
                await waitforme(obj[i].XIDelay*1000);
            }else{
               
                $("#ShowDiv" ).html(obj[i].XVSms);
               
                await waitforme(obj[i].XIDelay*1000);
            }
        }
    });
       
        
}

$("#BtnSendToVms").click(function () { 
    
    $.post("Controller.php",
    {   
        MqttPublish:"MqttPublish",
        VmsCode:$( "#SelVms" ).val()
    })
    .done(function (data) {
        
         if(data.trim()=="Success"){
            
            Swal.fire({
                text: "ส่งคำสั่งเสร็จสมบูรณ์",
                icon: "success",
                buttonsStyling: false,
                confirmButtonText: "รับทราบ",
                customClass: {
                    confirmButton: "btn btn-primary"
                }
            });
         }
    });
    
});


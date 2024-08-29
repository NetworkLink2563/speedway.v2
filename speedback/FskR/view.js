

function ShowSubMenu() {

    $.post("Controller.php",
        {
            PrjCode: $("#SelProject").val(),
            PrjCode: $("#SelProject").val(),
            StrDate: $("#datepicker").val(),
            ShowSubMenu: "ShowSubMenu"
        })
        .done(function (data) {
            alert(data);
            $("#ShowChart").hide();
            $("#SelSubMenu").empty();
            const obj = JSON.parse(data);
            for (var i = 0; i < obj.length; i++) {
                $("#ShowChart").show();
                $('#SelSubMenu').append('<option value="' + obj[i].XVFskNodeCode + '">' + obj[i].XVFskNodeName + '</option>');
            }
        });
}
function ShowStatus() {

    $("#TableBody").empty();
    $("#ShowChart").hide();
    $.post("Controller.php",
        {
            PrjCode: $("#SelProject").val(),
            StrDate: $("#datepicker").val(),
            ShowTableStatus: "ShowTableStatus"
        })
        .done(function (data) {
           
            obj = JSON.parse(data);
            if (obj.length > 0) {
                $("#ShowChart").show();


                $("#TextOn").val(0);
                $("#TextOff").val(0);

                $('#table').DataTable({
                    data: obj,
                    columns: [
                        { data: 'A' },
                        { data: 'B' },
                        { data: 'C' }

                    ],
                    "columnDefs": [
                        { "width": "60%", "targets": 0 },
                        { "width": "20%", "targets": 0 },
                        { "width": "20%", "targets": 1 }

                    ],
                    lengthChange: false,
                    "bDestroy": true
                });

            }
        });
}
function LampOnOFF() {
    $("#TextOn").val( 0);
    $("#TextOff").val(0);
    $.post("Controller.php",
        {
            PrjCode: $("#SelProject").val(),
            StrDate: $("#datepicker").val(),
            LampOnOFF: "LampOnOFF"
        })
        .done(function (data) {
           
            obj = JSON.parse(data);
    
            $("#TextOn").val( obj.ON)
            $("#TextOff").val(obj.OFF)
            
        });

}
$("#SelProject").change(function () {
    ShowStatus();
    LampOnOFF();
    ShowChart2();

});
$("#datepicker").change(function () {
    ShowStatus();
    LampOnOFF();
   
    //ShowSubMenu();

});

$("#SelSubMenu").change(function () {

});
$(function () {
  
    $('#datepicker').datepicker({
        dateFormat: 'yy-mm-dd'
  });
    $("#ShowChart").hide();
    ShowStatus();
    LampOnOFF();
    //ShowSubMenu();
    

});
$("#BtnDeviceStatus").click(function () {
    ShowStatus();
    LampOnOFF();
    $("#myModal").show();

});
$("#BtnMyModalClose").click(function () {
    $("#myModal").hide();

});




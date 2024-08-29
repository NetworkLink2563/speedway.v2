

function ShowSubMenu() {
    $.post("Controller.php",
        {
            PrjCode: $("#SelProject").val(),
            ShowSubMenu: "ShowSubMenu"
        })
        .done(function (data) {
            $("#SelSubMenu").empty();
            $('#SelSubMenu').append(data);

        });
}
$("#SelProject").change(function () {
    ShowSubMenu();

});


$("#SelProject").change(function () {
    var ProjectCode = $("#SelProject").val();
    var DeviceType = $("#SelDeviceType").val();
    ShowMap(ProjectCode, DeviceType);
});
$("#SelSubMenu").change(function () {
    var ProjectCode = $("#SelProject").val();
    var DeviceType = $("#SelSubMenu option:selected").val();
    ShowMap(ProjectCode, DeviceType);
});

function alertt() {
    alert("Hello")
}
function ShowMap(ProjectCode, DeviceType) {
    Camera();
    SpeedEn();
    Vms();
    Rada();
    Fsk();

}

function Camera() {
    if ($("#SelSubMenu option:selected").val() == 1) {

        $.post("Controller.php",
            {
                Camera: 'Camera',
                ProjectCode: $("#SelProject").val()
            })
            .done(function (data) {
                const obj = JSON.parse(data);
                for (i = 0; i < obj.length; i++) {
                    var iconpicture = 'Cameras.png';
                    var devicename = obj[i].XVFskName;
                    if (i == 0) {
                        var mapOptions = {
                            center: { lat: obj[i].XFSupLatitude, lng: obj[i].XFSupLongitude },
                            zoom: 12,
                        }
                        var maps = new google.maps.Map(document.getElementById("map"), mapOptions);
                    }
                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(obj[i].XFSupLatitude, obj[i].XFSupLongitude),
                        map: maps,
                        title: devicename,
                        icon: iconpicture,
                    });
                }

            });
    }
}
function SpeedEn() {
    if ($("#SelSubMenu option:selected").val() == 3) {

        $.post("Controller.php",
            {
                SpeedEn: 'SpeedEn',
                ProjectCode: $("#SelProject").val()
            })
            .done(function (data) {
                const obj = JSON.parse(data);
                for (i = 0; i < obj.length; i++) {
                    var iconpicture = 'SpeedEn_.png';
                    var devicename = obj[i].XVFskName;
                    if (i == 0) {
                        var mapOptions = {
                            center: { lat: obj[i].XFSupLatitude, lng: obj[i].XFSupLongitude },
                            zoom: 12,
                        }
                        var maps = new google.maps.Map(document.getElementById("map"), mapOptions);
                    }
                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(obj[i].XFSupLatitude, obj[i].XFSupLongitude),
                        map: maps,
                        title: devicename,
                        icon: iconpicture,
                    });
                }

            });
    }
}
function Vms() {
    if ($("#SelSubMenu option:selected").val() == 4) {

        $.post("Controller.php",
            {
                Vms: 'Vms',
                ProjectCode: $("#SelProject").val()
            })
            .done(function (data) {
                const obj = JSON.parse(data);
                for (i = 0; i < obj.length; i++) {
                    var iconpicture = 'Vmss.png';
                    var devicename = obj[i].XVFskName;
                    if (i == 0) {
                        var mapOptions = {
                            center: { lat: obj[i].XFSupLatitude, lng: obj[i].XFSupLongitude },
                            zoom: 12,
                        }
                        var maps = new google.maps.Map(document.getElementById("map"), mapOptions);
                    }
                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(obj[i].XFSupLatitude, obj[i].XFSupLongitude),
                        map: maps,
                        title: devicename,
                        icon: iconpicture,
                    });
                }

            });
    }
}
function Rada() {
    if ($("#SelSubMenu option:selected").val() == 5) {

        $.post("Controller.php",
            {
                Rada: 'Rada',
                ProjectCode: $("#SelProject").val()
            })
            .done(function (data) {
                const obj = JSON.parse(data);
                for (i = 0; i < obj.length; i++) {
                    var iconpicture = 'Radas.png';
                    var devicename = obj[i].XVFskName;
                    if (i == 0) {
                        var mapOptions = {
                            center: { lat: obj[i].XFSupLatitude, lng: obj[i].XFSupLongitude },
                            zoom: 12,
                        }
                        var maps = new google.maps.Map(document.getElementById("map"), mapOptions);
                    }
                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(obj[i].XFSupLatitude, obj[i].XFSupLongitude),
                        map: maps,
                        title: devicename,
                        icon: iconpicture,
                    });
                }

            });
    }
}
async function Fsk() {
    await waitforme(1000);
  
    if ($("#SelSubMenu option:selected").val() == 6) {
        
        swal.showLoading();
        $.post("Controller.php",
            {
                Fsk: 'Fsk',
                ProjectCode: $("#SelProject").val()
            })
            .done(function (data) {
               
                const obj = JSON.parse(data);
                for (i = 0; i < obj.length; i++) {
                    var iconpicture = 'FSK.png';

                    var devicename = obj[i].XVFskName;
                    if (i == 0) {
                        var mapOptions = {
                            center: { lat: obj[i].XFSupLatitude, lng: obj[i].XFSupLongitude },
                            zoom: 12,
                        }
                        var maps = new google.maps.Map(document.getElementById("map"), mapOptions);
                    }
                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(obj[i].XFSupLatitude, obj[i].XFSupLongitude),
                        map: maps,
                        title: devicename,
                        icon: iconpicture,
                    });
                }
                $.post("Controller.php",
                    {
                        FskNode: "FskNode",
                        ProjectCode: $("#SelProject").val()
                    })

                    .done(function (data) {
                        const obj = JSON.parse(data);

                        for (i = 0; i < obj.length; i++) {

                            if (obj[i].XFSupLatitude > 0) {
                                var devicename = obj[i].XVFskNodeName;
                              
                               

                                if (obj[i].MinuteDiff > 60 || obj[i].XFFskCurrent == 0) {
                                    var iconpicture = 'FNodeOff_of.png';

                                } else {
                                    var iconpicture = 'FnodeOn_on.png';
                                }

                                var marker = new google.maps.Marker({
                                    position: new google.maps.LatLng(obj[i].XFSupLatitude, obj[i].XFSupLongitude),

                                    title: devicename + "\n" + obj[i].XFSupLatitude + "," + obj[i].XFSupLongitude,
                                    icon: iconpicture,
                                    map: maps,


                                });

                            }
                        }
                        swal.close();
                    });
                    
            });


    }

}
function waitforme(millisec) {
    return new Promise(resolve => {
        setTimeout(() => { resolve('') }, millisec);
    })
}
$(function () {
    var ProjectCode = $("#SelProject").val();
    var DeviceType = $("#SelDeviceType").val();
    ShowSubMenu();

    Fsk();
    
    //setInterval(function () { Fsk() }, 60000*30);
});

$("#ShowMap").click(function(){
    Fsk();
});

$(function() {
    $("#timeBrightness").datetimepicker({
        dateFormat: '',
        datepicker:false,
        pickDate: false,
        format: "H:i",
        timeOnly:true
    });
});
$(function() {
    $("#timeElectrical").datetimepicker({
        dateFormat: '',
        datepicker:false,
        pickDate: false,
        format: "H:i",
        timeOnly:true
    });
});
$(function() {
    $("#timeMornitor").datetimepicker({
        dateFormat: '',
        datepicker:false,
        pickDate: false,
        format: "H:i",
        timeOnly:true
    });
});

function inputElectricalValue(bannerID) {
    document.getElementById("bannerIDBrightness").value = '';
    document.getElementById("bannerIDElectrical").value = bannerID;
    document.getElementById("bannerIDMornitor").value = '';
    document.getElementById("timeBrightness").value = '';
    document.getElementById("timeElectrical").value = '';
    document.getElementById("timeMornitor").value = '';
    document.getElementById("checkboxBrightnessMon").checked = false;
    document.getElementById("checkboxBrightnessTue").checked = false;
    document.getElementById("checkboxBrightnessWed").checked = false;
    document.getElementById("checkboxBrightnessThu").checked = false;
    document.getElementById("checkboxBrightnessFri").checked = false;
    document.getElementById("checkboxBrightnessSat").checked = false;
    document.getElementById("checkboxBrightnessSun").checked = false;
    document.getElementById("checkboxElectricalMon").checked = false;
    document.getElementById("checkboxElectricalTue").checked = false;
    document.getElementById("checkboxElectricalWed").checked = false;
    document.getElementById("checkboxElectricalThu").checked = false;
    document.getElementById("checkboxElectricalFri").checked = false;
    document.getElementById("checkboxElectricalSat").checked = false;
    document.getElementById("checkboxElectricalSun").checked = false;
    document.getElementById("checkboxMornitorMon").checked = false;
    document.getElementById("checkboxMornitorTue").checked = false;
    document.getElementById("checkboxMornitorWed").checked = false;
    document.getElementById("checkboxMornitorThu").checked = false;
    document.getElementById("checkboxMornitorFri").checked = false;
    document.getElementById("checkboxMornitorSat").checked = false;
    document.getElementById("checkboxMornitorSun").checked = false;
    $('input:radio').attr("checked", false);
    document.getElementById("myRange").value=0;
    document.getElementById( 'rangeBar' ).style.display = 'none';
}

function inputBrightnessValue(bannerID) {
    document.getElementById("bannerIDBrightness").value = bannerID;
    document.getElementById("bannerIDElectrical").value = '';
    document.getElementById("bannerIDMornitor").value = '';
    document.getElementById("timeBrightness").value = '';
    document.getElementById("timeElectrical").value = '';
    document.getElementById("timeMornitor").value = '';
    document.getElementById("checkboxBrightnessMon").checked = false;
    document.getElementById("checkboxBrightnessTue").checked = false;
    document.getElementById("checkboxBrightnessWed").checked = false;
    document.getElementById("checkboxBrightnessThu").checked = false;
    document.getElementById("checkboxBrightnessFri").checked = false;
    document.getElementById("checkboxBrightnessSat").checked = false;
    document.getElementById("checkboxBrightnessSun").checked = false;
    document.getElementById("checkboxElectricalMon").checked = false;
    document.getElementById("checkboxElectricalTue").checked = false;
    document.getElementById("checkboxElectricalWed").checked = false;
    document.getElementById("checkboxElectricalThu").checked = false;
    document.getElementById("checkboxElectricalFri").checked = false;
    document.getElementById("checkboxElectricalSat").checked = false;
    document.getElementById("checkboxElectricalSun").checked = false;
    document.getElementById("checkboxMornitorMon").checked = false;
    document.getElementById("checkboxMornitorTue").checked = false;
    document.getElementById("checkboxMornitorWed").checked = false;
    document.getElementById("checkboxMornitorThu").checked = false;
    document.getElementById("checkboxMornitorFri").checked = false;
    document.getElementById("checkboxMornitorSat").checked = false;
    document.getElementById("checkboxMornitorSun").checked = false;
    $('input:radio').attr("checked", false);
    document.getElementById("myRange").value=0;
    document.getElementById( 'rangeBar' ).style.display = 'none';
}

function inputMornitorValue(bannerID) {
    document.getElementById("bannerIDBrightness").value = '';
    document.getElementById("bannerIDElectrical").value = '';
    document.getElementById("bannerIDMornitor").value = bannerID;
    document.getElementById("timeBrightness").value = '';
    document.getElementById("timeElectrical").value = '';
    document.getElementById("timeMornitor").value = '';
    document.getElementById("checkboxBrightnessMon").checked = false;
    document.getElementById("checkboxBrightnessTue").checked = false;
    document.getElementById("checkboxBrightnessWed").checked = false;
    document.getElementById("checkboxBrightnessThu").checked = false;
    document.getElementById("checkboxBrightnessFri").checked = false;
    document.getElementById("checkboxBrightnessSat").checked = false;
    document.getElementById("checkboxBrightnessSun").checked = false;
    document.getElementById("checkboxElectricalMon").checked = false;
    document.getElementById("checkboxElectricalTue").checked = false;
    document.getElementById("checkboxElectricalWed").checked = false;
    document.getElementById("checkboxElectricalThu").checked = false;
    document.getElementById("checkboxElectricalFri").checked = false;
    document.getElementById("checkboxElectricalSat").checked = false;
    document.getElementById("checkboxElectricalSun").checked = false;
    document.getElementById("checkboxMornitorMon").checked = false;
    document.getElementById("checkboxMornitorTue").checked = false;
    document.getElementById("checkboxMornitorWed").checked = false;
    document.getElementById("checkboxMornitorThu").checked = false;
    document.getElementById("checkboxMornitorFri").checked = false;
    document.getElementById("checkboxMornitorSat").checked = false;
    document.getElementById("checkboxMornitorSun").checked = false;
    $('input:radio').attr("checked", false);
    document.getElementById("myRange").value=0;
    document.getElementById( 'rangeBar' ).style.display = 'none';
}


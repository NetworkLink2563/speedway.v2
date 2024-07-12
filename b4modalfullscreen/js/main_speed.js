

jQuery('#datetimepicker').datetimepicker({
    startDate:'+1971/05/01'//or 1986/12/08
});

jQuery('#datetimepickerend').datetimepicker({
    startDate:'+1971/05/01'//or 1986/12/08
});
jQuery('#datetimepickerImg').datetimepicker({
    startDate:'+1971/05/01'//or 1986/12/08
});
jQuery('#datetimepickerendImg').datetimepicker({
    startDate:'+1971/05/01'//or 1986/12/08
});

jQuery('#datetimepicker2').datetimepicker({
    startDate:'+1971/05/01'//or 1986/12/08
});

jQuery('#datetimepickerend2').datetimepicker({
    startDate:'+1971/05/01'//or 1986/12/08
});

jQuery('#datetimepicker3').datetimepicker({
    startDate:'+1971/05/01'//or 1986/12/08
});

jQuery('#datetimepickerend3').datetimepicker({
    startDate:'+1971/05/01'//or 1986/12/08
});
function show_modal(e)
{
    console.log (e.href);
    $("#iframe_modal").attr("src", e.href);
    $('#myModal').modal('show');
    return false;
}
function show_modalImg(e)
{
    console.log (e.href);
    $("#iframe_modalImg").attr("src", e.href);
    $('#myModalImg').modal('show');
    return false;
}


function openTab(evt, cityName) {
    var i,t, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");

    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";

}

function openChild(evt, ChildName) {
    var i, tabcontent;
    tabcontent = document.getElementsByClassName("tabcontent2");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    document.getElementById(ChildName).style.display = "block";
}


function openCity2(evt, cityName) {
    var i, tabcontent2, tablinks2;
    tabcontent = document.getElementsByClassName("tabcontent2");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks2");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
}
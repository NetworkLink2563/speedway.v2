

 function ShowSubMenu(){
    $.post("Controller.php", 
    {
        PrjCode:$("#SelProject").val(),
        ShowSubMenu:"ShowSubMenu"
       
    })
    .done( function( data ) 
    {  
       
        $("#SelSubMenu").empty();
        const obj = JSON.parse(data);
        for(var i=0;i<obj.length;i++){ 
            var selected="";
            if(i==0){
                selected="selected";
            }
            $('#SelSubMenu').append('<option '+selected+' value="'+obj[i].XVWssCode+'">'+obj[i].XVWssName+'</option>');
        } 
        ShowChartCountDay();
    });
 }

 $("#SelProject").change(function(){
     ShowSubMenu();
 });
 $("#SelSubMenu").change(function(){
    ShowChartCountDay();
 });
 $("#datepicker").change(function(){
    ShowChartCountDay();
 });
 $("#SelType").change(function(){
    ShowChartCountDay();
 });
 
 function getMonthShortName(monthNo) {
    const date = new Date();
    date.setMonth(monthNo - 1);
    return date.toLocaleString('en-US', { month: 'short' });
}

$(function() {
    //ShowChart1();
    //$("#chart").hide();
    ShowSubMenu();
    $('#datepicker').datepicker({
        dateFormat: 'yy-mm-dd'
    });
    /*
    const d = new Date();
    let year = d.getFullYear();
    const m = new Date();
    let month = m.getMonth();
    var monthname = ["Jan", "Feb", "Mar", "Apr", "May", "Jun","Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    $('#datepicker').val(monthname[month]+"-"+ year );
    $('#datepicker').datepicker({

        dateFormat: 'MM yy',
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
      
        onClose: function(dateText, inst) {
           
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).val($.datepicker.formatDate('MM-yy', new Date(year, month, 1)));
            ShowChart1();  
        
        }
    });
    $("#datepicker").focus(function () {
        $(".ui-datepicker-calendar").hide();
        $("#ui-datepicker-div").position({
            my: "center top",
            at: "center bottom",
            of: $(this)
        });
    });
    */
 });
 function ShowChartCountDay(){
    $.post("Controller.php",
    {
        ShowChartCountDay:"ShowChartCountDay",
        WssCode:$("#SelSubMenu").val(),  
        datepicker:$("#datepicker").val(),  
        ChartType:$("#SelType").val()
    }, function (result) {
        
        const obj = JSON.parse(result);
        const labeldate = [];
        const AvgTemp=[];
      
        for (i = 0; i < obj.length; i++) {
            labeldate[i]=obj[i].Thour+':00:00';
            AvgTemp[i]=obj[i].AvgValue.toFixed(2);
           
        }
        var texlabel="";
    
        if($("#SelType").val()==1){
            texlabel="อุณหภูมิเฉลี่ย";
           
        }
        if($("#SelType").val()==2){
            texlabel="ความชื้นเฉลี่ย";
        }
        if($("#SelType").val()==3){
            texlabel="PM2.5เฉลี่ย";
        }
        var ctx_chart = $("#charttemperature").get(0).getContext("2d");
        var chart = new Chart(ctx_chart, {            
            type: "line",
            data: {
                labels: labeldate,
                datasets: [{
                    label: texlabel,
                    data:  AvgTemp,
                    backgroundColor: "#F96206"
                }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: true,
                    labels: {
                        fontColor: "#703201",
                        fontSize: 14
                    }
                },
                plugins: {
                    labels: {
                        //render: 'percentage',
                        fontColor: "white",
                        precision: 2,
                        fontSize: 0
                    }
                },
            }
        });

        //-------------------------------
        
              
    });
}

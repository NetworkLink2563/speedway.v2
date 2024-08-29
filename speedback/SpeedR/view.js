

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
            $('#SelSubMenu').append('<option '+selected+' value="'+obj[i].XVRadaCode+'">'+obj[i].XVRadaName+'</option>');
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
    $("#chart").hide();
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
        RadaCode:$("#SelSubMenu").val(),  
        datepicker:$("#datepicker").val(),  
    }, function (result) {
        $("#chart").hide();
        const obj = JSON.parse(result);
        const labeldate = [];
        const qty=[];
        const AvgSpeed=[];
        var MinCount=0;
        var MaxCount=0;
        var SumCount=0;
        for (i = 0; i < obj.length; i++) {
            labeldate[i]=obj[i].Thour+':00:00';
            qty[i]=obj[i].TCountCar;
            AvgSpeed[i]=obj[i].AvgSpeed.toFixed(2);
            SumCount= SumCount+parseFloat(obj[i].TCountCar);
            $("#chart").show();
            if($("#SelType").val()==1){
                $("#Chart1").show();
                $("#Chart2").hide();
            }else{
                $("#Chart1").hide();
                $("#Chart2").show();
            }
        }
        //-----------------Chart1
        var minValue = Infinity;
        var maxValue = -Infinity;
        var TimeMin1= "";
        var TimeMax1= "";
        i=0;
        for (Value  of qty) {
            // find minimum value
            if (parseFloat(Value) < minValue)
                minValue = Value;
                  
    
            if (parseFloat(Value) > maxValue)
                maxValue = Value;
               
            i++;
        }
        var x=0;
        for (Value  of qty) {
            if (minValue==parseFloat(Value)){
                TimeMin1= labeldate[x];
            }
            if (maxValue==parseFloat(Value)){
                TimeMax1= labeldate[x];
            }
            x++;
        }
      
        $("#LabelCountDay").text("ปริมาณยานพาหนะเข้าในพื้นที่ทั้งสิ้น "+SumCount+" คัน");
        $("#LabelCountDayMin").text("ปริมาณยานพาหนะเข้าในพื้นที่หนาแน่นที่สุดจำนวน "+minValue+" คันในช่วงเวลา "+TimeMin1);
        $("#LabelCountDayMax").text("ปริมาณยานพาหนะเข้าในพื้นที่หนาแน่นที่สุดจำนวน "+maxValue+" คันในช่วงเวลา "+TimeMax1);
         //-----------------Chart2 
        var ctx_chart = $("#chartcountday").get(0).getContext("2d");
        var chart = new Chart(ctx_chart, {            
            type: "line",
            data: {
                labels: labeldate,
                datasets: [{
                    label: "ปริมาณรถ",
                    data:  qty,
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
        var minAvgValue = Infinity;
        var maxAvgValue = -Infinity;
        var AvgValue=0;
        var SumSpeed=0;
        var TimeMin= "";
        var TimeMax= "";
        $imin=0;
        $imax=0;
        $i=0;
        for (Value  of AvgSpeed) {
        
            // find minimum value
            if (parseFloat(Value) < minAvgValue)
               
                minAvgValue = Value;
                    
            // find maximum value
            if (parseFloat(Value) > maxAvgValue)
                maxAvgValue = Value;
                
            $i++;
            SumSpeed=SumSpeed+parseFloat(Value);
            AvgValue=SumSpeed/$i;
           
        }
        var x=0;
        for (Value  of AvgSpeed) {
            if (minAvgValue==parseFloat(Value)){
                TimeMin= labeldate[x];
            }
            if (maxAvgValue==parseFloat(Value)){
                TimeMax= labeldate[x];
            }
            x++;
        }
      

        $("#LabelCountAvgDay").text("ปริมาณยานพาหนะเข้าในพื้นที่ความเร็วเฉลี่ย "+AvgValue.toFixed(2)+" กม./ชม.");
        $("#LabelCountAvgDayMin").text("ปริมาณยานพาหนะเข้าในพื้นที่ความเร็วเฉลี่ยต่ำสุด "+minAvgValue+" คันในช่วงเวลา "+TimeMin);
        $("#LabelCountAvgDayMax").text("ปริมาณยานพาหนะเข้าในพื้นที่ความเร็วเฉลี่ยสูงสุด "+maxAvgValue+" กม./ชม. ในช่วงเวลา "+TimeMax);
        var ctx_chart = $("#chartaveday").get(0).getContext("2d");
        var chart = new Chart(ctx_chart, {            
            type: "line",
            data: {
                labels: labeldate,
                datasets: [{
                    label: "ความเร็วเฉลี่ย",
                    data:  AvgSpeed,
                    backgroundColor: "#F2C80C"
                }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: true,
                    labels: {
                        fontColor: "#CB3811",
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

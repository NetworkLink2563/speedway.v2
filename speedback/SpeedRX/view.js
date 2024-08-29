

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
            $('#SelSubMenu').append('<option '+selected+' value="'+obj[i].XVSpeCode+'">'+obj[i].XVSpeName+'</option>');
        } 
        if($("#SelType").val()>=1&&$("#SelType").val()<=2){
            ShowChartCountDay();
         }else{
             $("#Chart1").hide();
             $("#Chart2").hide();
             $("#ShowTable").show();
             ShowTableCountBydate();
         }
    });
 }

 $("#SelProject").change(function(){
     ShowSubMenu();
 });
 $("#SelSubMenu").change(function(){
    if($("#SelType").val()>=1&&$("#SelType").val()<=2){
        ShowChartCountDay();
     }else{
         $("#Chart1").hide();
         $("#Chart2").hide();
         $("#ShowTable").show();
         ShowTableCountBydate();
     }
 });
 $("#datepicker").change(function(){
    if($("#SelType").val()>=1&&$("#SelType").val()<=2){
        ShowChartCountDay();
     }else{
         $("#Chart1").hide();
         $("#Chart2").hide();
         $("#ShowTable").show();
         ShowTableCountBydate();
     }
 });
 $("#SelType").change(function(){
    if($("#SelType").val()>=1&&$("#SelType").val()<=2){
       ShowChartCountDay();
    }else{
        $("#Chart1").hide();
        $("#Chart2").hide();
        $("#ShowTable").show();
        ShowTableCountBydate();
    }
 });
 
 function getMonthShortName(monthNo) {
    const date = new Date();
    date.setMonth(monthNo - 1);
    return date.toLocaleString('en-US', { month: 'short' });
}

$(function() {
   
    ShowSubMenu();
  
    $("#datepicker1").datetimepicker({
		timeFormat: "HH:mm"
	});

    $('#table').dataTable( {
        "searching": false,
        "ordering": false,
        "bLengthChange": false
      } );
    
   
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
       
        $("#LabelCountDayMax").text("ปริมาณยานพาหนะเข้าในพื้นที่หนาแน่นที่สุดจำนวน "+maxValue+" คันในช่วงเวลา "+TimeMax1);
        $("#LabelCountDayMin").text("ปริมาณยานพาหนะเข้าในพื้นที่หนาแน่นน้อยสุดจำนวน "+minValue+" คันในช่วงเวลา "+TimeMin1);
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

function ShowTableCountBydate(){
    $.post("Controller.php",
    {
        ShowTableCountBydate:"ShowTableCountBydate",
        RadaCode:$("#SelSubMenu").val(),  
        datepicker:$("#datepicker").val(),  
    }, function (result) {
       
        
        obj=JSON.parse(result);
        $('#table').DataTable( {
            data: obj,
            columns: [
                { data: 'A' },
                { data: '0' },
                { data: '1' },
                { data: '2' },
                { data: '3' },
                { data: '4' },
                { data: '5' },
                { data: '6' },
                { data: '7' },
                { data: '8' },
                { data: '9' },
                { data: '10' },
                { data: '11' },
                { data: '12' },
                { data: '13' },
                { data: '14' },
                { data: '15' },
                { data: '16' },
                { data: '17' },
                { data: '18' },
                { data: '19' },
                { data: '20' },
                { data: '21' },
                { data: '22' },
                { data: '23' },
                { data: '24' }
                
            ],
            "columnDefs": [
                {  "targets": 0, "className": "text-center" },
                {  "targets": 1, "className": "text-center"},
                {  "targets": 2, "className": "text-center" },
                {  "targets": 3, "className": "text-center" },
                {  "targets": 4, "className": "text-center" },
                {  "targets": 5, "className": "text-center" },
                {  "targets": 6, "className": "text-center" },
                {  "targets": 7, "className": "text-center" },
                {  "targets": 8, "className": "text-center" },
                {  "targets": 9, "className": "text-center" },
                {  "targets": 10, "className": "text-center" },
                {  "targets": 11, "className": "text-center" },
                {  "targets": 12, "className": "text-center" },
                {  "targets": 13, "className": "text-center" },
                {  "targets": 14, "className": "text-center" },
                {  "targets": 15, "className": "text-center" },
                {  "targets": 16, "className": "text-center" },
                {  "targets": 17, "className": "text-center" },
                {  "targets": 18, "className": "text-center" },
                {  "targets": 19, "className": "text-center" },
                {  "targets": 20, "className": "text-center" },
                {  "targets": 21, "className": "text-center" },
                {  "targets": 22, "className": "text-center" },
                {  "targets": 23, "className": "text-center" }
             
               
              ],
              dom: 'Bfrtip',
              "ordering": false,
              "paging":   false,
        "ordering": false,
        "info":     false,
              buttons: [
                {
                    extend: 'excelHtml5',
                    title: 'ตารางแสดงข้อมูลปริมาณรถ วันที่ '+$("#datepicker").val()
                },
               
            ],
            lengthChange: false,
            "bDestroy": true
        } );
        
    });
}
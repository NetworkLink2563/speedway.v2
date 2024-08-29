



function ShowData(){
    $('#TableBody').empty();
    $.post("Controller.php", 
    {   
        starttime:$("#starttime").val(),
        endtime:$("#endtime").val(),
        io:$("#SelInout").val(),
        ShowData: "ShowData"
    }, function(result){
        
        obj=JSON.parse(result);
        var total=0;
        for(var i=0;i<obj.length;i++){
            total=total+parseInt(obj[i].J);
        }
        var io="";
        if($("#SelInout").val()=="I"){
            io="เข้า";
        }else{
            io="ออก";
        }
        
        const formattedNumber =total.toLocaleString("en-US");
        $('#total').text(formattedNumber);
        $('#table1').DataTable( {
            
            data: obj,
            columns: [
                { data: 'A' },
                { data: 'B' },
                { data: 'C' },
                { data: 'D' },
                { data: 'E' }
                
            ],
            /*
            "columnDefs": [
                { "width": "15%", "targets": 0 },
                { "width": "15%", "targets": 1 },
                { "width": "5%", "targets": 2 },
                { "width": "10%", "targets": 3 },
                { "width": "10%", "targets": 4 },
                { "width": "20%", "targets": 5 }
              ],
              */
            lengthChange: false,
            "bDestroy": true,
            dom: 'Bfrtip',
            buttons: [
                { extend: 'excelHtml5', footer: true, title: 'รายงานรถ'+io+'วันที่'+$("#starttime").val()+"-"+$("#endtime").val(),filename: 'รายงานรถ'+io+'วันที่'+$("#starttime").val()+"-"+$("#endtime").val()},
            ]
           
        } );
        
       
    });
    $("#Form1").hide();
    $("#Form2").show();
}

$(function() {    
    ShowData();
   
  
});

$("#starttime").change(function(){
    ShowData();
    
});
$("#endtime").change(function(){
    ShowData();
    
});
$("#SelInout").change(function(){
    ShowData();
    
});

function ShowChart6(){
    $.post("Controller.php",
    {
        Chart6: "Chart6"
    }, function (result) {
      
        const obj = JSON.parse(result);
        const labeldate = [];
        const datawatt=[];
        const datahour=[];
        for (i = 0; i < obj.length; i++) {
            labeldate[i]=obj[i].Date;
            datawatt[i]=obj[i].Watt;
            datahour[i]=obj[i].Hour;
        }
        var ctx_chart2 = $("#chart6").get(0).getContext("2d");
        var chart2 = new Chart(ctx_chart2, {
            type: "bar",
            data: {
                labels: labeldate,
                datasets: [{
                    label: "กำลังไฟฟ้าเฉลี่ย (วัตต์)",
                    data:  datawatt,
                    backgroundColor: "#F96206"
                },
                {
                    label: "ระยะเวลาที่เปิดใช้งาน (ชั่วโมง)",
                    data: datahour,
                    backgroundColor: "#FC3415"
                },
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    labels: {
                        fontColor: "#703201",
                        fontSize: 14
                    },
                   
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: true,
                        },
                        ticks: {
                          fontColor: "#A19F9D", // this here
                        },
                    }],
                    yAxes: [{
                        gridLines: {
                            display: true,
                          
                        },
                        ticks: {
                          fontColor: "#A19F9D", // this here
                        },
                    }],
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
    });
}
$(function () {
    ShowChart6();
    setInterval(ShowChart6, 10000*60);
    
});

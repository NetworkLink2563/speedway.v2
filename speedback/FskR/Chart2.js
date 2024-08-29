function ShowChart2(){
    swal.showLoading();
    $.post("Controller.php",
    {   PrjCode: $("#SelProject").val(),
        Chart2: "Chart2"
    }, function (result) {
       
        swal.close();
        const obj = JSON.parse(result);
        const labeldate = [];
        const dataon=[];
        const dataoff=[];
        for (i = 0; i < obj.length; i++) {
            labeldate[i]=obj[i].Date;
            dataon[i]=obj[i].PercenOn;
            dataoff[i]=obj[i].PercenOff;
        }
       
        var ctx_chart2 = $("#chart2").get(0).getContext("2d");
       // ctx_chart2.destroy();
        var chart2 = new Chart(ctx_chart2, {
            type: "bar",
            data: {
                labels: labeldate,
                datasets: [{
                    label: "%ติด",
                    data: dataon,
                    backgroundColor: "#F96206"
                },
                {
                    label: "%ดับ",
                    data: dataoff,
                    backgroundColor: "#F5C3A5"
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
                    }
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
    
    ShowChart2();
   // setInterval(ShowChart2, 60000*5);
});

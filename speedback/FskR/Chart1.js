

function  LampStatus(){
   
    $.post("Controller.php",
    {   Pcode:$("#SelProject").val(),
        Chart_1: "Chart_1"
    }, function (result) {
       
        
        const obj = JSON.parse(result);
        var ctx_chart1 = $("#chart1").get(0).getContext("2d");
        var chart1 = new Chart(ctx_chart1, {
            type: "pie",
            data: {
                labels: ["%ติด", "%ดับ"],
                datasets: [{
                    backgroundColor: [
                        "#F96206",
                        "#F5C3A5"
                    ],
                    data: [obj.PercenOn, obj.PercenOff],
                    borderWidth: 0
                }]
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
                plugins: {
                    labels: {
                        render: 'percentage',
                        fontColor: "#703201",
                        precision: 2,
                        fontSize: 14
                    },

                },
            }
        });
    });
}
$(function () {
   
        LampStatus();
        setInterval(LampStatus, 10000);
       
});


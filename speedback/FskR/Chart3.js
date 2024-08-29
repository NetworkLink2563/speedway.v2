function ShowChart3(){
    var ctx_chart3 = $("#chart3").get(0).getContext("2d");
    var chart3 = new Chart(ctx_chart3, {
            type: "bar",
            data: {
                labels: ["2016", "2017", "2018", "2019", "2020", "2021", "2022"],
                datasets: [{
                        label: "%ติด",
                        data: [15, 30, 55, 65, 60, 80, 95],
                        backgroundColor: "#E0C905"
                    },
                    {
                        label: "%ดับ",
                        data: [8, 35, 40, 60, 70, 55, 75],
                        backgroundColor: "#565551"
                    },
                ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        labels: {
                            fontColor: "white",
                            fontSize: 14
                        }
                    },
                    plugins: {
                    labels: {
                        render: 'percentage',
                        fontColor: "white",
                        precision: 2,
                        fontSize: 8
                    }
                    },
                }
    });
}
$(function () {

    Showchart3();
	setInterval(Showchart3, 60000*5);
});

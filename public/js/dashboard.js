const itemRequest = $("#itemRequest");
const monthlyData = $("#monthlyData");

$.ajax({
    url: "/api/dashboard",
    type: "get",
    success: function (res) {
        console.log("RESPONSE -> ", res);
        const { data } = res;

        var myChart = new Chart(monthlyData, {
            type: "bar",
            data: {
                labels: data.map((d) => d.month),
                datasets: [
                    {
                        label: 'Data By Monthly',
                        data: data.map((d) => d.data),
                        backgroundColor: [
                            "rgba(255, 99, 132, 0.2)",
                            "rgba(54, 162, 235, 0.2)",
                            "rgba(255, 206, 86, 0.2)",
                            "rgba(75, 192, 192, 0.2)",
                            "rgba(153, 102, 255, 0.2)",
                            "rgba(255, 159, 64, 0.2)",
                            "rgba(255, 99, 132, 0.2)",
                            "rgba(54, 162, 235, 0.2)",
                            "rgba(255, 206, 86, 0.2)",
                            "rgba(75, 192, 192, 0.2)",
                            "rgba(153, 102, 255, 0.2)",
                            "rgba(255, 159, 64, 0.2)",
                        ],
                    },
                ],
            },
        });
    },
    error: function (res) {
        console.log("ERR -> ", res);
    },
});

$.ajax({
    url: "/api/dashboard/item-request",
    type: "get",
    success: function (res) {
        console.log("RESPONSE ITEM REQUEST-> ", res);
        const { data } = res;

        var dataChart = {
            labels: data.map((d) => d.item),
            datasets: [
                {
                    data: data.map((d) => d.count_num),
                    backgroundColor: [
                        "#FF6384",
                        "#63FF84",
                        "#84FF63",
                        "#8463FF",
                        "#6384FF",
                    ],
                },
            ],
        };

        console.log(dataChart);

        var pieChart = new Chart(itemRequest, {
            type: "pie",
            data: dataChart,
        });
    },
    error: function (res) {
        console.log("ERR -> ", res);
    },
});

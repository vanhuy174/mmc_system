$(function () {

    var lineData = {
        labels: ["2012", "2013", "2014", "2015", "2016", "2017", "2018"],
        datasets: [

            {
                label: "Số sinh viên 1",
                backgroundColor: 'rgba(26,179,148,0.3)',
                borderColor: "rgba(26,179,148,0.7)",
                pointBorderColor: "#fff",
                data: [500, 400, 450, 489, 478, 578, 687]
            },{
                label: "Số sinh viên 2",
                backgroundColor: 'rgb(255,140,0,0.3)',
                borderColor: "rgb(255,140,0,0.7)",
                pointBorderColor: "#fff",
                data: [650, 590, 680, 681, 560, 552, 440]
            },{
                label: "Số sinh viên 3",
                backgroundColor: 'rgb(124,252,0,0.3)',
                borderColor: "rgb(124,252,0,0.7)",
                pointBorderColor: "#fff",
                data: [675, 549, 480, 581, 546, 515, 440]
            }
        ]
    };
    var lineOptions = {
        responsive: true
    };
    var ctx = document.getElementById("lineChart").getContext("2d");
    new Chart(ctx, {type: 'line', data: lineData, options:lineOptions});

    var doughnutData = {
        labels: ["Xuất sắc","Giỏi","Khá","Trung bình","Yếu" ],
        datasets: [{
            data: [10,20,30,30,10],
            backgroundColor: ["#E18500","#0B48E1","#00E1B2","#a3e1d4","#FF0100"]
        }]
    } ;
    var doughnutOptions = {
        responsive: true
    };
    var ctx4 = document.getElementById("doughnutChart").getContext("2d");
    new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});

});

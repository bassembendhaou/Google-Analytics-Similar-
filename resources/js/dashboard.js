var Dashboard = function () {

    //********************************************************************************//
    //                            Global variables
    //********************************************************************************//
    var $chart = $('#myChart');
    var chart;
    const data = {
        labels: labels,
        datasets: [{
            label: 'Visit Count Evolution',
            data: visitsCount,
            fill: false,
            borderColor: 'rgba(60, 56, 103, 0.8)',
            tension: 0.1
        },
            {
                label:  'Unique Visit Count Evolution',
                data: uniqueVisitsCount,
                fill: false,
                borderColor: 'rgb(117, 206, 208,0.9)',
                tension: 0.1
            }
        ]
    };
    const config = {
        type: 'line',
        data: data,
    };



    //********************************************************************************//
    //                            Initializations
    //********************************************************************************//
    var initChart = function () {
        chart = new Chart($chart, config);
    }


    //********************************************************************************//
    //                            methods
    //********************************************************************************//



    return {
        init: function () {
            initChart();
        },
    };
}();

window.addEventListener('load', function () {
    Dashboard.init();
});

        function requestData() {
        $.ajax({
            url: '<?php echo base_url('test/ajax_random')."/".$sensordata[0]->SENSORID?>',
            success: function(point) {
                var series = chart.series[0],
                    shift = series.data.length > 20; 
                chart.series[0].addPoint(point, true, shift);
                setTimeout(requestData, 1000);    
            },
            cache: false
        });
    }

    $(document).ready(function() {
    chart = new Highcharts.Chart({
        chart: {
            renderTo: 'realtimechart',
            defaultSeriesType: 'spline',
            events: {
                load: requestData
            }
        },
        title: {
            text: 'Realtime sensor data'
        },
        xAxis: {
            type: 'datetime',
            tickPixelInterval: 150,
            maxZoom: 20 * 1000
        },
        yAxis: {
            minPadding: 0.2,
            maxPadding: 0.2,
            title: {
                text: 'Value',
                margin: 80
            }
        },
        series: [{
            name: 'Sensor Reading',
            data: []
        }]
    });        
});
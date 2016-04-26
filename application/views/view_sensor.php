<script type="text/javascript">
        function requestData() {
        $.ajax({
            url: '<?php echo base_url('getRealtimeData')."/".$sensordata[0]->SENSORID?>',
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
</script>

<script type="text/javascript">
$(function () {
    $.getJSON('<?php echo base_url('getDataWithParam')."/".$sensordata[0]->SENSORID ?>', function (data) {
        var chart = new Highcharts.Chart({
            chart: {
                zoomType: 'x',
                renderTo: 'datacharts'
            },
            title: {
                text: 'Sensor value'
            },
            xAxis: {
                type: 'datetime'
            },
            yAxis: {
                title: {
                    text: 'Value'
                }
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                area: {
                    fillColor: {
                        linearGradient: {
                            x1: 0,
                            y1: 0,
                            x2: 0,
                            y2: 1
                        },
                        stops: [
                            [0, Highcharts.getOptions().colors[0]],
                            [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                        ]
                    },
                    marker: {
                        radius: 2
                    },
                    lineWidth: 1,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                }
            },

            series: [{
                type: 'area',
                name: 'Sensor value',
                data: data
            }]
        });
    });
});
</script>





<!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEAD-->
                    <div class="page-head">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1>View Sensor
                                <small><?php echo $sensordata[0]->SENSORNAME ?></small>
                            </h1>
                        </div>
                        <!-- END PAGE TITLE -->
                    </div>
                    <!-- END PAGE HEAD-->
                    <!-- BEGIN PAGE BREADCRUMB -->
                    <ul class="page-breadcrumb breadcrumb">
                        <li>
                            <a href="<?php echo base_url() ?>">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span class="active"><?php echo $sensordata[0]->SENSORNAME ?></span>
                        </li>
                    </ul>
                    <!-- END PAGE BREADCRUMB -->
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        <div class="col-md-6 ">
                            <!-- BEGIN Portlet PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <span class="caption-subject font-blue-soft bold uppercase">Sensor Info</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="scroller" style="height:200px">
                                        <pr>
                                            Name : <?php echo $sensordata[0]->SENSORNAME ?> <br>
                                            Description : <?php echo $sensordata[0]->SENSORDESC ?>
                                        </pr>
                                    </div>
                                </div>
                            </div>
                            <!-- END Portlet PORTLET-->
                        </div>
                        <div class="col-md-6 ">
                            <!-- BEGIN Portlet PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <span class="caption-subject font-blue-soft bold uppercase">Analyze</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="scroller" style="height:200px">
                                        <pr>
                                            <a href="<?php echo base_url('analyze')."/".$sensordata[0]->SENSORID ?>">Analyze</a>
                                            <br>
                                            <a href="<?php echo base_url('home/createAlertForm')."/".$sensordata[0]->SENSORID ?>">Create Alert</a>  
                                        </pr>
                                    </div>
                                </div>
                            </div>
                            <!-- END Portlet PORTLET-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 ">
                            <!-- BEGIN Portlet PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-graph"></i><span class="caption-subject font-blue-soft bold uppercase">Real Time Data</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="tab-content" id="realtimechart">                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN Portlet PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <span class="caption-subject font-blue-soft bold uppercase">Data</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="tab-content">
                                        <table class="table table-striped table-bordered table-hover" id="alldata_datatable">
                                            <thead>
                                                <tr>
                                                    <th> Timestamp </th>
                                                    <th> Data </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($sensordata as $row) { ?>
                                                <tr>
                                                    <td> <?php echo $row->TIMESTAMP ?> </td>
                                                    <td> <?php echo $row->DATAREADING ?> </td>
                                                </tr>
                                                <?php } ?>                                    
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- BEGIN Portlet PORTLET-->
                        </div>
                    </div>
                    <!-- END PAGE BASE CONTENT -->
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
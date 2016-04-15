<script type="text/javascript">
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
                            <a href="index.html">Home</a>
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
                            <div class="portlet box blue">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>Sensor Information </div>
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
                            <!-- BEGIN Portlet PORTLET-->
                            <div class="portlet box blue">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i> Data Reading
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="tab-content">
                                        <table class="table table-striped table-bordered table-hover" id="sample_1">
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
                            <!-- END Portlet PORTLET-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 ">
                            <!-- BEGIN Portlet PORTLET-->
                            <div class="portlet box blue">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>Graphs / Charts 
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
                        <div class="col-md-12 ">
                            <!-- BEGIN Portlet PORTLET-->
                            <div class="portlet box blue">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>Rules / Alerts
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="tab-content">
                                        Table for creating rules / alerts for sensor
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 ">
                        </div>
                    </div>
                    <!-- END PAGE BASE CONTENT -->
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
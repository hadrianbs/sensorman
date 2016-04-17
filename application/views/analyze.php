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
                <div class="col-md-12 ">
                    <!-- BEGIN Portlet PORTLET-->
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-gift"></i>Graphs / Charts 
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content" id="datacharts">                                        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
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
                </div>
            </div>
            <!-- END PAGE BASE CONTENT -->
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
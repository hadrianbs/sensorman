<script type="text/javascript">
$(function () {
    $.getJSON('<?php echo base_url('data_controller/getAllSensorData')."/".$sensordata[0]->SENSORID ?>', function (data) {
        var chart = new Highcharts.Chart({
            chart: {
                zoomType: 'x',
                renderTo: 'datacharts'
            },
            title: {
                text: ''
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
<script type="text/javascript">
$(function () {
    $.getJSON('<?php echo base_url('data_controller/getMaxSensorReading')."/".$sensordata[0]->SENSORID ?>', function (data) {
        var chartMaxData = new Highcharts.Chart({
            chart: {
                zoomType: 'x',
                renderTo: 'maxdatacharts'
            },
            title: {
                text: ''
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

<script type="text/javascript">
$(function () {
    $.getJSON('<?php echo base_url('data_controller/getMinSensorReading')."/".$sensordata[0]->SENSORID ?>', function (data) {
        var chartMinData = new Highcharts.Chart({
            chart: {
                zoomType: 'x',
                renderTo: 'mindatacharts'
            },
            title: {
                text: ''
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

<script type="text/javascript">
$(function () {
    $.getJSON('<?php echo base_url('data_controller/getAverageSensorReading')."/".$sensordata[0]->SENSORID ?>', function (data) {
        var chartAverageData = new Highcharts.Chart({
            chart: {
                zoomType: 'x',
                renderTo: 'averagedatacharts'
            },
            title: {
                text: ''
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
                    <h1>Analyze</h1>
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
                    <a href="<?php echo base_url('viewsensor')."/".$sensordata[0]->SENSORID ?>"> <?php echo $sensordata[0]->SENSORNAME ?> </a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span class="active">Analyze</span>
                </li>
            </ul>
            <!-- END PAGE BREADCRUMB -->
            <!-- BEGIN PAGE BASE CONTENT -->
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <span class="caption-subject font-blue-soft bold uppercase">Analyze</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#alldatatab" data-toggle="tab"> All Data </a>
                                </li>
                                <li>
                                    <a href="#max" data-toggle="tab"> Max </a>
                                </li>   
                                <li>
                                    <a href="#min" data-toggle="tab"> Min </a>
                                </li>  
                                <li>
                                    <a href="#avg" data-toggle="tab"> Average </a>
                                </li>                           
                            </ul>
                            <div class="tab-content">
                                <!--BEGIN ALL DATA TAB-->
                                <div class="tab-pane fade active in" id="alldatatab">
                                    <div class="portlet light bordered">
                                        <div class="portlet-body">
                                            <div id="datacharts">
                                            </div>   
                                        </div>  
                                    </div>  
                                    <div class="portlet light bordered">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="icon-graph"></i></i> Data Reading
                                            </div>
                                        </div>
                                        <div class="portlet-body">
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
                                <!--END ALL DATA TAB-->

                                <!--BEGIN MAX TAB-->
                                <div class="tab-pane fade" id="max">
                                    <div class="portlet light bordered">
                                        <div class="portlet-body">
                                            <div id="maxdatacharts">
                                            </div>   
                                        </div>  
                                    </div>  
                                    <div class="portlet light bordered">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="icon-graph"></i>Data Reading
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <table class="table table-striped table-bordered table-hover" id="maxtab">
                                                <thead>
                                                    <tr>
                                                        <th> Timestamp </th>
                                                        <th> Data </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($maxsensordata as $row) { ?>
                                                    <tr>
                                                        <td> <?php echo $row->sensordate ?> </td>
                                                        <td> <?php echo $row->sensordata ?> </td>
                                                    </tr>
                                                    <?php } ?>                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div> 
                                </div>
                                <!--END MAX TAB-->

                                <div class="tab-pane fade" id="min">
                                    <div class="portlet light bordered">
                                        <div class="portlet-body">
                                            <div id="mindatacharts">
                                            </div>   
                                        </div>  
                                    </div>  
                                    <div class="portlet light bordered">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="icon-graph"></i>Data Reading
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <table class="table table-striped table-bordered table-hover" id="mintab">
                                                <thead>
                                                    <tr>
                                                        <th> Timestamp </th>
                                                        <th> Data </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($minsensordata as $row) { ?>
                                                    <tr>
                                                        <td> <?php echo $row->sensordate ?> </td>
                                                        <td> <?php echo $row->sensordata ?> </td>
                                                    </tr>
                                                    <?php } ?>                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div> 
                                </div>

                                <div class="tab-pane fade" id="avg">
                                    <div class="portlet light bordered">
                                        <div class="portlet-body">
                                            <div id="averagedatacharts">
                                            </div>   
                                        </div>  
                                    </div>  
                                    <div class="portlet light bordered">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="icon-graph"></i>Data Reading
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <table class="table table-striped table-bordered table-hover" id="avgtab">
                                                <thead>
                                                    <tr>
                                                        <th> Timestamp </th>
                                                        <th> Data </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($averagesensordata as $row) { ?>
                                                    <tr>
                                                        <td> <?php echo $row->sensordate ?> </td>
                                                        <td> <?php echo $row->sensordata ?> </td>
                                                    </tr>
                                                    <?php } ?>                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE BASE CONTENT -->
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
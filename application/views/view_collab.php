<!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEAD-->
                    <div class="page-head">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1>View Collaborative Sensor
                                <small><?php echo $collabdata[0]->COLLABNAME ?></small>
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
                            <span class="active"><?php echo $collabdata[0]->COLLABNAME ?></span>
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
                                            Name : <?php echo $collabdata[0]->COLLABNAME ?> <br>
                                            Description : <?php echo $collabdata[0]->COLLABDESC ?>
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
                                            <a href="<?php echo base_url('analyze')."/".$collabdata[0]->COLLABID ?>">Analyze</a>
                                            <br>
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
                                                <?php foreach ($collabdata as $row) { ?>
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
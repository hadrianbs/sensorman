<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>
                    Public Sensors
                </h1>
            </div>
            <!-- END PAGE TITLE -->
        </div>
        <!-- END PAGE HEAD-->
        <!-- BEGIN PAGE BREADCRUMB -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="<?php base_url() ?>">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">Sensors available for public</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMB -->
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN Portlet PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject font-blue-soft bold uppercase">Public Sensors</span>
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                            <a href="javascript:;" class="reload"> </a>
                            <a href="" class="fullscreen"> </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                        <?php foreach ($sensorlist as $row) { ?>
                            <div class="col-md-3 ">
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption font-green-sharp">
                                            <span class=""> <?php echo $row->sensor_name ?> </span>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="scroller" style="height:100px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">                                                        
                                            <a href="<?php echo base_url('sensor/view')."/".$row->id ?>">
                                                <button type="button" class="btn blue">Go</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        </div>
                    </div>
                </div>
                <!-- END Portlet PORTLET-->
            </div>
        </div>        
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->
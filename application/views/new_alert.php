<!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEAD-->
                    <div class="page-head">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1>Create New Data Point / Sensor
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
                            <a href="<?php echo base_url('viewsensor')."/".$sensordata[0]->SENSORID ?>"><?php echo $sensordata[0]->SENSORNAME ?></a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span class="active">New Alert</span>
                        </li>
                    </ul>
                    <!-- END PAGE BREADCRUMB -->
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        <div class="col-md-12 ">
                            <!-- BEGIN SAMPLE FORM PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-body form">
                                    <form role="form" action="<?php echo base_url('home/submitNewAlert') ?>" method="POST">
                                        <div class="form-body">
                                            <input type="hidden" name="sensor_id" value="<?php echo $sensordata[0]->SENSORID ?>">
                                            <div class="form-group form-md-line-input has-info">
                                                <select class="form-control" id="form_control_1" name="alert_type" required>
                                                    <option value=""></option>
                                                    <option value="high"> > </option>
                                                    <option value="low"> < </option>   
                                                    <option value="high"> >= </option>
                                                    <option value="low"> <= </option>                                                  
                                                </select>                                               
                                                </select>
                                                <label for="form_control_1">Alert / rule type</label>
                                            </div>
                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <input type="number" class="form-control" id="form_control_1" name="value" required>
                                                <label for="form_control_1">Value</label>
                                                <span class="help-block">Value for the alert / rule type above</span>
                                            </div>
                                        </div>
                                        <div class="form-actions noborder">
                                            <button type="submit" class="btn blue">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- END SAMPLE FORM PORTLET-->                          
                        </div>
                    </div>
                    <!-- END PAGE BASE CONTENT -->
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
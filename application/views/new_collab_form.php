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
                            <span class="active">New Sensor Form</span>
                        </li>
                    </ul>
                    <!-- END PAGE BREADCRUMB -->
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        <div class="col-md-12 ">
                            <!-- BEGIN SAMPLE FORM PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-body form">
                                    <form role="form" action="<?php echo base_url('home/create_collab') ?>" method="POST">
                                        <div class="form-body">
                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <input type="text" class="form-control" id="form_control_1" name="name" required>
                                                <label for="form_control_1">Name</label>
                                                <span class="help-block">sensor / data point name</span>
                                            </div>
                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <textarea class="form-control" rows="3" name="description"></textarea>
                                                <label for="form_control_1">Data point description</label>
                                            </div>
                                            <div class="form-group form-md-line-input has-info">
                                                <select class="form-control" id="form_control_1" name="sensor_x" required>
                                                    <option value=""></option>
                                                    <?php foreach ($sensor_list as $row) { ?>
                                                    <option value="<?php echo $row->id ?>"><?php echo $row->sensor_name ?></option>
                                                    <?php } ?>
                                                </select>
                                                <label for="form_control_1">Sensor X</label>
                                            </div>
                                            <div class="form-group form-md-line-input has-info">
                                                <select class="form-control" id="form_control_1" name="sensor_y" required>
                                                    <option value=""></option>
                                                    <?php foreach ($sensor_list as $row) { ?>
                                                    <option value="<?php echo $row->id ?>"><?php echo $row->sensor_name ?></option>
                                                    <?php } ?>
                                                </select>
                                                <label for="form_control_1">Sensor Y</label>
                                            </div>
                                            <div class="form-group form-md-line-input has-info">
                                                <select class="form-control" id="form_control_1" name="operator" required>
                                                    <option value=""></option>
                                                    <option value="*">*</option>
                                                    <option value="+">+</option>
                                                    <option value="-">-</option>
                                                    <option value="/">/</option>                                                    
                                                </select>
                                                <label for="form_control_1">Operator</label>
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
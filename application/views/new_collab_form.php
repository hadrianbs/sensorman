
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
                                    <form role="form" action="<?php echo base_url('home/create_collab/submit2') ?>" method="POST">
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
                                                <select class="form-control" id="sensor_x" name="sensor_x" required>
                                                    <option value=""></option>
                                                    <?php foreach ($sensor_list as $row) { ?>
                                                    <option value="<?php echo $row->id ?>"> <?php echo $row->sensor_name ?> </option>
                                                    <?php } ?>
                                                </select>
                                                <label for="sensor_x">Sensor X</label>
                                            </div>
                                            <div class="form-group form-md-line-input has-info" id="sensor_x_rule_label">
                                                <select class="form-control" id="sensor_x_rule" name="sensor_x_rule" id="sensor_x_rule_label" required>
                                                    <option value=""></option>
                                                </select>
                                                <label for="sensor_x_rule">Sensor X Rule</label>
                                            </div>


                                            <div class="form-group form-md-line-input has-info">
                                                <select class="form-control" id="sensor_y" name="sensor_y" required>
                                                    <option value=""></option>
                                                    <?php foreach ($sensor_list as $row) { ?>
                                                    <option value="<?php echo $row->id ?>"><?php echo $row->sensor_name ?></option>
                                                    <?php } ?>
                                                </select>
                                                <label for="sensor_y">Sensor Y</label>
                                            </div>
                                            <div class="form-group form-md-line-input has-info" id="sensor_y_rule_label">
                                                <select class="form-control" id="sensor_y_rule" name="sensor_y_rule" id="sensor_y_rule_label" required>
                                                    <option value=""></option>
                                                </select>
                                                <label for="sensor_y_rule">Sensor Y Rule</label>
                                            </div>

                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <input type="text" class="form-control" id="form_control_1" name="operator" required>
                                                <label for="form_control_1">Math Expression</label>
                                                <span class="help-block">Math expression, must contain x and y</span>
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

<script type="text/javascript">
    $('#sensor_x_rule, #sensor_x_rule_label').hide();
    $('#sensor_x').change(function(){
        var state_id = $('#sensor_x').val();
        if (state_id != ""){
            var post_url = "/sensorman/data_controller/getsensorrules/" + state_id;
            $.ajax({
                type: "POST",
                 url: post_url,
                 success: function(cities) //we're calling the response json array 'cities'
                  {
                    $('#sensor_x_rule').empty();
                    $('#sensor_x_rule, #sensor_x_rule_label').show();
                       $.each(cities,function(id,city) 
                       {
                        var opt = $('<option />'); // here we're creating a new select option for each group
                          opt.val(id);
                          opt.text(city);
                          $('#sensor_x_rule').append(opt); 
                    });
                   } //end success
             }); //end AJAX
        } else {
            $('#sensor_x_rule').empty();
            $('#sensor_x_rule, #sensor_x_rule_label').hide();
        }//end if
    }); //end change 
</script>

<script type="text/javascript">
    $('#sensor_y_rule, #sensor_y_rule_label').hide();
    $('#sensor_y').change(function(){
        var state_id = $('#sensor_y').val();
        if (state_id != ""){
            var post_url = "/sensorman/data_controller/getsensorrules/" + state_id;
            $.ajax({
                type: "POST",
                 url: post_url,
                 success: function(cities) //we're calling the response json array 'cities'
                  {
                    $('#sensor_y_rule').empty();
                    $('#sensor_y_rule, #sensor_y_rule_label').show();
                       $.each(cities,function(id,city) 
                       {
                        var opt = $('<option />'); // here we're creating a new select option for each group
                          opt.val(id);
                          opt.text(city);
                          $('#sensor_y_rule').append(opt); 
                    });
                   } //end success
             }); //end AJAX
        } else {
            $('#sensor_y_rule').empty();
            $('#sensor_y_rule, #sensor_y_rule_label').hide();
        }//end if
    }); //end change 
</script>
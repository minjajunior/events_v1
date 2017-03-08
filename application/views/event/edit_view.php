<?php
/**
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 3/8/2017
 * Time: 3:39 PM
 */
$this->load->view('shared/header');
$this->load->view('shared/sidebar');
?>
<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="content-main">

        <div class="banner">
            <h2>
                <a href="<?php echo base_url('admin/home')?>">Admin</a>
                <i class="fa fa-angle-right"></i>
                <span>Edit Event</span>
            </h2>
        </div>

        <div class="blank">
            <div class="grid-form1">
                <h3 id="forms-horizontal">Edit Event</h3>
                <?php
                $attributes = array('class' => 'form-horizontal', 'id' => 'edit_event');
                echo form_open('event/edit', $attributes);
                foreach($event_detail as $ed){
                ?>
                <div id="the-message"></div>
                <div class="form-group">
                    <label for="eventname" class="col-sm-2 control-label">Event Name</label>
                    <div class="col-sm-8">
                        <input type="text" name="eventname" value="<?php echo $ed->event_name ?>" class="form-control1" placeholder="Event Name" id="eventname">
                    </div>
                </div>
                <div class="form-group">
                    <label for="eventcode" class="col-sm-2 control-label">Event Code</label>
                    <div class="col-sm-8">
                        <input type="text" name="eventcode" value="<?php echo $ed->event_code ?>" class="form-control1" placeholder="Event Code" id="eventcode">
                    </div>
                </div>
                <script>
                    $(document).ready(function() {
                        $("#eventdate").datepicker({
                            dateFormat: 'yy-mm-dd',
                            minDate: new Date(),
                            maxDate: '+1Y',
                        });
                    });
                </script>
                <div class="form-group">
                    <label for="eventdate" class="col-sm-2 control-label">Event Date</label>
                    <div class="col-sm-8">
                        <input type="text" name="eventdate" value="<?php echo $ed->event_date ?>" class="form-control1" placeholder="YYYY-MM-DD" id="eventdate">
                    </div>
                </div>
                <div class="form-group">
                    <label for="type" class="col-sm-2 control-label">Event Type</label>
                    <div class="col-sm-8">
                        <select name="type" id="type" class="form-control1">
                            <option value="">Select One</option>
                            <?php foreach($type as $t){ ?>
                                <option value="<?php echo set_value(print $t->type_name); ?>" id="type"><?php echo set_value(print $t->type_name); ?></option>
                            <?php } ?>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="othertext" class="col-sm-2 control-label"></label>
                    <div class="col-sm-8">
                        <input type="text" name="othertext" hidden="true" value="<?php echo set_value('othertext'); ?>" class="form-control1" placeholder="Event Type" id="othertext">
                    </div>
                </div>
                <script>
                    document.getElementById('type').addEventListener('change', function() {
                        if (this.value == "other") {
                            document.getElementById('othertext').hidden = false;
                        } else {
                            document.getElementById('othertext').hidden = true;
                        }
                    });
                </script>
                <div class="form-group">
                    <label for="location" class="col-sm-2 control-label">Event Location</label>
                    <div class="col-sm-8">
                        <select name="location" id="selector1" class="form-control1">
                            <option value="">Select Region</option>
                            <?php foreach($location as $loc){ ?>
                                <option value="<?php echo $loc->location_id; ?>" <?php echo set_select('location', $ed->event_location, TRUE) ?> id="location"><?php echo $loc->location_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-8">
                        <input type="password" name="password" value="<?php echo set_value('password'); ?>" class="form-control1" placeholder="Password" id="password">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password2" class="col-sm-2 control-label">Re-Enter Password</label>
                    <div class="col-sm-8">
                        <input type="password" name="password2" value="<?php echo set_value('password2'); ?>" class="form-control1" placeholder="Re-Enter Password" id="password2">
                        <?php echo form_error('password2'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-8 col-sm-offset-2">
                        <button type="button" class="btn btn-danger">Delete</button>
                        <button type="submit" class="btn btn-success pull-right">Save</button>
                    </div>
                </div>
                </form>
                <?php } ?>
            </div>
        </div>

        <?php $this->load->view('shared/footer') ?>

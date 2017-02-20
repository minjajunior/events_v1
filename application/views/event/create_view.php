<?php
/**
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 11/21/2016
 * Time: 3:31 PM
 */

$this->load->view('shared/header');
$this->load->view('shared/sidebar');
?>
<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="content-main">
        <!--banner-->
        <div class="banner">
            <h2>
                <a href="<?php echo base_url('admin/home')?>">Event</a>
                <i class="fa fa-angle-right"></i>
                <span>Create</span>
            </h2>
        </div>
        <!--//banner-->

        <div class="blank">
            <div class="blank-page">
                <h3>Create Event</h3>
                <?php
                $attributes = array('class' => 'form-horizontal');
                echo form_open('event/create', $attributes);
                ?>
                    <div class="form-group">
                        <label for="focusedinput" class="col-sm-2 control-label">Event Name</label>
                        <div class="col-sm-8">
                            <input type="text" name="eventname" value="<?php echo set_value('eventname'); ?>" class="form-control1" placeholder="Event Name">
                            <?php echo form_error('eventname'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="focusedinput" class="col-sm-2 control-label">Event Code</label>
                        <div class="col-sm-8">
                            <input type="text" name="eventcode" value="<?php echo set_value('eventcode'); ?>" class="form-control1" placeholder="Event Code">
                            <?php echo form_error('eventname'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="focusedinput" class="col-sm-2 control-label">Event Date</label>
                        <div class="col-sm-8">
                            <input type="text" name="eventdate" value="<?php echo set_value('eventdate'); ?>" class="form-control1" placeholder="YYYY-MM-DD">
                            <?php echo form_error('eventdate'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="selector1" class="col-sm-2 control-label">Event Location</label>
                        <div class="col-sm-8">
                            <select name="location" id="selector1" class="form-control1">
                                <option value="">Select Region</option>
                                <?php foreach($location as $loc){ ?>
                                    <option value="<?php echo set_value(print $loc->location_id); ?>"><?php echo set_value(print $loc->location_name); ?></option>
                                <?php } ?>
                            </select>
                            <?php echo form_error('location'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-8">
                            <input type="password" name="password" value="<?php echo set_value('password'); ?>" class="form-control1" placeholder="Password">
                            <?php echo form_error('password'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label">Re-Enter Password</label>
                        <div class="col-sm-8">
                            <input type="password" name="password2" value="<?php echo set_value('password2'); ?>" class="form-control1" placeholder="Re-Enter Password">
                            <?php echo form_error('password2'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-8 col-md-offset-2">
                            <button type="submit" class="btn btn-danger">Create</button>
                        </div>
                    </div>
                    </form>
            </div>
        </div>
<?php $this->load->view('shared/footer') ?>
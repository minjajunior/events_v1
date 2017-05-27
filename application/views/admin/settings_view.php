<?php
/**
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 4/18/2017
 * Time: 1:50 PM
 */
$this->load->view('shared/header');
$this->load->view('shared/sidebar');
?>
<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="content-main">

        <div class="banner">
            <h2>
                <a href="<?php echo base_url('admin')?>">Admin</a>
                <i class="fa fa-angle-right"></i>
                <span>Settings</span>
            </h2>
        </div>

        <div class="blank">
            <div class="col-md-3 compose">
                <nav class="nav-sidebar">
                    <ul class="nav tabs">
                        <li class="active"><a href="#adminDetails" data-toggle="tab"><i class="fa fa-edit"></i>Details </a></li>
                        <li class=""><a href="#adminPassword" data-toggle="tab"><i class="fa fa-key"></i>Password</a></li>
                    </ul>
                </nav>
            </div>
            <!-- tab content -->
            <div class="col-md-9 tab-content tab-content-in">
                <div class="tab-pane active text-style" id="adminDetails">
                    <div class="grid-form1">
                        <h3 id="forms-horizontal">Personal Details</h3>
                        <?php
                        $attributes = array('class' => 'form-horizontal', 'id' => 'edit_admin');
                        echo form_open('admin/edit_details', $attributes);
                        foreach($admin_details as $ad){
                            ?>
                            <div id="details_success"></div>
                            <div class="form-group">
                                <label for="fullname" class="col-sm-3 control-label">Full Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="fullname" value="<?php echo $ad->admin_name ?>" class="form-control1" placeholder="Full Name" id="fullname">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-3 control-label">Email</label>
                                <div class="col-sm-9">
                                    <input disabled="" type="text" class="form-control1" id="disabledinput" placeholder="<?php echo $ad->admin_email ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="phone" class="col-sm-3 control-label">Phone</label>
                                <div class="col-sm-9">
                                    <input type="text" name="phone" value="<?php echo $ad->admin_phone ?>" class="form-control1" placeholder="Phone" id="phone">
                                </div>
                            </div>
                            <input type="hidden" name="ae" value="<?php echo $ad->admin_email ?>" />
                            <input type="hidden" name="ap" value="<?php echo $ad->admin_phone ?>" />
                            <div class="form-group">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <button type="submit" class="btn btn-success pull-right">Save</button>
                                </div>
                            </div>
                        <?php } ?>
                        </form>
                    </div>
                </div>
                <div class="tab-pane text-style" id="adminPassword">
                    <div class="grid-form1">
                        <h3 id="forms-horizontal">Change Password</h3>
                        <?php
                        $attributes = array('class' => 'form-horizontal', 'id' => 'change_password');
                        echo form_open('admin/change_password', $attributes);
                        foreach($admin_details as $ad){
                            ?>
                            <div id="password_success"></div>
                            <div class="form-group">
                                <label for="newpassword" class="col-sm-3 control-label">New Password</label>
                                <div class="col-sm-9">
                                    <input type="password" name="newpassword" value="<?php echo set_value('newpassword') ?>" class="form-control1" placeholder="New Password" id="newpassword">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="repassword" class="col-sm-3 control-label">Retype Password</label>
                                <div class="col-sm-9">
                                    <input type="password" name="repassword" value="<?php echo set_value('repassword') ?>" class="form-control1" placeholder="Retype Password" id="repassword">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <button type="submit" class="btn btn-success pull-right">Save</button>
                                </div>
                            </div>
                        <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>

        <script>
            $(document).ready(function() {

                $('#edit_admin').submit(function(e) {
                    e.preventDefault();

                    var me = $(this);

                    $.ajax({
                        url: me.attr('action'),
                        type: 'post',
                        data: me.serialize(),
                        dataType: 'json',
                        success: function (response) {
                            if(response.success == true){
                                $('#details_success').append('<div class="alert alert-success">' +
                                    '<i class="fa fa-check"></i>' +
                                    ' Updated Successfully' +
                                    '</div>');
                                $('.form-group').removeClass('has-error')
                                    .removeClass('has-success');
                                $('.text-danger').remove();

                                // reset the form
                                me[0].reset();

                                // close the message after seconds
                                $('.alert-success').delay(500).show(10, function() {
                                    $(this).delay(3000).hide(10, function() {
                                        $(this).remove();
                                        window.location.reload()
                                    });
                                })
                            }else {
                                $.each(response.messages, function (key, value) {
                                    var element = $('#' + key);
                                    element.closest('div.form-group')
                                        .removeClass('has-error')
                                        .addClass(value.length > 0 ? 'has-error' : 'has-success')
                                        .find('.text-danger')
                                        .remove();
                                    element.after(value)
                                })
                            }
                        }
                    });
                });

                $('#change_password').submit(function(e) {
                    e.preventDefault();

                    var me = $(this);

                    $.ajax({
                        url: me.attr('action'),
                        type: 'post',
                        data: me.serialize(),
                        dataType: 'json',
                        success: function (response) {
                            if(response.success == true){
                                $('#password_success').append('<div class="alert alert-success">' +
                                    '<i class="fa fa-check"></i>' +
                                    ' Updated Successfully' +
                                    '</div>');
                                $('.form-group').removeClass('has-error')
                                    .removeClass('has-success');
                                $('.text-danger').remove();

                                // reset the form
                                me[0].reset();

                                // close the message after seconds
                                $('.alert-success').delay(500).show(10, function() {
                                    $(this).delay(3000).hide(10, function() {
                                        $(this).remove();
                                        window.location.reload()
                                    });
                                })
                            }else {
                                $.each(response.messages, function (key, value) {
                                    var element = $('#' + key);
                                    element.closest('div.form-group')
                                        .removeClass('has-error')
                                        .addClass(value.length > 0 ? 'has-error' : 'has-success')
                                        .find('.text-danger')
                                        .remove();
                                    element.after(value)
                                })
                            }
                        }
                    });
                });
            });
        </script>
<?php $this->load->view('shared/footer');?>

<?php
/**
 * Created by PhpStorm.
 * User: d.felix
 * Date: 27/03/2017
 * Time: 19:23
 */

$this->load->view('shared/login_header');
?>

    <div class="row login">
        <div class="col-sm-10 col-md-6 col-sm-offset-1">

            <div class="jumbotron">
                <div class="col-md-12">
                    <h1>Demi Events!</h1>
                    <p > Is a platform that simplify local event planning and management. It's an ideal solution for organizers when planning events such as Wedding, Send off , Kitchen party etc</p>
                </div>
            </div>

            <div class="land-list">
                <div class="col-md-12">
                    <h3><i class="fa fa-codepen"></i> Event Management</h3>
                    <p>Easily track and manage budget details and attendee details such as pledges, cash etc <br /><br /></p>
                </div>
                <div class="col-md-12">
                    <h3><i class="fa fa-file-o"> </i> Powerful Reports</h3>
                    <p>Easy to use reporting tools that deliver real time data on the event budget and attendee details <br /><br /></p>
                </div>
                <div class="col-md-12">
                    <h3><i class="fa fa-envelope-o"></i> Message Notifications</h3>
                    <p>Demi Events allows you to send message notifications to all event members with a single click <br /><br /></p>
                </div>
            </div>
        </div>
        <div class="col-sm-10 col-sm-offset-1 col-md-3 ">
            <div class="login-bottom">
                <h2 class="text-center">Complete Your Invitation</h2>
                <?php echo form_open('admin/admin_invite/'.$admin_id.'/'.$token); ?>
                <div class="col-md-12">
                    <div class="login-mail">
                        <input type="text" name="fullname" value="<?php echo set_value('fullname'); ?>" placeholder="Full Name">
                        <i class="fa fa-user"></i>
                        <?php echo form_error('fullname')?>
                    </div>
                    <div class="login-mail">
                        <input type="text" name="phone" value="<?php echo set_value('phone'); ?>" placeholder="Phone Number">
                        <i class="fa fa-phone"></i>
                        <?php echo form_error('phone')?>
                    </div>
                    <div class="login-mail">
                        <input type="password" name="password" value="<?php echo set_value('password'); ?>" placeholder="Password">
                        <i class="fa fa-lock"></i>
                        <?php echo form_error('password')?>
                    </div>
                    <div class="login-mail">
                        <input type="password" name="password2" value="<?php echo set_value('password2'); ?>" placeholder="Repeate Password">
                        <i class="fa fa-lock"></i>
                        <?php echo form_error('password2')?>
                    </div>
                    <!--a class="news-letter" href="#">
                        <label class="checkbox1"><input type="checkbox" name="checkbox" ><i> </i>I agree with the terms</label>
                    </a-->
                </div>
                <div class="col-md-12 login-do">
                    <label class="hvr-shutter-in-horizontal login-sub">
                        <input type="submit" value="Register">
                    </label>

                </div>
                </form>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>

<?php $this->load->view('shared/login_footer') ?>
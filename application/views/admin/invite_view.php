<?php
/**
 * Created by PhpStorm.
 * User: d.felix
 * Date: 27/03/2017
 * Time: 19:23
 */


$this->load->view('shared/login_header');
?>
    <div class="login">
        <h1><a href="<?php echo base_url() ?>">Events</a></h1>
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
<?php $this->load->view('shared/login_footer') ?>
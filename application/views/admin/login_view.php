<?php
/**
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 11/21/2016
 * Time: 10:19 AM
 */

$this->load->view('shared/login_header');
?>
    <div class="login">
        <h1><a href="<?php echo site_url('admin')?>">Events</a></h1>
        <div class="login-bottom">
            <h2>Admin Login</h2>
            <?php echo form_open('admin'); ?>
                <div class="col-md-6">
                    <div id="validation-error" class="alert-danger"></div>
                    <div class="login-mail">
                        <input type="text" name="email" value="<?php echo set_value('email'); ?>" placeholder="Email Address" required="">
                        <i class="fa fa-envelope"></i>
                        <?php echo form_error('email')?>
                    </div>

                    <div class="login-mail">
                        <input type="password" name="password" value="<?php echo set_value('password'); ?>" placeholder="Password" required="">
                        <i class="fa fa-lock"></i>
                        <?php echo form_error('password')?>
                    </div>
                </div>
                <div class="col-md-6 login-do">
                    <label class="hvr-shutter-in-horizontal login-sub">
                        <input type="submit" value="Login">
                    </label>
                    <p>Do not have an account?</p>
                    <a href="<?php echo base_url('admin/register')?>" class="hvr-shutter-in-horizontal">Register</a>
                    <p>Have an event?</p>
                    <a href="<?php echo base_url()?>" class="hvr-shutter-in-horizontal login-sub">Event Login</a>
                </div>
                <div class="clearfix"> </div>
            </form>
        </div>
    </div>
<?php $this->load->view('shared/login_footer') ?>

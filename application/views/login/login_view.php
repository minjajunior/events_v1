<?php
/**
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 11/20/2016
 * Time: 3:02 PM
 */

$this->load->view('shared/login_header');
?>
    <div class="login">
        <h1><a href="<?php echo site_url('admin')?>">Events</a></h1>
        <div class="login-bottom">
            <h2>Login</h2>
            <?php echo form_open('login'); ?>
            <div class="col-md-6">
                <div class="login-mail">
                    <input type="text" name="mailcode" value="<?php echo set_value('mailcode'); ?>" placeholder="Email or Event Code">
                    <i class="fa fa-codepen"></i>
                </div>
                <?php echo form_error('mailcode')?>
                <div class="login-mail">
                    <input type="password" name="password" value="<?php echo set_value('password'); ?>" placeholder="Password">
                    <i class="fa fa-lock"></i>
                    <?php echo form_error('password')?>
                </div>
                <!--a class="news-letter " href="#">
                    <label class="checkbox1"><input type="checkbox" name="checkbox" ><i> </i>Forget Password</label>
                </a-->
            </div>
            <div class="col-md-6 login-do">
                <label class="hvr-shutter-in-horizontal login-sub">
                    <input type="submit" value="Login">
                </label>
                <p>Do not have an account?</p>
                <a href="<?php echo base_url('admin/register')?>" class="hvr-shutter-in-horizontal">Register</a>
            </div>
            <div class="clearfix"> </div>
            </form>
        </div>
    </div>
<?php $this->load->view('shared/login_footer') ?>
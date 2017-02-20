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
            <h2>Event Login</h2>
            <?php echo form_open('event'); ?>
            <div class="col-md-6">
                <div class="login-mail">
                    <input type="text" name="eventcode" value="<?php echo set_value('eventcode'); ?>" placeholder="Event Code" required="">
                    <i class="fa fa-codepen"></i>
                    <?php echo form_error('eventcode')?>
                </div>
                <div class="login-mail">
                    <input type="password" name="password" value="<?php echo set_value('password'); ?>" placeholder="Password" required="">
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
                <p>Do not have an event</p>
                <a href="<?php echo base_url('admin')?>" class="hvr-shutter-in-horizontal">Admin Login</a>
            </div>
            <div class="clearfix"> </div>
            </form>
        </div>
    </div>
<?php $this->load->view('shared/login_footer') ?>
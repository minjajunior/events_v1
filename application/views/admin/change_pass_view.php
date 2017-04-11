<?php
/**
 * Created by PhpStorm.
 * User: d.felix
 * Date: 09/04/2017
 * Time: 20:45
 */

$this->load->view('shared/login_header');
?>
<div class="login">
    <h1><a href="<?php echo base_url() ?>">Events</a></h1>
    <div class="login-bottom">
        <h2>Change Password</h2>
        <?php echo form_open('login/change_password'); ?>
        <div id="reg-response"></div>
        <div class="col-md-12">
            <div class="login-mail">
                <input type="password" name="password" value="<?php echo set_value('password'); ?>" placeholder="Password">
                <i class="fa fa-lock"></i>
                <?php echo form_error('password')?>
            </div>
            <div class="login-mail">
                <input type="password" name="password2" value="<?php echo set_value('password2'); ?>" placeholder="Repeat Password">
                <input type="hidden" name="di" value="<?php echo $id; ?>">
                <i class="fa fa-lock"></i>
                <?php echo form_error('password2')?>
            </div>
            <!--a class="news-letter" href="#">
                <label class="checkbox1"><input type="checkbox" name="checkbox" ><i> </i>I agree with the terms</label>
            </a-->
        </div>
        <div class="col-md-12 login-do">
            <label class="hvr-shutter-in-horizontal login-sub">
                <input type="submit" value="Change">
            </label>
        </div>
        </form>
        <div class="clearfix"> </div>
    </div>
</div>

<?php
$this->load->view('shared/login_footer')
?>


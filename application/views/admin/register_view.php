<?php
/**
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 11/20/2016
 * Time: 3:30 PM
 */

$this->load->view('shared/login_header');
?>
    <div class="login">
        <h1><a href="<?php echo base_url() ?>">Events</a></h1>
        <div class="login-bottom">
            <h2>Admin Register</h2>
            <?php echo form_open('admin/register'); ?>
            <div id="reg-response"></div>
            <div class="col-md-12">
                <div class="login-mail">
                    <input type="text" name="fullname" value="<?php echo set_value('fullname'); ?>" placeholder="Full Name">
                    <i class="fa fa-user"></i>
                    <?php echo form_error('fullname')?>
                </div>
                <div class="login-mail">
                    <input type="text" name="email" value="<?php echo set_value('email'); ?>" placeholder="Email Address">
                    <i class="fa fa-envelope"></i>
                    <?php echo form_error('email')?>
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
                <p>Already registered?</p>
                <a href="<?php echo base_url()?>" class="hvr-shutter-in-horizontal">Login</a>
            </div>
            </form>
            <div class="clearfix"> </div>
        </div>
    </div>

<?php
if(isset($reg_status)){ ?>
    <script>
        $('#reg-response').append('<div class="alert alert-danger">Something went wrong! Please complete your registration again</div>');
            $('.alert-danger').delay(500).show(10, function() {
            $(this).delay(3000).hide(10, function() {
                $(this).remove();
            });
        });
    </script>
<?php }else if(isset($email_status)){ ?>
<script>
    $('#reg-response').append('<div class="alert alert-info">Registration successfully, Check your mailbox to confirm your email address</div>');
    $('.alert-danger').delay(500).show(10, function() {
        $(this).delay(3000).hide(10, function() {
            $(this).remove();
        });
    });
</script>

<?php }
$this->load->view('shared/login_footer')
?>
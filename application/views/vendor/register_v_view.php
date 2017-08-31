<?php
/**
 * Created by PhpStorm.
 * User: d.felix
 * Date: 20/08/2017
 * Time: 14:01
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
                <h2>Register as Service Provider</h2>
                <?php echo form_open('vendors/register'); ?>
                <div id="reg-response"></div>
                <div class="col-md-12">
                    <?php echo form_error('fullname')?>
                    <div class="login-mail">
                        <input type="text" name="fullname" value="<?php echo set_value('fullname'); ?>" placeholder="Full Name">
                        <i class="fa fa-user"></i>
                    </div>
                    <?php echo form_error('email')?>
                    <div class="login-mail">
                        <input type="text" name="email" value="<?php echo set_value('email'); ?>" placeholder="Email Address">
                        <i class="fa fa-envelope"></i>
                    </div>
                    <?php echo form_error('phone')?>
                    <div class="login-mail">
                        <input type="text" name="phone" value="<?php echo set_value('phone'); ?>" placeholder="Phone No. E.g 255XXXXXXXXX">
                        <i class="fa fa-phone"></i>
                    </div>
                    <?php echo form_error('password')?>
                    <div class="login-mail">
                        <input type="password" name="password" value="<?php echo set_value('password'); ?>" placeholder="Password">
                        <i class="fa fa-lock"></i>
                    </div>
                    <?php echo form_error('password2')?>
                    <div class="login-mail">
                        <input type="password" name="password2" value="<?php echo set_value('password2'); ?>" placeholder="Repeate Password">
                        <i class="fa fa-lock"></i>
                    </div>
                    <div>By clicking Register, you agree to our <a href="<?php echo site_url('login/terms')?>" target="_blank">Terms</a> and that you have read our <a href="<?php echo site_url('login/policy')?>" target="_blank">Privacy Policy</a></div>
                </div>
                <div class="col-md-12 login-do">
                    <label class="hvr-shutter-in-horizontal login-sub">
                        <input type="submit" value="Register">
                    </label>
                    <p>Already registered?</p>
                    <a href="<?php echo base_url()?>" class="hvr-shutter-in-horizontal login-sub">Login</a>
                </div>
                </form>
                <div class="clearfix"> </div>
            </div>
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
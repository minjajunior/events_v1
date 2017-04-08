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
            <?php $attributes = array('id' => 'login_form');
            echo form_open('login', $attributes); ?>
            <div id="login-response"></div>
            <div class="col-md-12 login-do">
                <div class="login-mail">
                    <input type="text" name="mailphone" id="mailphone" value="<?php echo set_value('mailphone'); ?>" placeholder="Eg: 2557XXXXXXXX or Email">
                </div>
            </div>
            <div class="col-md-12 login-do">
                <label class="hvr-shutter-in-horizontal login-sub">
                    <input type="submit" name="next" id="next" value="Next">
                </label>
                <div id="reg-link">
                    <p>Do not have an account ?</p>
                    <a href="<?php echo base_url('admin/register')?>" class="hvr-shutter-in-horizontal"><b>Register</b></a>
                </div>
            </div>
            <div class="clearfix"> </div>
            </form>
        </div>
    </div>

    <script>
        $('#login_form').submit(function(e) {
            e.preventDefault();

            var me = $(this);

            $.ajax({
                url: me.attr('action'),
                type: 'post',
                data: me.serialize(),
                dataType: 'json',
                success: function (response) {
                    if(response.loginStatus == false) {
                     $('#login-response').append('<div class="alert alert-danger">Sorry! The Phone number or email you have entered is not recognised in our system </div>');
                     $('.alert-danger').delay(500).show(10, function() {
                        $(this).delay(3000).hide(10, function() {
                            $(this).remove();
                        });
                     });
                    } else if(response.loginStatus == 'admin'){
                        $('#mailphone').replaceWith('<input type="password" name="password" class="form-control" id="password" placeholder="Enter Password">');
                        $('.login-mail').append('<input type="hidden" name="mailphone" value="'+ response.email +'" id="email" />');
                        $('#next').replaceWith('<input type="submit" name="submit" value="login" id="submit" />');
                        $('#reg-link').replaceWith('<div id="pass-link"><p>Forgot Password ?</p>' +
                            '<a href="<?php echo base_url('admin/register')?>" class="hvr-shutter-in-horizontal"><b>Reset Password</b></a>' +
                            '</div>');
                    } else if(response.loginStatus == 'password'){
                        $('#login-response').append('<div class="alert alert-danger">Sorry! Your have entered the wrong password</div>');
                        $('.alert-danger').delay(500).show(10, function() {
                            $(this).delay(3000).hide(10, function() {
                                $(this).remove();
                            });
                        });
                    } else if (response.smsStatus == "MESSAGE_SENT") {
                        $('#mailphone').replaceWith('<input type="text" name="pin" class="form-control" id="pin" placeholder="Enter Pin">');
                        $('.login-mail').append('<input type="hidden" name="pinId" value="'+ response.pinId +'" id="pinId" />');
                        $('.login-mail').append('<input type="hidden" name="mailphone" value="'+ response.to +'" id="phone" />');
                        $('#next').replaceWith('<input type="submit" name="submit" value="login" id="submit" />');
                        $('#reg-link').replaceWith('<div id="pin-link"><p>Did not receive a code ?</p>' +
                            '<a href="#" class="hvr-shutter-in-horizontal"><b>Resend Pin Code</b></a>' +
                            '</div>');
                    } else if(response.smsStatus == "MESSAGE_NOT_SENT"){
                        $('#login-response').append('<div class="alert alert-danger">Pin Code Not delivered. Please check the number and try again </div>');
                        $('.alert-danger').delay(500).show(10, function() {
                            $(this).delay(3000).hide(10, function() {
                                $(this).remove();
                            });
                        });
                    } else if (response.verified == true){
                        if(response.user == 'admin'){
                            window.location = "<?php echo site_url('admin') ?>";
                        } else {
                            window.location = "<?php echo site_url('member')?>";
                        }
                    }
                }
            });
        });
    </script>
<?php $this->load->view('shared/login_footer') ?>
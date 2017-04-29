<?php
/**
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 11/20/2016
 * Time: 3:02 PM
 */

$this->load->view('shared/login_header');
?>
<div class="row login">
    <div class=" col-md-6 col-md-offset-1">

        <div class="jumbotron">
            <h1>Demi Events!</h1>
            <p class="lead"> Is a platform that simplify local event planning and management. It's an ideal solution for organizers when planning events such as Wedding, Send off , Kitchen party etc</p>
        </div>

        <div class="row land-list">
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
    <div class=" col-md-3 col-md-offset-1">
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
            <div class="col-md-12 login-do pass-do">
                <label class="hvr-shutter-in-horizontal login-sub">
                    <input type="submit" name="next" id="next" value="Next">
                </label>
                <div id="reg-link">
                    <p>Do not have an account ?</p>
                    <a href="<?php echo base_url('admin/register')?>" class="hvr-shutter-in-horizontal login-sub"><b>Register</b></a>
                </div>
            </div>
            <div class="clearfix"> </div>
            </form>
        </div>
    </div>
</div>

<?php
if(isset($reg_status)){ ?>
    <script>
        $('#login-response').append('<div class="alert alert-success">Your registration completed successfully! Use your email to login</div>');
        $('.alert-danger').delay(500).show(10, function() {
            $(this).delay(3000).hide(10, function() {
                $(this).remove();
            });
        });
    </script>
<?php } else if(isset($pass_expire)){ ?>
    <script>
    $('#login-response').append('<div class="alert alert-danger">Verification code has expired, Reset your password again</div>');
    $('.alert-danger').delay(500).show(10, function() {
        $(this).delay(3000).hide(10, function() {
            $(this).remove();
        });
    });
    </script>
<?php } else if(isset($pass_change)){ ?>
    <script>
    $('#login-response').append('<div class="alert alert-success">Password changed successfully, You can now login</div>');
    $('.alert-danger').delay(500).show(10, function() {
        $(this).delay(3000).hide(10, function() {
            $(this).remove();
        });
    });
    </script>

<?php } ?>

    <script>
        $( document ).ready(function() {

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
                                '<a href="javascript:void(0)" class="pass-f-link hvr-shutter-in-horizontal login-sub" value="'+ response.email +'"><b>Reset Password</b></a>' +
                                '</div>');
                        } else if(response.loginStatus == 'password'){
                            $('#login-response').append('<div class="alert alert-danger">Sorry! Your have entered the wrong password</div>');
                            $('.alert-danger').delay(500).show(10, function() {
                                $(this).delay(3000).hide(10, function() {
                                    $(this).remove();
                                });
                            });
                        }else if(response.loginStatus == 'reg_status'){
                            $('#login-response').append('<div class="alert alert-danger">Sorry! You have not completed registration</div>');
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
                                '<a href="#" class="hvr-shutter-in-horizontal login-sub"><b>Resend Pin Code</b></a>' +
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

            $('.pass-do').on("click", ".pass-f-link", function() {

            //alert('Hello');
            var email = $(this).attr("value");

            var postData = {
                'email': email,
            };

            $.ajax({
                    type:"POST",
                    url: "<?php echo base_url('login/password')?>",
                    data:postData,
                    dataType: 'json',
                    success: function(response){

                        if (response.success == true) {
                            $('#login-response').append('<div class="alert alert-success"> Check your mailbox, Password link has been sent to your email</div>');
                            $('.alert-danger').delay(500).show(10, function () {
                                $(this).delay(3000).hide(10, function () {
                                    $(this).remove();
                                });
                            });
                        }else if(response.success == false){
                            $('#login-response').append('<div class="alert alert-danger">Please! Try again to reset your password</div>');
                            $('.alert-danger').delay(500).show(10, function () {
                                $(this).delay(3000).hide(10, function () {
                                    $(this).remove();
                                });
                            });

                        }



                    }
            });

        });

        });
    </script>
<?php $this->load->view('shared/login_footer') ?>
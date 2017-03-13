<?php
/**
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 3/13/2017
 * Time: 1:40 PM
 */
?>
<div class="blank">
    <div class="grid-form1">
        <h3 id="forms-horizontal">Change Password</h3>
        <?php
        $attributes = array('class' => 'form-horizontal', 'id' => 'edit_password');
        echo form_open('event/password/'.$event_id, $attributes);
        foreach($event_details as $ed){
            ?>
            <div id="the-message"></div>
            <div class="form-group">
                <label for="password" class="col-sm-2 control-label">Current Password</label>
                <div class="col-sm-8">
                    <input type="password" name="password" value="<?php echo set_value('password') ?>" class="form-control1" placeholder="Current Password" id="password">
                </div>
            </div>
            <input type="hidden" name="op" value="<?php echo $ed->event_password ?>" />
            <div class="form-group">
                <label for="newpassword" class="col-sm-2 control-label">New Password</label>
                <div class="col-sm-8">
                    <input type="password" name="newpassword" value="<?php echo set_value('newpassword') ?>" class="form-control1" placeholder="New Password" id="newpassword">
                </div>
            </div>
            <div class="form-group">
                <label for="repassword" class="col-sm-2 control-label">Re-enter Password</label>
                <div class="col-sm-8">
                    <input type="password" name="repassword" value="<?php echo set_value('repassword') ?>" class="form-control1" placeholder="Re-enter Password" id="repassword">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-8 col-sm-offset-2">
                    <button type="submit" class="btn btn-success pull-right">Save</button>
                </div>
            </div>
            </form>
        <?php } ?>
    </div>
</div>

<script>
    $('#edit_password').submit(function(e) {
        e.preventDefault();

        var me = $(this);

        $.ajax({
            url: me.attr('action'),
            type: 'post',
            data: me.serialize(),
            dataType: 'json',
            success: function (response) {
                if(response.success == true){
                    $('#the-message').append('<div class="alert alert-success">' +
                        '<span class="glyphicon glyphicon-ok"></span>' +
                        ' Member Updated Successfully' +
                        '</div>');
                    $('.form-group').removeClass('has-error')
                        .removeClass('has-success');
                    $('.text-danger').remove();

                    // reset the form
                    me[0].reset();

                    // close the message after seconds
                    $('.alert-success').delay(500).show(10, function() {
                        $(this).delay(3000).hide(10, function() {
                            $(this).remove();
                        });
                    })
                }else {
                    $.each(response.messages, function (key, value) {
                        var element = $('#' + key);
                        element.closest('div.form-group')
                            .removeClass('has-error')
                            .addClass(value.length > 0 ? 'has-error' : 'has-success')
                            .find('.text-danger')
                            .remove();
                        element.after(value)
                    })
                }
            }
        });
    });
</script>
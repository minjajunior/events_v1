<?php
/**
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 12/3/2016
 * Time: 10:09 AM
 */

?>

<div class="blank">
    <div class="grid-form1">
        <h3 id="forms-horizontal">Add <?php echo $type ?></h3>
        <?php if($type == 'Pledge' || $type == "Cash") {
            $attributes = array('class' => 'form-horizontal', 'id' => 'transaction');
            echo form_open('event/transaction/'.$type.'/'.$member_id, $attributes);
            foreach($member_detail as $md){ ?>
                <div id="the-message"></div>
                <div class="form-group">
                    <label for="disabledinput" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-8">
                        <input disabled="" type="text" name="membername" value="<?php echo $md->member_name ?>" class="form-control1" id="disabledinput" placeholder="Member Name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="amount" class="col-sm-2 control-label"><?php echo $type?></label>
                    <div class="col-sm-8">
                        <input  type="text" name="amount" value="" class="form-control1" id="amount" placeholder="Amount">
                    </div>
                </div>
                <input type="hidden" name="memberpledge" value="<?php echo $md->member_pledge ?>" />
                <input type="hidden" name="membercash" value="<?php echo $md->member_cash ?>" />
                <div class="form-group">
                    <div class="col-sm-8 col-md-offset-2">
                        <button type="submit" class="btn btn-danger pull-right">Add <?php echo $type?></button>
                    </div>
                </div>
            <?php } ?>
            </form>
        <?php }
        if($type == 'Cost' || $type == "Payment") {
            $attributes = array('class' => 'form-horizontal', 'id' => 'transaction');
            echo form_open('event/transaction/'.$type.'/'.$item_id, $attributes);
            ?>
            <?php foreach($item_detail as $idt){ ?>
                <div id="the-message"></div>
                <div class="form-group">
                    <label for="disabledinput" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-8">
                        <input disabled="" type="text" name="itemname" value="<?php echo $idt->item_name ?>" class="form-control1" id="disabledinput" placeholder="Member Name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="focusedinput" class="col-sm-2 control-label"><?php echo $type?></label>
                    <div class="col-sm-8">
                        <input  type="text" name="amount" value="" class="form-control1" id="focusedinput" placeholder="Amount">
                        <?php echo form_error('amount'); ?>
                    </div>
                </div>
                <input type="hidden" name="itemcost" value="<?php echo $idt->item_cost ?>" />
                <input type="hidden" name="itempaid" value="<?php echo $idt->item_paid ?>" />
                <div class="form-group">
                    <div class="col-sm-8 col-md-offset-2">
                        <button type="submit" class="btn btn-default">Add</button>
                    </div>
                </div>
            <?php } ?>
            </form>
        <?php } ?>
    </div>
</div>

<script>
    $('#transaction').submit(function(e) {
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
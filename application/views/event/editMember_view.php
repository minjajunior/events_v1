<?php
/**
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 12/2/2016
 * Time: 4:12 PM
 */
?>

<div class="blank">
    <div class="grid-form1">
        <h3 id="forms-horizontal">Edit Member</h3>
        <?php
        $attributes = array('class' => 'form-horizontal', 'id' => 'edit_member');
        echo form_open('event/edit_member/'.$member_id, $attributes);
        foreach($member_detail as $md){ ?>
            <div id="the-message"></div>
            <div class="form-group">
                <label for="membername" class="col-sm-2 control-label">Member Name</label>
                <div class="col-sm-8">
                    <input type="text" name="membername" value="<?php echo $md->member_name ?>" class="form-control1" id="membername" placeholder="Member Name">
                </div>
            </div>
            <div class="form-group">
                <label for="memberphone" class="col-sm-2 control-label">Phone Number</label>
                <div class="col-sm-8">
                    <input type="text" name="memberphone" value="<?php echo $md->member_phone ?>" class="form-control1" id="memberphone" placeholder="Phone Number">
                </div>
            </div>
            <div class="form-group">
                <label for="location" class="col-sm-2 control-label">Group</label>
                <div class="col-sm-8">
                    <select name="group" id="selector1" class="form-control1">
                        <option value="">Select Group</option>
                        <?php foreach($member_group as $mg){ ?>
                            <option value="<?php echo $mg->group_id; ?>" <?php if($mg->group_id == $md->group_id){ echo set_select('group', $mg->group_id, true); } ?> id="group"><?php echo $mg->group_name; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="disabledinput" class="col-sm-2 control-label">Member Pledge</label>
                <div class="col-sm-8">
                    <input disabled="" type="text" name="memberpledge" value="<?php echo $md->member_pledge ?>" class="form-control1" id="disabledinput" placeholder="Member Pledge">
                </div>
                <div class="col-sm-2">
                    <a href="javascript:void(0)" class="transaction btn btn-success" type="Pledge" rel="<?php echo $member_id; ?>" id="transaction_view">Add Pledge</a>
                </div>
            </div>
            <div class="form-group">
                <label for="focusedinput" class="col-sm-2 control-label">Member Cash</label>
                <div class="col-sm-8">
                    <input disabled="" type="text" name="membercash" value="<?php echo $md->member_cash ?>" class="form-control1" id="focusedinput" placeholder="Member Cash">
                </div>
                <div class="col-sm-2">
                    <a href="javascript:void(0)" class="transaction btn btn-success" type="Cash" rel="<?php echo $member_id; ?>" id="transaction_view">Add Cash</a>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-8 col-md-offset-2">
                    <button type="submit" class="btn btn-danger pull-right">Save</button>
                </div>
            </div>
        <?php } ?>
        </form>
    </div>
</div>

<script>

</script>

<script>
    $(document).ready(function() {

        var getContentView = function(postData) {
            $.ajax({
                type:"POST",
                url: "<?php echo base_url('event/load_views')?>",
                data:postData,
                dataType: "html",
                success: function(data) {
                    $('#load_navigation_menu_view').html(data);
                },
                error: function(data) {

                    alert('An error has occured trying to get the page details');
                }
            });
        }

        $('.grid-form1').on("click", ".transaction", function() {
            var view_name = $(this).attr("id");
            var member_id = $(this).attr("rel");
            var type = $(this).attr("type");
            var postData = {
                'view_name': view_name,
                'member_id': member_id,
                'type': type,
            };

            getContentView(postData);
        });

        $('#edit_member').submit(function(e) {
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
                            '<i class="fa fa-check"></i>' +
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
                                var postData = {
                                    'view_name' : 'editMember_view',
                                    'member_id' : '<?php echo $member_id ?>'
                                };
                                getContentView(postData);
                            });
                        });

                    }else {
                        $.each(response.messages, function (key, value) {
                            var element = $('#' + key);
                            element.closest('div.form-group')
                                .removeClass('has-error')
                                .addClass(value.length > 0 ? 'has-error' : 'has-success')
                                .find('.text-danger')
                                .remove();
                            element.after(value)
                        });
                    }
                },

            });
        });
    });
</script>

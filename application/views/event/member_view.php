<?php
/**
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 2/20/2017
 * Time: 5:15 PM
 */
?>

<div class="blank">
    <?php if(isset($this->session->admin_id)) { ?>
        <div class="blank-page">
            <h4>
                Members

                    <a href="#" class="pull-right" data-toggle="modal" data-target="#newMember">
                        New Member
                    </a>
                    <div class="modal fade" id="newMember" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h2 class="modal-title">New Member</h2>
                                </div>
                                <?php
                                $attributes = array('class' => 'form-horizontal', 'id' => 'new_member');
                                echo form_open('event/new_member/'.$event_id, $attributes);
                                ?>
                                <div class="modal-body">
                                    <div id="the-message"></div>
                                    <div class="form-group">
                                        <label for="membername" class="col-sm-4 control-label">Member Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="membername" value="<?php echo set_value('membername'); ?>" class="form-control1" id="membername" placeholder="Member Name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="memberpledge" class="col-sm-4 control-label">Member Pledge</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="memberpledge" value="<?php echo set_value('memberpledge'); ?>" class="form-control1" id="memberpledge" placeholder="Member Pledge">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="membercash" class="col-sm-4 control-label">Member Cash</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="membercash" value="<?php echo set_value('membercash'); ?>" class="form-control1" id="membercash" placeholder="Member Cash">
                                            <?php echo form_error('membercash'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="memberphone" class="col-sm-4 control-label">Phone Number</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="memberphone" value="<?php echo set_value('memberphone'); ?>" class="form-control1" id="memberphone" placeholder="Phone Number">
                                            <?php echo form_error('memberphone'); ?>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success pull-left" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger">Submit</button>
                                </div>
                                </form>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>
            </h4>
            <hr>
            <?php if (isset($member_details['error']) && $member_details['error'] == "0") {?>
                No members found. Create <a href="#" data-toggle="modal" data-target="#newMember">new member</a> or upload your members file.
            <?php } else { ?>
                <div class="tables">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Member Name</th>
                            <th>Pledge</th>
                            <th>Cash</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($member_details as $md){ ?>
                            <tr>
                                <?php if(isset($this->session->admin_id)){ ?>
                                    <td><a href="<?php echo site_url('event/edit_member/'.$md->member_id) ?>"><?php echo $md->member_name?></a></td>
                                <?php } else { ?>
                                    <td><?php echo $md->member_name?></td>
                                <?php } ?>
                                <td><?php echo $english_format_number = number_format($md->member_pledge, 0, '.', ',')." Tsh.";?></td>
                                <td><?php echo $english_format_number = number_format($md->member_cash, 0, '.', ',')." Tsh."; ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php } ?>
        </div>
        <div class="clearfix"> </div>
        <br>
        <div class="blank-page">
            <a class="btn btn-danger" href="<?php echo site_url('event/template/member')?>" >Download Member Template</a>
            <?php echo form_open_multipart('event/upload_members/'.$event_id); ?>
            <div class="form-group">
                <input type="file" name="members">
                <p class="help-block">Upload .xls or .xlsx file</p>
            </div>
            <button type="submit" name="submit" class="btn btn-danger">Upload</button>
            </form>
        </div>
    <?php } ?>
</div>

<script>
    $('#new_member').submit(function(e) {
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
                        ' Member Created Successfully' +
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
                            window.location.reload()
                            $('#newMember').modal('hide');
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

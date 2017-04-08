<?php
/**
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 2/20/2017
 * Time: 4:09 PM
 */
?>

<div class="blank">
    <?php if(isset($this->session->admin_id)){ ?>
        <div class="blank-page">
            <h4>Budget
                <a href="#" class="pull-right" data-toggle="modal" data-target="#newItem" data-placement="bottom" title="Add Budget Item">&nbsp;<i class="fa fa-plus-square"></i>&nbsp;</a>
                <a href="#" class="pull-right" data-toggle="modal" data-target="#uploadBudget" data-placement="bottom" title="Upload Budget File">&nbsp;<i class="fa fa-upload"></i>&nbsp;</a>
                <a href="<?php echo site_url('event/template/budget')?>" class="pull-right" data-toggle="tooltip" data-placement="bottom" title="Download Budget Template" >&nbsp;<i class="fa fa-download"></i>&nbsp;</a>
            </h4>
            <hr>
            <?php if (isset($budget_details['error']) && $budget_details['error'] == "0") {?>
                No budget items found create new item or upload your budget file.
            <?php } else { ?>
                <div class="tables">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Cost (Tsh.)</th>
                            <th>Paid (Tsh.)</th>
                            <th>Balance (Tsh.)</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($budget_details as $bd){ ?>
                            <tr>
                                <td><a href="javascript:void(0)" class="edit_budget" rel="<?php echo $bd->item_id; ?>" id="editBudget_view"><?php echo $bd->item_name?></a></td>
                                <td><?php echo $english_format_number = number_format($bd->item_cost, 0, '.', ',');?></td>
                                <td><?php echo $english_format_number = number_format($bd->item_paid, 0, '.', ','); ?></td>
                                <td><?php echo $english_format_number = number_format($bd->item_cost-$bd->item_paid, 0, '.', ','); ?></td>
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
            <?php echo form_open_multipart('event/upload_budget/'.$event_id); ?>
            <div class="form-group">
                <input type="file" accept=".xls,.xlsx" name="budget">
                <p class="help-block">Upload .xls or .xlsx file</p>
            </div>
            <button type="submit" name="submit" class="btn btn-danger">Upload</button>
            </form>
        </div>
    <?php } ?>
</div>

<div class="modal fade" id="newItem" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h2 class="modal-title">New Item</h2>
            </div>
            <?php
            $attributes = array('class' => 'form-horizontal', 'id' => 'new_item');
            echo form_open('event/new_item/'.$event_id, $attributes);
            ?>
            <div class="modal-body">
                <div id="the-message"></div>
                <div class="form-group">
                    <label for="itemname" class="col-sm-4 control-label">Item Name</label>
                    <div class="col-sm-8">
                        <input type="text" name="itemname" value="<?php echo set_value('itemname'); ?>" class="form-control1" id="itemname" placeholder="Item Name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="itemcost" class="col-sm-4 control-label">Item Cost</label>
                    <div class="col-sm-8">
                        <input type="text" name="itemcost" value="<?php echo set_value('itemcost'); ?>" class="form-control1" id="itemcost" placeholder="Item Cost">
                    </div>
                </div>
                <div class="form-group">
                    <label for="itempaid" class="col-sm-4 control-label">Item Paid</label>
                    <div class="col-sm-8">
                        <input type="text" name="itempaid" value="<?php echo set_value('itempaid'); ?>" class="form-control1" id="itempaid" placeholder="Item Paid">
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

<div class="modal fade" id="uploadBudget" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h2 class="modal-title">Upload Budget File</h2>
            </div>
            <?php
                $attributes = array('class' => 'form-horizontal', 'id' => 'upload_budget');
                echo form_open_multipart('event/upload_budget/'.$event_id, $attributes);
            ?>
            <div class="modal-body">
                <div id="the-message"></div>
                <div class="form-group">
                    <label for="budget" class="col-sm-4 control-label">Browse File</label>
                    <div class="col-sm-8">
                        <input type="file" accept=".xls,.xlsx" name="budget" id="budget">
                        <p class="help-block">Upload .xls or .xlsx file</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success pull-left" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Upload</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<script>
    $('#new_item').submit(function(e) {
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
                        ' Item Created Successfully' +
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
                            $('#newItem').modal('hide');
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
<script>
    $('#upload_budget').submit(function(e) {
        e.preventDefault();

        var form = $(this);

        $.ajax({
            url: form.attr('action'),
            type: 'post',
            data: form.serialize(),
            dataType: 'json',
            success: function (response) {
                if(response.success == true){
                    $('#the-message').append('<div class="alert alert-success">' +
                        '<span class="glyphicon glyphicon-ok"></span>' +
                        ' Budget Uploaded Successfully' +
                        '</div>');
                    $('.form-group').removeClass('has-error')
                        .removeClass('has-success');
                    $('.text-danger').remove();

                    // reset the form
                    form[0].reset();

                    // close the message after seconds
                    $('.alert-success').delay(500).show(10, function() {
                        $(this).delay(3000).hide(10, function() {
                            $(this).remove();
                            window.location.reload()
                            $('#upload_budget').modal('hide');
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
<script>
    $(document).ready(function() {

        var getContentView = function(postData) {
            $.ajax({
                type:"POST",
                url: "<?php echo base_url('event/load_views')?>",
                //data:"id="+view_name,
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

        $('.table').on("click", ".edit_budget", function() {
            var view_name = $(this).attr("id");
            var item_id = $(this).attr("rel");
            var postData = {
                'view_name': view_name,
                'item_id': item_id,
            };

            getContentView(postData);
        });
    });
</script>

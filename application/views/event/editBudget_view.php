<?php
/**
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 12/5/2016
 * Time: 10:31 AM
 */
?>

<div class="banner">
    <h2>
        <a href="<?php echo site_url('event/home/'.base64_encode($event_id)) ?>">Event</a>
        <i class="fa fa-angle-right"></i>
        <a href="javascript:void(0)" class="bread" rel="<?php echo $event_id; ?>" id="budget_view">Budget</a>
        <i class="fa fa-angle-right"></i>
        <span>Edit Item</span>
    </h2>
</div>

<div class="blank">
    <div class="grid-form1">
        <h3 id="forms-horizontal">Edit Item</h3>
        <?php
        $attributes = array('class' => 'form-horizontal', 'id' => 'edit_budget');
        echo form_open('event/edit_budget/'.$item_id, $attributes);
        foreach($item_detail as $idt){ ?>
            <div id="the-message"></div>
            <div class="form-group">
                <label for="itemname" class="col-sm-2 control-label">Item Name</label>
                <div class="col-sm-8">
                    <input type="text" name="itemname" value="<?php echo $idt->item_name ?>" class="form-control1" id="itemname" placeholder="Item Name">
                </div>
            </div>
            <div class="form-group">
                <label for="itemcost" class="col-sm-2 control-label">Item Cost</label>
                <div class="col-sm-8">
                    <input disabled="" type="text" name="itemcost" value="<?php echo $idt->item_cost ?>" class="form-control1" id="itemcost" placeholder="Item Cost">
                </div>
                <div class="col-sm-2">
                    <a href="javascript:void(0)" class="transaction btn btn-success" type="Cost" rel="<?php echo $item_id; ?>" id="transaction_view">Add Cost</a>
                </div>
            </div>
            <div class="form-group">
                <label for="itempaid" class="col-sm-2 control-label">Item Paid</label>
                <div class="col-sm-8">
                    <input disabled="" type="text" name="itempaid" value="<?php echo $idt->item_paid ?>" class="form-control1" id="itempaid" placeholder="Item Paid">
                </div>
                <div class="col-sm-2">
                    <a href="javascript:void(0)" class="transaction btn btn-success" type="Payment" rel="<?php echo $item_id; ?>" id="transaction_view">Add Payment</a>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-8 col-md-offset-2">
                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteItem">Delete</a>
                    <button type="submit" class="btn btn-success pull-right">Save</button>
                </div>
            </div>
        <?php } ?>
        </form>
    </div>
</div>

<div class="modal fade" id="deleteItem" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h2 class="modal-title">Delete Item</h2>
            </div>
            <div class="modal-body">
                <div class="the-response"></div>
                <?php foreach ($item_detail as $idt) { ?>
                    <p>Are you sure you want to delete <?php echo $idt->item_name ?>?</p>
                <?php } ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success pull-left" data-dismiss="modal">Cancel</button>
                <a href="javascript:void(0)" class="delete_item btn btn-danger" rel="<?php echo $item_id; ?>" id="editBudget_view">Delete</a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

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
        };

        $('.grid-form1').on("click", ".transaction", function() {
            var view_name = $(this).attr("id");
            var item_id = $(this).attr("rel");
            var type = $(this).attr("type");
            var postData = {
                'view_name': view_name,
                'item_id': item_id,
                'type': type,
            };

            getContentView(postData);
        });

        $('#edit_budget').submit(function(e) {
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
                            ' Item Updated Successfully' +
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
                                    'view_name' : 'editBudget_view',
                                    'item_id' : '<?php echo $item_id ?>'
                                };
                                getContentView(postData);
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

        $('.banner').on("click", ".bread", function() {
            var view_name = $(this).attr("id");
            var event_id = $(this).attr("rel");
            var postData = {
                'view_name': view_name,
                'event_id': event_id,
            };

            getContentView(postData);
        });

        $('.modal-footer').on("click", ".delete_item", function () {
            var view_name = 'budget_view';

            var postValue = {
                'view_name': view_name,
                'event_id': <?php echo $event_id?>,
            };

            $.ajax({
                type:"POST",
                url: "<?php echo base_url('event/delete_item/'.$item_id)?>",
                //data:"id="+view_name,
                data:postValue,
                dataType: "json",
                success: function(response) {
                    if(response.success == true) {
                        $('#deleteItem').modal('hide');

                        $('#the-message').delay(100).show(10, function() {
                            $(this).delay(300).hide(10, function() {
                                getContentView(postValue);
                            });
                        });
                    }
                }
            });
        });
    });
</script>
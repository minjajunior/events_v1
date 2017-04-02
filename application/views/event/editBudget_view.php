<?php
/**
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 12/5/2016
 * Time: 10:31 AM
 */
?>

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
                    <button type="submit" class="btn btn-danger pull-right">Save</button>
                </div>
            </div>
        <?php } ?>
        </form>
    </div>
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
        }

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
    });
</script>
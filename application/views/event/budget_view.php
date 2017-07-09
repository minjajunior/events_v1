<?php
/**
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 2/20/2017
 * Time: 4:09 PM
 */
?>

<div class="banner">
    <h2>
        <a href="<?php echo site_url('event/home/'.base64_encode($event_id)) ?>">Event</a>
        <i class="fa fa-angle-right"></i>
        <span>Budget</span>
    </h2>
</div>

<div class="blank">
    <?php if(isset($this->session->admin_id)){ ?>
        <div class="blank-page">
            <h4><div class="col-sm-3 col-xs-12">Budget</div>
            <?php if(date_add(date_create($event_date), date_interval_create_from_date_string('7 days')) > date_create(date('Y-m-d'))) { ?>
                <div class="col-sm-9">
                <a href="#" class=" col-xs-12 col-sm-3 btn btn-sm btn-success" data-toggle="modal" data-target="#newItem" data-placement="bottom" title="Add Budget Item"><i class="fa fa-plus-square"></i> New Item</a>
                    <a href="#" class="col-xs-12 col-sm-3 btn btn-sm btn-success" data-toggle="modal" data-target="#uploadBudget" data-placement="bottom" title="Upload Budget File"><i class="fa fa-upload"></i> Upload Budget</a>
                    <a href="<?php echo site_url('event/template/budget')?>" class=" col-xs-12 col-sm-3 btn btn-sm btn-success" data-toggle="tooltip" data-placement="bottom" title="Download Budget Template" ><i class="fa fa-download"></i> Download Template</a>
                </div>
            <?php } ?>
            </h4>
            <hr>
            <?php if (isset($budget_details['error']) && $budget_details['error'] == "0") {?>
                No budget items found. Create <a href="#" data-toggle="modal" data-target="#newItem"> new item</a> or upload your budget file or use our budget <a href="#" data-toggle="modal" data-target="#estimator"> estimator </a> to create your budget.
                <div class="clearfix"></div>

            <?php } else { ?>
                <div class="col-md-12">
                    <a href="#" class=" col-sm-2 col-xs-12 btn btn-sm btn-warning pull-right" data-toggle="modal" data-target="#deleteAll"> <i class="fa fa-trash"></i> Delete All</a>
                </div>
                <div class="tables">
                    <table id="table_item" class="table table-hover">
                        <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Cost (TZS)</th>
                            <th>Paid (TZS)</th>
                            <th class="hidden-xs">Balance (TZS)</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($budget_details as $bd){ ?>
                            <tr>
                                <td>
                                    <?php if (date_add(date_create($event_date), date_interval_create_from_date_string('7 days')) > date_create(date('Y-m-d'))) { ?>
                                        <a href="javascript:void(0)" class="edit_budget" rel="<?php echo $bd->item_id; ?>" id="editBudget_view"><?php echo $bd->item_name?></a>
                                    <?php } else {
                                        echo $bd->item_name;
                                    } ?>
                                </td>
                                <td><?php echo $english_format_number = number_format($bd->item_cost, 0, '.', ',');?></td>
                                <td><?php echo $english_format_number = number_format($bd->item_paid, 0, '.', ','); ?></td>
                                <td class="hidden-xs"><?php echo $english_format_number = number_format($bd->item_cost-$bd->item_paid, 0, '.', ','); ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php } ?>
        </div>
        <div class="clearfix"> </div>
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
                <div class="box">
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success pull-left" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Submit</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="estimator" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h2 class="modal-title">Budget Estimator</h2>
            </div>
            <?php
            $attributes = array('class' => 'form-horizontal', 'id' => 'budget_estimate');
            echo form_open('event/estimator/'.$event_id, $attributes);
            ?>
            <div class="modal-body">
                <div class="box">
                    <div id="the-message"></div>
                    <div class="alert alert-info">
                        <i class="fa fa-info-circle"></i> This function is still under construction
                    </div>
                    <div id="the-message"></div>
                    <div class="form-group">
                        <label for="guest_no" class="col-sm-4 control-label">Number of Guests</label>
                        <div class="col-sm-8">
                            <input type="text" name="guest_no" value="<?php echo set_value('guestno'); ?>" class="form-control1" id="guest_no" placeholder="Number of Guests">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="standard" class="col-sm-4 control-label">Event Standard</label>
                        <div class="col-sm-8">
                            <select name="standard" class="form-control1">
                                <option value="">Select One</option>
                                <option id="standard" value="royal">Royal</option>
                                <option id="standard" value="classic">Classic</option>
                                <option id="standard" value="normal">Normal</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success pull-left" data-dismiss="modal">Cancel</button>
                <button id="budget_s_button" type="submit" class="  btn btn-primary" style=''>Submit</button>
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
                <div class="box">
                    <div id="upload-response"></div>
                    <div class="form-group">
                        <label for="budget" class="col-sm-4 control-label">Browse File</label>
                        <div class="col-sm-8">
                            <input type="file" accept=".xls,.xlsx" name="budget" id="budget">
                            <p class="help-block">Upload .xls or .xlsx file</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success pull-left" data-dismiss="modal">Cancel</button>
                <button type="submit" id="uploadBtn" data-loading-text="Uploading..." data-complete-text="Uploaded" class="btn btn-primary" autocomplete="off">
                    Upload
                </button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="deleteAll" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h2 class="modal-title">Delete All Items</h2>
            </div>
            <div class="modal-body">
                <div class="delete-message"></div>
                <p>Are you sure you want to delete all budget items?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success pull-left" data-dismiss="modal">Cancel</button>
                <a href="javascript:void(0)" class="delete_all_items btn btn-danger" rel="<?php echo $event_id; ?>" id="budget_view">Delete</a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<script>
    $(document).ready(function() {

        $('#table_item').DataTable({
            "dom": "<'row'<'col-sm-6'l><'col-sm-6'f>>"+"<'row'<'col-sm-12'tr>>"+"<'row'<'col-sm-6 col-xs-12' i><'col-sm-6 col-xs-12'p>>",
//            "dom": "<'row'<'col-sm-6'l><'col-sm-6'f>>"+"<'row'<'col-sm-12'tr>>"+"<'row'<'col-sm-6 col-xs-12' i><'col-sm-6 col-xs-12'p>>",
        });

        $('#budget_estimate').submit(function(e) {
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
                            'Budget Created Successfully' +
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
                                $('#newItem').modal('hide');
                                var postData = {
                                    'view_name' : 'budget_view',
                                    'event_id' : '<?php echo $event_id ?>'
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
                        });
                    }
                }
            });


        });



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

        $('.modal-footer').on("click", ".delete_all_items", function () {
            var view_name = 'budget_view';

            var postValue = {
                'view_name': view_name,
                'event_id': <?php echo $event_id?>,
            };

            $.ajax({
                type:"POST",
                url: "<?php echo base_url('event/delete_all_items/'.$event_id)?>",
                //data:"id="+view_name,
                data:postValue,
                dataType: "json",
                success: function(response) {
                    if(response.success == true) {
                        $('.delete-message').append('<div class="alert alert-success">' +
                            '<i class="fa fa-check"></i>' +
                            'All Items Deleted Successfully' +
                            '</div>');


                        $('.alert-success').delay(500).show(10, function() {
                            $(this).delay(300).hide(10, function() {
                                $('#deleteAll').modal('hide');

                                getContentView(postValue);
                            });
                        });
                    }
                }
            });
        });

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
                            '<i class="fa fa-check"></i>' +
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
                                $('#newItem').modal('hide');
                                var postData = {
                                    'view_name' : 'budget_view',
                                    'event_id' : '<?php echo $event_id ?>'
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
                        });
                    }
                }
            });
        });

        $('#upload_budget').submit(function(e) {
            e.preventDefault();

            var form = $(this);
            var formD = $(form)[0];
            var formData = new FormData(formD);

            var $btn = $('#uploadBtn').button('loading')

            $.ajax({
                url: form.attr('action'),
                type: 'post',
                //data: form.serialize(),
                data : formData,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if(response.success == true){
                        $btn.button('complete');
                        $('#upload-response').append('<div class="alert alert-success">' +
                            '<i class="fa fa-check" ></i>' +
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
                                $('#uploadBudget').modal('hide');
                                var postData = {
                                    'view_name' : 'budget_view',
                                    'event_id' : '<?php echo $event_id ?>'
                                };
                                getContentView(postData);
                            });
                        })
                    } else if(response.success == false) {
                        $('#upload-response').append('<div class="alert alert-danger">' +
                            response.messages + '</div>'
                         );
                        $('.alert-danger').delay(500).show(10, function() {
                            $(this).delay(3000).hide(10, function() {
                                $(this).remove();
                            });
                        });
                        $btn.button('reset');
                    }
                }
            });
        });
    });
</script>

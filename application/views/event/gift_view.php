<?php
/**
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 8/6/2017
 * Time: 2:09 PM
 */
?>

<div class="banner">
    <h2>
        <a href="<?php echo site_url('event/home/'.base64_encode($event_id)) ?>">Event</a>
        <i class="fa fa-angle-right"></i>
        <span>Gifts</span>
    </h2>
</div>

<div class="blank">
    <?php if(isset($this->session->admin_id)){ ?>
        <div class="blank-page">
            <h4><div class="col-sm-3 col-xs-12">Gifts</div>
                <?php if(date_add(date_create($event_date), date_interval_create_from_date_string('7 days')) > date_create(date('Y-m-d'))) { ?>
                    <div class="col-sm-9">
                        <a href="#" class=" col-sm-2 col-xs-12 btn btn-sm btn-warning pull-right" data-toggle="modal" data-target="#deleteAll"> <i class="fa fa-trash"></i> Delete All</a>
                        <a href="#" class=" col-xs-12 col-sm-3 btn btn-sm btn-success pull-right" data-toggle="modal" data-target="#newGift" data-placement="bottom" title="Add Budget Item"><i class="fa fa-plus-square"></i> Add Gift</a>
                    </div>
                <?php } ?>
            </h4>
            <hr>
            <?php if (isset($gift_list['error']) && $gift_list['error'] == "0") {?>
                No gift items found.<a href="#" data-toggle="modal" data-target="#newGift"> Add gift </a> here.
                <div class="clearfix"></div>

            <?php } else { ?>
                <div class="col-md-12">

                </div>
                <div class="tables">
                    <table id="table_item" class="table table-hover">
                        <thead>
                        <tr>
                            <th>Gift Name</th>
                            <th>Status</th>
                            <th>Offered By</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($gift_list as $gl){ ?>
                            <tr>
                                <td><a href="javascript:void(0)" class="edit_gift" rel="<?php echo $gl->gift_id; ?>" id="editGift_view"><?php echo $gl->gift_name?></a></td>
                                <td><?php if ($gl->gift_status == 0) { echo "Not Commited"; } else { echo "Commited"; } ?></td>
                                <td><?php echo $gl->offered_by ?></td>
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

<div class="modal fade" id="newGift" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h2 class="modal-title">Add Gift</h2>
            </div>
            <?php
            $attributes = array('class' => 'form-horizontal', 'id' => 'new_gift');
            echo form_open('event/new_gift/'.$event_id, $attributes);
            ?>

            <div class="modal-body">
                <div class="box">
                    <div id="the-message"></div>
                    <div class="form-group">
                        <label for="giftname" class="col-sm-4 control-label">Gift Name</label>
                        <div class="col-sm-8">
                            <input type="text" name="giftname" value="<?php echo set_value('giftname'); ?>" class="form-control1" id="giftname" placeholder="Gift Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status" class="col-sm-4 control-label">Status</label>
                        <div class="col-sm-8">
                            <select name="status" id="status" class="form-control1">
                                <option value="0">Not Committed</option>
                                <option value="group">Offered by group</option>
                                <option value="person">Offered by person</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-4">
                            <select name="group" id="group" class="form-control1" hidden="true">
                                <option value="">Select Group</option>
                                <?php foreach($member_group as $mg){ ?>
                                    <option value="<?php echo set_value(print $mg->group_name); ?>" id="type"><?php echo set_value(print $mg->group_name); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-4">
                            <select name="person" id="person" class="form-control1" hidden="true">
                                <option value="">Select One</option>
                                <?php foreach($member_details as $md){ ?>
                                    <option value="<?php echo set_value(print $md->member_name); ?>" id="type"><?php echo set_value(print $md->member_name); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <script>
                        document.getElementById('status').addEventListener('change', function() {
                            if (this.value == "group") {
                                document.getElementById('person').hidden = true;
                                document.getElementById('group').hidden = false;
                            } else if (this.value == "person"){
                                document.getElementById('group').hidden = true;
                                document.getElementById('person').hidden = false;
                            } else {
                                document.getElementById('group').hidden = true;
                                document.getElementById('person').hidden = true;
                            }
                        });
                    </script>
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

        $('.table').on("click", ".edit_gift", function() {
            var view_name = $(this).attr("id");
            var gift_id = $(this).attr("rel");
            var postData = {
                'view_name': view_name,
                'gift_id': gift_id,
            };

            getContentView(postData);
        });

        $('#new_gift').submit(function(e) {
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
                            ' Gift Added Successfully' +
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
                                $('#newGift').modal('hide');
                                var postData = {
                                    'view_name' : 'gift_view',
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
    });
</script>
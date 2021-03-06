<?php
/**
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 3/8/2017
 * Time: 3:39 PM
 */
?>
<div class="banner">
    <h2>
        <a href="<?php echo site_url('event/home/'.base64_encode($event_id)) ?>">Event</a>
        <i class="fa fa-angle-right"></i>
        <span>Settings</span>
    </h2>
</div>

<div class="blank">
    <div class="col-md-3 compose">
        <nav class="nav-sidebar">
            <ul class="nav tabs">
                <li class="active"><a href="#eventDetails" data-toggle="tab"><i class="fa fa-edit"></i>Details <div class="clearfix"></div></a></li>
                <li class=""><a href="#eventAdmins" data-toggle="tab"><i class="fa fa-user-md"></i>Admins</a></li>
            </ul>
        </nav>
    </div>
    <!-- tab content -->
    <div class="col-md-9 tab-content tab-content-in">
        <div class="tab-pane active text-style" id="eventDetails">
            <div class="grid-form1">
                <h3 id="forms-horizontal">Event Details</h3>
                <?php

                $attributes = array('class' => 'form-horizontal', 'id' => 'edit_event');
                echo form_open('event/edit/'.$event_id, $attributes);
                foreach($event_details as $ed){
                    if( date_create($ed->event_date) > date_create(date('Y-m-d'))){
                    ?>
                    <div id="details_success"></div>
                    <div class="form-group">
                        <label for="eventname" class="col-sm-3 control-label">Event Name</label>
                        <div class="col-sm-9">
                            <input type="text" name="eventname" value="<?php echo $ed->event_name ?>" class="form-control1" placeholder="Event Name" id="eventname">
                        </div>
                    </div>
                    <script>
                        $(document).ready(function() {
                            $("#eventdate").datepicker({
                                dateFormat: 'yy-mm-dd',
                                minDate: new Date(),
                                maxDate: '+1Y',
                            });
                        });
                    </script>
                    <div class="form-group">
                        <label for="eventdate" class="col-sm-3 control-label">Event Date</label>
                        <div class="col-sm-9">
                            <input type="text" name="eventdate" value="<?php echo $ed->event_date ?>" class="form-control1" placeholder="YYYY-MM-DD" id="eventdate">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="type" class="col-sm-3 control-label">Event Type</label>
                        <div class="col-sm-9">
                            <?php $ov = 1; ?>
                            <select name="type" id="type" class="form-control1">
                                <option value="other">Other</option>
                                <?php foreach($event_type as $et){?>
                                    <option value="<?php echo $et->type_name; ?>"<?php if($et->type_name == $ed->event_type){ $ov = 0; echo set_select('type', $et->type_name, true); }  ?> id="type"><?php echo $et->type_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                <?php if($ov == 1) { ?>
                    <div class="form-group">
                        <label for="othertext" class="col-sm-3 control-label"></label>
                        <div class="col-sm-9">
                            <input type="text" name="othertext" value="<?php echo $ed->event_type; ?>" class="form-control1" placeholder="Event Type" id="othertext">
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="form-group">
                        <label for="othertext" class="col-sm-3 control-label"></label>
                        <div class="col-sm-9">
                            <input type="text" name="othertext" hidden="true" value="<?php echo set_value('othertext'); ?>" class="form-control1" placeholder="Event Type" id="othertext">
                        </div>
                    </div>
                <?php } ?>
                    <script>
                        document.getElementById('type').addEventListener('change', function() {
                            if (this.value == "other") {
                                document.getElementById('othertext').hidden = false;
                            } else {
                                document.getElementById('othertext').hidden = true;
                            }
                        });
                    </script>
                    <div class="form-group">
                        <label for="location" class="col-sm-3 control-label">Event Location</label>
                        <div class="col-sm-9">
                            <select name="location" id="selector1" class="form-control1">
                                <option value="">Select Region</option>
                                <?php foreach($location as $loc){ ?>
                                    <option value="<?php echo $loc->location_id; ?>" <?php if($loc->location_id == $ed->event_location){ echo set_select('location', $loc->location_id, true); } ?> id="location"><?php echo $loc->location_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Event Name</label>
                        <div class="col-sm-9">
                            <p class="form-control-static"><?php echo $ed->event_name ?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Event Date</label>
                        <div class="col-sm-9">
                            <p class="form-control-static"><?php echo $ed->event_date ?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Event Type</label>
                        <div class="col-sm-9">
                            <p class="form-control-static"><?php echo $ed->event_type ?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Event Location</label>
                        <div class="col-sm-9">
                            <p class="form-control-static"><?php echo $ed->location_name ?></p>
                        </div>
                    </div>
                <?php }  ?>
                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <?php if($admin_role == 1) { ?>
                            <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteEvent">Delete</a>&nbsp;
                        <?php } if(date_create($ed->event_date) > date_create(date('Y-m-d'))) { ?>
                        <button type="submit" class="btn btn-success pull-right">Save</button>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
                </form>
            </div>
        </div>
        <div class="tab-pane text-style" id="eventAdmins">
            <div class="blank-page">
                <div class="h4 col-md-4">
                    Event Admins
                </div>
                <div class="col-md-8">
                    <?php if (($admin_role ==  1) && (date_create($ed->event_date) > date_create(date('Y-m-d')))){
                    $attributes = array('id' => 'add_admin');
                    echo form_open('admin/add_admin/'.$event_id, $attributes);
                    ?>
                    <div class="input-group input-group-in">
                        <input type="text" name="mail" id="mail" value="<?php echo set_value('mail')?>" class="form-control2 input-search" placeholder="Enter email here to add or invite Admin">
                    </div>
                    </form>
                    <?php } ?>
                </div>
                <br>
                <table class="table">
                    <tbody>
                    <?php
                    if (!isset($event_admin['error'])){
                        foreach($event_admin as $ea){ ?>
                            <tr class="table-row">
                                <td class="table-text">
                                    <?php if($admin_role == 1) { ?>
                                        <h6><a href="<?php echo base_url('admin/profile/'.base64_encode($ea->admin_id))?>" class=""><?php echo $ea->admin_name ?></a></h6>
                                    <?php } else { ?>
                                        <h6><?php echo $ea->admin_name ?></h6>
                                    <?php } ?>
                                </td>
                                <td>
                                    <p><?php echo $ea->admin_phone ?></p>
                                </td>
                                <td >
                                    <p><?php echo $ea->admin_email ?></p>
                                </td>
                                <td>
                                    <span class="mar"><?php echo $ea->role_name?></span>
                                </td>
                            </tr>
                        <?php } } ?>
                    </tbody>
                </table>
            </div>
            <script>
                $(document).ready(function () {
                    $("#mail").keyup(function () {

                        var mail = $("#mail").val();
                        var dataString = "email=" + mail;

                        $.ajax({
                            url: '<?php echo base_url("admin/add_admin/".$event_id) ?>',
                            type: 'post',
                            data: dataString,

                            success: function (response) {
                                if(response == 0){
                                    $('#rea').remove();
                                    $('.input-group').removeClass('has-error')
                                        .addClass('has-error');
                                    $('.text-danger').remove();
                                }else if (response == 1){
                                    $('#rea').remove();
                                    $('#action').remove();
                                    $('.input-group').append('<input type="hidden" name="action" value="invite" id="action">');
                                    $('.input-group').append('<span class="input-group-btn" id="rea"><button type="submit" name="submit" class="btn btn-danger">Invite</button></span>');
                                    $('.text-danger').remove();
                                } else if (response == 2){
                                    $('#rea').remove();
                                    $('#action').remove();
                                    $('.input-group').append('<input type="hidden" name="action" value="add" id="action">');
                                    $('.input-group').append('<span class="input-group-btn" id="rea"><button type="submit"  value="add" name="submit" class="btn btn-danger">Add</button></span>');
                                    $('.text-danger').remove();
                                } else if (response == 5){
                                    $('#rea').remove();
                                    $('.input-group').removeClass('has-error')
                                        .addClass('has-error').append('<div id="rea">This user is already Admin</div>');
                                    $('.text-danger').remove();
                                }
                            }
                        });
                    });

                    $('#add_admin').submit(function (e) {
                        e.preventDefault();

                        var action = $("#action").val();
                        var mail = $("#mail").val();
                        var postData = {
                            'email': mail,
                            'action': action,
                        };

                        $.ajax({
                            url: '<?php echo base_url("admin/add_admin/".$event_id) ?>',
                            type: 'post',
                            data: postData,

                            success: function (response) {
                                if(response == 3){
                                    $('#rea').remove();
                                    $('.input-group').removeClass('has-error')
                                        .addClass('has-error').append('<div id="rea">Admin Added Successful</div>');
                                    $('.text-danger').remove();

                                    $('#add_admin')[0].reset();

                                    // close the message after seconds
                                    $('#rea').delay(500).show(10, function() {
                                        $(this).delay(3000).hide(10, function() {
                                            $(this).remove();
                                            //window.location.reload()
                                        });
                                    });
                                }else if (response == 4){

                                    $('#rea').remove();
                                    $('.input-group').removeClass('has-error')
                                        .addClass('has-error').append('<div id="rea">Admin Invited Successful</div>');
                                    $('.text-danger').remove();

                                    $('#add_admin')[0].reset();

                                    // close the message after seconds
                                    $('#rea').delay(500).show(10, function() {
                                        $(this).delay(3000).hide(10, function() {
                                            $(this).remove();
                                            //window.location.reload()
                                        });
                                    });
                                }else if (response == 6){
                                    $('#rea').remove();
                                    $('.input-group').removeClass('has-error')
                                        .addClass('has-error').append('<div id="rea">Failed to send an email</div>');
                                    $('.text-danger').remove();

                                    $('#add_admin')[0].reset();

                                    // close the message after seconds
                                    $('#rea').delay(500).show(10, function() {
                                        $(this).delay(3000).hide(10, function() {
                                            $(this).remove();
                                            //window.location.reload()
                                        });
                                    });
                                }
                            }
                        });
                    })
                });
            </script>
        </div>
    </div>
    <div class="clearfix"> </div>
</div>

<div class="modal fade" id="deleteEvent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h2 class="modal-title">Delete Event</h2>
            </div>
            <div class="modal-body">
                <?php foreach ($event_details as $ed) { ?>
                <p>Are you sure you want to delete <?php echo $ed->event_name ?> <?php echo $ed->event_type ?>?</p>
                <?php } ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success pull-left" data-dismiss="modal">Cancel</button>
                <a href="<?php echo site_url('event/delete/'.$event_id)?>" class="btn btn-danger">Delete</a>
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
            var member_id = $(this).attr("rel");
            var type = $(this).attr("type");
            var postData = {
                'view_name': view_name,
                'member_id': member_id,
                'type': type,
            };

            getContentView(postData);
        });

        $('#edit_event').submit(function(e) {
            e.preventDefault();

            var me = $(this);

            $.ajax({
                url: me.attr('action'),
                type: 'post',
                data: me.serialize(),
                dataType: 'json',
                success: function (response) {
                    if(response.success == true){
                        $('#details_success').append('<div class="alert alert-success">' +
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
                                //window.location.reload()
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
<?php
/**
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 11/21/2016
 * Time: 12:34 PM
 */

$this->load->view('shared/header');
$this->load->view('shared/sidebar');
?>
<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="content-main">

        <div class="banner">
            <h2>
                <a href="<?php echo base_url('admin')?>">Admin</a>
                <i class="fa fa-angle-right"></i>
                <span>Home</span>
                <a href="#" class="pull-right" data-toggle="modal" data-target="#newEvent">Create Event</a>
            </h2>
        </div>

        <div class="blank">
            <div class="blank-page">
                <?php if(!isset($event['error'])) { ?>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Event Name</th>
                            <th class="hidden-xs hidden-sm">Event Type</th>
                            <th class="hidden-xs">Event Date</th>
                            <th class="hidden-xs hidden-sm">Event Location</th>
                            <th>Event Fee</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($event as $eve){ ?>
                            <tr>
                                <td><a href="<?php echo site_url('event/home/'.base64_encode($eve->event_id)) ?>"><?php echo $eve->event_name ?></a></td>
                                <td class="hidden-xs hidden-sm"><?php echo $eve->event_type?></td>
                                <td class="hidden-xs"><?php echo date_format(date_create($eve->event_date), 'D, jS M Y') ?></td>
                                <td class="hidden-xs hidden-sm"><?php echo $eve->location_name?></td>
                                <?php if ($eve->event_paid == 0){ ?>
                                    <td>Not Paid</td>
                                <?php } else { ?>
                                    <td>Paid</td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <p>You did not create any event yet.</p>
                <?php } ?>
            </div>
        </div>

        <div class="modal fade" id="newEvent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h1 class="modal-title">Create Event</h1>
                    </div>
                    <?php
                    $attributes = array('class' => 'form-horizontal', 'id' => 'new_event');
                    echo form_open('event/create', $attributes);
                    ?>
                    <div class="modal-body">
                        <div id="the-message"></div>
                        <div class="form-group">
                            <label for="eventname" class="col-sm-4 control-label">Event Name</label>
                            <div class="col-sm-8">
                                <input type="text" name="eventname" value="<?php echo set_value('eventname'); ?>" class="form-control1" placeholder="Event Name" id="eventname">
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
                        <div class=" form-group">
                            <label for="eventdate" class="col-sm-4 control-label">Event Date</label>
                            <div class="col-sm-8">
                                <input type="text" name="eventdate" value="<?php echo set_value('eventdate'); ?>" class="form-control1" placeholder="YYYY-MM-DD" id="eventdate">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="type" class="col-sm-4 control-label">Event Type</label>
                            <div class="col-sm-8">
                                <select name="type" id="type" class="form-control1">
                                    <option value="">Select One</option>
                                    <?php foreach($event_type as $et){ ?>
                                        <option value="<?php echo set_value(print $et->type_name); ?>" id="type"><?php echo set_value(print $et->type_name); ?></option>
                                    <?php } ?>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="othertext" class="col-sm-4 control-label"></label>
                            <div class="col-sm-8">
                                <input type="text" name="othertext" hidden="true" value="<?php echo set_value('othertext'); ?>" class="form-control1" placeholder="Event Type" id="othertext">
                            </div>
                        </div>
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
                            <label for="location" class="col-sm-4 control-label">Event Location</label>
                            <div class="col-sm-8">
                                <select name="location" id="selector1" class="form-control1">
                                    <option value="">Select Region</option>
                                    <?php foreach($location as $loc){ ?>
                                        <option value="<?php echo set_value(print $loc->location_id); ?>" id="location"><?php echo set_value(print $loc->location_name); ?></option>
                                    <?php } ?>
                                </select>
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

        <script>
            $('#new_event').submit(function(e) {
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
                                ' Event Created Successfully' +
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
                                    $('#newEvent').modal('hide');
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

    <?php $this->load->view('shared/footer') ?>
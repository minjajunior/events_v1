<?php
/**
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 3/8/2017
 * Time: 3:39 PM
 */
?>
<div class="blank">
    <div class="grid-form1">
        <h3 id="forms-horizontal">Edit Event</h3>
        <?php
        $attributes = array('class' => 'form-horizontal', 'id' => 'edit_event');
        echo form_open('event/edit/'.$event_id, $attributes);
        foreach($event_details as $ed){
        ?>
        <div id="the-message"></div>
        <div class="form-group">
            <label for="eventname" class="col-sm-2 control-label">Event Name</label>
            <div class="col-sm-8">
                <input type="text" name="eventname" value="<?php echo $ed->event_name ?>" class="form-control1" placeholder="Event Name" id="eventname">
            </div>
        </div>
        <div class="form-group">
            <label for="eventcode" class="col-sm-2 control-label">Event Code</label>
            <div class="col-sm-8">
                <input type="text" name="eventcode" value="<?php echo $ed->event_code ?>" class="form-control1" placeholder="Event Code" id="eventcode">
            </div>
        </div>
        <input type="hidden" name="ec" value="<?php echo $ed->event_code ?>" />
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
            <label for="eventdate" class="col-sm-2 control-label">Event Date</label>
            <div class="col-sm-8">
                <input type="text" name="eventdate" value="<?php echo $ed->event_date ?>" class="form-control1" placeholder="YYYY-MM-DD" id="eventdate">
            </div>
        </div>
        <div class="form-group">
            <label for="type" class="col-sm-2 control-label">Event Type</label>
            <div class="col-sm-8">
                <select name="type" id="type" class="form-control1">
                    <option value="">Select One</option>
                    <?php foreach($type as $t){ ?>
                        <option value="<?php echo $t->type_name; ?>" id="type"><?php echo $t->type_name; ?></option>
                    <?php } ?>
                    <option value="other">Other</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="othertext" class="col-sm-2 control-label"></label>
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
            <label for="location" class="col-sm-2 control-label">Event Location</label>
            <div class="col-sm-8">
                <select name="location" id="selector1" class="form-control1">
                    <option value="">Select Region</option>
                    <?php foreach($location as $loc){ ?>
                        <option value="<?php echo $loc->location_id; ?>" id="location"><?php echo $loc->location_name; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-8 col-sm-offset-2">
                <button type="button" class="btn btn-danger">Delete</button>
                <button type="submit" class="btn btn-success pull-right">Save</button>
            </div>
        </div>
        </form>
        <?php } ?>
    </div>
</div>

<script>
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
            var member_id = $(this).attr("rel");
            var type = $(this).attr("type");
            var postData = {
                'view_name': view_name,
                'member_id': member_id,
                'type': type,
            };

            getContentView(postData);
        });
    });
</script>
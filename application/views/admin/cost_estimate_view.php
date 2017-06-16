<?php
/**
 * Created by PhpStorm.
 * User: d.felix
 * Date: 13/06/2017
 * Time: 21:50
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
                <span>Settings</span>
            </h2>
        </div>

        <div class="blank">
            <div class="col-md-3 compose">
                <nav class="nav-sidebar">
                    <ul class="nav tabs">
                        <li class="active"><a href="#adminDetails" data-toggle="tab"><i class="fa fa-edit"></i>Budget Estimate</a></li>
<!--                        <li class=""><a href="#adminPassword" data-toggle="tab"><i class="fa fa-key"></i>Password</a></li>-->
                    </ul>
                </nav>
            </div>
            <!-- tab content -->
            <div class="col-md-9 tab-content tab-content-in">
                <div class="tab-pane active text-style" id="adminDetails">
                    <div class="grid-form1">
                        <h3 id="forms-horizontal">Budget Estimate</h3><h5 class="text-danger">This page is still under construction</h5>
                        <?php
                        $attributes = array('class' => 'form-horizontal', 'id' => 'edit_admin');
                        echo form_open('admin/edit_details', $attributes);
                        foreach($admin_details as $ad){
                            ?>
                            <div id="details_success"></div>

                            <div class="form-group">
                                <label for="type" class="col-sm-3 control-label">Event Type</label>
                                <div class="col-sm-9">
                                    <select name="type" id="type" class="form-control1">
                                        <option value="">Select One</option>
                                        <option value="Wedding" id="type">Wedding</option>
                                        <option value="Wedding" id="type">Send Off</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="othertext" class="col-sm-3 control-label"></label>
                                <div class="col-sm-9">
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
                                <label for="location" class="col-sm-3 control-label">Event Location</label>
                                <div class="col-sm-9">
                                    <select name="location" id="selector1" class="form-control1">
                                        <option value="">Select Region</option>
                                        <?php foreach($location as $loc){ ?>
                                            <option value="<?php echo set_value(print $loc->location_id); ?>" id="location"><?php echo set_value(print $loc->location_name); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="guests" class="col-sm-3 control-label">How many guests</label>
                                <div class="col-sm-9">
                                    <input type="text" name="guests" value="" class="form-control1" placeholder="Number of guests" id="guests">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="photography" class="col-sm-3 control-label">Venue</label>
                                <div class="col-sm-9">
                                    <div class="checkbox-inline1"><label><input type="checkbox">Classic</label></div>
                                    <div class="checkbox-inline1"><label><input type="checkbox">Standard</label></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="photography" class="col-sm-3 control-label">Catering</label>
                                <div class="col-sm-9">
                                    <div class="checkbox-inline1"><label><input type="checkbox">Classic</label></div>
                                    <div class="checkbox-inline1"><label><input type="checkbox">Standard</label></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="photography" class="col-sm-3 control-label">Wedding Cake</label>
                                <div class="col-sm-9">
                                    <div class="checkbox-inline1"><label><input type="checkbox">Classic</label></div>
                                    <div class="checkbox-inline1"><label><input type="checkbox">Standard</label></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="photography" class="col-sm-3 control-label">Beverage</label>
                                <div class="col-sm-9">
                                    <div class="checkbox-inline1"><label><input type="checkbox">Alcoholic </label></div>
                                    <div class="checkbox-inline1"><label><input type="checkbox">Non-Alcoholic</label></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="photography" class="col-sm-3 control-label">Flowers & Decorations</label>
                                <div class="col-sm-9">
                                    <div class="checkbox-inline1"><label><input type="checkbox">Bridal Bouquet</label></div>
                                    <div class="checkbox-inline1"><label><input type="checkbox">Event Decorations</label></div>
                                    <div class="checkbox-inline1"><label><input type="checkbox">Boutonnieres, Corsages</label></div>
                                    <div class="checkbox-inline1"><label><input type="checkbox">Bridesmaid Bouquets</label></div>
                                    <div class="checkbox-inline1"><label><input type="checkbox">Flower Petals</label></div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="photography" class="col-sm-3 control-label">Transportation</label>
                                <div class="col-sm-9">
                                    <div class="checkbox-inline1"><label><input type="checkbox">Special Wedding Car</label></div>
                                    <div class="checkbox-inline1"><label><input type="checkbox">Shuttles for the Guests</label></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="photography" class="col-sm-3 control-label">Photography & Video</label>
                                <div class="col-sm-9">
                                    <div class="checkbox-inline1"><label><input type="checkbox">Wedding Photographer</label></div>
                                    <div class="checkbox-inline1"><label><input type="checkbox">Wedding Videographer</label></div>
                                    <div class="checkbox-inline1"><label><input type="checkbox">Digital or Photo cd / dvd</label></div>
                                    <div class="checkbox-inline1"><label><input type="checkbox">Wedding album/s or photo book/s</label></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="photography" class="col-sm-3 control-label">Attire & Accessories</label>
                                <div class="col-sm-9">
                                    <div class="checkbox-inline1"><label><input type="checkbox">Bride's Wedding Dress</label></div>
                                    <div class="checkbox-inline1"><label><input type="checkbox">Groom's Tuxedo / Suit</label></div>
                                    <div class="checkbox-inline1"><label><input type="checkbox">Bride's Hair and Makeup</label></div>
                                    <div class="checkbox-inline1"><label><input type="checkbox">Bride's Accessories (Includes headpiece, veil, shoes, lingerie, jewelry, sash, handbag, garter, etc.)</label></div>
                                    <div class="checkbox-inline1"><label><input type="checkbox">Groom's Accessories((Includes cuff links, cummerbund, tie, pocket square, shoes, jewelry, etc.)</label></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="photography" class="col-sm-3 control-label">Entertainment</label>
                                <div class="col-sm-9">
                                    <div class="checkbox-inline1"><label><input type="checkbox">Music</label></div>
                                    <div class="checkbox-inline1"><label><input type="checkbox">Master of Ceremony</label></div>
                                    <div class="checkbox-inline1"><label><input type="checkbox">Live Band</label></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="photography" class="col-sm-3 control-label">Beauty</label>
                                <div class="col-sm-9">
                                    <div class="checkbox-inline1"><label><input type="checkbox">Hair & Makeup service</label></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="photography" class="col-sm-3 control-label">Gifts & Favors</label>
                                <div class="col-sm-9">
                                    <div class="checkbox-inline1"><label><input type="checkbox">Gifts for Parents</label></div>
                                    <div class="checkbox-inline1"><label><input type="checkbox">Gift for Attendants</label></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="photography" class="col-sm-3 control-label">Jewelry</label>
                                <div class="col-sm-9">
                                    <div class="checkbox-inline1"><label><input type="checkbox">Engagement Ring</label></div>
                                    <div class="checkbox-inline1"><label><input type="checkbox">Wedding Rings</label></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="checkbox" class="col-sm-3 control-label">Event Stationery</label>
                                <div class="col-sm-9">
                                    <div class="checkbox-inline1"><label><input type="checkbox">Contribution Cards</label></div>
                                    <div class="checkbox-inline1"><label><input type="checkbox">Invitations Cards</label></div>
                                    <div class="checkbox-inline1"><label><input type="checkbox">Guest Book</label></div>
                                    <div class="checkbox-inline1"><label><input type="checkbox">Committee Reports Printing + Other</label></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="photography" class="col-sm-3 control-label">Honeymoon</label>
                                <div class="col-sm-9">
                                    <div class="checkbox-inline1"><label><input type="checkbox">Honeymoon</label></div>

                                </div>
                            </div>



                            <div class="form-group">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <button type="submit" class="btn btn-success pull-right">Export Estimate Budget</button>
                                </div>
                            </div>
                        <?php } ?>
                        </form>
                    </div>
                </div>

            </div>
            <div class="clearfix"> </div>
        </div>

        <script>
            $(document).ready(function() {

                $('#edit_admin').submit(function(e) {
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
                                    ' Updated Successfully' +
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

                $('#change_password').submit(function(e) {
                    e.preventDefault();

                    var me = $(this);

                    $.ajax({
                        url: me.attr('action'),
                        type: 'post',
                        data: me.serialize(),
                        dataType: 'json',
                        success: function (response) {
                            if(response.success == true){
                                $('#password_success').append('<div class="alert alert-success">' +
                                    '<i class="fa fa-check"></i>' +
                                    ' Updated Successfully' +
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
        <?php $this->load->view('shared/footer');?>




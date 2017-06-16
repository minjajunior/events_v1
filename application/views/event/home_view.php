<?php
/*
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 11/21/2016
 * Time: 5:53 PM
 */

?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#demo-pie-1').pieChart({
            barColor: '#0070ba',
            trackColor: '#eee',
            lineCap: 'round',
            lineWidth: 8,
            onStep: function (from, to, percent) {
                $(this.element).find('.pie-value').text(Math.round(percent) + '%');
            }
        });

        $('#demo-pie-2').pieChart({
            barColor: '#0070ba',
            trackColor: '#eee',
            lineCap: 'round',
            lineWidth: 8,
            onStep: function (from, to, percent) {
                $(this.element).find('.pie-value').text(Math.round(percent) + '%');
            }
        });

        $('#demo-pie-3').pieChart({
            barColor: '#0070ba',
            trackColor: '#eee',
            lineCap: 'round',
            lineWidth: 8,
            onStep: function (from, to, percent) {
                $(this.element).find('.pie-value').text(Math.round(percent) + '%');
            }
        });

        $('#demo-pie-4').pieChart({
            barColor: '#0070ba',
            trackColor: '#eee',
            lineCap: 'round',
            lineWidth: 8,
            onStep: function (from, to, percent) {
                $(this.element).find('.pie-value').text(Math.round(percent) + '%');
            }
        });
    });
</script>
<!--content-->
<div class="banner">
    <h2>
        <a href="<?php echo site_url('event/home/'.base64_encode($event_id)) ?>">Event</a>
        <i class="fa fa-angle-right"></i>
        <span>Home</span>
    </h2>
</div>

<div class="content-top">
     <!-- Admin Event home view -->
    <?php if (!empty($this->session->admin_id)) { ?>
        <div class="col-md-4">
            <div class="content-top-1">
                <div class="col-md-6 top-content">
                    <h5>Pledge</h5>
                    <p>
                        <?php
                        if(isset($pledge_sum)){
                            echo $english_format_number = number_format($pledge_sum, 0, '.', ',')." TZS";
                        }else {
                            echo "0 Tsh.";
                        } ?>
                    </p>
                </div>
                <div class="col-md-6 top-content1">
                    <?php
                    if(isset($budget_sum) && isset($pledge_sum)){
                        $pp = ($pledge_sum / $budget_sum )*100; ?>
                        <div id="demo-pie-3" class="pie-title-center" data-percent="<?php echo $pp ?>"> <span class="pie-value"></span> </div>
                    <?php } ?>
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="content-top-1">
                <div class="col-md-6 top-content">
                    <h5>Cash Collected</h5>
                    <p>
                        <?php
                        if(isset($cash_sum)){
                            echo $english_format_number = number_format($cash_sum, 0, '.', ',')." TZS";
                        }else {
                            echo "0 Tsh.";
                        } ?>
                    </p>
                </div>
                <div class="col-md-6 top-content1">
                    <?php
                    if(isset($cash_sum) && isset($budget_sum)){
                        $cp = ($cash_sum / $budget_sum)*100; ?>
                        <div id="demo-pie-1" class="pie-title-center" data-percent="<?php echo $cp ?>"> <span class="pie-value"></span> </div>
                    <?php } ?>
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="content-top-1">
                <div class="col-md-6 top-content">
                    <h5>Balance</h5>
                    <p>
                        <?php
                        if(isset($cash_sum) || isset($advance_sum)){
                            $ba = $cash_sum - $advance_sum;
                            echo $english_format_number = number_format($ba, 0, '.', ',')." TZS";
                        }else {
                            echo "0 Tsh.";
                        } ?>
                    </p>
                </div>
                <div class="col-md-6 top-content1">
                    <?php
                    if(isset($cash_sum) && isset($budget_sum)){
                        $bp = (($cash_sum - $advance_sum) / $budget_sum)*100; ?>
                        <div id="demo-pie-2" class="pie-title-center" data-percent="<?php echo $bp ?>"> <span class="pie-value"></span> </div>
                    <?php } ?>
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="content-top-1">
                <div class="col-md-6 top-content">
                    <h5>Budget</h5>
                    <p>
                        <?php
                        if(isset($budget_sum)){
                            echo $english_format_number = number_format($budget_sum, 0, '.', ',')." TZS";
                        }else {
                            echo "0 Tsh.";
                        } ?>
                    </p>
                </div>
                <div class="col-md-6 top-content1">
                    <?php
                    if(isset($advance_sum) && isset($budget_sum)){
                        $bup = ($advance_sum / $budget_sum)*100; ?>
                        <div id="demo-pie-4" class="pie-title-center" data-percent="<?php echo $bup ?>"> <span class="pie-value"></span> </div>
                    <?php } ?>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
        <div class="col-md-8 content-top-2">
            <div class="box">
                <div class="blank-page">
                    <h4><div class="col-sm-8 col-xs-12">Text Message Notifications</div>

                    <?php if (date_add(date_create($event_date), date_interval_create_from_date_string('7 days')) > date_create(date('Y-m-d'))) { ?>

                        <div class="col-sm-4 col-xs-12"><a href="#" class="btn btn-success" data-toggle="modal" data-target="#newSms" data-placement="bottom" title="New Sms">&nbsp;<i class="fa fa-envelope"></i>&nbsp; Send SMS</a></div>
                    <?php } ?>
                </h4>
                <table class="table">
                <tbody>
                <?php if(!isset($sms_list['error'])) {
                foreach ($sms_list as $sl) { ?>
                <tr class="table-row">
                    <td class="table-text">
                        <?php if($sl->sms_to == 0) { ?>
                            <h6>To: All Members</h6>
                            <?php }else {
                            foreach ($member_group as $mg ) {
                                if ($sl->sms_to == $mg->group_id ){?>
                                    <h6>To: <?php echo $mg->group_name ?></h6>
                        <?php } } } ?>
                        <?php echo $sl->sms_text; ?>
                        <p>Sent by: <?php echo $sl->admin_name ?>
                            <i class="fa fa-clock-o"></i>
                            <?php
                            $timeFirst  = strtotime($sl->sent_on);
                            $timeSecond = strtotime(date('Y-m-d H:i:s'));
                            $delta = $timeSecond - $timeFirst;

                            if ( $delta < 60 ) {
                                echo 'Less than a minute ago';
                            }
                            elseif ($delta > 60 && $delta < 120){
                                echo 'About a minute ago';
                            }
                            elseif ($delta > 120 && $delta < (60*60)){
                                echo strval(round(($delta/60),0)), ' minutes ago';
                            }
                            elseif ($delta > (60*60) && $delta < (120*60)){
                                echo 'About an hour ago';
                            }
                            elseif ($delta > (120*60) && $delta < (24*60*60)){
                                echo strval(round(($delta/3600),0)), ' hours ago';
                            }
                            else {
                                $dt = date_create($sl->sent_on);
                                echo $dt->format('F d H:i');
                            }
                            ?>
                        </p>
                    </td>
                </tr>
                <?php }
                } else { ?>
                    <tr>You did not send sms to your members</tr>
                <?php } ?>
                </tbody>
            </table>
                </div>
            </div>
        </div>

        <!-- New sms modal-->
        <div class="modal fade" id="newSms" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h2 class="modal-title">New Sms</h2>
                    </div>
                    <?php
                        $attributes = array('class' => 'form-horizontal', 'id' => 'new_sms');
                        echo form_open('member/send_sms/'.base64_encode($event_id), $attributes);
                    ?>
                    <div class="modal-body">
                        <div id="the-message"></div>
                        <div class="form-group">
                            <label for="to" class="col-sm-3 control-label">To:</label>
                            <div class="col-sm-9">
                                <select name="to" id="selector1" class="form-control1">
                                    <option value="0">All members</option>
                                    <?php if (!isset($member_group['error'])){
                                    foreach($member_group as $mg){ ?>
                                        <option value="<?php echo set_value(print $mg->group_id); ?>" id="location"><?php echo set_value(print $mg->group_name); ?></option>
                                    <?php } }?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message" class="col-sm-3 control-label">Sms</label>
                            <div class="col-sm-9">
                                <textarea name="sms" maxlength="160" rows="4" class="form-control" id="sms" placeholder="Type your text here..." required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success pull-left" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Send</button>
                    </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <script>
            $('#new_sms').submit(function(e) {
                e.preventDefault();

                var me = $(this);

                $.ajax({
                    url: me.attr('action'),
                    type: 'post',
                    data: me.serialize(),
                    dataType: 'json',
                    success: function (response) {
                        if(response.messages){
                            $('#the-message').append('<div class="alert alert-success">' +
                                '<i class="fa fa-check"></i>' +
                                'Sms sent Successfully' +
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
                                    $('#newSms').modal('hide');
                                    window.location.reload();
                                });
                            })
                        }else if(response.Status == false){
                            $('#the-message').append('<div class="alert alert-danger">' +
                                '<h4><i class="fa fa-error"></i> Sms not Sent</h4>' +
                                'No Numbers selected. Please insert numbers with 255XXXXXXXXX format.' +
                                '</div>');
                            $('.form-group').removeClass('has-error')
                                .removeClass('has-success');
                            $('.text-danger').remove();

                            $('.alert-danger').delay(1000).show(10, function() {
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
    <?php }
    else if (!empty($this->session->member_phone)) { ?>
        <!-- Member Event home view -->
        <div class="col-md-8">
            <div class="content-top-1 col-md-6">
                <div class="col-md-6 top-content">
                    <h5>Cash Collected</h5>
                    <p>
                        <?php
                        if(isset($cash_sum)){
                            echo $english_format_number = number_format($cash_sum, 0, '.', ',')." TZS";
                        }else {
                            echo "0 Tsh.";
                        } ?>
                    </p>
                </div>
                <div class="col-md-6 top-content1">
                    <?php
                    if(isset($cash_sum) && isset($budget_sum)){
                        $cp = ($cash_sum / $budget_sum)*100; ?>
                        <div id="demo-pie-1" class="pie-title-center" data-percent="<?php echo $cp ?>"> <span class="pie-value"></span> </div>
                    <?php } ?>

                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="content-top-1 col-md-6">
                <div class="col-md-6 top-content">
                    <h5>Balance</h5>
                    <p>
                        <?php
                        if(isset($cash_sum) || isset($advance_sum)){
                            $ba = $cash_sum - $advance_sum;
                            echo $english_format_number = number_format($ba, 0, '.', ',')." TZS";
                        }else {
                            echo "0 Tsh.";
                        } ?>
                    </p>
                </div>
                <div class="col-md-6 top-content1">
                    <?php
                    if(isset($cash_sum) && isset($budget_sum)){
                        $bp = (($cash_sum - $advance_sum) / $budget_sum)*100; ?>
                        <div id="demo-pie-2" class="pie-title-center" data-percent="<?php echo $bp ?>"> <span class="pie-value"></span> </div>
                    <?php } ?>
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="content-top-1 col-md-6">
                <div class="col-md-6 top-content">
                    <h5>Pledge</h5>
                    <p>
                        <?php
                        if(isset($pledge_sum)){
                            echo $english_format_number = number_format($pledge_sum, 0, '.', ',')." TZS";
                        }else {
                            echo "0 Tsh.";
                        } ?>
                    </p>
                </div>
                <div class="col-md-6 top-content1">
                    <?php
                    if(isset($budget_sum) && isset($pledge_sum)){
                        $pp = ($pledge_sum / $budget_sum )*100; ?>
                        <div id="demo-pie-3" class="pie-title-center" data-percent="<?php echo $pp ?>"> <span class="pie-value"></span> </div>
                    <?php } ?>
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="content-top-1 col-md-6">
                <div class="col-md-6 top-content">
                    <h5>Budget</h5>
                    <p>
                        <?php
                        if(isset($budget_sum)){
                            echo $english_format_number = number_format($budget_sum, 0, '.', ',')." TZS";
                        }else {
                            echo "0 Tsh.";
                        } ?>
                    </p>
                </div>
                <div class="col-md-6 top-content1">
                    <?php
                    if(isset($advance_sum) && isset($budget_sum)){
                        $bup = ($advance_sum / $budget_sum)*100; ?>
                        <div id="demo-pie-4" class="pie-title-center" data-percent="<?php echo $bup ?>"> <span class="pie-value"></span> </div>
                    <?php } ?>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="profile-bottom">
                <div class="profile-bottom-top">
                    <?php foreach($member_detail as $md){ ?>
                        <h3>Your Details</h3>
                        <div class="col-md-12 profile-text">
                            <table>
                                <tr>
                                    <td>Your Name</td>
                                    <td>:</td>
                                    <td><?php echo $md->member_name ?></td>
                                </tr>
                                <tr>
                                    <td>Your Pledge</td>
                                    <td> :</td>
                                    <td><?php echo $english_format_number = number_format($md->member_pledge, 0, '.', ',')." TZS"; ?></td>
                                </tr>
                                <tr>
                                    <td>Cash Paid</td>
                                    <td>:</td>
                                    <td><?php echo $english_format_number = number_format($md->member_cash, 0, '.', ',')." TZS"; ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="clearfix"></div>
                    <?php } ?>
                </div>
            </div>

            <div class="grid-form1">
                <h4 id="forms-horizontal">Add your pledge</h4>
                <?php
                    foreach($member_detail as $md){
                    $attributes = array('class' => 'form-horizontal', 'id' => 'add_pledge');
                    echo form_open('member/add_pledge/'.$md->member_id, $attributes);
                ?>
                    <div id="the-message"></div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="text" class="form-control1" name="amount" id="amount" placeholder="Enter Amount">
                        </div>
                    </div>
                    <input type="hidden" name="memberpledge" value="<?php echo $md->member_pledge ?>" />
                    <div class="form-group">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-danger">Add Pledge</button>
                        </div>
                    </div>
                <?php } ?>
                </form>
            </div>
        </div>
        <script>
            $('#add_pledge').submit(function(e) {
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
                                'Pledge Added Successfully' +
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
                                    window.location.reload();
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
    <?php } ?>
    <div class="clearfix"> </div>
</div>
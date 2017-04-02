<?php
/**
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 11/21/2016
 * Time: 5:53 PM
 */

?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#demo-pie-1').pieChart({
            barColor: '#3bb2d0',
            trackColor: '#eee',
            lineCap: 'round',
            lineWidth: 8,
            onStep: function (from, to, percent) {
                $(this.element).find('.pie-value').text(Math.round(percent) + '%');
            }
        });

        $('#demo-pie-2').pieChart({
            barColor: '#fbb03b',
            trackColor: '#eee',
            lineCap: 'round',
            lineWidth: 8,
            onStep: function (from, to, percent) {
                $(this.element).find('.pie-value').text(Math.round(percent) + '%');
            }
        });

        $('#demo-pie-3').pieChart({
            barColor: '#ed6498',
            trackColor: '#eee',
            lineCap: 'round',
            lineWidth: 8,
            onStep: function (from, to, percent) {
                $(this.element).find('.pie-value').text(Math.round(percent) + '%');
            }
        });

        $('#demo-pie-4').pieChart({
            barColor: '#d9534f',
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
    <div class="content-top">
        <?php if (!empty($this->session->admin_id)) { ?>
            <div class="col-md-4">
                <div class="content-top-1">
                    <div class="col-md-6 top-content">
                        <h5>Pledge</h5>
                        <p>
                            <?php
                            if(isset($pledge_sum)){
                                echo $english_format_number = number_format($pledge_sum, 0, '.', ',')." Tsh.";
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
                                echo $english_format_number = number_format($cash_sum, 0, '.', ',')." Tsh.";
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
                                echo $english_format_number = number_format($ba, 0, '.', ',')." Tsh.";
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
                                echo $english_format_number = number_format($budget_sum, 0, '.', ',')." Tsh.";
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
            <div class="col-md-8">
                <div class="blank-page">
                    <table class="table">
                    <tbody>
                    <tr class="table-row">
                        <td class="table-img">
                            <img src="images/in.jpg" alt="" />
                        </td>
                        <td class="table-text">
                            <h6> Lorem ipsum</h6>
                            <p>Nullam quis risus eget urna mollis ornare vel eu leo</p>
                        </td>
                        <td>
                            <span class="fam">Family</span>
                        </td>
                        <td class="march">
                            in 5 days
                        </td>

                        <td >
                            <i class="fa fa-star-half-o icon-state-warning"></i>

                        </td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-img">
                            <img src="images/in1.jpg" alt="" />
                        </td>
                        <td class="table-text">
                            <h6> Lorem ipsum</h6>
                            <p>Nullam quis risus eget urna mollis ornare vel eu leo</p>
                        </td>
                        <td>
                            <span class="mar">Market</span>
                        </td>
                        <td class="march">
                            in 5 days
                        </td>

                        <td >
                            <i class="fa fa-star-half-o icon-state-warning"></i>
                        </td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-img">
                            <img src="images/in2.jpg" alt="" />
                        </td>
                        <td class="table-text">
                            <h6> Lorem ipsum</h6>
                            <p>Nullam quis risus eget urna mollis ornare vel eu leo</p>
                        </td>
                        <td>
                            <span class="work">work</span>
                        </td>
                        <td class="march">
                            in 5 days
                        </td>

                        <td >
                            <i class="fa fa-star-half-o icon-state-warning"></i>
                        </td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-img">
                            <img src="images/in3.jpg" alt="" />
                        </td>
                        <td class="table-text">
                            <h6> Lorem ipsum</h6>
                            <p>Nullam quis risus eget urna mollis ornare vel eu leo</p>
                        </td>
                        <td>
                            <span class="fam">Family</span>
                        </td>
                        <td class="march">
                            in 4 days
                        </td>

                        <td >
                            <i class="fa fa-star-half-o icon-state-warning"></i>
                        </td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-img">
                            <img src="images/in4.jpg" alt="" />
                        </td>
                        <td class="table-text">
                            <h6> Lorem ipsum</h6>
                            <p>Nullam quis risus eget urna mollis ornare vel eu leo</p>
                        </td>
                        <td>
                            <span class="ur">urgent</span>
                        </td>
                        <td class="march">
                            in 4 days
                        </td>

                        <td >
                            <i class="fa fa-star-half-o icon-state-warning"></i>
                        </td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-img">
                            <img src="images/in5.jpg" alt="" />
                        </td>
                        <td class="table-text">
                            <h6> Lorem ipsum</h6>
                            <p>Nullam quis risus eget urna mollis ornare vel eu leo</p>
                        </td>
                        <td>

                        </td>
                        <td class="march">
                            in 3 days
                        </td>

                        <td >
                            <i class="fa fa-star-half-o icon-state-warning"></i>
                        </td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-img">
                            <img src="images/in6.jpg" alt="" />
                        </td>
                        <td class="table-text">
                            <h6> Lorem ipsum</h6>
                            <p>Nullam quis risus eget urna mollis ornare vel eu leo</p>
                        </td>
                        <td>
                            <span class="fam">Family</span>
                        </td>
                        <td class="march">
                            in 2 days
                        </td>

                        <td >
                            <i class="fa fa-star-half-o icon-state-warning"></i>
                        </td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-img">
                            <img src="images/in7.jpg" alt="" />
                        </td>
                        <td class="table-text">
                            <h6> Lorem ipsum</h6>
                            <p>Nullam quis risus eget urna mollis ornare vel eu leo</p>
                        </td>
                        <td>
                            <span class="ur">urgent</span>
                        </td>
                        <td class="march">
                            in 2 days
                        </td>

                        <td >
                            <i class="fa fa-star-half-o icon-state-warning"></i>
                        </td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-img">
                            <img src="images/in8.jpg" alt="" />
                        </td>
                        <td class="table-text">
                            <h6> Lorem ipsum</h6>
                            <p>Nullam quis risus eget urna mollis ornare vel eu leo</p>
                        </td>
                        <td>

                        </td>
                        <td class="march">
                            in 2 days
                        </td>

                        <td >
                            <i class="fa fa-star-half-o icon-state-warning"></i>
                        </td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-img">
                            <img src="images/in9.jpg" alt="" />
                        </td>
                        <td class="table-text">
                            <h6> Lorem ipsum</h6>
                            <p>Nullam quis risus eget urna mollis ornare vel eu leo</p>
                        </td>
                        <td>

                        </td>
                        <td class="march">
                            in 2 days
                        </td>

                        <td >
                            <i class="fa fa-star-half-o icon-state-warning"></i>
                        </td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-img">
                            <img src="images/in10.jpg" alt="" />
                        </td>
                        <td class="table-text">
                            <h6> Lorem ipsum</h6>
                            <p>Nullam quis risus eget urna mollis ornare vel eu leo</p>
                        </td>
                        <td>
                            <span class="mar">Market</span>
                        </td>
                        <td class="march">
                            in 1 days
                        </td>

                        <td >
                            <i class="fa fa-star-half-o icon-state-warning"></i>
                        </td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-img">
                            <img src="images/in11.jpg" alt="" />
                        </td>
                        <td class="table-text">
                            <h6> Lorem ipsum</h6>
                            <p>Nullam quis risus eget urna mollis ornare vel eu leo</p>
                        </td>
                        <td>
                            <span class="ur">urgent</span>
                        </td>
                        <td class="march">
                            in 1 days
                        </td>

                        <td >
                            <i class="fa fa-star-half-o icon-state-warning"></i>
                        </td>
                    </tr>
                    </tbody>
                </table>
                </div>
            </div>
        <?php } else if (!empty($this->session->member_phone)) { ?>
            <div class="col-md-8">
                <div class="content-top-1 col-md-6">
                    <div class="col-md-6 top-content">
                        <h5>Cash Collected</h5>
                        <p>
                            <?php
                            if(isset($cash_sum)){
                                echo $english_format_number = number_format($cash_sum, 0, '.', ',')." Tsh.";
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
                                echo $english_format_number = number_format($ba, 0, '.', ',')." Tsh.";
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
                                echo $english_format_number = number_format($pledge_sum, 0, '.', ',')." Tsh.";
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
                                echo $english_format_number = number_format($budget_sum, 0, '.', ',')." Tsh.";
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
                                        <td><?php echo $md->member_pledge ?></td>
                                    </tr>
                                    <tr>
                                        <td>Cash Paid</td>
                                        <td>:</td>
                                        <td><?php echo $md->member_cash; ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="clearfix"></div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="clearfix"> </div>
    </div>
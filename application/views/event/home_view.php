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
        <div class="col-md-4">
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
            <div class="calendar">
                <div class="custom-calendar-wrap custom-calendar-full">
                    <div class="custom-header">

                        <h3 class="custom-month-year">
                            <span id="custom-month" class="custom-month"> </span>
                            <span id="custom-year" class="custom-year"> </span>
                            <nav>
                                <span id="custom-prev" class="custom-prev"> </span>
                                <span id="custom-next" class="custom-next"> </span>
                                <span id="custom-current" class="custom-current" title="Got to current date"></span>
                            </nav>
                            <div class="clearfix"> </div>
                        </h3>
                    </div>
                    <div id="calendar" class="fc-calendar-container"> </div>
                    <div class="clearfix"> </div>

                </div>
            </div>
        </div>
        <div class="clearfix"> </div>
    </div>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/calendar.css')?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/custom_1.css')?>" />
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.calendario.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/data.js')?>"></script>
<script type="text/javascript">
    $(function() {

        var cal = $( '#calendar' ).calendario({
            onDayClick : function( $el, $contentEl, dateProperties ) {
                for( var key in dateProperties ) {
                    console.log( key + ' = ' + dateProperties[ key ] );
                }
            },
                caldata : codropsEvents
            }),

            $month = $( '#custom-month' ).html( cal.getMonthName() ),
            $year = $( '#custom-year' ).html( cal.getYear() );

        $( '#custom-next' ).on( 'click', function() {
            cal.gotoNextMonth( updateMonthYear );
        } );
        $( '#custom-prev' ).on( 'click', function() {
            cal.gotoPreviousMonth( updateMonthYear );
        } );
        $( '#custom-current' ).on( 'click', function() {
            cal.gotoNow( updateMonthYear );
        } );

        function updateMonthYear() {
            $month.html( cal.getMonthName() );
            $year.html( cal.getYear() );
        }

    });
</script>

<?php
/**
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 2/20/2017
 * Time: 5:43 PM
 */?>

<div class="blank" xmlns="http://www.w3.org/1999/html">


    <div class="blank-page col-md-8">
        <h4>Reports</h4>
        <hr/>
        <table class="table">
            <tbody>
            <tr class="table-row">
                <td class="">
                     <i class="fa fa-users fa-3x"></i>
                </td>
                <td class="table-text">
                    <h6>Members Report</h6>
                    <p>A report that provides details on all members</p>
                </td>

                <td class="report_pdf">
                    <a href="javascript:void(0)" class="report fa fa-file-pdf-o fa-2x" rel="<?php echo $event_id; ?>" id="members"></a>
                    <p>PDF</p>
                </td>
            </tr>


            <tr class="table-row">
                <td class="">
                    <i class="fa fa-money fa-3x"></i>
                </td>
                <td class="table-text">
                    <h6>Budget Report</h6>
                    <p>A report that provides details on all budget items</p>
                </td>

                <td class="report_pdf">
                    <a href="javascript:void(0)" class="report fa fa-file-pdf-o fa-2x" rel="<?php echo $event_id; ?>" id="budget"></a>
                    <p>PDF</p>
                </td>

            </tr>

            <!--<tr class="table-row">
                <td class="">
                    <i class="fa fa-users fa-3x"></i>
                </td>
                <td class="table-text">
                    <h6>Unpaid Pledges Report</h6>
                    <p>A report that provides members' list who have paid less than the pledged amount</p>
                </td>

                <td class="report_pdf">
                    <a href="javascript:void(0)" class="report fa fa-file-pdf-o fa-2x" rel="<?php /*echo $event_id; */?>" id="pledge"></a>
                    <p>PDF</p>
                </td>

            </tr>

            <tr class="table-row">
                <td class="">
                    <i class="fa fa-money fa-3x"></i>
                </td>
                <td class="table-text">
                    <h6>Income vs Budget Report</h6>
                    <p>A report that tells how much income collected against the proposed budget</p>
                </td>

                <td class="report_pdf">
                    <a href="javascript:void(0)" class="report fa fa-file-pdf-o fa-2x" rel="<?php /*echo $event_id; */?>" id="income"></a>
                    <p>PDF</p>
                </td>

            </tr>

            <tr class="table-row">
                <td class="">
                    <i class="fa fa-info-circle fa-3x"></i>
                </td>
                <td class="table-text">
                    <h6>Expenses vs Budget Report</h6>
                    <p>A report that tells more about actual expenses done against the proposed budget</p>
                </td>

                <td>
                    <a class="fa fa-file-pdf-o fa-2x"></a>
                    <p>PDF</p>
                </td>

            </tr>-->
            </tbody>
        </table>

        <div>
        <h4>Custom Reports</h4>
        <hr/>

        <div class="form-group">
            <label for="radio" class="control-label">Create your custom report on : </label>
            <div class="">
                <div class="radio-inline"><label><input name="c_report" id="members" type="radio"  checked="">Members</label></div>
                <div class="radio-inline"><label><input name="c_report" id="budget" type="radio">Budget</label></div>
                <div class="radio-inline"><label><input name="c_report" id="event" type="radio" >Event</label></div>
            </div>
        </div>

        <div class="c_report" id="show-members" style=''>

            <div class="well well-sm">
                <table class="table">
                    <tbody>
                    <tr class=" table-row">
                        <td class="table-text">
                            <h6>Members with unpaid pledges</h6>
                            <p>A report with the list of members who have paid less than the pledge amount </p>
                        </td>
                        <td class="report_pdf">
                            <a href="javascript:void(0)" class="report fa fa-file-pdf-o fa-2x" rel="<?php /*echo $event_id; */?>" id="income"></a>
                            <p>PDF</p>
                        </td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-text">
                            <h6>Members with full paid pledges</h6>
                            <p>A report with the list of members who have full paid their pledge amount</p>
                        </td>
                        <td class="report_pdf">
                            <a href="javascript:void(0)" class="report fa fa-file-pdf-o fa-2x" rel="<?php /*echo $event_id; */?>" id="income"></a>
                            <p>PDF</p>
                        </td>
                    </tr>
                    </tbody>
                </table>

            </div>

            <div class="">
                <div class="grid-form1">
                    <h4 id="forms-horizontal">A list of members based on defined paid and pledge amounts</h4>
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="pledge_amount" class="col-sm-2 control-label">Pledge Amount</label>
                            <div class="col-sm-8">
                                <input type="text" name="pledge_amount" value="" class="form-control1" id="pledge_amount" placeholder="Enter pledge amount">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="membercash" class="col-sm-2 control-label">Paid Amount</label>
                            <div class="col-sm-8">
                                <input type="text" name="membercash" value="<?php echo set_value('membercash'); ?>" class="form-control1" id="membercash" placeholder="Member Cash">
                                <?php echo form_error('membercash'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">Sign in</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>



        </div>

        <div class="c_report" id="show-budget" style='display:none'>
            <p>Hello Budget</p>
        </div>

        <div class="c_report" id="show-event" style='display:none'>
            <p>Hello Events</p>
        </div>

        </div>

    </div>





</div>
<script>

$(document).ready(function() {


    $('input[type="radio"]').change(function(){
        if($("input[name='group']:checked")){
            var type=$(this).attr('id');
            var str = '#show-'+type;
            $('.c_report').hide();
            $(str).show();
        }
    });


    var getPDFReport = function(postData) {

        $.ajax(
            {
                type:"POST",
                url: "<?php echo base_url('reports/pdf_reports')?>",
                data:postData,
                dataType: 'json',
                success: function(data) {

                    var $a = $("<a>");
                    $a.attr("href",data.file);
                    $("body").append($a);
                    $a.attr("download",data.report_name);
                    $a[0].click();
                    $a.remove();

                },

                error: function(data) {

                    alert('An error has occured while trying to get the report details, Please try again ');
                }
            });
    }




    $('.report_pdf').on("click", ".report", function() {
        var report_name = $(this).attr("id");
        var event_id = $(this).attr("rel");
        var postData = {
            'report_name': report_name,
            'event_id': event_id,
        };

        getPDFReport(postData);

    });


    });


</script>

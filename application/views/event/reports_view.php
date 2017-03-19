<?php
/**
 * Created by PhpStorm.
 * User: d.felix
 * Date: 14/03/2017
 * Time: 21:57
 */

?>

<div class="blank" xmlns="http://www.w3.org/1999/html">


    <div class="blank-page col-md-8">

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
                            <a href="javascript:void(0)" class="report fa fa-file-pdf-o fa-2x" rel="<?php echo $event_id; ?>" id="less_pledge"></a>
                            <p>PDF</p>
                        </td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-text">
                            <h6>Members with full paid pledges</h6>
                            <p>A report with the list of members who have full paid their pledge amount</p>
                        </td>
                        <td class="report_pdf">
                            <a href="javascript:void(0)" class="report fa fa-file-pdf-o fa-2x" rel="<?php echo $event_id; ?>" id="full_pledge"></a>
                            <p>PDF</p>
                        </td>
                    </tr>
                    </tbody>
                </table>

            </div>

            <div class="">

                <div class="grid-form1">
                    <h4 id="forms-horizontal">A list of members based on the defined member categories</h4>
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="type" class="col-sm-4 control-label">Choose members category</label>
                            <div class="col-sm-6">
                                <?php $ov = 1; ?>
                                <select name="type" rel="<?php echo $event_id; ?>" id="m_cat" class="form-control1">
                                    <?php foreach($member_cat as $mc){?>
                                        <option  value="<?php echo $mc->category_id; ?>" ><?php echo $mc->category_name; ?></option>
                                    <?php  } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-8">
                                <button id="mc_button" type="submit" class="btn btn-primary" style='display:none'>Create PDF Report</button>
                            </div>
                        </div>
                    </form>
                </div>



                <div class="grid-form1">
                    <h4 id="forms-horizontal">A list of members based on defined paid and pledge amounts</h4>
                    <form id="custom_member_form" rel="<?php echo $event_id; ?>" class="form-horizontal" method="POST" action="">
                        <div class="form-group">
                            <label for="pledge_amount" class="col-sm-4 control-label">Pledge Amount equals to:</label>
                            <div class="col-sm-6">
                                <input type="text" name="pledge_amount" class="form-control1" id="pledge_amount" placeholder="Enter pledge amount">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="paid_amount" class="col-sm-4 control-label">Paid Amount equals or less than </label>
                            <div class="col-sm-6">
                                <input type="text" name="paid_amount" class="form-control1" id="paid_amount" placeholder="Enter paid amount">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-8">
                                <button id="" type="submit" class="btn btn-primary">Create PDF Report</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>



        </div>

        <div class="c_report" id="show-budget" style='display:none'>
            <div class="well well-sm">
                <table class="table">
                    <tbody>
                    <tr class=" table-row">
                        <td class="table-text">
                            <h6>Collected amount</h6>
                            <p>A report that tells how much income collected against the proposed budget</p>
                        </td>
                        <td class="report_pdf">
                            <a href="javascript:void(0)" class="report fa fa-file-pdf-o fa-2x" rel="<?php /*echo $event_id; */?>" id="income"></a>
                            <p>PDF</p>
                        </td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-text">
                            <h6>Amount spent</h6>
                            <p>A report that tells more about actual expenses done against the proposed budget</p>
                        </td>
                        <td class="report_pdf">
                            <a href="javascript:void(0)" class="report fa fa-file-pdf-o fa-2x" rel="<?php /*echo $event_id; */?>" id="income"></a>
                            <p>PDF</p>
                        </td>
                    </tr>
                    </tbody>
                </table>

            </div>
        </div>

        <div class="c_report" id="show-event" style='display:none'>
            <p>Hello Events</p>
        </div>

        </div>

    </div>

    <div class=" blank-page col-md-4">
        <h4>Basic Reports</h4>
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

            </tbody>
        </table>


    </div>





</div>
<script>








$(document).ready(function() {

    // A function on custom reports

    $('input[type="radio"]').change(function(){
        if($("input[name='group']:checked")){
            var type=$(this).attr('id');
            var str = '#show-'+type;
            $('.c_report').hide();
            $(str).show();
        }
    });


    $('#m_cat').on('change', function () {

            var report_name = 'member_cat';
            var cat_id = this.value;
            var event_id = $(this).attr("rel");
            var postData = {
                'report_name': report_name,
                'event_id': event_id,
                'cat_id':cat_id

            };

            getPDFReport(postData);


    });


    $('#custom_member_form').submit(function(e) {

        e.preventDefault();
        var p_amount=$('#paid_amount').val();
        var pl_amount=$('#pledge_amount').val();

        var report_name = 'member_amounts';
        var event_id = $('#custom_member_form').attr("rel");

        var postData = {
            'report_name': report_name,
            'event_id': event_id,
            'p_amount':p_amount,
            'pl_amount':pl_amount

        };


        getPDFReport(postData);

    });



    // a function on PDF reports

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

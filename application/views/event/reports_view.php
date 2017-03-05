<?php
/**
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 2/20/2017
 * Time: 5:43 PM
 */?>

<div class="blank">


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
                <td class="report_excel">
                    <a href="javascript:void(0)" class="report fa fa-file-excel-o fa-2x" rel="<?php echo $event_id; ?>" id="members"></a>
                    <p>Excel</p>
                </td>
                <td>
                    <a class="fa fa-file-pdf-o fa-2x"></a>
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
                <td class="report_excel">
                    <a href="javascript:void(0)" class="report fa fa-file-excel-o fa-2x" rel="<?php echo $event_id; ?>" id="budget"></a>
                    <p>Excel</p>
                </td>
                <td>
                    <a class="fa fa-file-pdf-o fa-2x"></a>
                    <p>PDF</p>
                </td>

            </tr>

            <tr class="table-row">
                <td class="">
                    <i class="fa fa-users fa-3x"></i>
                </td>
                <td class="table-text">
                    <h6>Unpaid Pledges Report</h6>
                    <p>A report that provides members' list who have paid less than the pledged amount</p>
                </td>
                <td class="report_excel">
                    <a href="javascript:void(0)" class="report fa fa-file-excel-o fa-2x" rel="<?php echo $event_id; ?>" id="pledge"></a>
                    <p>Excel</p>
                </td>
                <td>
                    <a class="fa fa-file-pdf-o fa-2x"></a>
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
                <td class="report_excel">
                    <a href="javascript:void(0)" class="report fa fa-file-excel-o fa-2x" rel="<?php echo $event_id; ?>" id="income"></a>
                    <p>Excel</p>
                </td>
                <td>
                    <a class="fa fa-file-pdf-o fa-2x"></a>
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
                <td class="report_excel">
                    <a href="javascript:void(0)" class="report fa fa-file-excel-o fa-2x" rel="<?php echo $event_id; ?>" id="expenses"></a>
                    <p>Excel</p>
                </td>
                <td>
                    <a class="fa fa-file-pdf-o fa-2x"></a>
                    <p>PDF</p>
                </td>

            </tr>
            </tbody>
        </table>
    </div>

    <div class="blank-page col-md-4">
        <h4>Custom Reports</h4>
        <hr/>
        <p>You can create reports based on the categories defined below </p>


        <div class="col-md-12 form-group2 group-mail">
            <label class="control-label">Select Category</label>
            <select>
                <option value="0">Members</option>
                <option value="1">Budget</option>
                <option value="2">Event</option>
                <option value="3">Contrary3</option>
                <option value="4">Contrary4</option>
            </select>
        </div>

        <div>

            <label class="control-label">Create Report</label>
            <div class="form-inline">

                <div class="form-group">
                    <a href="javascript:void(0)" class="report fa fa-file-excel-o fa-2x " rel="<?php echo $event_id; ?>" id="custom"></a>
                    <p>Excel</p>
                </div>

                <div class="form-group">
                    <a class="fa fa-file-pdf-o fa-2x"></a>
                    <p>PDF</p>
                </div>
            </div>

        </div>


    </div>



</div>
<script>
$(document).ready(function() {


    var getReport = function(postData) {

        $.ajax(
            {
                type:"POST",
                url: "<?php echo base_url('event/reports')?>",
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


$('.report_excel').on("click", ".report", function() {
var report_name = $(this).attr("id");
var event_id = $(this).attr("rel");
var postData = {
'report_name': report_name,
'event_id': event_id,
};

getReport(postData);

});
});
</script>

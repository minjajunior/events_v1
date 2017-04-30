<?php
/**
 * Created by PhpStorm.
 * User: d.felix
 * Date: 14/03/2017
 * Time: 21:57
 */

?>
<div class="banner">
    <h2>
        <a href="<?php echo site_url('event/home/'.base64_encode($event_id)) ?>">Event</a>
        <i class="fa fa-angle-right"></i>
        <span>Reports</span>
    </h2>
</div>

<div class="content-top" >

    <div class="col-md-8">
        <div class="blank-page">
            <h3 class="head-top">Custom Reports</h3>
            <div class="but_list">
                <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab" class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Members</a></li>
<!--                        <li role="presentation" class=""><a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Budget</a></li>-->
<!--                        <li role="presentation" class="dropdown">-->
<!--                            <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown" aria-controls="myTabDrop1-contents" aria-expanded="false">Event<span class="caret"></span></a>-->
<!--                            <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1" id="myTabDrop1-contents">-->
<!--                                <li><a href="#dropdown1" tabindex="-1" role="tab" id="dropdown1-tab" data-toggle="tab" aria-controls="dropdown1">@fat</a></li>-->
<!--                                <li><a href="#dropdown2" tabindex="-1" role="tab" id="dropdown2-tab" data-toggle="tab" aria-controls="dropdown2">@mdo</a></li>-->
<!--                            </ul>-->
<!--                        </li>-->
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="home" aria-labelledby="home-tab">

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
                                                    <?php foreach($member_group as $mg){?>
                                                        <option  value="<?php echo $mg->group_id; ?>" ><?php echo $mg->group_name; ?></option>
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
                                    <div id="the-message"></div>
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

                        <div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledby="profile-tab">
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


<!--                        <div role="tabpanel" class="tab-pane fade" id="dropdown1" aria-labelledby="dropdown1-tab">-->
<!--                            <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>-->
<!--                        </div>-->
<!--                        <div role="tabpanel" class="tab-pane fade" id="dropdown2" aria-labelledby="dropdown2-tab">-->
<!--                            <p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.</p>-->
<!--                        </div>-->

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 ">
        <div class="blank-page">
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
    <div class="clearfix"> </div>
</div>
<script>

    $( document ).ready(function() {

    //A function creating PDF report based on member category
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


    // A function creating a PDF report based on the pledge and paid amounts supplied
    $('#custom_member_form').submit(function(e) {

        e.preventDefault();
        var p_amount=$('#paid_amount').val();
        var pl_amount=$('#pledge_amount').val();
        var report_name = 'member_amounts';
        var event_id = $('#custom_member_form').attr("rel");




        if($.isNumeric(p_amount) && $.isNumeric(pl_amount)){

            var postData = {
                'report_name': report_name,
                'event_id': event_id,
                'p_amount':p_amount,
                'pl_amount':pl_amount

            };

            getPDFReport(postData);

        }else{

            if(p_amount ==="" || pl_amount==="" ){

                $('#the-message').append('<div class="alert alert-danger">' +
                    '<span class="glyphicon glyphicon-ok"></span>' +
                    'Amounts can not be empty.' +
                    '</div>');

            }else{

                $('#the-message').append('<div class="alert alert-danger">' +
                    '<span class="glyphicon glyphicon-ok"></span>' +
                    'Amounts must contain numbers only.' +
                    '</div>');

            }
            // reset the form
            $('#custom_member_form').reset();



        }


    });



    // a function on creating a PDF reports

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


    // A function to load basic PDF reports
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

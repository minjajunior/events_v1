<?php
/**
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 12/5/2016
 * Time: 10:31 AM
 */

$this->load->view('shared/header');
?>

<div class="page-container">
    <!--/content-inner-->
    <div class="left-content">
        <div class="inner-content">
            <!-- header-starts -->
            <div class="header-section">
                <!--menu-right-->
                <div class="top_menu">
                    <!--/profile_details-->
                    <div class="profile_details_left">
                        <h4>N ~ E ~ P</h4>
                    </div>
                    <div class="clearfix"></div>
                    <!--//profile_details-->
                </div>
                <!--//menu-right-->
                <div class="clearfix"></div>
            </div>

            <!-- //header-ends -->
            <!--//outer-wp-->
            <div class="outter-wp">
                <!--/sub-heard-part-->
                <div class="sub-heard-part">
                    <ol class="breadcrumb m-b-0">
                        <li><a href="#">Budget</a></li>
                        <li class="active">Edit</li>
                    </ol>
                </div>
                <!--/sub-heard-part-->
                <!--/forms-->
                <div class="forms-main">
                    <!--/forms-inner-->
                    <div class="forms-inner">
                        <!--/set-2-->
                        <div class="set-1">
                            <div class="graph-2 general">
                                <h3 class="inner-tittle two">Edit Item</h3>
                                <div class="grid-1">
                                    <div class="form-body">
                                        <?php
                                        $attributes = array('class' => 'form-horizontal');
                                        echo form_open('event/edit_budget/'.$item_id, $attributes);
                                        ?>
                                        <?php foreach($item_detail as $idt){ ?>
                                            <div class="form-group">
                                                <label for="focusedinput" class="col-sm-2 control-label">Item Name</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="itemname" value="<?php echo $idt->item_name ?>" class="form-control1" id="focusedinput" placeholder="Item Name">
                                                    <?php echo form_error('itemname'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledinput" class="col-sm-2 control-label">Item Cost</label>
                                                <div class="col-sm-8">
                                                    <input disabled="" type="text" name="itemcost" value="<?php echo $idt->item_cost ?>" class="form-control1" id="disabledinput" placeholder="Item Cost">
                                                    <?php echo form_error('itemcost'); ?>
                                                </div>
                                                <div class="col-sm-2">
                                                    <a href="<?php echo site_url('event/transaction/Cost/'.$item_id)?>" class="">Add Cost</a>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="focusedinput" class="col-sm-2 control-label">Item Paid</label>
                                                <div class="col-sm-8">
                                                    <input disabled="" type="text" name="itempaid" value="<?php echo $idt->item_paid ?>" class="form-control1" id="focusedinput" placeholder="Item Paid">
                                                    <?php echo form_error('itempaid'); ?>
                                                </div>
                                                <div class="col-sm-2">
                                                    <a href="<?php echo site_url('event/transaction/Payment/'.$item_id)?>" class="">Add Payment</a>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-8 col-md-offset-2">
                                                    <button type="submit" class="btn btn-default">Save</button>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--//set-2-->
                    </div>
                    <!--//forms-inner-->
                </div>
                <!--//forms-->
            </div>
            <!--//outer-wp-->
            <!--footer section start-->
            <?php $this->load->view('shared/footer') ?>
            <!--footer section end-->
        </div>
    </div>
    <!--//content-inner-->
    <!--/sidebar-menu-->
    <?php $this->load->view('shared/sidebar') ?>
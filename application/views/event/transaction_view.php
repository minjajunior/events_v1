<?php
/**
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 12/3/2016
 * Time: 10:09 AM
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
                        <li><a href="#">Transaction</a></li>
                        <li class="active"><?php echo $type ?></li>
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
                                <h3 class="inner-tittle two">Add <?php echo $type ?></h3>
                                <div class="grid-1">
                                    <div class="form-body">
                                        <?php if($type == 'Pledge' || $type == "Cash") {
                                        $attributes = array('class' => 'form-horizontal');
                                        echo form_open('event/transaction/'.$type.'/'.$member_id, $attributes);
                                        ?>
                                        <?php foreach($member_detail as $md){ ?>
                                            <div class="form-group">
                                                <label for="disabledinput" class="col-sm-2 control-label">Name</label>
                                                <div class="col-sm-8">
                                                    <input disabled="" type="text" name="membername" value="<?php echo $md->member_name ?>" class="form-control1" id="disabledinput" placeholder="Member Name">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="focusedinput" class="col-sm-2 control-label"><?php echo $type?></label>
                                                <div class="col-sm-8">
                                                    <input  type="text" name="amount" value="" class="form-control1" id="focusedinput" placeholder="Amount">
                                                    <?php echo form_error('amount'); ?>
                                                </div>
                                            </div>
                                            <input type="hidden" name="memberpledge" value="<?php echo $md->member_pledge ?>" />
                                            <input type="hidden" name="membercash" value="<?php echo $md->member_cash ?>" />
                                            <div class="form-group">
                                                <div class="col-sm-8 col-md-offset-2">
                                                    <button type="submit" class="btn btn-default">Add</button>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        </form>
                                        <?php }
                                         if($type == 'Cost' || $type == "Payment") {
                                            $attributes = array('class' => 'form-horizontal');
                                            echo form_open('event/transaction/'.$type.'/'.$item_id, $attributes);
                                            ?>
                                            <?php foreach($item_detail as $idt){ ?>
                                                <div class="form-group">
                                                    <label for="disabledinput" class="col-sm-2 control-label">Name</label>
                                                    <div class="col-sm-8">
                                                        <input disabled="" type="text" name="itemname" value="<?php echo $idt->item_name ?>" class="form-control1" id="disabledinput" placeholder="Member Name">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label"><?php echo $type?></label>
                                                    <div class="col-sm-8">
                                                        <input  type="text" name="amount" value="" class="form-control1" id="focusedinput" placeholder="Amount">
                                                        <?php echo form_error('amount'); ?>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="itemcost" value="<?php echo $idt->item_cost ?>" />
                                                <input type="hidden" name="itempaid" value="<?php echo $idt->item_paid ?>" />
                                                <div class="form-group">
                                                    <div class="col-sm-8 col-md-offset-2">
                                                        <button type="submit" class="btn btn-default">Add</button>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            </form>
                                        <?php } ?>
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
    <?php $this->load->view('shared/sidebar')?>
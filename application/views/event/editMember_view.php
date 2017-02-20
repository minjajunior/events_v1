<?php
/**
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 12/2/2016
 * Time: 4:12 PM
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
                        <li><a href="#">Member</a></li>
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
                                <h3 class="inner-tittle two">Edit Member</h3>
                                <div class="grid-1">
                                    <div class="form-body">
                                        <?php
                                        $attributes = array('class' => 'form-horizontal');
                                        echo form_open('event/edit_member/'.$member_id, $attributes);
                                        ?>
                                        <?php foreach($member_detail as $md){ ?>
                                        <div class="form-group">
                                            <label for="focusedinput" class="col-sm-2 control-label">Member Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="membername" value="<?php echo $md->member_name ?>" class="form-control1" id="focusedinput" placeholder="Member Name">
                                                <?php echo form_error('membername'); ?>
                                            </div>
                                        </div>
                                            <div class="form-group">
                                                <label for="focusedinput" class="col-sm-2 control-label">Phone Number</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="memberphone" value="<?php echo $md->member_phone ?>" class="form-control1" id="focusedinput" placeholder="Phone Number">
                                                    <?php echo form_error('memberphone'); ?>
                                                </div>
                                            </div>
                                        <div class="form-group">
                                            <label for="disabledinput" class="col-sm-2 control-label">Member Pledge</label>
                                            <div class="col-sm-8">
                                                <input disabled="" type="text" name="memberpledge" value="<?php echo $md->member_pledge ?>" class="form-control1" id="disabledinput" placeholder="Member Pledge">
                                                <?php echo form_error('memberpledge'); ?>
                                            </div>
                                            <div class="col-sm-2">
                                                <a href="<?php echo site_url('event/transaction/Pledge/'.$member_id)?>" class="">Add Pledge</a>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="focusedinput" class="col-sm-2 control-label">Member Cash</label>
                                            <div class="col-sm-8">
                                                <input disabled="" type="text" name="membercash" value="<?php echo $md->member_cash ?>" class="form-control1" id="focusedinput" placeholder="Member Cash">
                                                <?php echo form_error('membercash'); ?>
                                            </div>
                                            <div class="col-sm-2">
                                                <a href="<?php echo site_url('event/transaction/Cash/'.$member_id)?>" class="">Add Cash</a>
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
    <?php $this->load->view('shared/sidebar');?>
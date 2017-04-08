<?php
/**
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 3/14/2017
 * Time: 1:18 PM
 */

$this->load->view('shared/header');
$this->load->view('shared/sidebar');
?>
<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="content-main">

        <div class="banner">
            <h2>
                <a href="<?php echo base_url('admin/home')?>">Admin</a>
                <i class="fa fa-angle-right"></i>
                <span>Profile</span>
            </h2>
        </div>

        <div class=" profile">

            <div class="profile-bottom">
                <h3><i class="fa fa-user"></i>Profile</h3>
                <div class="profile-bottom-top">
                    <?php foreach($admin_details as $ad){ ?>
                    <div class="col-md-8 profile-text">
                        <h6><?php echo $ad->admin_name?></h6>
                        <table>
                            <tr>
                                <td>Phone</td>
                                <td>:</td>
                                <td><?php echo $ad->admin_phone?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td> :</td>
                                <td><?php echo $ad->admin_email?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-4 profile-fo">
                        <h4><?php echo $event_sum; ?></h4>
                        <p>Events</p>
                        <?php if ($admin_id == $this->session->admin_id ) { ?>
                        <a href="<?php echo base_url('admin')?>" class="pro1"><i class="fa fa-list"></i>View Events</a>
                        <?php } else { ?>
                            <a href="#" ><i class="fa fa-remove"></i>Remove Admin</a>
                        <?php } ?>
                    </div>
                    <?php } ?>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

<?php $this->load->view('shared/footer') ?>

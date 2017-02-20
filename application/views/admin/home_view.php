<?php
/**
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 11/21/2016
 * Time: 12:34 PM
 */

$this->load->view('shared/header');
$this->load->view('shared/sidebar');
?>
<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="content-main">
        <!--banner-->
        <div class="banner">
            <h2>
                <a href="<?php echo base_url('admin/home')?>">Admin</a>
                <i class="fa fa-angle-right"></i>
                <span>Events List</span>
                <a href="<?php echo site_url('event/create')?>" class="pull-right">Create Event</a>
            </h2>
        </div>
        <!--//banner-->

        <div class="blank">
            <div class="blank-page">
                <?php if(!isset($event['error'])) { ?>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Event Name</th>
                            <th>Event Date</th>
                            <th>Event Fee</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($event as $eve){ ?>
                            <tr>
                                <td><a href="<?php echo site_url('event/home/'.$eve->event_id) ?>"><?php echo $eve->event_name ?></a></td>
                                <td><?php echo date_format(date_create($eve->event_date), 'l, jS F Y') ?></td>
                                <?php if($eve->event_paid == 0) { ?>
                                    <td>Not Paid</td>
                                <?php } else { ?>
                                    <td>Paid</td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <p>You did not create any event yet.</p>
                <?php } ?>
            </div>
        </div>
    <?php $this->load->view('shared/footer') ?>

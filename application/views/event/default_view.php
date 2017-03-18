<?php
/**
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 2/20/2017
 * Time: 4:45 PM
 */

$this->load->view('shared/header');
$this->load->view('shared/sidebar');
?>

<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="content-main">

        <div class="profile">
            <div class="profile-bottom">
                <div class="profile-bottom-top">
                    <?php foreach($event_details as $ed){ ?>
                    <h3><?php echo $ed->event_name?></h3>
                    <div class="col-md-8 profile-text">
                        <table>
                            <tr>
                                <td>Event Date</td>
                                <td>:</td>
                                <td><?php echo date_format(date_create($ed->event_date), 'l, jS F Y') ?></td>
                            </tr>
                            <tr>
                                <td>Event Code</td>
                                <td> :</td>
                                <td><?php echo $ed->event_code ?></td>
                            </tr>
                            <tr>
                                <td>Event Type</td>
                                <td> :</td>
                                <td><?php echo $ed->event_type ?></td>
                            </tr>
                            <tr>
                                <td>Event Location </td>
                                <td>:</td>
                                <td>
                                    <?php foreach($location as $loc){
                                        if($loc->location_id == $ed->event_location){
                                            echo $loc->location_name;
                                        }
                                    } ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-4 profile-bottom-img text-center">
                        <?php $td = date_create(date('Y-m-d')); $de = date_create($ed->event_date); $in = date_diff($td, $de); ?>
                        <h1 class="text-success"><span><?php echo $in->format('%a') ?></span></h1>
                        <p>Days Remaining</p>
                    </div>
                    <div class="clearfix"></div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <!--content-->

        <!--Write views using Ajax-->
        <div id="load_navigation_menu_view"></div>
        <br>
        <?php $this->load->view('shared/footer') ?>

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

        <!--banner-->
        <div class="banner">
            <?php foreach($event_details as $ed){ ?>
                <h1><?php echo $ed->event_name?></h1>
                <h2><span>Event Date: <?php echo date_format(date_create($ed->event_date), 'l, jS F Y') ?></span></h2>
                <?php $td = date_create(date('Y-m-d')); $de = date_create($ed->event_date); $in = date_diff($td, $de); ?>
                <h2><span>Days Remaining: <?php echo $in->format('%a days') ?></span></h2>
            <?php } ?>
        </div>
        <!--//banner-->

        <!--content-->
        <!--Write views using Ajax-->
        <div id="load_navigation_menu_view"></div>
        <br>
        <?php $this->load->view('shared/footer') ?>

<?php
/**
 * Created by PhpStorm.
 * User: d.felix
 * Date: 11/04/2017
 * Time: 00:39
 */
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Events</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <link href="<?php echo base_url('assets/css/bootstrap.min.css')?>" rel='stylesheet' type='text/css' />
    <!-- Custom Theme files -->
    <link href="<?php echo base_url('assets/css/style.css')?>" rel='stylesheet' type='text/css' />
    <link href="<?php echo base_url('assets/css/font-awesome.css')?>" rel="stylesheet">
    <script src="<?php echo base_url('assets/js/jquery.min.js')?>"> </script>
    <!-- Mainly scripts -->
    <script src="<?php echo base_url('assets/js/jquery.metisMenu.js')?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.slimscroll.min.js')?>"></script>
    <!-- Custom and plugin javascript -->
<!--    <link href="--><?php //echo base_url('assets/css/custom.css')?><!--" rel="stylesheet">-->
    <link href="<?php echo base_url('assets/css/jquery-ui.theme.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/jquery-ui.structure.css')?>" rel="stylesheet">
    <script src="<?php echo base_url('assets/js/custom.js')?>"></script>
    <script src="<?php echo base_url('assets/js/screenfull.js')?>"></script>
    <script src="<?php echo base_url('assets/js/jquery-ui.js')?>"></script>
</head>
<body>

<div class="container">
    <div class=" col-md-12 profile">
        <div class="profile-bottom">
            <div class="profile-bottom-top">
                <div class="col-md-6">
                    <table>
                        <tbody>
                        <tr>
                            <td>Event Name : <?php echo $event_details[0]->event_name; ?></td>
                        </tr>
                        <tr>
                            <td>Generate by : <?php echo $admin_details[0]->admin_name; ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-offset-6">
                    <img  src="<?php echo base_url(); ?>/assets/images/demi.png">
                </div>
            </div>
        </div>
    </div>
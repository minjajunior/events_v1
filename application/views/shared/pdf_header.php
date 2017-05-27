<?php
/**
 * Created by PhpStorm.
 * User: d.felix
 * Date: 12/03/2017
 * Time: 14:34
 */

?>

<?php
/**
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 2/15/2017
 * Time: 9:57 AM
 */
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Demi Events</title>
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
    <link href="<?php echo base_url('assets/css/custom.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/jquery-ui.theme.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/jquery-ui.structure.css')?>" rel="stylesheet">
    <script src="<?php echo base_url('assets/js/custom.js')?>"></script>
    <script src="<?php echo base_url('assets/js/screenfull.js')?>"></script>
    <script src="<?php echo base_url('assets/js/jquery-ui.js')?>"></script>
    <script src="<?php echo base_url('assets/js/Chart.js')?>"></script>
    <script>
        $(function () {
            $('#supported').text('Supported/allowed: ' + !!screenfull.enabled);

            if (!screenfull.enabled) {
                return false;
            }
            $('#toggle').click(function () {
                screenfull.toggle($('#container')[0]);
            });
        });
    </script>
    <!----->

    <!--pie-chart--->
    <script src="<?php echo base_url('assets/js/pie-chart.js')?>" type="text/javascript"></script>

    <!--skycons-icons-->
    <script src="<?php echo base_url('assets/js/skycons.js')?>"></script>
    <!--//skycons-icons-->
</head>
<body>

<div id="wrapper">



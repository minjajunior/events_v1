<?php
/**
 * Created by PhpStorm.
 * User: d.felix
 * Date: 11/04/2017
 * Time: 00:39
 */
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PDF Report</title>
    <style>
        body{
            width: 100%;
        }
        h4{
            margin-top: 0;
        }
        hr {
            width: 300px;
            margin-left: auto;
            margin-right: auto;
            height: 2px;
            background-color:#f3f6db;
            color:gray;
            border: 0 none;
        }
        #tblproduct-details table {
            color: #333;
            font-family:Arial, sans-serif;
            /*width: 1045px; */
            border-collapse:collapse;
            border-spacing: 0;
            border-color: gray;
        }
        #tblproduct-details th {
            border: 1px solid gray; /* No more visible border */
            height: 30px;
            border-spacing: 0;
        }
        #tblproduct-details td {
            border-bottom: 1px solid gray; /* No more visible border */
            height: 30px;
            border-spacing: 0;
        }
        #tblproduct-details th {
            background: #DFDFDF;  /* Darken header a bit */
            font-weight: bold;
        }
        .desc{
            font-style: italic;
        }
        .text-right{
            text-align: right;
        }
        .text-center{
            text-align: center;
        }
        .inv-p p{
            display: inline-block;
            text-align: right;
            padding: 0;
            margin: 0;
        }
        .inv-p{
            margin-top: 20px;
        }
        #inv-spacing{
            padding-top: 0px;
        }
    </style>

</head>
<body>

<table width="100%" cellspacing="1" cellpadding="6">
    <tr>
        <td width="30%" rowspan="5"><a href="index"> <img src="<?php echo base_url(); ?>/assets/images/demi.png"></a> </td>
    </tr>
    <tr>
        <td width="15%" ><h3 class="invoiceHeading">Event Name : <?php echo $event_details[0]->event_name; ?></h3></td>
        <td width="15%" ><h3 class="invoiceHeading">Generate by : <?php echo $admin_details[0]->admin_name; ?></h3></td>
    </tr>

</table>
<table width="100%" cellspacing="1" cellpadding="6">
    <tr>
        <td ><strong>Demi Corporation Limited</strong></td>
    </tr>
    <tr>
        <td>4th Floor Barclays House</td>
    </tr>
    <tr>
        <td>info@demi.co.tz</td>
    </tr>

    <tr>
        <td >+255 752 934 547</td>
    </tr>

</table>

<table width="100%" cellspacing="0" cellpadding="3">

    <tr>
        <td colspan='4'><hr></td>
    </tr>
    <tr>
        <td colspan='4'>&nbsp;</td>
    </tr>
    <tr>
        <td><h2><?php echo $report_name; ?></h2></td>
    </tr></table>

<!--    <tr>-->
<!--        <td colspan="4">-->

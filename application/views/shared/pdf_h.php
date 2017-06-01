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
            font-family:"Klavika Lt" ;
        }
        table{
            padding-left:15px;
            padding-right:15px;

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
            /*width: 1045px; */
            border-collapse:collapse;
            border-spacing: 0;
            /*border-color: gray;*/
        }
        #tblproduct-details th {
            border: 1px solid gray; /* No more visible border */
            height: 30px;
            border-spacing: 0;
        }
        #tblproduct-details td {
            border-bottom: 1px solid black; /* No more visible border */
            height: 30px;
            border-spacing: 0;
            border-left:1px solid black;
            border-top:1px solid black;
            border-right:1px solid black;
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
        .text-left{
            text-align: left;
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
        <td width="100%" class="text-center" ><h2 ><?php echo $event_details[0]->event_name.' - '.$report_name; ?> </h2></td>
    </tr>
    <tr>
        <td width="30%" >
<!--            <h2 class=" text-center">--><?php //echo $event_details[0]->event_name.'-'.$report_name; ?><!-- </h2>-->
            <p class="invoiceHeading">Event Type : <?php echo $event_details[0]->event_type; ?></p>
            <p class="invoiceHeading">Event Date : <?php echo $event_details[0]->event_date; ?></p>
            <p class="invoiceHeading">Generate by : <?php echo $admin_details[0]->admin_name; ?></p>
        </td>
        <td class="text-right"><a href="index"> <img src="<?php echo base_url(); ?>/assets/images/demi.png"></a></td>
    </tr>

</table>

<table width="100%" cellspacing="0" cellpadding="3">

    <tr>
        <td colspan='4'><hr></td>
    </tr>
<!--    <tr>-->
<!--        <td colspan='4'>&nbsp;</td>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <td><h2>--><?php //echo $report_name; ?><!--</h2></td>-->
<!--    </tr>-->
</table>

<!--    <tr>-->
<!--        <td colspan="4">-->

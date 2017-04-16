<?php
/**
 * Created by PhpStorm.
 * User: d.felix
 * Date: 10/04/2017
 * Time: 23:07
 */

echo $pdf_h;

?>

<table id="tblproduct-details" cellspacing="0" width="100%" cellpadding=6>
    <tr>
        <th> <h4>#</h4></th>
        <th> <h4>Item Name</h4></th>
        <th> <h4>Cost</h4></th>
        <th> <h4>Paid</h4></th>
        <th> <h4>Balance</h4></th>
    </tr>
    <!-- Products Heading -->
    <?php
    $i=1;  $sum_cost = 0; $sum_paid =0; $sum_bal=0;
    foreach ($budget_details as $bd) { ?>

        <tr>
            <td class="text-center"><?php echo $i; ?></td>
            <td class='text-left'><?php echo $bd->item_name ?></td>
            <td class="text-right"><?php echo $english_format_number = number_format($bd->item_cost, 0, '.', ','); ?></td>
            <td class='text-right'><?php echo $english_format_number = number_format($bd->item_paid, 0, '.', ','); ?></td>
            <td class='text-right'><?php if ($bd->item_cost-$bd->item_paid>0){ echo $english_format_number = number_format($bd->item_cost-$bd->item_paid, 0, '.', ','); } else echo 0; ?></td>
        </tr>
        <?php $i++;  $sum_cost += $bd->item_cost; $sum_paid += $bd->item_paid;  if($bd->item_cost-$bd->item_paid>0){ $sum_bal+=($bd->item_cost-$bd->item_paid); } } ?>

    <tr>
        <td class='text-center'></td>
        <td  class='text-left'>Total Amounts</td>
        <td  class='text-right'><?php echo $english_format_number = number_format($sum_cost, 0, '.', ','); ?></td>
        <td  class='text-right'><?php echo $english_format_number = number_format($sum_paid, 0, '.', ','); ?></td>
        <td  class='text-right'><?php echo $english_format_number = number_format($sum_bal, 0, '.', ','); ?></td>
    </tr>
    <!-- Products Details Details -->
</table>
<!--        </td>-->
<!--    </tr>-->

</table>

</body>
</html>
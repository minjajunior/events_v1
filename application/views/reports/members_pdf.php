

<?php
/**
 * Created by PhpStorm.
 * User: d.felix
 * Date: 12/03/2017
 * Time: 14:34
 */

echo $pdf_h;
?>


<?php if(!isset($member_group['error'])){ ?>
<table id="tblproduct-details" cellspacing="0" width="100%" cellpadding=6>
    <tr>
        <th> <h4>#</h4></th>
        <th> <h4>Member Name</h4></th>
        <th> <h4>Mobile Number</h4></th>
        <th> <h4>Pledge</h4></th>
        <th> <h4>Cash</h4></th>
        <th> <h4>Balance</h4></th>
    </tr>
    <!-- Products Heading -->
    <?php
    $i=1;  $sum_pledge = 0; $sum_cash =0; $sum_bal=0;
    foreach ($member_details as $md) { ?>

        <tr>
            <td class="text-center"><?php echo $i; ?></td>
            <td class='text-left'><?php echo $md->member_name ?></td>
            <td class='text-left'><?php echo $md->member_phone ?></td>
            <td class="text-right"><?php echo $english_format_number = number_format($md->member_pledge, 0, '.', ','); ?></td>
            <td class='text-right'><?php echo $english_format_number = number_format($md->member_cash, 0, '.', ','); ?></td>
            <td class='text-right'><?php if ($md->member_pledge-$md->member_cash>0){ echo $english_format_number = number_format($md->member_pledge-$md->member_cash, 0, '.', ','); } else echo 0; ?></td>
        </tr>
        <?php $i++;  $sum_pledge += $md->member_pledge; $sum_cash += $md->member_cash;  if($md->member_pledge-$md->member_cash>0){ $sum_bal+=($md->member_pledge-$md->member_cash); } } ?>

    <tr>
        <td class='text-center'></td>
        <td class='text-center'></td>
        <td  class='text-left'>Total Amounts</td>
        <td  class='text-right'><?php echo $english_format_number = number_format($sum_pledge, 0, '.', ','); ?></td>
        <td  class='text-right'><?php echo $english_format_number = number_format($sum_cash, 0, '.', ','); ?></td>
        <td  class='text-right'><?php echo $english_format_number = number_format($sum_bal, 0, '.', ','); ?></td>
    </tr>
    <!-- Products Details Details -->
</table>
<!--        </td>-->
<!--    </tr>-->

</table>

<?php } else { ?>
    <h2 class="text-center">No members found</h2>

<?php } ?>

</body>
</html>
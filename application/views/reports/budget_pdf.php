<?php
/**
 * Created by PhpStorm.
 * User: d.felix
 * Date: 10/04/2017
 * Time: 23:07
 */

echo $pdf_h;
?>


<div class="content-top">
    <div class="col-md-12">
        <div class="blank-page">
            <h3 class="head-top"><?php echo $report_name; ?></h3><hr>

            <?php if (isset($budget_details['error']) && $budget_details['error'] == "0") { ?>
                No budget items found create new item or upload your budget file.
            <?php } else { ?>
                <div class="tables">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Item Name</th>
                            <th>Cost</th>
                            <th>Paid</th>
                            <th>Balance</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i=1;
                        foreach ($budget_details as $bd) { ?>
                            <tr>
                                <th scope="row"><?php echo $i; ?></th>
                                <td><?php echo $bd->item_name ?></td>
                                <td><?php echo $english_format_number = number_format($bd->item_cost, 0, '.', ','); ?></td>
                                <td><?php echo $english_format_number = number_format($bd->item_paid, 0, '.', ','); ?></td>
                                <td><?php echo $english_format_number = number_format($bd->item_cost-$bd->item_paid, 0, '.', ','); ?></td>
                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                    </table>
                </div>
            <?php } ?>


        </div>

    </div>


</div>

</div>

</body>
</html>

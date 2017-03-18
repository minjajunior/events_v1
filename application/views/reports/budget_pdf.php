<?php
/**
 * Created by PhpStorm.
 * User: d.felix
 * Date: 14/03/2017
 * Time: 22:57
 */


$this->load->view('shared/pdf_header');

if(isset($this->session->admin_id)){ ?>
<div class="blank-page">
    <h4>Budget</h4>
    <hr>
    <?php if (isset($budget_details['error']) && $budget_details['error'] == "0") { ?>
        No budget items found create new item or upload your budget file.
    <?php } else { ?>
        <div class="tables">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Cost</th>
                    <th>Paid</th>
                    <th>Balance</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($budget_details as $bd) { ?>
                    <tr>
                        <?php if (isset($this->session->admin_id)) { ?>
                            <td><a href="javascript:void(0)" class="edit_budget" rel="<?php echo $bd->item_id; ?>"
                                   id="editBudget_view"><?php echo $bd->item_name ?></a></td>
                        <?php } else { ?>
                            <td><?php echo $bd->item_name ?></td>
                        <?php } ?>
                        <td><?php echo $english_format_number = number_format($bd->item_cost, 0, '.', ',') . " Tsh."; ?></td>
                        <td><?php echo $english_format_number = number_format($bd->item_paid, 0, '.', ',') . " Tsh."; ?></td>
                        <td><?php echo $english_format_number = number_format($bd->item_cost-$bd->item_paid, 0, '.', ',') . " Tsh."; ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    <?php }

}  $this->load->view('shared/pdf_footer');

?>

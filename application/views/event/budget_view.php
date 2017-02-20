<?php
/**
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 2/20/2017
 * Time: 4:09 PM
 */?>

<div class="blank">
    <?php if(isset($this->session->admin_id)){ ?>
                <div class="blank-page">
                    <h4>
                        Budget Details
                        <a href="<?php echo site_url('event/new_item/'.$event_id)?>" class="pull-right">New Item</a>
                    </h4>
                    <hr>
                    <?php if (isset($budget_details['error']) && $budget_details['error'] == "0") {?>
                        No budget items found create new item or upload your budget file.
                    <?php } else { ?>
                        <div class="tables">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Item Name</th>
                                    <th>Cost</th>
                                    <th>Paid</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($budget_details as $bd){ ?>
                                    <tr>
                                        <?php if(isset($this->session->admin_id)){ ?>
                                            <td><a href="<?php echo site_url('event/edit_budget/'.$bd->item_id) ?>"><?php echo $bd->item_name?></a></td>
                                        <?php } else { ?>
                                            <td><?php echo $bd->item_name?></td>
                                        <?php } ?>
                                        <td><?php echo $english_format_number = number_format($bd->item_cost, 0, '.', ',')." Tsh.";?></td>
                                        <td><?php echo $english_format_number = number_format($bd->item_paid, 0, '.', ',')." Tsh."; ?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } ?>
                </div>
                <div class="clearfix"> </div>
                <br>
                <div class="blank-page">
                    <a class="btn btn-danger" href="<?php echo site_url('event/template/budget')?>" >Download Budget Template</a>
                    <?php echo form_open_multipart('event/upload_budget/'.$event_id); ?>
                    <div class="form-group">
                        <input type="file" name="budget">
                        <p class="help-block">Upload .xls or .xlsx file</p>
                    </div>
                    <button type="submit" name="submit" class="btn btn-danger">Upload</button>
                    </form>
                </div>
            <?php } ?>
</div>

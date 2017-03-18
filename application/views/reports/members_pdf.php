

<?php
/**
 * Created by PhpStorm.
 * User: d.felix
 * Date: 12/03/2017
 * Time: 14:34
 */



$this->load->view('shared/pdf_header');

if(isset($this->session->admin_id)) {
    ?>
<div class="blank-page">
    <h4>Members</h4>
    <hr>
    <?php if (isset($member_details['error']) && $member_details['error'] == "0") { ?>
        No members found. Create <a href="#" data-toggle="modal" data-target="#newMember">new
            member</a> or upload your members file.
    <?php } else { ?>
        <div class="tables">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Member Name</th>
                    <th>Pledge</th>
                    <th>Cash</th>
                    <th>Balance</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($member_details as $md) { ?>
                    <tr>
                        <?php if (isset($this->session->admin_id)) { ?>
                            <td><a href="javascript:void(0)" class="edit_member" rel="<?php echo $md->member_id; ?>"
                                   id="editMember_view"><?php echo $md->member_name ?></a></td>
                        <?php } else { ?>
                            <td><?php echo $md->member_name ?></td>
                        <?php } ?>
                        <td><?php echo $english_format_number = number_format($md->member_pledge, 0, '.', ',') . " Tsh."; ?></td>
                        <td><?php echo $english_format_number = number_format($md->member_cash, 0, '.', ',') . " Tsh."; ?></td>
                        <td><?php echo $english_format_number = number_format($md->member_pledge-$md->member_cash, 0, '.', ',') . " Tsh."; ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    <?php }

    }

    $this->load->view('shared/pdf_footer');

    ?>

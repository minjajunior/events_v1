

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

    <div class="" data-example-id="">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Member Name</th>
                <th>Pledge</th>
                <th>Cash</th>
                <th>Balance</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $i=1;
            foreach ($member_details as $md) { ?>
            <tr>
                <th scope="row"><?php echo $i; ?></th>
                <td><?php echo $md->member_name ?></td>
                <td><?php echo $english_format_number = number_format($md->member_pledge, 0, '.', ','); ?></td>
                <td><?php echo $english_format_number = number_format($md->member_cash, 0, '.', ','); ?></td>
                <td><?php echo $english_format_number = number_format($md->member_pledge-$md->member_cash, 0, '.', ','); ?></td>
            </tr>
            <?php $i++; } ?>

            </tbody>
        </table>
    </div>

    <?php }

    }

    $this->load->view('shared/pdf_footer');

    ?>

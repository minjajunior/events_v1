<?php
/**
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 5/26/2017
 * Time: 3:13 PM
 */
$this->load->view('shared/login_header');
?>
<div class="col-md-10 col-md-offset-1">
        <!--banner-->
        <div class="banner">
            <h2>
                <a href="<?php echo base_url() ?>">Home</a>
                <i class="fa fa-angle-right"></i>
                <span>Help</span>
            </h2>
        </div>
        <!--//banner-->
        <!--faq-->
        <div class="asked">


            <div class="questions">
                <h5>Support Contacts</h5>
                <p><b>Tel :</b> +255 712 431242<br/>
                <b>Tel :</b> +255 752 934547<br/>
                <b>Email :</b> support@demi.co.tz<br/>
                <b>Web :</b> www.demi.co.tz</p>
            </div>
        </div>
</div>
<div class="clearfix"></div>

<?php $this->load->view('shared/login_footer') ?>

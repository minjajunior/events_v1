<?php
/**
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 5/26/2017
 * Time: 3:50 PM
 */
$this->load->view('shared/login_header');
?>

<div class="col-md-10 col-md-offset-1">
    <!--banner-->
    <div class="banner">
        <h2>
            <a href="<?php echo site_url()?>">Home</a>
            <i class="fa fa-angle-right"></i>
            <span>Privacy policy</span>
        </h2>
    </div>
    <!--//banner-->
    <!--faq-->
    <div class="asked">

        <div class="questions">
            <h5>1.What personal information do we collect from the people that visit our website or app?</h5>
            <p>When registering on our site, as appropriate, you may be asked to enter your name, email address, phone number or other details to help you with your experience.</p>
        </div>
        <div class="questions">
            <h5>2.When do we collect information?</h5>
            <p>We collect information from you when you register on our site, fill out a form or enter information on our site or provide us with feedback on our services </p>
        </div>
        <div class="questions">
            <h5>3.How do we use your information?</h5>
            <p>We may use the information we collect from you when you register, sign up for our newsletter, respond to a survey or marketing communication, surf the website, or use certain other site features in the following ways:<br/>
            To personalize your experience and to allow us to deliver the type of content in which you are most interested.<br/>
                To improve our website in order to better serve you.<br/>
                To quickly process your transactions.</p>

        </div>
        <div class="questions">
            <h5>4.How do we protect your information?</h5>
            <p>
                We do not use Malware Scanning.<br/>

                Your personal information is contained behind secured networks and is only accessible by a limited number of persons who have special access rights to such systems, and are required to keep the information confidential. In addition, all sensitive/credit information you supply is encrypted via Secure Socket Layer (SSL) technology.<br/>

                We implement a variety of security measures when a user enters, submits, or accesses their information to maintain the safety of your personal information.<br/>

                All transactions are processed through a gateway provider and are not stored or processed on our servers.</p>
        </div>
        <div class="questions">
            <h5>5.Do we use 'cookies'?</h5>
            <p>
                Yes. Cookies are small files that a site or its service provider transfers to your computer's hard drive through your Web browser (if you allow) that enables the site's or service provider's systems to recognize your browser and capture and remember certain information.
                <br/>We use cookies to help us understand your preferences based on previous or current site activity, which enables us to provide you with improved services.
                <br/>We also use cookies to help us compile aggregate data about site traffic and site interaction so that we can offer better site experiences and tools in the future.
                <br/>
                You can choose to have your computer warn you each time a cookie is being sent, or you can choose to turn off all cookies. You do this through your browser settings. Since browser is a little different, look at your browser's Help Menu to learn the correct way to modify your cookies.
            </p>
        </div>
        <div class="questions">
            <h5>6.If users disable cookies in their browser:</h5>
            <p>If you turn cookies off, Some of the features that make your site experience more efficient may not function properly.Some of the features that make your site experience more efficient and may not function properly.
            </p>
        </div>
        <div class="questions">
            <h5>7.Third-party disclosure</h5>
            <p>
                We do not sell, trade, or otherwise transfer to outside parties your Personally Identifiable Information.
            </p>
        </div>

        <div class="questions">
            <h5>8.Third-party links</h5>
            <p>We do not include or offer third-party products or services on our website.</p>
        </div>

    </div>
</div>
<div class="clearfix"></div>

<?php $this->load->view('shared/login_footer') ?>

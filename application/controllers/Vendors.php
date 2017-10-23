<?php
/**
 * Created by PhpStorm.
 * User: d.felix
 * Date: 20/08/2017
 * Time: 11:56
 */

class Vendors extends CI_Controller {


    public function vendor(){

        $this->load->view('vendor/find_vendor');

    }

    public function home(){

        $this->load->view('vendor/home_vendor');

    }


    public function login_vendor(){

        if(isset($this->session->vendor_id)){
            redirect('vendors/home');
        } else {
            $this->form_validation->set_rules('mailphone', 'Phone or Email', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('vendor/find_vendor');
            } else {
                if(!is_null($this->login_model->member_login($this->input->post('mailphone')))) {
                    $curl = curl_init();
                    if (!is_null($this->input->post('pin'))){
                        $data = array('msisdn'=>$this->input->post('mailphone') );
                        json_decode(json_encode($data['msisdn']));
                        $value = array('member_phone' => json_decode(json_encode($data['msisdn'])));
                        $this->session->set_userdata($value);
                        $pin = $this->input->post('pin');
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => "http://api.infobip.com/2fa/1/pin/".$this->input->post('pinId')."/verify",
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => "",
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 30,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => "POST",
                            CURLOPT_POSTFIELDS => "{ \"pin\":\"$pin\" }",
                            CURLOPT_HTTPHEADER => array(
                                "accept: application/json",
                                "authorization: App f5af8ed1007bb7678b6bed837c6cbced-6c9059a6-69bd-43cd-9469-e619c0880406",
                                "content-type: application/json"
                            ),
                        ));
                        $response = curl_exec($curl);
                        $err = curl_error($curl);
                        curl_close($curl);
                        if ($err) {
                            echo "cURL Error #:" . $err;
                        } else {
                            echo $response;
                        }
                    } else {

                        $pn = $this->input->post('mailphone');
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => "http://api.infobip.com/2fa/1/pin?ncNeeded=true",
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => "",
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 30,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => "POST",
                            CURLOPT_POSTFIELDS => "{ \"applicationId\":\"396812BC7ACFA9799689F61DDC936027\", \"messageId\":\"CEFC1BF7C29F4DAB2E21C250777925D0\", \"from\":\"Demi Corp\", \"to\":\"$pn\" }",
                            CURLOPT_HTTPHEADER => array(
                                "accept: application/json",
                                "authorization: App f5af8ed1007bb7678b6bed837c6cbced-6c9059a6-69bd-43cd-9469-e619c0880406",
                                "content-type: application/json"
                            ),
                        ));
                        $response = curl_exec($curl);
                        $err = curl_error($curl);
                        curl_close($curl);
                        if ($err) {
                            echo "cURL Error #:" . $err;
                        } else {
                            echo $response;
                        }
                    }
                }elseif(!is_null($this->vendors_model->vendor_login($this->input->post('mailphone')))) {
                    $value = $this->vendors_model->vendor_login($this->input->post('mailphone'));
                    if(!is_null($this->input->post('password'))) {
                        if($value['vendor_password'] == md5($this->input->post('password'))){
                            $this->session->set_userdata($value);
                            $data = array('verified' => true, 'user' => 'vendor');
                            echo json_encode($data);
                        }else{
                            $data = array('loginStatus' => 'password');
                            echo json_encode($data);
                        }
                    }elseif($value['reg_status'] == 1) {
                        $data = array('loginStatus' => 'vendor', 'email' => $this->input->post('mailphone'));
                        echo json_encode($data);
                    } else{
                        $data = array('loginStatus' => 'reg_status');
                        echo json_encode($data);
                    }
                } else {
                    $data = array('loginStatus' => false);
                    echo json_encode($data);
                }
            }
        }



}

    public function register() {

        $this->form_validation->set_message('required', 'This field required');
        $this->form_validation->set_rules('fullname', 'Full Name', 'required');
        $this->form_validation->set_rules('email', 'E-mail Address', 'required|valid_email|is_unique[vendors.vendor_email]');
        $this->form_validation->set_message('valid_email', 'Email address you have entered is not a valid email address.');
        $this->form_validation->set_message('is_unique', '{field} you have entered is already registered in an account with us.');
        $this->form_validation->set_rules('phone', 'Phone Number', 'required|is_unique[vendors.vendor_phone]|exact_length[12]|numeric');
        $this->form_validation->set_message('exact_length', 'The phone number must be in a 255XXXXXXXXX format.');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        $this->form_validation->set_message('min_length', '{field} must be at least {param} characters long.');
        $this->form_validation->set_rules('password2', 'Repeat Password', 'required|matches[password]');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        if (empty($this->session->provider_id)){
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('vendor/register_v_view');
            } else {

                //generate a token
                $token = md5(microtime (TRUE)*100000);
                //hash token to be stored on db

                $token_to_db = hash('sha256',$token);

                $values = array(
                    'vendor_name' => $this->input->post('fullname'),
                    'vendor_email' => $this->input->post('email'),
                    'vendor_phone' => $this->input->post('phone'),
                    'vendor_password' => md5($this->input->post('password')),
                    'hashed_token'=>$token_to_db,
                    'reg_status'=>0
                );

                $provider_id = $this->vendors_model->register($values);

                if(isset($provider_id) && is_numeric($provider_id)){

                    $token_to_email = base64_encode($token);
                    $provider_id = base64_encode($provider_id);
                    $site_url = site_url();
                    $email_url = $site_url . 'vendors/vendor_confirm/' . $provider_id . '/' . $token_to_email;

                    $from = "noreply@demi.co.tz";
                    $to = $this->input->post('email');
                    $subject = "Account Confirmation";
                    $message = " 
                        <html>
                        <head>
                        <title>Account Confirmation</title>
                        </head>
                        <body>
                                <h4>Hello ".$this->input->post('fullname').",</h4>    
                                <p>You just signed up for Demi Events. Please follow this link to confirm that this is your e-mail address.</p>
                                <a href='$email_url'>
                                    Click here to confirm your registration</a>                                
                                <p>Sincerely,</p>
                                <p>Admin,</p>
                                <p><b>Demi Corporation.</b><br/>
                                <b>Tel :</b> +255 712 431242<br/>
                                <b>Tel :</b> +255 752 934547<br/>
                                <b>Email :</b> info@demi.co.tz<br/>
                                <b>Website :</b> www.demi.co.tz</p>
                        </body></html>";

                    $this->email->from($from, 'Demi Corporation');
                    $this->email->to($to);

                    $this->email->subject($subject);
                    $this->email->message($message);


                    if($this->email->send()){

                        $data['email_status']= '<div class="alert alert-danger">Registration successfully, Email Sent</div>';
                        $this->load->view('vendor/register_v_view', $data);
                        //on success sending email

                    }else {
                        show_error($this->email->print_debugger());
                        //on failure sending email

                    }//end inner else

                }else{
                    $data['reg_status']= '<div class="alert alert-danger">Something went wrong! Please complete your registration again</div>';
                    $this->load->view('vendor/register_v_view', $data);
                }

                redirect(base_url());
            }
        } else {
            redirect('admin');
        }
    }


    public function vendor_confirm($vendor_id,$token){

        $vendor_id_decoded = base64_decode($vendor_id);
        $token_decoded = base64_decode($token);

        //hash token to be matched with db
        $token_to_email = hash('sha256', $token_decoded);

        $result = $this->vendors_model->vendor_info($vendor_id_decoded);

        //$token_expire = $result[0]['token_expire'];
        $token_to_db = $result[0]['hashed_token'];
        $reg_status =$result[0]['reg_status'];

        if(($token_to_db == $token_to_email)&&($reg_status==0)){

            $values = array('reg_status'=>1);

            $this->vendors_model->update_vendor($vendor_id_decoded,$values);

            $data['reg_status']= '<div class="alert alert-danger">Your registration completed successfully! You can now login </div>';
            $this->load->view('vendor/find_vendor',$data);

        }else if(($token_to_db == $token_to_email)&&($reg_status==1)){

            $data['reg_status']= '<div class="alert alert-danger">Your registration completed successfully! You can now login </div>';
            $this->load->view('vendor/find_vendor',$data);

        }
    }



}
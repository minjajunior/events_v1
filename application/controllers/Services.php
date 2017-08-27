<?php
/**
 * Created by PhpStorm.
 * User: d.felix
 * Date: 20/08/2017
 * Time: 11:56
 */

class Services extends CI_Controller {


    public function register() {

        $this->form_validation->set_message('required', 'This field required');
        $this->form_validation->set_rules('fullname', 'Full Name', 'required');
        $this->form_validation->set_rules('email', 'E-mail Address', 'required|valid_email|is_unique[s_providers.sp_email]');
        $this->form_validation->set_message('valid_email', 'Email address you have entered is not a valid email address.');
        $this->form_validation->set_message('is_unique', '{field} you have entered is already registered in an account with us.');
        $this->form_validation->set_rules('phone', 'Phone Number', 'required|is_unique[s_providers.sp_phone]|exact_length[12]|numeric');
        $this->form_validation->set_message('exact_length', 'The phone number must be in a 255XXXXXXXXX format.');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        $this->form_validation->set_message('min_length', '{field} must be at least {param} characters long.');
        $this->form_validation->set_rules('password2', 'Repeat Password', 'required|matches[password]');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        if (empty($this->session->provider_id)){
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('service/register_p_view');
            } else {

                //generate a token
                $token = md5(microtime (TRUE)*100000);
                //hash token to be stored on db

                $token_to_db = hash('sha256',$token);

                $values = array(
                    'sp_name' => $this->input->post('fullname'),
                    'sp_email' => $this->input->post('email'),
                    'sp_phone' => $this->input->post('phone'),
                    'sp_password' => md5($this->input->post('password')),
                    'hashed_token'=>$token_to_db,
                    'reg_status'=>0
                );

                $provider_id = $this->service_model->register($values);

                if(isset($provider_id) && is_numeric($provider_id)){

                    $token_to_email = base64_encode($token);
                    $provider_id = base64_encode($provider_id);
                    $site_url = site_url();
                    $email_url = $site_url . 'services/provider_confirm/' . $provider_id . '/' . $token_to_email;

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
                        $this->load->view('service/register_p_view', $data);
                        //on success sending email

                    }else {
                        show_error($this->email->print_debugger());
                        //on failure sending email

                    }//end inner else

                }else{
                    $data['reg_status']= '<div class="alert alert-danger">Something went wrong! Please complete your registration again</div>';
                    $this->load->view('service/register_p_view', $data);
                }

                redirect(base_url());
            }
        } else {
            redirect('admin');
        }
    }


    public function provider_confirm($provider_id,$token){

        $provider_id_decoded = base64_decode($provider_id);
        $token_decoded = base64_decode($token);

        //hash token to be matched with db
        $token_to_email = hash('sha256', $token_decoded);

        $result = $this->service_model->provider_info($provider_id_decoded);

        //$token_expire = $result[0]['token_expire'];
        $token_to_db = $result[0]['hashed_token'];
        $reg_status =$result[0]['reg_status'];

        if(($token_to_db == $token_to_email)&&($reg_status==0)){

            $values = array('reg_status'=>1);

            $this->service_model->update_provider($provider_id_decoded,$values);

            $data['reg_status']= '<div class="alert alert-danger">Your registration completed successfully! You can now login </div>';
            $this->load->view('login/login_view',$data);

        }else if(($token_to_db == $token_to_email)&&($reg_status==1)){

            $data['reg_status']= '<div class="alert alert-danger">Your registration completed successfully! You can now login </div>';
            $this->load->view('login/login_view',$data);

        }
    }



}
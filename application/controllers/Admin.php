<?php

/*
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 11/21/2016
 * Time: 10:25 AM
 *
 * This Controller controls all the function about Admin
 */
class Admin extends CI_Controller {

    /*
     * This function load Admin home page after login process complete
     */
    public function index() {
        $data['location'] = $this->event_model->get_location();
        $data['event_type'] = $this->event_model->get_type();
        $data['event'] = $this->event_model->get_event($this->session->admin_id);

        if (!empty($this->session->admin_id)){
            $this->load->view('admin/home_view', $data);
        } else {
            redirect(base_url());
        }
    }

    /*
     * This function load Admin Registration page and process registration validation.
     */
    public function register() {

        $this->form_validation->set_message('required', 'This field required');
        $this->form_validation->set_rules('fullname', 'Full Name', 'required');
        $this->form_validation->set_rules('email', 'E-mail Address', 'required|valid_email|is_unique[admin.admin_email]');
        $this->form_validation->set_message('valid_email', 'Email address you have entered is not a valid email address.');
        $this->form_validation->set_message('is_unique', '{field} you have entered is already registered in an account with us.');
        $this->form_validation->set_rules('phone', 'Phone Number', 'required|is_unique[admin.admin_phone]|exact_length[12]|numeric');
        $this->form_validation->set_message('exact_length', 'The phone number must be in a 255XXXXXXXXX format.');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        $this->form_validation->set_message('min_length', '{field} must be at least {param} characters long.');
        $this->form_validation->set_rules('password2', 'Repeat Password', 'required|matches[password]');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        if (empty($this->session->admin_id)){
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('admin/register_view');
            } else {

                //generate a token
                $token = md5(microtime (TRUE)*100000);
                //hash token to be stored on db

                $token_to_db = hash('sha256',$token);

                $values = array(
                    'admin_name' => $this->input->post('fullname'),
                    'admin_email' => $this->input->post('email'),
                    'admin_phone' => $this->input->post('phone'),
                    'admin_password' => md5($this->input->post('password')),
                    'hashed_token'=>$token_to_db,
                    'reg_status'=>0
                );

                $admin_id = $this->admin_model->register($values);

                if(isset($admin_id) && is_numeric($admin_id)){

                    $token_to_email = base64_encode($token);
                    $admin_id = base64_encode($admin_id);
                    $site_url = site_url();
                    $email_url = $site_url . 'admin/admin_confirm/' . $admin_id . '/' . $token_to_email;

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
                        $this->load->view('admin/register_view', $data);
                        //on success sending email

                    }else {
                        show_error($this->email->print_debugger());
                        //on failure sending email

                    }//end inner else

                }else{
                    $data['reg_status']= '<div class="alert alert-danger">Something went wrong! Please complete your registration again</div>';
                    $this->load->view('admin/register_view', $data);
                }

                redirect(base_url());
            }
        } else {
            redirect('admin');
        }
    }

    public function admin_confirm($admin_id,$token){

        $admin_id_decoded = base64_decode($admin_id);
        $token_decoded = base64_decode($token);

        //hash token to be matched with db
        $token_to_email = hash('sha256', $token_decoded);

        $result = $this->admin_model->admin_info($admin_id_decoded);

        //$token_expire = $result[0]['token_expire'];
        $token_to_db = $result[0]['hashed_token'];
        $reg_status =$result[0]['reg_status'];

        if(($token_to_db == $token_to_email)&&($reg_status==0)){

                $values = array('reg_status'=>1);

                $this->admin_model->update_admin($admin_id_decoded,$values);

                $data['reg_status']= '<div class="alert alert-danger">Your registration completed successfully! You can now login </div>';
                $this->load->view('login/login_view',$data);

        }else if(($token_to_db == $token_to_email)&&($reg_status==1)){

            $data['reg_status']= '<div class="alert alert-danger">Your registration completed successfully! You can now login </div>';
            $this->load->view('login/login_view',$data);

        }
    }

    /*
     * This function load the details of the admin selected by id
     */
    public function profile($id) {
        $id = base64_decode($id);
        $data['admin_details'] = $this->admin_model->admin_details($id);
        $data['event_sum'] = $this->admin_model->event_sum($id);
        $data['admin_id'] = $id;

        if (!empty($this->session->admin_id)){
            $this->load->view('admin/profile_view', $data);
        } else {
            redirect(base_url());
        }
    }

    /*
     * This function check and add admin to the event
     */
    public function add_admin($id){

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            echo 0;
        } elseif(!is_null($this->input->post('action'))) {
            $value = $this->login_model->admin_login($this->input->post('email'));
            if($this->input->post('action') == "add"){
                if($value['admin_email'] == $this->input->post('email')){
                    $values = array(
                        'admin_id' => $value['admin_id'],
                        'event_id' => $id,
                    );
                    $this->admin_model->add_admin($values);
                    echo 3;
                }
            }
            elseif ($this->input->post('action') == "invite"){

                $email = $this->input->post('email');

                //generate a token
                $token = md5(microtime (TRUE)*100000);
                //hash token to be stored on db

                $token_to_db = hash('sha256',$token);
                //expire time to be stored on db
                $expire_time = date("Y-m-d H:i:s",time()+604800);
                //array for updating database
                $data = array(
                    'reg_status' => 0,
                    'admin_email'=>$email,
                    'hashed_token' => $token_to_db
                );


                $result = $this->admin_model->invite_admin($data,$id);

                if(isset($result) && is_numeric($result)){
                    //user id and token to be sent to email

                    $token_to_email= base64_encode($token);
                    $admin_id =  base64_encode($result);
                    $site_url = site_url();
                    $email_url = $site_url. 'admin/admin_invite/'.$admin_id.'/'.$token_to_email;

                    $from = "noreply@demi.co.tz";
                    $to = $this->input->post('email');
                    $subject = "Admin Invitation";
                    $message = " 
                        <html>
                        <head>
                        <title>Admin Invitation</title>
                        </head>
                        <body>
                                <h4>Hello Sir/Madam,</h4>    
                                <p>Please visit the following link to accept and complete your invitation</p>
                                <a href='$email_url'>Click here to accept and complete your invitation</a>
                                <p>Sincerely,</p>
                                <p>Admin.</p>
                                <p><b>Demi Corporation.</b><br/>
                                <b>Tel :</b> +255 712 431242<br/>
                                <b>Tel :</b> +255 752 934547<br/>
                                <b>Email :</b> info@demi.co.tz<br/>
                                <b>Website :</b> www.demi.co.tz</p>
                        </body></html>";
                    //sending email

                    $this->email->from($from, 'Demi Corporation');
                    $this->email->to($to);

                    $this->email->subject($subject);
                    $this->email->message($message);



                   // $email_result =
                    if($this->email->send()){
                        //on success sending email
                        echo 4;
                    }else {
                        show_error($this->email->print_debugger());
                        //on failure sending email
                        //echo 6;
                    }//end inner else
                }else{
                    //on failure to store
                    echo 7;


                }//end else if $result

            }
        }
        else {
            $value = $this->login_model->admin_login($this->input->post('email'));
            if(empty($value)){
                echo 1;
            }else {
                if($this->admin_model->check_admin($id, $value['admin_id']) > 0 ){
                    echo 5;
                } else {
                    echo 2;
                }
            }
        }
    }

    public function admin_invite($admin_id,$token){

        $admin_id_decoded = base64_decode($admin_id);
        $token_decoded = base64_decode($token);

        //hash token to be matched with db
        $token_to_email = hash('sha256', $token_decoded);


        $result = $this->admin_model->admin_info($admin_id_decoded);


        //$token_expire = $result[0]['token_expire'];
        $token_to_db = $result[0]['hashed_token'];
        $reg_status =$result[0]['reg_status'];

        if(($token_to_db == $token_to_email)&&($reg_status==0)){

            $this->form_validation->set_message('required', 'This field required');
            $this->form_validation->set_rules('fullname', 'Full Name', 'required');
            $this->form_validation->set_message('is_unique', '{field} you have entered is already registered in an account with us.');
            $this->form_validation->set_rules('phone', 'Phone Number', 'required|is_unique[admin.admin_phone]|exact_length[12]|numeric');
            $this->form_validation->set_message('exact_length', 'The phone number must be in a 255XXXXXXXXX format.');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
            $this->form_validation->set_message('min_length', '{field} must be at least {param} characters long.');
            $this->form_validation->set_rules('password2', 'Re-Enter Password', 'required|matches[password]');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

            if ($this->form_validation->run() == FALSE) {

                $data['admin_id']= $admin_id;
                $data['token'] = $token;

                $this->load->view('admin/invite_view',$data);
            } else {
                $values = array(
                    'admin_name' => $this->input->post('fullname'),
                    'admin_phone' => $this->input->post('phone'),
                    'reg_status'=>1,
                    'admin_password' => md5($this->input->post('password'))
                );

                $this->admin_model->update_admin($admin_id_decoded,$values);

                $data['reg_status']= '<div class="alert alert-danger">Your registration completed successfully! You can now login </div>';
                $this->load->view('login/login_view',$data);
            }


        }else if(($token_to_db == $token_to_email)&&($reg_status==1)){

            $data['reg_status']= '<div class="alert alert-danger">Your registration completed successfully! You can now login </div>';
            $this->load->view('login/login_view',$data);

        }

    }

    public function estimator(){
        $data['admin_details'] = $this->admin_model->admin_details($this->session->admin_id);
        $data['location'] = $this->event_model->get_location();

        if (!empty($this->session->admin_id)){
            $this->load->view('admin/cost_estimate_view', $data);
        } else {
            redirect(base_url());
        }
    }


    public function settings(){
        $data['admin_details'] = $this->admin_model->admin_details($this->session->admin_id);

        if (!empty($this->session->admin_id)){
            $this->load->view('admin/settings_view', $data);
        } else {
            redirect(base_url());
        }
    }



    public function edit_details(){
        $this->form_validation->set_rules('fullname', 'Full Name', 'required');
        /*if ($this->input->post('ae') != $this->input->post('email')) {
            $this->form_validation->set_rules('email', 'E-mail Address', 'required|valid_email|is_unique[admin.admin_email]');
        }
        $this->form_validation->set_message('valid_email', 'Email address you have entered is not a valid email address.');*/
        $this->form_validation->set_message('is_unique', '{field} you have entered is already registered in an account with us.');
        if ($this->input->post('ap') != $this->input->post('phone')) {
            $this->form_validation->set_rules('phone', 'Phone Number', 'required|is_unique[admin.admin_phone]|exact_length[12]|numeric');
        }
        $this->form_validation->set_message('exact_length', 'The phone number must be in a 255XXXXXXXXX format.');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

        if ($this->form_validation->run() == FALSE) {
            foreach ($_POST as $key => $value) {
                $data['messages'][$key] = form_error($key);
            }
        } else {
            $data['success'] = true;

            $values = array(
                'admin_name' => $this->input->post('fullname'),
                'admin_phone' => $this->input->post('phone')
            );

            $this->admin_model->update_admin($this->session->admin_id, $values);
            $this->session->set_userdata('admin_name', $this->input->post('fullname'));
        }
        echo json_encode($data);
    }

    public function change_password(){

        $this->form_validation->set_rules('newpassword', 'New Password', 'required|min_length[8]');
        $this->form_validation->set_message('min_length', '{field} must be at least {param} characters long.');
        $this->form_validation->set_rules('repassword', 'Retype Password', 'required|matches[newpassword]');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

        if ($this->form_validation->run() == FALSE) {

            foreach ($_POST as $key => $value) {
                $data['messages'][$key] = form_error($key);
            }
        } else {
            $values = array(
                'admin_password' => md5($this->input->post('newpassword'))
            );

            $this->admin_model->update_admin($this->session->admin_id, $values);

            $from = "noreply@demi.co.tz";
            $to = $this->session->admin_email;
            $subject = "Password Changed";
            $message = " 
                        <html>
                        <head>
                        <title>Password Changed</title>
                        </head>
                        <body>
                                <h4>Hello ".$this->session->admin_name.",</h4>    
                                <p>Your password has changed successfully</p>                              
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
            $this->email->send();

            $data['success'] = true;
        }
        echo json_encode($data);
    }
}
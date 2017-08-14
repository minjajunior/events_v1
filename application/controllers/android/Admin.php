<?php

/**
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 7/7/2017
 * Time: 9:48 AM
 */
class Admin extends CI_Controller {

    public function register(){

        if(!is_null($this->admin_model->admin_email($this->input->post('email')))) {
            echo json_encode(array("status" => "email"));
        } else if(!is_null($this->admin_model->admin_phone($this->input->post('phone')))){
            echo json_encode(array("status" => "phone"));
        } else  {

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
            echo json_encode(array("status" => "success"));

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
                    echo json_encode(array("status" => "email_sent"));
                }else {
                    show_error($this->email->print_debugger());

                }//end inner else

            }else{
                //$data['reg_status']= '<div class="alert alert-danger">Something went wrong! Please complete your registration again</div>';
            }
        }
    }

    public function get_event($admin_id){
        echo json_encode($this->event_model->get_event($admin_id));
    }
}
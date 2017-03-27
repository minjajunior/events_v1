<?php

/**
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 11/21/2016
 * Time: 10:25 AM
 *
 * This Controller controls all the function about Admin
 */
class Admin extends CI_Controller {

    /**
     * This function load Admin login page and process validation of Admin.
     */
    public function index(){
        $data['location'] = $this->event_model->get_location();
        $data['event_type'] = $this->event_model->get_type();
        $data['event'] = $this->event_model->get_event($this->session->admin_id);

        if (!empty($this->session->admin_id)){
            $this->load->view('admin/home_view', $data);
        } else {
            redirect('login');
        }
    }

    /**
     *This function load Admin Registration page and process registration validation.
     */
    public function register(){

        $this->form_validation->set_rules('fullname', 'Full Name', 'required');
        $this->form_validation->set_message('fullname', 'Error Message');
        $this->form_validation->set_rules('email', 'E-mail Address', 'required|valid_email|is_unique[admin.admin_email]');
        $this->form_validation->set_rules('phone', 'Phone Number', 'required|is_unique[admin.admin_phone]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('password2', 'Re-Enter Password', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/register_view');
        } else {
            $values = array(
                'admin_name' => $this->input->post('fullname'),
                'admin_email' => $this->input->post('email'),
                'admin_phone' => $this->input->post('phone'),
                'admin_password' => md5($this->input->post('password'))
            );

            $this->admin_model->register($values);

            redirect('admin');
        }
    }

    /*
     * This function load Admin home page after login process complete
     */
    public function home(){

    }

    public function profile($id){
        $data['admin_details'] = $this->admin_model->admin_details($id);
        $data['event_sum'] = $this->admin_model->event_sum($id);

        if (!empty($this->session->admin_id)){
            $this->load->view('admin/profile_view', $data);
        } else {
            redirect('admin');
        }
    }

    /*
    *This function check and add admin to the event
    */
    public function add_admin($id){

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            echo 0;
        } elseif(!empty($this->input->post('action'))) {
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
            }elseif ($this->input->post('action') == "invite"){



                $email = $this->input->post('email');

                //generate a token
                $token = md5(microtime (TRUE)*100000);
                //hash token to be stored on db

                $token_to_db = hash('sha256',$token);
                //expire time to be stored on db
                $expire_time = date("Y-m-d H:i:s",time()+3600);
                //array for updating database
                $data = array(
                    'token_expire' => $expire_time,
                    'admin_email'=>$email,
                    'hashed_token' => $token_to_db
                );


                $result = $this->admin_model->invite_admin($data,$id);



                if($result){
                    //user id and token to be sent to email

                    $token_to_email= $token;
                    $site_url = site_url();

                    $from = "admin@demicorp.co.tz";
                    $to = $email;
                    $subject = "Demi Events - Admin Invitation";
                    $message = " 
                        <html>
                        <head>
                        <title>Dermi Corp | Admin Invitation</title>
                        </head>
                        <body>
                                <h4>Hello Sir/Madam,</h4>    
                                <p>Please visit the following link to accept and complete your invitation</p>
                                <a href='$site_url/access/password/change_password/$user_type/$user_id/$token_to_email'>
                                    Click here to change your password</a>
                                <p>The invitaion link will expire in 1hour.</p>
                                <p>Sincerely,</p>
                                <p>Dermi Corp Admin.</p>
                        </body></html>";
                    //sending email

                    echo 4;

                    $email_result =  send($from,$to,$subject,$message);
//                    if($email_result){
//                        //on success sending email
//                        echo 4;
//                    }else {
//                        //on failure sending email
//                        echo 6;
//                    }//end inner else
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
                if($this->admin_model->check_admin($id, $value['admin_id']) > 0 or $value['admin_id'] == $this->admin_model->admin_id($id)){
                    echo 5;
                } else {
                    echo 2;
                }
            }
        }
    }

}
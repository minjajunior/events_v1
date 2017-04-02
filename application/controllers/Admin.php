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

                    $token_to_email= $token;
                    $admin_id =  base64_encode($id);
                    $site_url = site_url();
                    $email_url = $site_url. 'admin/admin_invite/'.$admin_id.'/'.$token_to_email;

                    $from = "demicorp@localhost";
                    //$to = $email;
                    $to = "demi@localhost";
                    $subject = "Demi Events - Admin Invitation";
                    $message = " 
                        <html>
                        <head>
                        <title>Dermi Corp | Admin Invitation</title>
                        </head>
                        <body>
                                <h4>Hello Sir/Madam,</h4>    
                                <p>Please visit the following link to accept and complete your invitation</p>
                                <a href='$email_url'>
                                    Click here to accept and complete your invitation</a>
                                <p>The invitation link will expire in 7 Days.</p>
                                <p>Sincerely,</p>
                                <p>Dermi Corp Admin.</p>
                        </body></html>";
                    //sending email

                    $this->email->from($from, 'Demi Corp');
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
                if($this->admin_model->check_admin($id, $value['admin_id']) > 0 or $value['admin_id'] == $this->admin_model->admin_id($id)){
                    echo 5;
                } else {
                    echo 2;
                }
            }
        }
    }


    public function admin_invite($admin_id,$token){

        $admin_id = base64_decode($admin_id);
        $token = base64_decode($token);

        //hash token to be matched with db
        $token_to_email = hash('sha256', $token);


        $result = $this->admin_model->admin_info($admin_id);


        //$token_expire = $result[0]['token_expire'];
        $token_to_db = $result[0]['hashed_token'];

        if(($token_to_db == $token_to_email)){

            $this->form_validation->set_rules('fullname', 'Full Name', 'required');
            $this->form_validation->set_message('fullname', 'Error Message');
            $this->form_validation->set_rules('phone', 'Phone Number', 'required|is_unique[admin.admin_phone]');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('password2', 'Re-Enter Password', 'required|matches[password]');

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

                $this->admin_model->update_admin($admin_id,$values);

                redirect('admin');
            }


        }else{


            //else load the forgot password view with the expire time error on it




        }






    }

}
<?php
/**
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 3/18/2017
 * Time: 5:03 PM
 *
 * This Controller controls all the Login functions
 */
class Login extends CI_Controller {

    public function index(){
        if(isset($this->session->admin_id)){
            redirect('admin');
        } elseif (isset($this->session->member_phone)){
            redirect('member');
        } else {
            $this->form_validation->set_rules('mailphone', 'Phone or Email', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('login/login_view');
            } else {
                if(!is_null($this->login_model->member_login($this->input->post('mailphone')))) {
                    $curl = curl_init();
                    if (!is_null($this->input->post('pin'))){
                        $data = array('verified' => true, 'msisdn'=>'255712431242');
                        echo json_encode($data);
                        //json_decode(json_encode($data['msisdn']));
                        $value = array('member_phone' => json_decode(json_encode($data['msisdn'])));
                        $this->session->set_userdata($value);
                        /*$pin = $this->input->post('pin');
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
                        }*/
                    } else {
                        $data = array('smsStatus' => 'MESSAGE_SENT', 'pinId'=>'12345', 'to' =>'255712431242');
                        echo json_encode($data);
                        /*$pn = $this->input->post('phoneno');
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => "http://api.infobip.com/2fa/1/pin?ncNeeded=true",
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => "",
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 30,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => "POST",
                            CURLOPT_POSTFIELDS => "{ \"applicationId\":\"396812BC7ACFA9799689F61DDC936027\", \"messageId\":\"BD22377338ACC68AB805362D11A65A3C\", \"from\":\"InfoSMS\", \"to\":\"$pn\" }",
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
                        }*/
                    }
                }elseif(!is_null($this->login_model->admin_login($this->input->post('mailphone')))) {
                    if(!is_null($this->input->post('password'))) {
                        $value = $this->login_model->admin_login($this->input->post('mailphone'));
                        if(!is_null($value)){
                            if($value['admin_password'] == md5($this->input->post('password'))){
                                $this->session->set_userdata($value);
                                $data = array('verified' => true, 'user' => 'admin');
                                echo json_encode($data);
                            }else{
                                $data = array('loginStatus' => 'password');
                                echo json_encode($data);
                            }
                        }
                    }else {
                        $data = array('loginStatus' => 'admin', 'email' => $this->input->post('mailphone'));
                        echo json_encode($data);
                    }
                } else {
                    $data = array('loginStatus' => false);
                    echo json_encode($data);
                }
            }
        }
    }



    public function password(){

            $email = $_POST['email'];

            $value = $this->login_model->admin_login($email);

            if(!empty($value)){
                //generate a token
                $token = md5(microtime (TRUE)*100000);
                //hash token to be stored on db

                $token_to_db = hash('sha256',$token);
                //expire time to be stored on db
                $expire_time = date("Y-m-d H:i:s",time()+3600);
                //array for updating database
                $values = array(
                    'token_expire' => $expire_time,
                    'hashed_token' => $token_to_db
                );

                    $result = $this->admin_model->update_admin($value['admin_id'],$values);

                    if($result){

                        //user id and token to be sent to email
                        //
                        $name = $value['admin_name'];
                        $admin_id = base64_encode($value['admin_id']);
                        $token_to_email= base64_encode($token);
                        $site_url = site_url();
                        $email_url = $site_url .'login/forgot_password/'.$admin_id. '/'.$token_to_email;

                        $from = "demicorp@localhost";
                        //$to = $email;
                        $to = "demi@localhost";
                        $subject = "Change password";
                        $message = "
                        <html>
                        <head>
                        <title>Dermi Corp | Change password</title>
                        </head>
                        <body>
                                <h4>Hello $name</h4>    
                                <p>Please visit the following link to change your password</p>
                                <a href='$email_url'>
                                    Click here to change your password</a>
                                <p>This verification code will expire in 1hour.</p>
                                <p>Sincerely,</p>
                                <p>Dermi Corp Admin.</p>
                        </body></html>";
                    //sending email
                        $this->email->from($from, 'Demi Corp');
                        $this->email->to($to);

                        $this->email->subject($subject);
                        $this->email->message($message);

                        if($this->email->send()){

                            $data = array('success' => true);

                        }else {

                            $data = array('success' => false, 'messages' => $this->email->print_debugger());

                        }//end inner else

                        }else{
                        //Failure to store token
                            $data = array('success' => false, 'messages' =>'Token' );

                }//end else if $result

            }else{
                //Failure to find the email
                $data = array('success' => false, 'messages' =>'Email' );
            }//end outer else

        echo json_encode($data);

    }//end function forgot

    public function forgot_password($admin_id,$token){

        $admin_id_decoded = base64_decode($admin_id);
        $token_decoded = base64_decode($token);

        //hash token to be matched with db
        $token_to_email = hash('sha256', $token_decoded);

        $result = $this->admin_model->admin_info($admin_id_decoded);

        $token_expire = $result[0]['token_expire'];
        $token_to_db = $result[0]['hashed_token'];

        if((strtotime($token_expire) > time()) && $token_to_db == $token_to_email){

            $data['id']= $admin_id_decoded;
            $this->load->view('admin/change_pass_view', $data);
        }else{
            //else load the forgot password view with the expire time error on it
            $data['pass_expire']= "Code expired";
            $this->load->view('login/login_view',$data);
        }
    }//end function change password

    public function change_password(){

        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('password2', 'Re-Enter Password', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $data['id'] = $this->input->post('di');
            $this->load->view('admin/change_pass_view',$data);
        } else {
            $values = array(
                'admin_password' => md5($this->input->post('password')),
                );

            if(!is_null($this->admin_model->update_admin($this->input->post('di'),$values))){
                $data['pass_change'] = "Pass changed";
                $this->load->view('login/login_view', $data);
            }else{
                $data['id'] = $this->input->post('di');
                $this->load->view('admin/change_pass_view',$data);
            }

        }
    }

    /*
    * This function process logout process
    */
    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url());
    }

}
?>
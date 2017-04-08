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
                if(!empty($this->login_model->member_login($this->input->post('mailphone')))) {
                    $curl = curl_init();

                    if (!empty($this->input->post('pin'))){
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

                }elseif(!empty($this->login_model->admin_login($this->input->post('mailphone')))) {
                    if(!empty($this->input->post('password'))) {

                        $value = $this->login_model->admin_login($this->input->post('mailphone'));
                        if(!empty($value)){
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

    public function forgot_password(){
        $this->form_validation->set_rules("email","Email","required|valid_email");
        $this->form_validation->set_message('required',' is required');
        if($this->form_validation->run() !== FALSE){
            //setting a field to be verified on db
            $data = array(
                'email'=>$_POST['email']
            );
            //verifying email on non student table
            $user_data['data'] =$this->manage_users->get_non_student($data);

            if($user_data['data'] == NULL){
                //verfying email on student table
                $user_data['data'] =$this->manage_users->get_student($data);
            }//end if $user_data['data'] == NULL

            if($user_data['data'] != NULL){
                $email = $user_data['data'][0]['email'];
                $user = ucfirst($user_data['data'][0]['first_name']);
                //generate a token
                $token = md5(microtime (TRUE)*100000);
                //hash token to be stored on db

                $token_to_db = hash('sha256',$token);
                //expire time to be stored on db
                $expire_time = date("Y-m-d H:i:s",time()+3600);
                //array for updating database
                $data = array(
                    'token_expire' => $expire_time,
                    'hashed_token' => $token_to_db
                );
                if( isset($user_data['data'][0]['role']) && isset($user_data['data'][0]['user_id'])){
                    $user_id = $user_data['data'][0]['user_id'];
                    $result = $this->manage_users->update_non_student($user_id,$data);
                    $user_type = base64_encode('non_student');
                }else{
                    $user_id = $user_data['data'][0]['student_id'];
                    $result = $this->manage_users->update_student($user_id,$data);
                    $user_type = base64_encode('student');
                }
                if($result){
                    //user id and token to be sent to email
                    $user_id = base64_encode($user_id);
                    $token_to_email= $token;
                    $site_url = site_url();

                    $from = "admin@promas.com";
                    $to = $email;
                    $subject = "Change password";
                    $message = " 
                        <html>
                        <head>
                        <title>Dermi Corp | Change password</title>
                        </head>
                        <body>
                                <h4>Hello $user,</h4>    
                                <p>Please visit the following link to change your password</p>
                                <a href='$site_url/access/password/change_password/$user_type/$user_id/$token_to_email'>
                                    Click here to change your password</a>
                                <p>This verification code will expire in 1hour.</p>
                                <p>Sincerely,</p>
                                <p>Dermi Corp Admin.</p>
                        </body></html>";
                    //sending email
                    $email_result =  send($from,$to,$subject,$message);
                    if($email_result){
                        //on success sending email
                        $data['message'] = "<div class='alert alert-success fade in text-center'> A link has been sent, Check your <b>email inbox</b> if not found check your <b>spam folder</b>. A link expires after <b>1 hour<b></b></div>";
                        $this->load->view('access/forgot_password',$data);
                    }else {
                        //on failure sending email
                        $data['message'] = "<div class='alert alert-danger fade in text-center'> Email has not been sent, Please try again.</div>";
                        $this->load->view('access/forgot_password',$data);
                    }//end inner else
                }else{
                    //on failure to store
                    $data['message'] = "<div class='alert alert-warning fade in text-center'>Failed to send link please try again</div>";
                    $this->load->view('access/forgot_password', $data);


                }//end else if $result

            }else{
                $data['message'] = "<div class='alert alert-warning fade in text-center'>Email was not found, Please use registered email</div>";
                $this->load->view('access/forgot_password',$data);
            }//end outer else

        }else{
            $data['message'] = "<div class='alert alert-warning fade in text-center'>Email can not be empty</div>";
            $this->load->view('access/forgot_password',$data);


        }// end else $this->form_validation->run() !== FALSE

    }//end function forgot

    public function change_password($user_type,$user_id,$hashed_token){

        //decoding user id and user type
        $user_type = base64_decode($user_type);
        $user_id = base64_decode($user_id);

        //hash token to be matched with db
        $token_to_email = hash('sha256', $hashed_token);


        if($user_type=='student'){
            $data = array(
                'student_id'=>$user_id,
            );
            $user_data['data'] =$this->manage_users->get_student($data);
        }elseif ($user_type=='non_student') {
            $data = array(
                'non_student_users.user_id'=>$user_id,
            );
            $user_data['data'] =   $this->manage_users->get_non_student($data);
        }//// end else if $user_type=='non_student'
        $token_expire = $user_data['data'][0]['token_expire'];
        $token_to_db = $user_data['data'][0]['hashed_token'];

        if((strtotime($token_expire) > time()) &&($token_to_db == $token_to_email)){
            $data['user_id'] =$user_id;
            $data['user_type']=$user_type;
            $data['message']= "<div class=\"alert alert-info fade in text-center\"> Hello " . ucfirst($user_data['data'][0]['first_name']).", Create your new password</div>";
            $this->load->view('access/change_password', $data);
        }else{
            //else load the forgor password view with the expire time error on it
            $data['message']= "<div class=\"alert alert-warning fade in text-center\">Verification code has expired, Send a new link again</div>";
            $this->load->view('access/forgot_password',$data);
        }
    }//end function change password


    /*
    * This function process logout process
    */
    public function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }

}
?>
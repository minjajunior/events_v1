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

    /*
    * This function process logout process
    */
    public function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }

}
?>
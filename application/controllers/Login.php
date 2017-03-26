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
        $this->form_validation->set_rules('mailcode', 'Event Code', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login/login_view');
        } else {
            if(!empty($this->login_model->event_login($this->input->post('mailcode')))) {
                $value = $this->login_model->event_login($this->input->post('mailcode'));

                if (!empty($value)) {
                    if ($value['event_password'] == md5($this->input->post('password'))) {
                        $this->session->set_userdata($value);
                        redirect('event/home/'.$value['event_id']);
                    } else {
                        redirect('login');
                    }
                } else {
                    redirect('login');
                }
            }elseif(!empty($this->login_model->admin_login($this->input->post('mailcode')))) {
                $value = $this->login_model->admin_login($this->input->post('mailcode'));

                if(!empty($value)){
                    if($value['admin_password'] == md5($this->input->post('password'))){
                        $this->session->set_userdata($value);
                        redirect('admin');
                    }else{
                        redirect('login');
                    }
                }else {
                    redirect('login');
                }
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

    public function member(){

        $curl = curl_init();

        if($this->input->post('action') == "request"){
            $data = array('smsStatus' => 'MESSAGE_SENT', 'pinId'=>'12345');
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
        }elseif ($this->input->post('action') == "verify") {
            $data = array('verified' => 'true', 'msisdn'=>'255712431242');
            echo json_encode($data);
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
        }

    }
}
?>
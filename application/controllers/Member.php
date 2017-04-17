<?php
/**
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 3/27/2017
 * Time: 10:28 AM
 */

class Member extends CI_Controller {

    public function index(){

        if (!empty($this->session->member_phone)){
            $data['event'] = $this->event_model->member_event($this->session->member_phone);
            $this->load->view('member/home_view', $data);
        } else {
            redirect('login');
        }
    }

    public function add_pledge($id){

        $data['member_detail'] = $this->event_model->member_detail($id);

        if (!empty($this->session->member_phone)) {

            $data = array('success' => false, 'messages' => array(), 'id' => $id);

            $this->form_validation->set_rules('amount', 'Amount', 'numeric|required');
            $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

            if ($this->form_validation->run() == FALSE) {
                foreach ($_POST as $key => $value) {
                    $data['messages'][$key] = form_error($key);
                }
            } else {
                $data['success'] = true;
                $np = $this->input->post('amount') + $this->input->post('memberpledge');
                $values = array(
                    'member_pledge' => $np
                );

                $this->event_model->update_member($values, $id);
            }
            echo json_encode($data);
        } else {
            redirect('login');
        }
    }

    public function send_sms($id){
        $id = base64_decode($id);

        if($this->input->post('to') == 0 ){
            $numbers = $this->member_model->get_numbers($id);
        }else {
            $numbers = $this->member_model->get_group_numbers($id, $this->input->post('to'));
        }

        if ($numbers == null) {
            $data = array('Status' => false);
            echo json_encode($data);
        } else {
            //$data = array('bulkId' => '97965896598489');
            //echo json_encode($data);
            /*$text = $this->input->post('sms');

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "http://api.infobip.com/sms/1/text/single",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "{ \"from\":\"InfoSMS\", \"to\":[\"".implode('", "',$numbers)."\"], \"text\":\"".$text."\" }",
                CURLOPT_HTTPHEADER => array(
                    "accept: application/json",
                    "authorization: Basic RGVtaUFkbWluOkBDb3JwbzE3Jg==",
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
                $values = array(
                    'sms_to' => $this->input->post('to'),
                    'sms_text' => $text,
                    'event_id' => $id,
                    'sent_by' => $this->session->admin_id
                );
                $this->member_model->sent_sms($values);
            }*/
        }
    }

    public function new_group($id){
        if (!empty($this->session->admin_id)) {

            $data = array('success' => false, 'messages' => array());

            $this->form_validation->set_rules('groupname', 'Group Name', 'required');
            $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

            if ($this->form_validation->run() == FALSE) {
                foreach ($_POST as $key => $value) {
                    $data['messages'][$key] = form_error($key);
                }
            } else {
                $data['success'] = true;
                $values = array(
                    'group_name' => $this->input->post('groupname'),
                    'event_id' => $id
                );

                $this->member_model->insert_group($values);

            }
            echo json_encode($data);
        } else {
            redirect('admin');
        }
    }

    public function delete_member($id){
        $this->member_model->delete_member($id);
        $data = array('success' => true);
        echo json_encode($data);
    }
}
?>
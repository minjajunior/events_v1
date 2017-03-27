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
}
?>
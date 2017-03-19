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
                        redirect('event/home/' . $value['event_id']);
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
}
?>
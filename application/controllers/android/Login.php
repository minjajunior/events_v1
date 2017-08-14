<?php

/**
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 7/6/2017
 * Time: 5:05 PM
 */
class Login extends CI_Controller {

    public function index(){
        if(!is_null($this->login_model->admin_login($this->input->post('mailphone')))) {
            $value = $this->login_model->admin_login($this->input->post('mailphone'));
            if(!is_null($this->input->post('password'))) {
                if($value['admin_password'] == md5($this->input->post('password'))){
                    $data = array('user' => 'admin');
                    echo json_encode($value);
                    //echo json_encode($data);
                }else{
                    $data = array('loginStatus' => 'password');
                    echo json_encode($data);
                }
            }elseif($value['reg_status'] == 1) {
                $data = array('loginStatus' => 'admin', 'email' => $this->input->post('mailphone'));
                echo json_encode($data);
            } else{
                $data = array('loginStatus' => 'reg_status');
                echo json_encode($data);
            }
        } else {
            $data = array('loginStatus' => false);
            echo json_encode($data);
        }
    }

}
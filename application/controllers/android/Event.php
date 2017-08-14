<?php

/**
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 7/18/2017
 * Time: 12:16 PM
 */
class Event extends CI_Controller {

    public function get_members($event_id){
        echo json_encode($this->event_model->member_details($event_id));
    }

    public function get_budget($event_id){
        echo json_encode($this->event_model->budget_details($event_id));
    }

    public function get_messages($event_id){
        echo json_encode($this->member_model->sms_list($event_id));
    }

    public function get_types(){
        echo json_encode($this->event_model->get_type());
    }

    public function get_regions(){
        echo json_encode($this->event_model->get_location());
    }
}
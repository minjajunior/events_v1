<?php
/**
 * Created by PhpStorm.
 * User: d.felix
 * Date: 14/03/2017
 * Time: 23:21
 */


class  Reports_model extends CI_Model{

    public function member_details($event_id){

        $this->db->select('*');
        $this->db->from('member');
        $this->db->order_by('member_name', 'asc');
        $this->db->where('event_id', $event_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $response[] = $row;
            }
            return $response;
        }else{
            $response['error'] = '0';
            return $response;
        }
    }


    /*
     * This function returns the budget item details of the selected event
     */
    public function budget_details($event_id){
        $this->db->select('*');
        $this->db->from('budget');
        $this->db->order_by('item_name', 'asc');
        $this->db->where('event_id', $event_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $response[] = $row;
            }
            return $response;
        }else{
            $response['error'] = '0';
            return $response;
        }
    }

    public function pledge_details($event_id){
        $amount_diff = 0;
        $this->db->select('*');
        $this->db->from('member');
        $this->db->where('event_id', $event_id);
        $this->db->where('(member_pledge>member_cash)');
        //$this->db->where('member_cash', $event_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $response[] = $row;
            }
            return $response;
        }else{
            $response['error'] = '0';
            return $response;
        }


    }





}
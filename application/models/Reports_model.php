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

    public function less_pledges($event_id)
    {

        $this->db->select('*');
        $this->db->from('member');
        $this->db->where('event_id', $event_id);
        $this->db->where('(member_pledge>member_cash)');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $response[] = $row;
            }
            return $response;
        } else {
            $response['error'] = '0';
            return $response;
        }
    }

    public function full_pledges($event_id){

        $this->db->select('*');
        $this->db->from('member');
        $this->db->where('event_id', $event_id);
        $this->db->where('(member_pledge=member_cash)');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $response[] = $row;
            }
            return $response;
        } else {
            $response['error'] = '0';
            return $response;
        }

    }


    public function get_member_group($event_id){
        $this->db->select('*');
        $this->db->from('member_group');
        $this->db->where('event_id', $event_id);
        $this->db->order_by('group_name', 'asc');
        $query = $this->db->get();

        if ($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $response[] = $row;
            }
            return $response;
        }else{
            $response['error'] = 'Event type Not Found';
            return $response;
        }
    }


    public function get_members_group($event_id,$grp_id){
        $this->db->select('*');
        $this->db->from('member');
        $this->db->where('event_id', $event_id);
        $this->db->where('group_id', $grp_id);
        //$this->db->order_by('group_name', 'asc');
        $query = $this->db->get();

        if ($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $response[] = $row;
            }
            return $response;
        }else{
            $response['error'] = 'Category type Not Found';
            return $response;
        }
    }

    public function get_members_amounts($paid_am,$pledge_am,$event_id){
        $this->db->select('*');
        $this->db->from('member');
        $this->db->where('event_id', $event_id);
        $this->db->where('member_pledge=', $pledge_am);
        $this->db->where('member_cash<', $paid_am);
        $this->db->order_by('member_name', 'asc');
        $query = $this->db->get();

        if ($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $response[] = $row;
            }
            return $response;
        }else{
            $response['error'] = 'Category type Not Found';
            return $response;
        }
    }





}
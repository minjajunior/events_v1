<?php
/*
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 4/5/2017
 * Time: 1:24 PM
 */

class Member_model extends CI_Model {

    public function get_numbers($eid){
        $this->db->select('member_phone');
        $this->db->from('member');
        $this->db->where('event_id', $eid);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $response = array();
            foreach ($query->result_array() as $row) {
                if(strlen($row['member_phone']) == 12){
                    $response[] = $row['member_phone'];
                }
            }
            return $response;
        } else {
            $response[] = null;
            return $response;
        }
    }

    public function get_group_numbers($eid, $gid){
        $this->db->select('member_phone');
        $this->db->from('member');
        $this->db->where('event_id', $eid);
        $this->db->where('group_id', $gid);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $response = array();
            foreach ($query->result_array() as $row) {
                if(strlen($row['member_phone']) == 12){
                    $response[] = $row['member_phone'];
                }
            }
            return $response;
        } else {
            $response[] = null;
            return $response;
        }

    }

    public function sent_sms($values){
        $this->db->insert('sms_to_member', $values);
    }

    public function sms_list($id){
        $this->db->select('*');
        $this->db->from('sms_to_member');
        $this->db->join('admin', 'sms_to_member.sent_by = admin.admin_id');
        $this->db->where('sms_to_member.event_id', $id);
        $this->db->order_by('sms_to_member.sent_on', 'desc');

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

    public function insert_group($values){
        $this->db->insert('member_group', $values);
    }
}
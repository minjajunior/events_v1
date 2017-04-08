<?php

/**
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 11/21/2016
 * Time: 11:30 AM
 *
 * This transact with database from Admin Controller
 */
class Admin_model extends CI_Model {

    /*
     * This function insert new admin details into database
     */
    public function register($values){
        $this->db->insert('admin', $values);
    }

    /*
     * This function add admin to an event
     */
    public function add_admin($values){
        $this->db->insert('event_admin', $values);
    }

    /*
     * This function returns the list of all admin manage one Event.
     */
    public function get_admin($id){
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->join('event_admin', 'admin.admin_id = event_admin.admin_id');
        $this->db->join('user_role', 'user_role.role_id = event_admin.role_id');
        $this->db->where('event_admin.event_id', $id);
        $this->db->where('admin.reg_status', 1);
        $this->db->order_by('admin_name', 'asc');
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
     * This function returns the role of the admin on event.
     */
    public function get_role($id){
        $this->db->select('role_id');
        $this->db->from('event_admin');
        $this->db->where('event_id', $id);
        $this->db->where('admin_id', $this->session->admin_id);
        $query = $this->db->get();
        $row = $query->row_array();
        return $row['role_id'];
    }

    /*
     * This function returns the events details of one selected event.
     */
    public function admin_details($id){
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('admin_id', $id);
        $query = $this->db->get();

        if ($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $response[] = $row;
            }
            return $response;
        }else{
            $response['error'] = 'Admin Not Found';
            return $response;
        }
    }

    /*
     * This function returns the sum of the budget items of the selected event
     */
    public function event_sum($id){
        $this->db->select('admin_id');
        $this->db->from('event_admin');
        $this->db->where('admin_id', $id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function check_admin($eid, $aid){
        $this->db->select('*');
        $this->db->from('event_admin');
        $this->db->where('event_id', $eid);
        $this->db->where('admin_id', $aid);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function invite_admin($values,$event_id){
        $this->db->insert('admin', $values);
        $id = $this->db->insert_id();
        $role_id =2;
        $this->db->insert('event_admin', array('event_id'=>$event_id,'admin_id' =>$id,'role_id' =>$role_id));

        return $id;
    }

    public function admin_info($id){
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('admin_id', $id);
        $query = $this->db->get();

        if ($query->num_rows() > 0){
            return $query->result_array();


        }
    }

    public function update_admin($id,$values){

        $this->db->where('admin.admin_id', $id);
        $result =  $this->db->update('admin', $values);

        if($result){
            $query = $this->db->get_where('admin', array('admin_id' => $id));
        }

        return $query->result_array();

    }

}
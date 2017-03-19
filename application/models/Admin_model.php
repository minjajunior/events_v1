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

    public function admin_id($id){
        $this->db->select('event_admin');
        $this->db->from('event');
        $this->db->where('event_id', $id);
        $query = $this->db->get();
        $row = $query->row_array();
        return $row['event_admin'];
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
        $this->db->select('event_admin');
        $this->db->from('event');
        $this->db->where('event_admin', $id);
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
}
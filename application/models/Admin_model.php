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
     * This function returns all admin details selected by unique email address for login validation process
     */
    public function login($mail){
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('admin_email', $mail);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
    }
}
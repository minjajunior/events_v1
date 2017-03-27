<?php
/**
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 3/18/2017
 * Time: 5:51 PM
 */

class Login_model extends CI_Model {

    /*
     * This function returns all admin details selected by unique email address for login validation process
     */
    public function admin_login($mail){
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('admin_email', $mail);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
    }

    /*
     * This function returns all events details selected by a unique event code
     */
    public function member_login($number) {
        $this->db->select('*');
        $this->db->from('member');
        $this->db->where('member_phone', $number);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: d.felix
 * Date: 20/08/2017
 * Time: 14:16
 */

class Vendors_model extends CI_Model
{

    /*
     * This function insert new admin details into database
     */
    public function register($values){
        $this->db->insert('vendors', $values);
        $id = $this->db->insert_id();
        return $id;
    }

    public function vendor_login($mail){
        $this->db->select('*');
        $this->db->from('vendors');
        $this->db->where('vendor_email', $mail);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
    }


    public function vendor_info($id){
        $this->db->select('*');
        $this->db->from('vendors');
        $this->db->where('vendor_id', $id);
        $query = $this->db->get();

        if ($query->num_rows() > 0){
            return $query->result_array();


        }
    }

    public function update_vendor($id,$values){

        $this->db->where('vendor_id', $id);
        $result =  $this->db->update('vendors', $values);

        if($result){
            $query = $this->db->get_where('vendors', array('vendor_id' => $id));
        }

        return $query->result_array();

    }

    public function provider_phone($phone){
        $this->db->select('*');
        $this->db->from('vendors');
        $this->db->where('vendor_phone', $phone);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
    }

}
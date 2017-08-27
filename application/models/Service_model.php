<?php
/**
 * Created by PhpStorm.
 * User: d.felix
 * Date: 20/08/2017
 * Time: 14:16
 */

class Service_model extends CI_Model
{

    /*
     * This function insert new admin details into database
     */
    public function register($values){
        $this->db->insert('s_providers', $values);
        $id = $this->db->insert_id();
        return $id;
    }


    public function provider_info($id){
        $this->db->select('*');
        $this->db->from('s_providers');
        $this->db->where('sp_id', $id);
        $query = $this->db->get();

        if ($query->num_rows() > 0){
            return $query->result_array();


        }
    }

    public function update_provider($id,$values){

        $this->db->where('sp_id', $id);
        $result =  $this->db->update('s_providers', $values);

        if($result){
            $query = $this->db->get_where('s_providers', array('sp_id' => $id));
        }

        return $query->result_array();

    }

    public function provider_phone($phone){
        $this->db->select('*');
        $this->db->from('s_providers');
        $this->db->where('sp_phone', $phone);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
    }

}
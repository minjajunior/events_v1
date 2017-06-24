<?php
/*
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 11/21/2016
 * Time: 4:24 PM
 *
 * This model transact with database from Event Controller.
 */
class Event_model extends CI_Model {

    /*
     * This function returns all the locations(regions) from the database
     */
    public function get_location(){
        $this->db->select('*');
        $this->db->from('location');
        $this->db->order_by('location_name', 'asc');
        $query = $this->db->get();

        if ($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $response[] = $row;
            }
            return $response;
        }else{
            $response['error'] = 'Locations Not Found';
            return $response;
        }
    }

    public function get_type(){
        $this->db->select('*');
        $this->db->from('event_type');
        $this->db->order_by('type_name', 'asc');
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

    /*
     * This function returns the list of all events managed by one Admin.
     */
    public function get_event($id){
        $this->db->select('*');
        $this->db->from('event');
        $this->db->join('event_admin', 'event.event_id = event_admin.event_id');
        $this->db->join('location', 'event.event_location = location.location_id');
        $this->db->where('event_admin.admin_id', $id);
        $this->db->order_by('event_name', 'asc');
        $query = $this->db->get();

        if ($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $response[] = $row;
            }
            return $response;
        }else{
            $response['error'] = 'Event Not Found';
            return $response;
        }
    }

    /*
     * This function returns the list of all events registered to one Member.
     */
    public function member_event($pn){
        $this->db->select('*');
        $this->db->from('event');
        $this->db->join('member', 'event.event_id = member.event_id');
        $this->db->where('member.member_phone', $pn);
        $this->db->order_by('event_name', 'asc');
        $query = $this->db->get();

        if ($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $response[] = $row;
            }
            return $response;
        }else{
            $response['error'] = 'Event Not Found';
            return $response;
        }
    }

    /*
     * This function returns the events details of one selected event.
     */
    public function event_details($id){
        $this->db->select('*');
        $this->db->from('event');
        $this->db->join('location', 'event.event_location = location.location_id');
        $this->db->where('event.event_id', $id);
        $query = $this->db->get();

        if ($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $response[] = $row;
            }
            return $response;
        }else{
            $response['error'] = 'Event Not Found';
            return $response;
        }
    }

    /*
     * This function returns the list of all members registered on selected event
     */
    public function member_details($id){
        $this->db->select('*');
        $this->db->from('member');
        $this->db->where('event_id', $id);
        $this->db->order_by('member_name', 'asc');
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
     * This function returns member details of the selected member
     */
    public function member_detail($id){
        $this->db->select('*');
        $this->db->from('member');
        $this->db->where('member_id', $id);
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
    public function budget_details($id){
        $this->db->select('*');
        $this->db->from('budget');
        $this->db->order_by('item_name', 'asc');
        $this->db->where('event_id', $id);
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
     * This function returns the item details of the selected item
     */
    public function budget_detail($id){
        $this->db->select('*');
        $this->db->from('budget');
        $this->db->where('item_id', $id);
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
     * This function insert new event details into database
     */
    public function create($values){
        $this->db->insert('event', $values);
        $event_id = $this->db->insert_id();
        $role_id =1;
        $this->db->insert('event_admin', array('event_id'=>$event_id,'admin_id' =>$this->session->admin_id,'role_id' =>$role_id));
    }

    /*
     * This function update selected event details
     */
    public function update_event($values, $id){
        $this->db->where('event_id', $id);
        $this->db->update('event', $values);
    }

    /*
     * This function insert member(s) details into database
     */
    public function insert_member($values){
        $this->db->insert('member', $values);
    }

    /*
     * This function update selected member details
     */
    public function update_member($values, $id){
        $this->db->where('member_id', $id);
        $this->db->update('member', $values);
    }

    public function update_member_group($values, $id){
        $this->db->where('group_id', $id);
        $this->db->update('member', $values);
    }

    /*
     * This function insert budget item(s) details into database
     */
    public function insert_budget($values){
        $this->db->insert('budget', $values);
    }

    /*
     * This function update selected budget item details
     */
    public function update_budget($values, $id){
        $this->db->where('item_id', $id);
        $this->db->update('budget', $values);
    }

    /*
     * This function is deleting the event
     */
    public function delete_event($id){
        $this->db->where('event_id', $id);
        $this->db->delete('event');
    }

    /*
     * This function is deleting the item
     */
    public function delete_item($id){
        $this->db->where('item_id', $id);
        $this->db->delete('budget');
    }

    /*
     * This function is deleting all items
     */
    public function delete_all_items($id){
        $this->db->where('event_id', $id);
        $this->db->delete('budget');
    }

    /*
     * This function returns the sum of pledge of the selected event
     */
    public function pledge_sum($id){
        $this->db->select_sum('member_pledge');
        $this->db->from('member');
        $this->db->where('event_id', $id);
        $query = $this->db->get();
        $row = $query->row_array();
        return $row['member_pledge'] ;
    }

    /*
     * This function returns the sum of the cash collected of the selected event
     */
    public function cash_sum($id){
        $this->db->select_sum('member_cash');
        $this->db->from('member');
        $this->db->where('event_id', $id);
        $query = $this->db->get();
        $row = $query->row_array();
        return $row['member_cash'];
    }

    /*
     * This function returns the sum of the budget items of the selected event
     */
    public function budget_sum($id){
        $this->db->select_sum('item_cost');
        $this->db->from('budget');
        $this->db->where('event_id', $id);
        $query = $this->db->get();
        $row = $query->row_array();
        return $row['item_cost'];
    }

    /*
     * This function returns the sum of advanced payment of budget items of the selected events
     */
    public function advance_sum($id){
        $this->db->select_sum('item_paid');
        $this->db->from('budget');
        $this->db->where('event_id', $id);
        $query = $this->db->get();
        $row = $query->row_array();
        return $row['item_paid'];
    }

    /*
     * This function returns event id of the selected member
     */
    public function event_id($id){
        $this->db->select('event_id');
        $this->db->from('member');
        $this->db->where('member_id', $id);
        $query = $this->db->get();
        $row = $query->row_array();
        return $row['event_id'];
    }

    /*
     * This function returns event name of the selected id
     */
    public function event_name($id){
        $this->db->select('event_name');
        $this->db->from('event');
        $this->db->where('event_id', $id);
        $query = $this->db->get();
        $row = $query->row_array();
        return $row['event_name'];
    }

    public function event_iid($id){
        $this->db->select('event_id');
        $this->db->from('budget');
        $this->db->where('item_id', $id);
        $query = $this->db->get();
        $row = $query->row_array();
        return $row['event_id'];
    }

    public function event_date($id){
        $this->db->select('event_date');
        $this->db->from('event');
        $this->db->where('event_id', $id);
        $query = $this->db->get();
        $row = $query->row_array();
        return $row['event_date'];
    }
}
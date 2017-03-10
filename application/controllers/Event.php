<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * This controller controls all the function about Events
 */
class Event extends CI_Controller {

    /*
     * This function load Event login page and process validation of the user
     */
	public function index() {
        $this->form_validation->set_rules('eventcode', 'Event Code', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('event/login_view');
        } else {
            $value = $this->event_model->login($this->input->post('eventcode'));

            if(!empty($value)){
                if($value['event_password'] == md5($this->input->post('password'))){
                    $this->session->set_userdata($value);
                    redirect('event/home/'.$value['event_id']);
                }else{
                    redirect('event');
                }
            }else {
                redirect('event');
            }
        }
	}

	/*
	 * This function load Event home page after the event login process completed
	 */
	public function home($id){

        if (!empty($this->session->admin_id) || !empty($this->session->event_id) ) {
            $data['event_details'] = $this->event_model->event_details($id);
            $data['member_details'] = $this->event_model->member_details($id);
            $data['budget_details'] = $this->event_model->budget_details($id);
            $data['pledge_sum'] = $this->event_model->pledge_sum($id);
            $data['cash_sum'] = $this->event_model->cash_sum($id);
            $data['budget_sum'] = $this->event_model->budget_sum($id);
            $data['advance_sum'] = $this->event_model->advance_sum($id);
            $data['location'] = $this->event_model->get_location();
            $data['event_id'] = $id;
            $this->load->view('event/default_view', $data);
        } else {
            redirect('event');
        }
    }

    public function load_views(){


        if(!empty($_POST['view_name']) ||!empty($_POST['event_id']) || !empty($this->session->admin_id) || !empty($this->session->event_id)){

            if(!empty($_POST['type'])) {

                $data['type'] = $_POST['type'];
                if($_POST['type'] == 'Cash' || $_POST['type'] == 'Pledge'){
                    $data['member_id'] = $_POST['member_id'];
                    $data['member_detail'] = $this->event_model->member_detail($_POST['member_id']);
                    $id = $this->event_model->event_id($_POST['member_id']);
                } elseif ($_POST['type'] == 'Cost' || $_POST['type'] == 'Payment'){
                    $data['item_id'] = $_POST['item_id'];
                    $data['item_detail'] = $this->event_model->budget_detail($_POST['item_id']);
                    $id = $this->event_model->event_iid($_POST['item_id']);
                }

            } elseif(!empty($_POST['member_id'])) {
                $data['member_detail'] = $this->event_model->member_detail($_POST['member_id']);
                $id = $this->event_model->event_id($_POST['member_id']);
                $data['member_id'] = $_POST['member_id'];
            }elseif (!empty($_POST['item_id'])){
                $data['item_id'] = $_POST['item_id'];
                $data['item_detail'] = $this->event_model->budget_detail($_POST['item_id']);
                $id = $this->event_model->event_iid($_POST['item_id']);
            }
            else {
                $id = $_POST['event_id'];
            }
            $data['location'] = $this->event_model->get_location();
            $data['type'] = $this->event_model->get_type();
            $data['event_details'] = $this->event_model->event_details($id);
            $data['member_details'] = $this->event_model->member_details($id);
            $data['budget_details'] = $this->event_model->budget_details($id);
            $data['pledge_sum'] = $this->event_model->pledge_sum($id);
            $data['cash_sum'] = $this->event_model->cash_sum($id);
            $data['budget_sum'] = $this->event_model->budget_sum($id);
            $data['advance_sum'] = $this->event_model->advance_sum($id);
            $data['event_id'] = $id;
            $view_name = $_POST['view_name'];

            $this->load->view('event/'.$view_name,$data);
        }

    }

    /*
     * This function process Event logout process
     */
    public function logout(){
        $this->session->sess_destroy();
        redirect('event');
    }

    /*
     * This function load Create event page and process validation of event creation.
     */
	public function create(){
        $data['location'] = $this->event_model->get_location();
        $data['type'] = $this->event_model->get_type();

        if (!empty($this->session->admin_id)){

            $data = array('success' => false, 'messages' => array());

            $this->form_validation->set_rules('eventname', 'Event Name', 'required');
            $this->form_validation->set_rules('eventcode', 'Event Code', 'required|is_unique[event.event_code]');
            $this->form_validation->set_rules('eventdate', 'Event Date', 'required');
            $this->form_validation->set_rules('type', 'Event Type', 'required');
            $this->form_validation->set_rules('location', 'Event Location', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('password2', 'Re-Enter Password', 'required|matches[password]');
            if($this->input->post('type') == "other") {
                $this->form_validation->set_rules('othertext', 'Event Type', 'required');
            }
            $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

            if ($this->form_validation->run() == FALSE) {
                foreach ($_POST as $key => $value){
                    $data['messages'][$key] = form_error($key);
                }
            } else {
                $data['success'] = true;
                if($this->input->post('type') == "other") {
                    $tv = $this->input->post('othertext');
                }else{
                    $tv = $this->input->post('type');
                }
                $values = array(
                    'event_name' => $this->input->post('eventname'),
                    'event_code' => $this->input->post('eventcode'),
                    'event_date' => $this->input->post('eventdate'),
                    'event_type' => $tv,
                    'event_location' => $this->input->post('location'),
                    'event_password' => md5($this->input->post('password')),
                    'event_admin' => $this->session->admin_id,
                    'event_paid' => '0'
                );

                $this->event_model->create($values);
            }
            echo json_encode($data);
        } else {
            redirect('admin');
        }
    }

    /*
     * This function load edit event page.
     */
    public function edit($id){
        $data['location'] = $this->event_model->get_location();
        $data['type'] = $this->event_model->get_type();
        $data['event_details'] = $this->event_model->event_details($id);

        if (!empty($this->session->admin_id)){

            $data = array('success' => false, 'messages' => array());

            $this->form_validation->set_rules('eventname', 'Event Name', 'required');
            if ($this->input->post('ec') != $this->input->post('eventcode')){
                $this->form_validation->set_rules('eventcode', 'Event Code', 'required|is_unique[event.event_code]');
            }
            $this->form_validation->set_rules('eventdate', 'Event Date', 'required');
            $this->form_validation->set_rules('type', 'Event Type', 'required');
            $this->form_validation->set_rules('location', 'Event Location', 'required');
            if($this->input->post('type') == "other") {
                $this->form_validation->set_rules('othertext', 'Event Type', 'required');
            }
            $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

            if ($this->form_validation->run() == FALSE) {
                //$this->load->view('event/editMember_view', $data);
                foreach ($_POST as $key => $value){
                    $data['messages'][$key] = form_error($key);
                }
            } else {
                $data['success'] = true;
                if($this->input->post('type') == "other") {
                    $tv = $this->input->post('othertext');
                }else{
                    $tv = $this->input->post('type');
                }
                $values = array(
                    'event_name' => $this->input->post('eventname'),
                    'event_code' => $this->input->post('eventcode'),
                    'event_date' => $this->input->post('eventdate'),
                    'event_type' => $tv,
                    'event_location' => $this->input->post('location')
                );

                $this->event_model->update_event($values, $id);
            }
            echo json_encode($data);
        } else {
            redirect('admin');
        }
    }

    /*
     * This function process the PHPExcel library to upload members list to the database
     */
    public function upload_members($id){

        $config['upload_path']          = './upload/';
        $config['allowed_types']        = 'xlsx|xls';
        $config['max_size']             = 0;

        $this->load->library('upload', $config);

        if($this->upload->do_upload('members'))
        {
            $data = array('upload_data' => $this->upload->data());
            $file = $data['upload_data']['file_name'];
            //load the excel library
            $this->load->library('excel');
            //read file from path
            $objPHPExcel = PHPExcel_IOFactory::load('./upload/'.$file);
            $objWorksheet = $objPHPExcel->getActiveSheet();

            foreach ($objWorksheet->getRowIterator() as $row) {
                $mn = "";
                $mp = "0";
                $mc = "0";
                $pn = "";
                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(true);
                foreach ($cellIterator as $cell) {
                    if($cell->getColumn() == "A") {
                        $mn = $cell->getValue();
                    }elseif($cell->getColumn() == "B") {
                        $mp = $cell->getValue();
                    }elseif($cell->getColumn() == "C") {
                        $mc = $cell->getValue();
                    }elseif($cell->getColumn() == "D") {
                        $pn = $cell->getValue();
                    }
                }
                if($mn != "Member Name"){
                    $values = array(
                        'member_name' => $mn,
                        'member_pledge' => $mp,
                        'member_cash' => $mc,
                        'member_phone' => $pn,
                        'event_id' => $id
                    );
                    $this->event_model->insert_member($values);
                }
            }
            redirect('event/home/'.$id);
        }
        else
        {
            $error = array('error' => $this->upload->display_errors());
            echo var_dump($error);
            $this->load->view('event/home_view');
        }
    }

    /*
     * This function process the PHPExcel library to upload budget items to the database
     */
    public function upload_budget($id){

        $config['upload_path']          = './upload/';
        $config['allowed_types']        = 'xlsx|xls';
        $config['max_size']             = 0;

        $this->load->library('upload', $config);

        if($this->upload->do_upload('budget'))
        {
            $data = array('upload_data' => $this->upload->data());
            $file = $data['upload_data']['file_name'];
            //load the excel library
            $this->load->library('excel');
            //read file from path
            $objPHPExcel = PHPExcel_IOFactory::load('./upload/'.$file);
            $objWorksheet = $objPHPExcel->getActiveSheet();

            foreach ($objWorksheet->getRowIterator() as $row) {
                $in = "";
                $ic = "0";
                $ip = "0";
                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(true);
                foreach ($cellIterator as $cell) {
                    if($cell->getColumn() == "A") {
                        $in = $cell->getValue();
                    }elseif($cell->getColumn() == "B") {
                        $ic = $cell->getValue();
                    }elseif($cell->getColumn() == "C") {
                        $ip = $cell->getValue();
                    }
                }
                if ($in != "Item Name") {
                    $values = array(
                        'item_name' => $in,
                        'item_cost' => $ic,
                        'item_paid' => $ip,
                        'event_id' => $id
                    );
                    $this->event_model->insert_budget($values);
                }
            }
            redirect('event/home/'.$id);
        }
        else
        {
            //$error = array('error' => $this->upload->display_errors());
            //$this->load->view('event/home_view', $error);
        }
    }

    /*
     * This function load new member registration page and process validation of adding new member
     */
    public function new_member($id){

        $data['event_id'] = $id;

        if (!empty($this->session->admin_id)){

            $data = array('success' => false, 'messages' => array());

            $this->form_validation->set_rules('membername', 'Member Name', 'required');
            $this->form_validation->set_rules('memberpledge', 'Member Pledge', 'numeric');
            $this->form_validation->set_rules('membercash', 'Member Cash', 'numeric');
            $this->form_validation->set_rules('memberphone', 'Phone Number', 'numeric');
            $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

            if ($this->form_validation->run() == FALSE) {
                foreach ($_POST as $key => $value){
                    $data['messages'][$key] = form_error($key);
                }
            } else {
                $data['success'] = true;
                $values = array(
                    'member_name' => $this->input->post('membername'),
                    'member_pledge' => $this->input->post('memberpledge'),
                    'member_cash' => $this->input->post('membercash'),
                    'member_phone' => $this->input->post('memberphone'),
                    'event_id' => $id
                );

                $this->event_model->insert_member($values);

                //redirect('event/home/'.$id);
            }
            echo json_encode($data);
        } else {
            redirect('admin');
        }
    }

    /*
     * This function load new budget item page and process validation of adding new budget item
     */
    public function new_item($id){

        $data['event_id'] = $id;

        if (!empty($this->session->admin_id)){

            $data = array('success' => false, 'messages' => array());

            $this->form_validation->set_rules('itemname', 'Item Name', 'required');
            $this->form_validation->set_rules('itemcost', 'Item Cost', 'numeric');
            $this->form_validation->set_rules('itempaid', 'Item Paid', 'numeric');
            $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

            if ($this->form_validation->run() == FALSE) {
                //$this->load->view('event/newItem_view', $data);
                foreach ($_POST as $key => $value){
                    $data['messages'][$key] = form_error($key);
                }
            } else {
                $data['success'] = true;
                $values = array(
                    'item_name' => $this->input->post('itemname'),
                    'item_cost' => $this->input->post('itemcost'),
                    'Item_paid' => $this->input->post('itempaid'),
                    'event_id' => $id
                );

                $this->event_model->insert_budget($values);

                //redirect('event/home/'.$id);
            }
            echo json_encode($data);
        } else {
            redirect('admin');
        }
    }

    /*
     * This function load member details to the edit member page and process validation of updating member details
     */
    public function edit_member($id) {

        $data['member_id'] = $id;
        $data['member_detail'] = $this->event_model->member_detail($id);
        $event_id = $this->event_model->event_id($id);

        if (!empty($this->session->admin_id)){

            $data = array('success' => false, 'messages' => array());

            $this->form_validation->set_rules('membername', 'Member Name', 'required');
            $this->form_validation->set_rules('memberpledge', 'Member Pledge', 'numeric');
            $this->form_validation->set_rules('membercash', 'Member Cash', 'numeric');
            $this->form_validation->set_rules('memberphone', 'Phone Number', 'numeric');
            $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

            if ($this->form_validation->run() == FALSE) {
                //$this->load->view('event/editMember_view', $data);
                foreach ($_POST as $key => $value){
                    $data['messages'][$key] = form_error($key);
                }
            } else {
                $data['success'] = true;
                $values = array(
                    'member_name' => $this->input->post('membername'),
                    'member_phone' => $this->input->post('memberphone'),
                );

                $this->event_model->update_member($values, $id);

                //redirect('event/home/'.$event_id);
            }
            echo json_encode($data);
        } else {
            redirect('admin');
        }
    }

    /*
     * This function load budget item details to the budget item edit page and process validation of updating
     * budget item details
     */
    public function edit_budget($id) {

        $data['item_id'] = $id;
        $data['item_detail'] = $this->event_model->budget_detail($id);
        $event_id = $this->event_model->event_iid($id);

        if (!empty($this->session->admin_id)){

            $data = array('success' => false, 'messages' => array());

            $this->form_validation->set_rules('itemname', 'Item Name', 'required');
            $this->form_validation->set_rules('itemcost', 'Item Cost', 'numeric');
            $this->form_validation->set_rules('itempaid', 'Item Paid', 'numeric');
            $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

            if ($this->form_validation->run() == FALSE) {
                //$this->load->view('event/editBudget_view', $data);
                foreach ($_POST as $key => $value){
                    $data['messages'][$key] = form_error($key);
                }
            } else {
                $data['success'] = true;
                $values = array(
                    'item_name' => $this->input->post('itemname'),
                );

                $this->event_model->update_budget($values, $id);

                //redirect('event/home/'.$event_id);
            }
            echo json_encode($data);
        } else {
            redirect('admin');
        }
    }

    /*
     * This function process all transaction ie(Pledge, Cash, Cost, Payment)
     * Pledge = This is the amount member pledge
     * Cash = This is the amount member have already submit it to the accountant
     * Cost = This is the amount budget item cost
     * Payment = This is the amount budget item paid
     **/
    public function transaction($type, $id){

        $data['type'] = $type;
        if($type == 'Cash' || $type == 'Pledge'){
            $data['member_id'] = $id;
            $data['member_detail'] = $this->event_model->member_detail($id);
        } elseif ($type == 'Cost' || $type == 'Payment'){
            $data['item_id'] = $id;
            $data['item_detail'] = $this->event_model->budget_detail($id);
        }

        if (!empty($this->session->admin_id)){

            $data = array('success' => false, 'messages' => array());

            $this->form_validation->set_rules('amount', 'Amount', 'numeric|required');
            $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

            if ($this->form_validation->run() == FALSE) {
                //$this->load->view('event/transaction_view', $data);
                foreach ($_POST as $key => $value){
                    $data['messages'][$key] = form_error($key);
                }
            } else {
                if($type == 'Pledge'){
                    $data['success'] = true;
                    $np = $this->input->post('amount') + $this->input->post('memberpledge');
                    $values = array(
                        'member_pledge' => $np
                    );

                    $this->event_model->update_member($values, $id);
                    //redirect('event/edit_member/'.$id);
                }
                if($type == 'Cash'){
                    $data['success'] = true;
                    if($this->input->post('amount') > $this->input->post('memberpledge') ){
                        $np = 0;
                    }else{
                        $np = $this->input->post('memberpledge') - $this->input->post('amount');
                    }
                    $nc = $this->input->post('amount') + $this->input->post('membercash');
                    $values = array(
                        'member_pledge' => $np,
                        'member_cash' => $nc
                    );

                    $this->event_model->update_member($values, $id);
                    //redirect('event/edit_member/'.$id);
                }
                if($type == 'Cost'){
                    $data['success'] = true;
                    $ic = $this->input->post('amount') + $this->input->post('itemcost');
                    $values = array(
                        'item_cost' => $ic
                    );

                    $this->event_model->update_budget($values, $id);
                    //redirect('event/edit_budget/'.$id);
                }
                if($type == 'Payment'){
                    $data['success'] = true;
                    $ip = $this->input->post('amount') + $this->input->post('itempaid');
                    $values = array(
                        'item_paid' => $ip
                    );

                    $this->event_model->update_budget($values, $id);
                    //redirect('event/edit_budget/'.$id);
                }
            }
            echo json_encode($data);
        } else {
            redirect('admin');
        }
    }

    /*
     * This function process the download of Member template excel file and Budget Template excel file
     */
    public function template($name){
        if ($name == 'member'){
            redirect(base_url('templates/MemberTemplate.xlsx'));
        } elseif ($name == 'budget') {
            redirect(base_url('templates/BudgetTemplate.xlsx'));
        }
    }

    /*
     * This is the test function to test the upload of the document
     */
    public function do_upload()
    {
        $config['upload_path']          = './upload/';
        $config['allowed_types']        = 'xls|xlsx';
        $config['max_size']             = 0;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('userfile'))
        {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('event/upload_view', $error);
        }
        else
        {
            echo  'hi';
            //$data = array('upload_data' => $this->upload->data());

            //$this->load->view('upload_success', $data);
        }
    }


    /* A function to retrieve respective data from database depends on the type of report to e generate
    */
    public function reports(){

        if(!empty($_POST['report_name']) ||!empty($_POST['event_id']) || !empty($this->session->admin_id) || !empty($this->session->event_id)) {

            $report_name=$_POST['report_name'];
            $event_id=$_POST['event_id'];

            if($report_name=='members'){


                $column_heads = array(
                    'member name' => 'member_name',
                    'member pledge' => 'member_pledge',
                    'member cash' => 'member_cash',
                    'member phone' => 'member_phone',
                );

                $member_details = $this->event_model->member_details($event_id);
                $this->download_excel_file($report_name,$member_details,$column_heads);

            }elseif ($report_name=='budget'){

                $column_heads = array(
                    'member name' => 'item_name',
                    'member pledge' => 'item_cost',
                    'member cash' => 'item_paid',
                );

                $budget_details = $this->event_model->budget_details($event_id);
                $this->download_excel_file($report_name,$budget_details,$column_heads);

            }elseif ($report_name=='pledge'){

                $column_heads = array(
                    'member name' => 'member_name',
                    'member pledge' => 'member_pledge',
                    'member cash' => 'member_cash',
                    'member phone' => 'member_phone',
                );

                $member_details = $this->event_model->member_details($event_id);
                $this->download_excel_file($report_name,$member_details,$column_heads);

            }elseif ($report_name=='income'){

                $column_heads = array(
                    'member name' => 'member_name',
                    'member pledge' => 'member_pledge',
                    'member cash' => 'member_cash',
                    'member phone' => 'member_phone',
                );

                $member_details = $this->event_model->member_details($event_id);
                $this->download_excel_file($report_name,$member_details,$column_heads);

            }elseif ($report_name=='expenses'){

                $column_heads = array(
                    'member name' => 'member_name',
                    'member pledge' => 'member_pledge',
                    'member cash' => 'member_cash',
                    'member phone' => 'member_phone',
                );

                $member_details = $this->event_model->member_details($event_id);
                $this->download_excel_file($report_name,$member_details,$column_heads);

            }


        }


    }



    /*
     * This is the function to down excel file using ajax , given report name and excel file data as input into the function
     */

    public function download_excel_file($report_name,$excel_data,$column_heads){

        //load the excel library
        $this->load->library('excel');



        // Creating a new workbook
        $objPHPExcel = new PHPExcel();
        // Set properties
        $objPHPExcel->getProperties()->setTitle($report_name)->setDescription("none");

        //activate worksheet number 1
        $objPHPExcel->setActiveSheetIndex(0);


        $col = 0;
        foreach ($column_heads as $field)
        {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
            $col++;
        }


        // Fetching the table data
        $row = 2;
        foreach($excel_data as $data)
        {
            $col = 0;
            foreach ($column_heads as $field)
            {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
                $col++;
            }

            $row++;
        }


        header('Content-Type: application/vnd.ms-excel');//mime type
        header('Content-Disposition: attachment;filename="Members.xls"');//tell browser what's the file name
        header('Cache-Control: max-age=0');//no cache


        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

        //force user to download the Excel file without writing it to server's HD
        ob_start();
        $objWriter->save("php://output");
        $xlsData = ob_get_contents();
        ob_end_clean();


        $response =  array(
            'report_name' => $report_name,
            'file' => "data:application/vnd.ms-excel;base64,".base64_encode($xlsData)
        );

        die(json_encode($response));


    }



}

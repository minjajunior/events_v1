<?php
/**
 * Created by PhpStorm.
 * User: d.felix
 * Date: 14/03/2017
 * Time: 21:57
 */



class Reports extends CI_Controller{


    /* A function to retrieve respective data from database depends on the type of report to e generate
*/
    public function excel_reports(){

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

                $member_details = $this->reports_model->member_details($event_id);
                $this->download_excel_file($report_name,$member_details,$column_heads);

            }elseif ($report_name=='budget'){

                $column_heads = array(
                    'member name' => 'item_name',
                    'member pledge' => 'item_cost',
                    'member cash' => 'item_paid',
                );

                $budget_details = $this->reports_model->budget_details($event_id);
                $this->download_excel_file($report_name,$budget_details,$column_heads);

            }elseif ($report_name=='pledge'){

                $column_heads = array(
                    'member name' => 'member_name',
                    'member pledge' => 'member_pledge',
                    'member cash' => 'member_cash',
                    'member phone' => 'member_phone',
                );

                $member_details = $this->reports_model->member_details($event_id);
                $this->download_excel_file($report_name,$member_details,$column_heads);

            }elseif ($report_name=='income'){

                $column_heads = array(
                    'member name' => 'member_name',
                    'member pledge' => 'member_pledge',
                    'member cash' => 'member_cash',
                    'member phone' => 'member_phone',
                );

                $member_details = $this->reports_model->member_details($event_id);
                $this->download_excel_file($report_name,$member_details,$column_heads);

            }elseif ($report_name=='expenses'){

                $column_heads = array(
                    'member name' => 'member_name',
                    'member pledge' => 'member_pledge',
                    'member cash' => 'member_cash',
                    'member phone' => 'member_phone',
                );

                $member_details = $this->reports_model->member_details($event_id);
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


    public function pdf_reports(){ ob_start();

        if(!empty($_POST['report_name']) ||!empty($_POST['event_id']) || !empty($this->session->admin_id) || !empty($this->session->event_id)) {

            $report_name=$_POST['report_name'];
            $event_id=$_POST['event_id'];
            $admin_id=$this->session->admin_id;

            if($report_name=='members'){

                $data['member_details'] = $this->reports_model->member_details($event_id);
                $data['event_details'] = $this->event_model->event_details($event_id);
                $data['admin_details'] = $this->admin_model->admin_details($admin_id);
                $data['report_name'] = 'Members Report';
                $pdf_name = $data['event_details'][0]->event_name."-".$data['report_name'];


                if(!isset($data['member_details']['error'])){

                    $data['pdf_h'] = $this->load->view('shared/pdf_h', $data, TRUE);
                    $html = $this->load->view('reports/members_pdf',$data,true);
                    $this->download_pdf($pdf_name,$html);

                }else{
                    $response =  array(
                        'success' => false,
                        'error' => $data['member_details']['error']
                    );
                    echo json_encode($response);

                }


            }elseif ($report_name=='budget'){


                $data['budget_details'] = $this->reports_model->budget_details($event_id);
                $data['event_details'] = $this->event_model->event_details($event_id);
                $data['admin_details'] = $this->admin_model->admin_details($admin_id);
                $data['report_name'] = 'Budget Report';
                $pdf_name = $data['event_details'][0]->event_name."-".$data['report_name'];

                if(!isset($data['budget_details']['error'])){
                    $data['pdf_h'] = $this->load->view('shared/pdf_h', $data, TRUE);
                    $html = $this->load->view('reports/budget_pdf',$data,true);
                    $this->download_pdf($pdf_name,$html);
                }else{
                    $response =  array(
                        'success' => false,
                        'error' => $data['budget_details']['error']
                    );
                    echo json_encode($response);

                }


            }elseif ($report_name=='less_pledge'){

                $data['member_details'] = $this->reports_model->less_pledges($event_id);
                $data['event_details'] = $this->event_model->event_details($event_id);
                $data['admin_details'] = $this->admin_model->admin_details($admin_id);
                $data['report_name'] = 'Members Report';
                $pdf_name = $data['event_details'][0]->event_name."-".$data['report_name'];

                if(!isset($data['member_details']['error'])){
                    $data['pdf_h'] = $this->load->view('shared/pdf_h', $data, TRUE);
                    $html = $this->load->view('reports/members_pdf',$data,true);
                    $this->download_pdf($pdf_name,$html);
                } else{
                    $response =  array(
                        'success' => false,
                        'error' => $data['member_details']['error']
                    );
                    echo json_encode($response);

                }


            }elseif ($report_name=='full_pledge'){

                $data['member_details'] = $this->reports_model->full_pledges($event_id);
                $data['event_details'] = $this->event_model->event_details($event_id);
                $data['admin_details'] = $this->admin_model->admin_details($admin_id);
                $data['report_name'] = 'Members Report';
                $pdf_name = $data['event_details'][0]->event_name."-".$data['report_name'];

                if(!isset($data['member_details']['error'])){
                    $data['pdf_h'] = $this->load->view('shared/pdf_h', $data, TRUE);
                    $html = $this->load->view('reports/members_pdf',$data,true);
                    $this->download_pdf($pdf_name,$html);
                } else{
                    $response =  array(
                        'success' => false,
                        'error' => $data['member_details']['error']
                    );
                    echo json_encode($response);

                }

            }elseif ($report_name=='member_cat'){
                $cat_id = $_POST['cat_id'];

                $data['member_details'] = $this->reports_model->get_members_group($event_id,$cat_id);
                $data['event_details'] = $this->event_model->event_details($event_id);
                $data['admin_details'] = $this->admin_model->admin_details($admin_id);
                $data['report_name'] = 'Members Report';
                $pdf_name = $data['event_details'][0]->event_name."-".$data['report_name'];

                if(!isset($data['member_details']['error'])){
                    $data['pdf_h'] = $this->load->view('shared/pdf_h', $data, TRUE);
                    $html = $this->load->view('reports/members_pdf',$data,true);
                    $this->download_pdf($pdf_name,$html);
                } else{
                    $response =  array(
                        'success' => false,
                        'error' => $data['member_details']['error']
                    );
                    echo json_encode($response);

                }

            }elseif ($report_name=='pledge_amounts'){

                $pledge_amount = $_POST['pl_amount'];
                $amount_type = $report_name;

                $data['member_details'] = $this->reports_model->get_members_amounts($amount_type,$pledge_amount,$event_id);
                $data['event_details'] = $this->event_model->event_details($event_id);
                $data['admin_details'] = $this->admin_model->admin_details($admin_id);
                $data['report_name'] = 'Budget Report';
                $pdf_name = $data['event_details'][0]->event_name."-".$data['report_name'];

                if(!isset($data['member_details']['error'])){
                    $data['pdf_h'] = $this->load->view('shared/pdf_h', $data, TRUE);
                    $html = $this->load->view('reports/members_pdf',$data,true);
                    $this->download_pdf($pdf_name,$html);
                } else{
                    $response =  array(
                        'success' => false,
                        'error' => $data['member_details']['error']
                    );
                    echo json_encode($response);

                }

            }elseif ($report_name=='paid_amounts'){
                $paid_amount = $_POST['p_amount'];
                $amount_type = $report_name;

                $data['member_details'] = $this->reports_model->get_members_amounts($amount_type,$paid_amount,$event_id);
                $data['event_details'] = $this->event_model->event_details($event_id);
                $data['admin_details'] = $this->admin_model->admin_details($admin_id);
                $data['report_name'] = 'Budget Report';
                $pdf_name = $data['event_details'][0]->event_name."-".$data['report_name'];

                if(!isset($data['member_details']['error'])){
                    $data['pdf_h'] = $this->load->view('shared/pdf_h', $data, TRUE);
                    $html = $this->load->view('reports/members_pdf',$data,true);
                    $this->download_pdf($pdf_name,$html);
                } else{
                    $response =  array(
                        'success' => false,
                        'error' => $data['member_details']['error']
                    );
                    echo json_encode($response);

                }

            }elseif ($report_name=='income'){

                $data['budget_details'] = $this->reports_model->budget_details($event_id);
                $data['event_details'] = $this->event_model->event_details($event_id);
                $data['admin_details'] = $this->admin_model->admin_details($admin_id);
                $data['report_name'] = 'Budget Report';
                $pdf_name = $data['event_details'][0]->event_name."-".$data['report_name'];

                $data['pdf_h'] = $this->load->view('shared/pdf_h', $data, TRUE);
                $html = $this->load->view('reports/income_pdf',$data,true);

                $this->download_pdf($pdf_name,$html);

            }elseif ($report_name=='expenses'){

                $data['budget_details'] = $this->reports_model->budget_details($event_id);
                $data['event_details'] = $this->event_model->event_details($event_id);
                $data['admin_details'] = $this->admin_model->admin_details($admin_id);
                $data['report_name'] = 'Budget Report';
                $pdf_name = $data['event_details'][0]->event_name."-".$data['report_name'];

                $data['pdf_h'] = $this->load->view('shared/pdf_h', $data, TRUE);
                $html = $this->load->view('reports/budget_pdf',$data,true);

                $this->download_pdf($pdf_name,$html);

            }


        }




    }



    public function  download_pdf($file_name,$html_view){

        $file_name = $file_name.".pdf";

        header("Content-Type: application/pdf");//mime type
        header("Content-Disposition: attachment;filename=".$file_name); //tell browser what's the file name
        header('Cache-Control: max-age=0');//no cache

        //load the PDF library
        $this->load->library('m_pdf');

        $dtz = new DateTimeZone("Africa/Dar_es_Salaam"); //Your timezone
        $now = new DateTime(date("Y-m-d"), $dtz);
        $print_date = $now->format("Y-m-d H:i:s");

        //$this->m_pdf->pdf->SetHTMLHeader('<img class="pull-right" src="' . base_url() . 'assets/images/demi.png">');
        //$this->m_pdf->pdf->SetHTMLHeader($pdf_h);
        $this->m_pdf->pdf->SetHTMLFooter('
            <table  width="100%" style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-weight: bold; font-style: italic; padding-bottom: 10px">
                <tr><td width="33%"><span style="font-weight: bold; font-style: italic;">Tel: +255 712 431242/+255 752 934547</span></td></tr>
                <tr><td width="33%"><span style="font-weight: bold; font-style: italic;">Email: info@demi.co.tz</span></td></tr>
                <tr>
                    <td width="33%"><span style="font-weight: bold; font-style: italic;"></span>Website: www.demievents.co.tz</td>
                    <td width="33%" align="center" style="font-weight: bold; font-style: italic;">{PAGENO}/{nbpg}</td>
                    <td width="33%" style="text-align: right; ">Printed on: {DATE j-m-Y}</td>
                </tr>
            </table>
            ');


        $this->m_pdf->pdf->AddPage('', // L - landscape, P - portrait
            '', '', '', '',
            0, // margin_left
            0, // margin right
            10, // margin top
            10, // margin bottom
            0, // margin header
            0); // margin footer


        //generate the PDF from the given html
        $this->m_pdf->pdf->WriteHTML($html_view);


        //force user to download the PDF file without writing it to server's HD
        ob_start();
        $this->m_pdf->pdf->Output($file_name, "I"); //download it.
        $pdfData = ob_get_contents();
        ob_end_clean();

        $response =  array(
            'success'=>true,
            'report_name' => $file_name,
            'file' => "data:application/pdf;base64,".base64_encode($pdfData)
        );

       echo json_encode($response);
    }

    public function test(){
        $id=1;
        $budget_details = $this->event_model->budget_details($id);
        //$temp_array = get_object_vars($budget_details);
        print_r($budget_details);

        if(gettype($budget_details[0]->var1->var2) == "Venue"){
            echo "Present";
        }

        if(in_array( "Venue", $budget_details )){
            echo 'TRUE';
        }else{
            echo 'FALSE';
        }
}






}
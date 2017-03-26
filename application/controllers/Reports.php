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


    public function pdf_reports(){

        if(!empty($_POST['report_name']) ||!empty($_POST['event_id']) || !empty($this->session->admin_id) || !empty($this->session->event_id)) {

            $report_name=$_POST['report_name'];
            $event_id=$_POST['event_id'];

            if($report_name=='members'){

                $data['member_details'] = $this->reports_model->member_details($event_id);
                $html = $this->load->view('reports/members_pdf',$data,true);

                $this->download_pdf($report_name,$html);

            }elseif ($report_name=='budget'){

                $data['budget_details'] = $this->reports_model->budget_details($event_id);
                $html = $this->load->view('reports/budget_pdf',$data,true);

                $this->download_pdf($report_name,$html);

            }elseif ($report_name=='less_pledge'){

                $data['member_details'] = $this->reports_model->less_pledges($event_id);

                $html = $this->load->view('reports/members_pdf',$data,true);

                $this->download_pdf($report_name,$html);

            }elseif ($report_name=='member_cat'){
                $cat_id = $_POST['cat_id'];

                $data['member_details'] = $this->reports_model->get_members_categories($event_id,$cat_id);

                $html = $this->load->view('reports/members_pdf',$data,true);

                $this->download_pdf($report_name,$html);

            }elseif ($report_name=='member_amounts'){
                $paid_amount = $_POST['p_amount'];
                $pledge_amount = $_POST['pl_amount'];

                $data['member_details'] = $this->reports_model->get_members_amounts($paid_amount,$pledge_amount,$event_id);

                $html = $this->load->view('reports/members_pdf',$data,true);

                $this->download_pdf($report_name,$html);

            }elseif ($report_name=='income'){

                $data['budget_details'] = $this->reports_model->budget_details($event_id);
                $html = $this->load->view('reports/income_pdf',$data,true);

                $this->download_pdf($report_name,$html);

            }elseif ($report_name=='expenses'){

                $data['budget_details'] = $this->reports_model->budget_details($event_id);
                $html = $this->load->view('reports/budget_pdf',$data,true);

                $this->download_pdf($report_name,$html);

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

        $this->m_pdf->pdf->SetHTMLHeader('<div style="text-align: right; font-weight: bold;">My document</div>');

        $this->m_pdf->pdf->SetHTMLFooter('<table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-weight: bold; font-style: italic;"><tr><td width="33%"><span style="font-weight: bold; font-style: italic;">{DATE j-m-Y}</span></td><td width="33%" align="center" style="font-weight: bold; font-style: italic;">{PAGENO}/{nbpg}</td><td width="33%" style="text-align: right; ">My document</td></tr></table>');


        //generate the PDF from the given html
        $this->m_pdf->pdf->WriteHTML($html_view);


        //force user to download the PDF file without writing it to server's HD
        ob_start();
        $this->m_pdf->pdf->Output($file_name, "I"); //download it.
        $pdfData = ob_get_contents();
        ob_end_clean();

        $response =  array(
            'report_name' => $file_name,
            'file' => "data:application/pdf;base64,".base64_encode($pdfData)
        );

        die(json_encode($response));
    }

    public function test(){
        $this->load->view('reports/income_pdf');
}






}
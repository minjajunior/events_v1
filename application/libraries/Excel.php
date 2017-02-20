<?php
/**
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 11/22/2016
 * Time: 1:27 PM
 */?>
<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH."/third_party/PHPExcel.php";
class Excel extends PHPExcel {
    public function __construct() {
        parent::__construct();
    }
}

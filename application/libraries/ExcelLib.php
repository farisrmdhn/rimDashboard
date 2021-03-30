<?php
require_once APPPATH."/third_party/PHPExcel.php";
class ExcelLib extends PHPExcel {
   public function __construct() {
      parent::__construct();
   }
}

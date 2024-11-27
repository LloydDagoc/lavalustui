<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');


class ExamController extends Controller {
    public function __construct() {
        parent::__construct();
    }
    public function index() {
        $this->call->view('exam-management');
    }
}
?>
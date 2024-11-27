<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

// app/controllers/UserController.php
class UserController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    // This method will fetch and display logged-in students
    public function showLoggedInStudents() {
        // Connect to the database
        $db = \Config\Database::connect();

        // Query to fetch students who are logged in (login_status = 1)
        $query = $db->query('SELECT * FROM students WHERE login_status = 1');
        
        // Fetch the results as an array
        $students = $query->getResultArray();

        // Pass the student data to the view
        $this->call->view('admin/dashboard', ['students' => $students]);
    }

    // Default index method
    public function index() {
        $this->call->view('user-management');
    }
}

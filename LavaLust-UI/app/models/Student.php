<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
// app/models/Student.php
class Student extends Model {
    protected $table = 'students';

    public function getLoggedInStudents() {
        // SQL query to select students with login_status set to 1 (logged in)
        $sql = "SELECT * FROM $this->table WHERE login_status = 1";
        return $this->query($sql)->fetchAll();
    }
}

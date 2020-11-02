<?php

require 'Models/Bill.php';

class BillController
{
    private $model;

    public function __construct()
    {
        $this->model = new Bill;
    }

    public function index()
    {
        require 'Views/Layout.php';
        $bills = $this->model->getAll();
        require 'Views/Bills/list.php';
        require 'Views/Scripts.php';
    }

    public function import()
    {
        if (isset($_POST['import_data'])) {
            // validate to check uploaded file is a valid csv file
            $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
            if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $file_mimes)) {
                if (is_uploaded_file($_FILES['file']['tmp_name'])) {
                    $csv_file = fopen($_FILES['file']['tmp_name'], 'r');
                    //fgetcsv($csv_file);            
                    // get data records from csv file
                    while (($emp_record = fgetcsv($csv_file)) !== FALSE) {
                        // Check if employee already exists with same email
                        echo '<pre>';
                        var_dump($emp_record);
                        echo '</pre>';
                        echo '<hr>';
                        $data = $this->model->getByNum($emp_record);
                        var_dump($data);
                        //$sql_query = "SELECT emp_id, emp_name, emp_salary, emp_age FROM emp WHERE emp_email = '".$emp_record[2]."'";
                        //$resultset = mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));
                        if(!empty($data) ) {
                            // if employee already exist then update details otherwise insert new record
                            //$sql_update = "UPDATE emp set emp_name='".$emp_record[1]."', emp_salary='".$emp_record[3]."', emp_age='".$emp_record[4]."' WHERE emp_email = '".$emp_record[2]."'";
                            //mysqli_query($conn, $sql_update) or die("database error:". mysqli_error($conn));
                            $this->model->updateBill($emp_record);
                        } else{
                            $this->model->newBill($emp_record);
                            // $mysql_insert = "INSERT INTO emp (emp_name, emp_email, emp_salary, emp_age )VALUES('".$emp_record[1]."', '".$emp_record[2]."', '".$emp_record[3]."', '".$emp_record[4]."')";
                            // mysqli_query($conn, $mysql_insert) or die("database error:". mysqli_error($conn));
                        }
                    }
                    fclose($csv_file);
                    $import_status = '?import_status=success';
                }
            } else {
                $import_status = '?import_status=error';
            }
        } else {
            $import_status = '?import_status=invalid_file';
        }
        header('Location: ?controller=bill');
    }
}
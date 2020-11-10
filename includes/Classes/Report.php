<?php
  require_once('./includes/Classes/Database.php');
  
  class Report extends Database{

    // Generic select function
    function select($table, $columns, $conditions='1'){
        $sql = "SELECT $columns FROM $table ";
        if(isset($conditions)){
            $sql .= " WHERE $conditions";
        }

        return $sql;
    }

    // Generic insert function
    function insert($table, $columns, $values){
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        return $sql;
    }

    // Generic delete function
    function delete($table, $condition){
        $sql = "DELETE FROM $table WHERE $condition";
        return $sql;
    }

    // Generic update function
    function update($table, $columns, $condition){
        $sql = "UPDATE $table SET ".implode(',', $columns);
        $sql .= " WHERE $condition";
        return $sql;
    }


    // Validating report form
    function validate_report($report_details){
        $errors = [];
        
        if(empty($report_details['report_date']) || !isset($report_details['report_date'])){
            $errors['report_date'] = 'This field is required';
        }

        if(empty($report_details['title']) || !isset($report_details['title'])){
            $errors['title'] = 'This field is required';
        }

        return $errors;
    }
  }

?>
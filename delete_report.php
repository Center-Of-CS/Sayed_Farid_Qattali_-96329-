<?php

// setting page title 
$page_title = 'Delete Report';

// Header
include_once('./includes/header.php');

// Report class
require_once('./includes/Classes/Report.php');

// instatiating a report
$report = new Report();
$db = $report->connect();
$id = htmlentities($_GET['id']);

// show selected report for deleting
$table = 'report';
$columns = '*';
$conditions = 'id=:id';
$sql = $report->select($table, $columns, $conditions);
$stmt = $db->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();
$stmt->bindColumn('title', $title);
$stmt->fetch();

// if request is post, delete report
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['id'];
    $table = 'report';
    $condition = 'id=:id';
    $sql = $report->delete($table, $condition);
    $stmt =$db->prepare($sql);
    $stmt->bindParam(':id', $id);
    if($stmt->execute()){
        header('location: view_report.php');
    }

}
?>


<header class="bg-light mt-5 pt-3">
    <div class="container">
        <div class="row py-3">
            <!--add post modal-->
            <div class="col-md-3">
                <a href="view_report.php" class="btn btn-info btn-block"><i class="fa fa-angle-left"></i> Back To Home</a>

            </div>

        </div>
    </div>

</header>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h5>Delete Report</h5>
        </div>
        <div class="card-body">
            <div class="container">
            <p>Are you sure you want to delete the following report?</p>
            <h6><?php echo $title; ?></h6>
            </div>
            <!-- New Report form starts -->
    <form action="delete_report.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="row">
        <div class="mb-3 col-md-3 px-5">
                <label for="">&nbsp;</label>
                <input type="submit" value="Delete" class="btn btn-danger btn-block">
            </div>
        </div>
    </form>
    <!-- New Report form ends -->
        </div>
    </div>
    
</div>

<?php
// Footer
include_once('./includes/footer.php');
?>
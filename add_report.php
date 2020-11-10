<?php

// setting page title 
$page_title = 'New Report';

// Header
include_once('./includes/header.php');

// Report class
require_once('./includes/Classes/Report.php');

// instatiating a report 
$report = new Report();
$db = $report->connect();
$errors = [];

// check if it is post method gather form data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $report_details = [];
    $report_details['report_date'] = $_POST['report_date'] ?? '';
    $report_details['title'] = $_POST['title'] ?? '';
    $report_details['description'] = $_POST['description'] ?? '';

    // if no error insert report
    if (empty($report->validate_report($report_details))) {
        $table = 'report';
        $columns = 'report_date, title, description';
        $values = ':report_date, :title, :description';
        $sql = $report->insert($table, $columns, $values);
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':report_date', $report_details['report_date']);
        $stmt->bindParam(':title', $report_details['title']);
        $stmt->bindParam(':description', $report_details['description']);

        if ($stmt->execute()) {
            $_SESSION['message'] = 'Report was added successfully!';
            header('location:view_report.php');
        }
    } else {
        $errors = $report->validate_report($report_details);
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
    <!-- New Report form starts -->
    <div class="card">
        <div class="card-header">Add New Report</div>
        <div class="card-body">
            <form action="add_report.php" method="POST" novalidate>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="report_date">Date</label>
                        <input type="date" class="form-control" name="report_date" id="report_date" value="<?php echo $report_details['report_date'] ?? ''; ?>" required>
                        <span class="text-danger"><?php echo $errors['report_date'] ?? ''; ?></span>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="<?php echo $report_details['title'] ?? ''; ?>" required>
                        <span class="text-danger"><?php echo $errors['title'] ?? ''; ?></span>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" name="description" id="description" placeholder="Description" value="<?php echo $report_details['description'] ?? ''; ?>" required>
                    </div>
                    <div class="mb-3 col-md-3">
                        <label for="">&nbsp;</label>
                        <input type="submit" value="Submit" class="btn btn-primary btn-block">
                    </div>
                </div>


            </form>
        </div>
    </div>
    <!-- New Report form ends -->

</div>

<?php
// Footer
include_once('./includes/footer.php');
?>
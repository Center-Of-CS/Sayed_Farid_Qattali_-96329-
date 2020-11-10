<?php

// setting page title 
$page_title = 'Reports';

// Header
include_once('./includes/header.php');

// Report class
require_once('./includes/Classes/Report.php');

// instatiating a report
$report = new Report();
$db = $report->connect();
// check if it is post method gather form data
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $table = 'report';
    $columns = '*';
    $sql = $report->select($table, $columns);
    $stmt = $db->prepare($sql);

    $stmt->execute();
    $count = $stmt->rowCount();
}
?>

<header class="bg-light mt-5 pt-3">
    <div class="container">
        <div class="row py-3">
            <!--add post modal-->
            <div class="col-md-3">
                <a href="add_report.php" class="btn btn-success btn-block"><i class="fa fa-plus"></i> Add Report</a>

            </div>
        </div>
    </div>

</header>
<div class="container mt-5 pt-5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>All Reports</h5>
            </div>
            <table class="table">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($count > 0) :
                        $counter = 1;
                        while ($reports = $stmt->fetch()) :
                    ?>
                            <tr>
                                <td><?php echo $counter; ?></td>
                                <td><?php echo $reports['report_date']; ?></td>
                                <td><?php echo $reports['title']; ?></td>
                                <td><?php echo $reports['description']; ?></td>
                                <td>
                                    <a href="update_report.php?id=<?php echo $reports['id']; ?>" class="btn btn-outline-primary">Update</a>
                                    <a href="delete_report.php?id=<?php echo $reports['id']; ?>" class="btn btn-outline-danger">Delete</a>
                                </td>

                            </tr>
                        <?php
                            $counter++;
                        endwhile;
                    else :
                        ?>
                        <tr>
                            <td colspan="5" class="text-center">No report</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
// Footer
include_once('./includes/footer.php');
?>
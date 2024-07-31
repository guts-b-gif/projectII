<?php
$page_title = 'Supplier Report';
require_once('includes/load.php');
page_require_level(2);

// Initialize suppliers array
$suppliers = [];

// Check if the form is submitted
if (isset($_POST['submit'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $suppliers = find_suppliers_by_date_range($start_date, $end_date);
}
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Supplier Report</span>
        </strong>
        <div class="pull-right">
          <form class="form-inline" method="post" action="supplier_report.php">
            <div class="form-group">
              <label for="start_date">From</label>
              <input type="date" class="form-control" name="start_date" required>
            </div>
            <div class="form-group">
              <label for="end_date">To</label>
              <input type="date" class="form-control" name="end_date" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Generate Report</button>
          </form>
        </div>
      </div>
      <div class="panel-body">
        <?php if ($suppliers): ?>
        <div class="clearfix">
          <button onclick="window.print();" class="btn btn-primary pull-right">Print</button>
        </div>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th class="text-center" style="width: 50px;">#</th>
              <th> Supplier Name </th>
              <th> Contact Person </th>
              <th> Phone Number </th>
              <th> Email </th>
              <th> Address </th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($suppliers as $supplier): ?>
              <tr>
                <td class="text-center"><?php echo count_id(); ?></td>
                <td> <?php echo remove_junk($supplier['name']); ?></td>
                <td> <?php echo remove_junk($supplier['contact_person']); ?></td>
                <td> <?php echo remove_junk($supplier['phone']); ?></td>
                <td> <?php echo remove_junk($supplier['email']); ?></td>
                <td> <?php echo remove_junk($supplier['address']); ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <?php else: ?>
        <p>No suppliers found for the selected date range.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<?php include_once('layouts/footer.php'); ?>

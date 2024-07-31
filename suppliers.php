<?php
$page_title = 'Manage Suppliers';
require_once('includes/load.php');
page_require_level(2);

// Fetch all suppliers
$suppliers = find_all('suppliers');
?>
<?php include_once('layouts/header.php'); ?>

<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <div class="pull-right">
          <a href="add_supplier.php" class="btn btn-primary">Add New Supplier</a>
        </div>
      </div>
      <div class="panel-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th class="text-center" style="width: 50px;">#</th>
              <th>Name</th>
              <th>Contact Person</th>
              <th>Phone</th>
              <th>Email</th>
              <th>Status</th>
              <th class="text-center" style="width: 100px;">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($suppliers as $supplier): ?>
            <tr>
              <td class="text-center"><?php echo $supplier['id']; ?></td>
              <td><?php echo remove_junk($supplier['name']); ?></td>
              <td><?php echo remove_junk($supplier['contact_person']); ?></td>
              <td><?php echo remove_junk($supplier['phone']); ?></td>
              <td><?php echo remove_junk($supplier['email']); ?></td>
              <td><?php echo remove_junk($supplier['status']); ?></td>
              <td class="text-center">
                <div class="btn-group">
                  <a href="edit_supplier.php?id=<?php echo (int)$supplier['id'];?>" class="btn btn-info btn-xs" title="Edit" data-toggle="tooltip">
                    <span class="glyphicon glyphicon-edit"></span>
                  </a>
                  <a href="delete_supplier.php?id=<?php echo (int)$supplier['id'];?>" class="btn btn-danger btn-xs" title="Delete" data-toggle="tooltip">
                    <span class="glyphicon glyphicon-trash"></span>
                  </a>
                </div>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>

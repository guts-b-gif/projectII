<?php
$page_title = 'Manage Inventory';
require_once('includes/load.php');
page_require_level(2);

$inventories = join_inventory_table();

if ($inventories === false) {
    $msg = "Failed to retrieve inventory data.";
} else {
    // Proceed with displaying data
}
?>
<?php include_once('layouts/header.php'); ?>
  <div class="row">
    <div class="col-md-12">
      <?php echo isset($msg) ? display_msg($msg) : ''; ?>
    </div>
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <div class="pull-right">
            <a href="add_inventory.php" class="btn btn-primary">Add New</a>
          </div>
        </div>
        <div class="panel-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th>Product Name</th>
                <th class="text-center" style="width: 10%;">Quantity</th>
                <th class="text-center" style="width: 10%;">Buying Price</th>
                <th class="text-center" style="width: 10%;">Selling Price</th>
                <th class="text-center" style="width: 10%;">Date Added</th>
                <th class="text-center" style="width: 100px;">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($inventories)): ?>
                <?php foreach ($inventories as $inventory): ?>
                <tr>
                  <td class="text-center"><?php echo $inventory['id']; ?></td>
                  <td><?php echo remove_junk($inventory['product_name']); ?></td>
                  <td class="text-center"><?php echo remove_junk($inventory['quantity']); ?></td>
                  <td class="text-center"><?php echo remove_junk($inventory['buy_price']); ?></td>
                  <td class="text-center"><?php echo remove_junk($inventory['sale_price']); ?></td>
                  <td class="text-center"><?php echo read_date($inventory['date_added']); ?></td>
                  <td class="text-center">
                    <div class="btn-group">
                      <a href="edit_inventory.php?id=<?php echo (int)$inventory['id'];?>" class="btn btn-info btn-xs"  title="Edit" data-toggle="tooltip">
                        <span class="glyphicon glyphicon-edit"></span>
                      </a>
                      <a href="delete_inventory.php?id=<?php echo (int)$inventory['id'];?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                        <span class="glyphicon glyphicon-trash"></span>
                      </a>
                    </div>
                  </td>
                </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="7" class="text-center">No inventory records found.</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
<?php include_once('layouts/footer.php'); ?>

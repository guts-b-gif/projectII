<?php
$page_title = 'Inventory Report';
require_once('includes/load.php');
page_require_level(2);

// Fetch inventory data
$inventories = join_inventory_table(); // Ensure this function is defined and works correctly
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
            <button class="btn btn-primary" onclick="printReport()">Print Report</button>
          </div>
        </div>
        <div class="panel-body">
          <table class="table table-bordered" id="inventoryTable">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th>Product</th>
                <th class="text-center" style="width: 10%;">Quantity</th>
                <th class="text-center" style="width: 10%;">Buying Price</th>
                <th class="text-center" style="width: 10%;">Selling Price</th>
                <th class="text-center" style="width: 15%;">Date Added</th>
                <th class="text-center" style="width: 10%;">Status</th>
              </tr>
            </thead>
            <tbody>
              <?php if($inventories): ?>
                <?php foreach ($inventories as $inventory): ?>
                <tr>
                  <td class="text-center"><?php echo $inventory['id']; ?></td>
                  <td><?php echo remove_junk($inventory['product_name']); ?></td>
                  <td class="text-center"><?php echo remove_junk($inventory['quantity']); ?></td>
                  <td class="text-center"><?php echo remove_junk($inventory['buy_price']); ?></td>
                  <td class="text-center"><?php echo remove_junk($inventory['sale_price']); ?></td>
                  <td class="text-center"><?php echo read_date($inventory['date_added']); ?></td>
                  <td class="text-center"><?php echo remove_junk($inventory['status']); ?></td>
                </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="7" class="text-center">No Inventory Data Available</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <script>
    function printReport() {
      var printWindow = window.open('', '', 'height=600,width=800');
      var content = document.getElementById('inventoryTable').outerHTML;
      printWindow.document.write('<html><head><title>Inventory Report</title>');
      printWindow.document.write('<link rel="stylesheet" type="text/css" href="path/to/your/bootstrap.css">'); 
      printWindow.document.write('</head><body >');
      printWindow.document.write(content);
      printWindow.document.write('</body></html>');
      printWindow.document.close();
      printWindow.focus();
      printWindow.print();
    }
  </script>

<?php include_once('layouts/footer.php'); ?>

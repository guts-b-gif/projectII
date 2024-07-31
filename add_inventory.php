<?php
$page_title = 'Add Inventory';
require_once('includes/load.php');
page_require_level(2);

if(isset($_POST['add_inventory'])){
    $req_fields = array('product_id', 'quantity', 'buy_price', 'sale_price');
    validate_fields($req_fields);

    if(empty($errors)){
        $product_id  = remove_junk($db->escape($_POST['product_id']));
        $quantity    = remove_junk($db->escape($_POST['quantity']));
        $buy_price   = remove_junk($db->escape($_POST['buy_price']));
        $sale_price  = remove_junk($db->escape($_POST['sale_price']));
        $status      = remove_junk($db->escape($_POST['status']));

        $sql  = "INSERT INTO inventory (product_id, quantity, buy_price, sale_price, status)";
        $sql .= " VALUES ('{$product_id}', '{$quantity}', '{$buy_price}', '{$sale_price}', '{$status}')";
        
        if($db->query($sql)){
            $session->msg('s', "Inventory added successfully.");
            redirect('inventory.php', false);
        } else {
            $session->msg('d', 'Failed to add inventory.');
            redirect('add_inventory.php', false);
        }
    } else {
        $session->msg("d", $errors);
        redirect('add_inventory.php', false);
    }
}
?>
<?php include_once('layouts/header.php'); ?>
  <div class="row">
    <div class="col-md-12">
      <?php echo display_msg($msg); ?>
    </div>
    <div class="col-md-8">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>Add New Inventory</strong>
        </div>
        <div class="panel-body">
          <form method="post" action="add_inventory.php" class="clearfix">
            <div class="form-group">
              <label for="product_id">Product</label>
              <select class="form-control" name="product_id" required>
                <?php
                // Fetch and display products for the dropdown
                $products = join_product_table(); // Ensure this function is defined and works correctly
                foreach ($products as $product):
                ?>
                <option value="<?php echo (int)$product['id']; ?>">
                  <?php echo remove_junk($product['name']); ?>
                </option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="quantity">Quantity</label>
              <input type="number" class="form-control" name="quantity" placeholder="Enter quantity" required>
            </div>
            <div class="form-group">
              <label for="buy_price">Buying Price</label>
              <input type="text" class="form-control" name="buy_price" placeholder="Enter buying price" required>
            </div>
            <div class="form-group">
              <label for="sale_price">Selling Price</label>
              <input type="text" class="form-control" name="sale_price" placeholder="Enter selling price" required>
            </div>
            <div class="form-group">
              <label for="status">Status</label>
              <select class="form-control" name="status">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
              </select>
            </div>
            <button type="submit" name="add_inventory" class="btn btn-primary">Add Inventory</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php include_once('layouts/footer.php'); ?>

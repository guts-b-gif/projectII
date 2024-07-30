<?php
$page_title = 'Add Order';
require_once('includes/load.php');
page_require_level(2);

// If the form is submitted
if(isset($_POST['add_order'])){
  $req_fields = array('customer_name', 'product_name', 'quantity', 'total_price');
  validate_fields($req_fields);
  
  if(empty($errors)){
    $customer_name  = remove_junk($db->escape($_POST['customer_name']));
    $product_name   = remove_junk($db->escape($_POST['product_name']));
    $quantity       = remove_junk($db->escape((int)$_POST['quantity']));
    $total_price    = remove_junk($db->escape($_POST['total_price']));
    $order_date     = make_date();

    $query  = "INSERT INTO orders (";
    $query .= " customer_name, product_name, quantity, total_price, order_date";
    $query .= ") VALUES (";
    $query .= " '{$customer_name}', '{$product_name}', {$quantity}, '{$total_price}', '{$order_date}'";
    $query .= ")";
    
    if($db->query($query)){
      $session->msg('s', "Order added ");
      redirect('add_order.php', false);
    } else {
      $session->msg('d', ' Sorry failed to add order!');
      redirect('add_order.php', false);
    }
  } else{
    $session->msg("d", $errors);
    redirect('add_order.php',false);
  }
}
?>

<?php include_once('layouts/header.php'); ?>

<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Add New Order</span>
       </strong>
      </div>
      <div class="panel-body">
        <form method="post" action="add_order.php">
          <div class="form-group">
              <label for="customer_name">Customer Name</label>
              <input type="text" class="form-control" name="customer_name" placeholder="Customer Name">
          </div>
          <div class="form-group">
              <label for="product_name">Product Name</label>
              <input type="text" class="form-control" name="product_name" placeholder="Product Name">
          </div>
          <div class="form-group">
              <label for="quantity">Quantity</label>
              <input type="number" class="form-control" name="quantity" placeholder="Quantity">
          </div>
          <div class="form-group">
              <label for="total_price">Total Price</label>
              <input type="text" class="form-control" name="total_price" placeholder="Total Price">
          </div>
          <button type="submit" name="add_order" class="btn btn-primary">Add Order</button>
      </form>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>

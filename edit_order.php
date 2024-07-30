<?php
$page_title = 'Edit Order';
require_once('includes/load.php');
// Check what level user has permission to view this page
page_require_level(2);

if(isset($_GET['id'])){
  $order_id = (int)$_GET['id'];
  $order = find_by_id('orders', $order_id);
  if(!$order){
    $session->msg("d","Missing order id.");
    redirect('orders.php');
  }
} else {
  $session->msg("d","Missing order id.");
  redirect('orders.php');
}

if(isset($_POST['update_order'])){
  $req_fields = array('customer_name', 'product_name', 'quantity', 'total_price', 'status');
  validate_fields($req_fields);

  if(empty($errors)){
    $customer_name  = remove_junk($db->escape($_POST['customer_name']));
    $product_name   = remove_junk($db->escape($_POST['product_name']));
    $quantity       = (int)$_POST['quantity'];
    $total_price    = remove_junk($db->escape($_POST['total_price']));
    $status         = remove_junk($db->escape($_POST['status']));

    $query  = "UPDATE orders SET ";
    $query .= "customer_name='{$customer_name}', product_name='{$product_name}', ";
    $query .= "quantity={$quantity}, total_price='{$total_price}', status='{$status}' ";
    $query .= "WHERE id={$order_id}";

    if($db->query($query)){
      $session->msg('s',"Order updated ");
      redirect('edit_order.php?id='.(int)$order['id'], false);
    } else {
      $session->msg('d',' Sorry failed to update order!');
      redirect('edit_order.php?id='.(int)$order['id'], false);
    }
  } else{
    $session->msg("d", $errors);
    redirect('edit_order.php?id='.(int)$order['id'], false);
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
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Editing Order #<?php echo (int)$order['id'];?></span>
        </strong>
      </div>
      <div class="panel-body">
         <form method="post" action="edit_order.php?id=<?php echo (int)$order['id'];?>">
          <div class="form-group">
              <label for="customer_name">Customer Name</label>
              <input type="text" class="form-control" name="customer_name" value="<?php echo remove_junk($order['customer_name']); ?>">
          </div>
          <div class="form-group">
              <label for="product_name">Product Name</label>
              <input type="text" class="form-control" name="product_name" value="<?php echo remove_junk($order['product_name']); ?>">
          </div>
          <div class="form-group">
              <label for="quantity">Quantity</label>
              <input type="number" class="form-control" name="quantity" value="<?php echo (int)$order['quantity']; ?>">
          </div>
          <div class="form-group">
              <label for="total_price">Total Price</label>
              <input type="text" class="form-control" name="total_price" value="<?php echo remove_junk($order['total_price']); ?>">
          </div>
          <div class="form-group">
              <label for="status">Status</label>
              <select class="form-control" name="status">
                <option value="Pending" <?php if($order['status'] === 'Pending') echo 'selected'; ?>>Pending</option>
                <option value="Processing" <?php if($order['status'] === 'Processing') echo 'selected'; ?>>Processing</option>
                <option value="Completed" <?php if($order['status'] === 'Completed') echo 'selected'; ?>>Completed</option>
                <option value="Cancelled" <?php if($order['status'] === 'Cancelled') echo 'selected'; ?>>Cancelled</option>
              </select>
          </div>
          <div class="form-group clearfix">
            <button type="submit" name="update_order" class="btn btn-info">Update Order</button>
          </div>
      </form>
      </div>
    </div>
  </div>
</div>
<?php include_once('layouts/footer.php'); ?>

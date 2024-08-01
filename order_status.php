<?php
$page_title = 'Order Status';
require_once('includes/load.php');
page_require_level(2); 
$orders = join_orders_table();
<?php include_once('layouts/header.php'); ?>
<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
       <div class="pull-right">
         <a href="add_order.php" class="btn btn-primary">Add New</a>
       </div>
      </div>
      <div class="panel-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th class="text-center" style="width: 50px;">#</th>
              <th> Customer Name </th>
              <th> Product Name </th>
              <th class="text-center" style="width: 10%;"> Quantity </th>
              <th class="text-center" style="width: 10%;"> Total Price </th>
              <th class="text-center" style="width: 10%;"> Order Date </th>
              <th class="text-center" style="width: 10%;"> Status </th>
              <th class="text-center" style="width: 100px;"> Actions </th>
            </tr>
          </thead>
          <tbody>
            <?php if(is_array($orders)): ?>
              <?php foreach ($orders as $order): ?>
              <tr>
                <td class="text-center"><?php echo count_id(); ?></td>
                <td> <?php echo remove_junk($order['customer_name']); ?></td>
                <td> <?php echo remove_junk($order['product_name']); ?></td>
                <td class="text-center"> <?php echo (int)$order['quantity']; ?></td>
                <td class="text-center"> <?php echo remove_junk($order['total_price']); ?></td>
                <td class="text-center"> <?php echo read_date($order['order_date']); ?></td>
                <td class="text-center"> <?php echo remove_junk($order['status']); ?></td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_order.php?id=<?php echo (int)$order['id'];?>" class="btn btn-info btn-xs"  title="Edit" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                    <a href="delete_order.php?id=<?php echo (int)$order['id'];?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
                  </div>
                </td>
              </tr>
             <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="8">No orders found.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php include_once('layouts/footer.php'); ?>

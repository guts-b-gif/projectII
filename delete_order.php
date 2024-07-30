<?php
require_once('includes/load.php');
page_require_level(2);

if(isset($_GET['id'])){
  $order_id = (int)$_GET['id'];
  $delete_id = delete_by_id('orders', $order_id);

  if($delete_id){
    $session->msg("s","Order deleted.");
    redirect('orders.php');
  } else {
    $session->msg("d","Order deletion failed.");
    redirect('orders.php');
  }
} else {
  $session->msg("d","Missing order id.");
  redirect('orders.php');
}
?>

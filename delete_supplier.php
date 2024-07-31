<?php
require_once('includes/load.php');
page_require_level(2);

$supplier_id = (int)$_GET['id'];
if(!$supplier_id){
  $session->msg("d", "Missing supplier id.");
  redirect('suppliers.php');
}

$supplier = find_by_id('suppliers', $supplier_id);
if(!$supplier){
  $session->msg("d", "Supplier not found.");
  redirect('suppliers.php');
}

$query = "DELETE FROM suppliers WHERE id='{$supplier['id']}'";
$result = $db->query($query);
if($result && $db->affected_rows() === 1){
  $session->msg("s", "Supplier deleted.");
} else {
  $session->msg("d", "Failed to delete supplier.");
}

redirect('suppliers.php');

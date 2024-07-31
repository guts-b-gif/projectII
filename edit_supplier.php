<?php
$page_title = 'Edit Supplier';
require_once('includes/load.php');
page_require_level(2);

// Check if an ID is provided in the URL
$supplier_id = (int)$_GET['id'];
if(!$supplier_id){
  $session->msg("d","Missing supplier id.");
  redirect('manage_suppliers.php');
}

// Fetch supplier details
$supplier = find_by_id('suppliers', $supplier_id);
if(!$supplier){
  $session->msg("d","Missing supplier.");
  redirect('manage_suppliers.php');
}

if(isset($_POST['edit_supplier'])){
  $req_fields = array('name', 'phone', 'email');
  validate_fields($req_fields);
  if(empty($errors)){
    $name   = remove_junk($db->escape($_POST['name']));
    $contact_person   = remove_junk($db->escape($_POST['contact_person']));
    $phone   = remove_junk($db->escape($_POST['phone']));
    $email   = remove_junk($db->escape($_POST['email']));
    $address   = remove_junk($db->escape($_POST['address']));
    $status = remove_junk($db->escape($_POST['status']));

    $query   = "UPDATE suppliers SET";
    $query  .=" name='{$name}', contact_person='{$contact_person}', phone='{$phone}', email='{$email}', address='{$address}', status='{$status}'";
    $query  .=" WHERE id='{$supplier['id']}'";
    $result = $db->query($query);
    if($result && $db->affected_rows() === 1){
      $session->msg('s',"Supplier updated ");
      redirect('manage_suppliers.php', false);
    } else {
      $session->msg('d',' Sorry failed to update supplier!');
      redirect('edit_supplier.php?id='.$supplier['id'], false);
    }
  } else {
    $session->msg("d", $errors);
    redirect('edit_supplier.php?id='.$supplier['id'], false);
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
          <span>Edit Supplier</span>
        </strong>
      </div>
      <div class="panel-body">
        <form method="post" action="edit_supplier.php?id=<?php echo (int)$supplier['id'];?>">
          <div class="form-group">
            <input type="text" class="form-control" name="name" placeholder="Supplier Name" value="<?php echo remove_junk($supplier['name']); ?>" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="contact_person" placeholder="Contact Person" value="<?php echo remove_junk($supplier['contact_person']); ?>">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="phone" placeholder="Phone" value="<?php echo remove_junk($supplier['phone']); ?>" required>
          </div>
          <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo remove_junk($supplier['email']); ?>" required>
          </div>
          <div class="form-group">
            <textarea class="form-control" name="address" placeholder="Address"><?php echo remove_junk($supplier['address']); ?></textarea>
          </div>
          <div class="form-group">
            <select class="form-control" name="status">
              <option value="active" <?php if($supplier['status'] === 'active') echo 'selected'; ?>>Active</option>
              <option value="inactive" <?php if($supplier['status'] === 'inactive') echo 'selected'; ?>>Inactive</option>
            </select>
          </div>
          <button type="submit" name="edit_supplier" class="btn btn-primary">Update Supplier</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>

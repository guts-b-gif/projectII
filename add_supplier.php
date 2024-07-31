<?php
$page_title = 'Add Supplier';
require_once('includes/load.php');
page_require_level(2);

if(isset($_POST['add_supplier'])){
  $req_fields = array('name', 'phone', 'email');
  validate_fields($req_fields);
  if(empty($errors)){
    $name   = remove_junk($db->escape($_POST['name']));
    $contact_person   = remove_junk($db->escape($_POST['contact_person']));
    $phone   = remove_junk($db->escape($_POST['phone']));
    $email   = remove_junk($db->escape($_POST['email']));
    $address   = remove_junk($db->escape($_POST['address']));
    $status = remove_junk($db->escape($_POST['status']));
    $date    = make_date();
    $query = "INSERT INTO suppliers (";
    $query .=" name, contact_person, phone, email, address, status, date_added";
    $query .=") VALUES (";
    $query .=" '{$name}', '{$contact_person}', '{$phone}', '{$email}', '{$address}', '{$status}', '{$date}'";
    $query .=")";
    if($db->query($query)){
      $session->msg('s',"Supplier added ");
      redirect('add_supplier.php', false);
    } else {
      $session->msg('d',' Sorry failed to add supplier!');
      redirect('add_supplier.php', false);
    }
  } else {
    $session->msg("d", $errors);
    redirect('add_supplier.php',false);
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
          <span>Add New Supplier</span>
        </strong>
      </div>
      <div class="panel-body">
        <form method="post" action="add_supplier.php">
          <div class="form-group">
            <input type="text" class="form-control" name="name" placeholder="Supplier Name" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="contact_person" placeholder="Contact Person">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="phone" placeholder="Phone" required>
          </div>
          <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Email" required>
          </div>
          <div class="form-group">
            <textarea class="form-control" name="address" placeholder="Address"></textarea>
          </div>
          <div class="form-group">
            <select class="form-control" name="status">
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
            </select>
          </div>
          <button type="submit" name="add_supplier" class="btn btn-primary">Add Supplier</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>

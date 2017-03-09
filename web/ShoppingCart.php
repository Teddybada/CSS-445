<?php 
if(!isset($_SESSION)){
    session_start();
}
$page_type = 'Customer';
require('inc.header.php');

if (isset($_POST['delete'])) {
  print_r($_POST['delete']);
}

function getProduct($arr) {
  if (!isset($db)) {
    require_once('inc.dbc.php');
    $db = get_connection();
  }
  $id = $arr['productID'];

  $q = "SELECT name, description, price, productID FROM 
          Product
        WHERE productID={$id}";
  $r = $db->query($q);
  
  if($r) {
    $ret = array();
    $newarr = $r->fetch(PDO::FETCH_ASSOC);
    $ret['name'] = $newarr['name'];
    $ret['description'] = $newarr['description'];
    $ret['price'] = $newarr['price'];
    $ret['quantity'] = $arr['quantity'];
    $ret['total'] = $arr['quantity'] * $newarr['price'];
    $ret['productID'] = $newarr['productID'];
    return $ret;
  } 
  return NULL;
}

if (!isset($db)) {
  require_once('inc.dbc.php');
  $db = get_connection();
}

$id = $_SESSION['userid'];
$q = "SELECT productID, quantity FROM Cart
  WHERE cartID={$_SESSION['userid']}";
$r = $db->query($q);
if ($r) {
  $out = array();
  while ($row = $r->fetch()) {
    array_push($out, getProduct($row));
  }
} else {
  echo "red head";
}
?>

 
<body>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h2 class="panel-title">Welcome to TSS445 Project Demo</h2>
    </div>
    <div class="panel-body">
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-sm-4">
        <ul class="nav nav-pills nav-stacked">
<!--  ************************** -->
<!--  SET NAVIGATION ACTIVE HERE -->
<!--  ************************** -->
          <li role="presentation" class="inactive">  <a href="Profile.php">Profile</a></li>
          <li role="presentation" class="inactive"><a href="EditProfile.php">Edit Profile</a></li>
          <li role="presentation" class="active">  <a href="ShoppingCart.php">Shopping Cart</a></li>
          <li role="presentation" class="inactive"><a href="Shopping.php">Go Shopping</a></li>
          <li role="presentation" class="inactive"><a href="Logout.php">Logout</a></li>
          </ul>	   
      </div>
      <div class="col-sm-8">
        <div class="panel panel-default">
          <div class="panel-heading"></div>
          <div class="panel-body">
            <table class="table">
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Description</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Total</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
<?php 
                foreach($out as $row)  {
                  $str = '<tr>';
                  foreach($row as $k => $col) {
                    if (strcmp($k, 'productID') != 0) $str .= "<td>{$col}</td>";
                  }
                  $str .= "<td>
                  <form method='post' action=''>
                    <button value='{$row['productID']}' name='delete' type='submit' class='btn btn-link'>Delete</button></td>
                  </form></tr>";
                  echo $str;
                }
               ?>
              </tbody>
            </table>
		      </div>
            </form>
          </div>        
        </div>
      </div>
    </div>
 </div>
 <?php include("./inc.footer.php");?>

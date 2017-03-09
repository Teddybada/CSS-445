<?php if(!isset($_SESSION)) {
    session_start();
  }
  $page_type = 'Customer';
  require('inc.header.php');

if (!isset($db)) {
    require_once('inc.dbc.php');
    $db = get_connection();
}


if (isset($_POST['update'])) {
  $arr = array(
    "firstName" => $_POST['firstname'],
    "lastName" => $_POST['lastname'],
    "email" => $_POST['email'],
    "phone" => $_POST['phone'],
    "address" => $_POST['address']
  );
  $query = array();
  foreach ($arr as $key => $val) {
    echo $key . " " . $val;
    if (!is_null($val) && strlen($val) != 0) {
      array_push($query, "{$key}='{$val}'");
    }
  }
  $q = 'UPDATE User SET ' 
    . implode(", ", $query) . 
    ' WHERE userid=' . $_SESSION['userid'];
  echo $q;
  $r = $db->query($q);
  if (!$r) {
    echo '<p>the failure</p>';
  }
}

$q = 'SELECT userid, firstName, lastName, email, address, phone
       FROM User
      WHERE userid = ' . $_SESSION['userid'];

$r = $db->query($q);

$row = $r->fetch(); // GET A SINGLE ROW
$attributes = array(
  'first name' => $row['firstName'],
  'last name' => $row['lastName'],
  'email'    => $row['email'],
  'phone'    => $row['phone'],
  'address'  => $row['address']
);


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
          <li role="presentation" class="active"><a href="EditProfile.php">Edit Profile</a></li>
          <li role="presentation" class="inactive">  <a href="ShoppingCart.php">Shopping Cart</a></li>
          <li role="presentation" class="inactive"><a href="Shopping.php">Go Shopping</a></li>
          <li role="presentation" class="inactive"><a href="Logout.php">Logout</a></li>
          </ul>	   
      </div>
      <div class="col-sm-8 container">
        <div class="panel panel-default">
          <div class="panel-heading">Edit Your Profile</div>
          <div class="panel-body">
          <form class="" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <?php foreach($attributes as $key => $val)  {
              $v = implode('', explode(' ', $key));
              echo "
                <div class='row'>
                  <div class='col-sm-6'>{$key}</div>
                  <input class='col-sm-6' type='text' placeholder='{$val}' name='{$v}' />
                </div>";
              }
            ?>
		        </div>
            <button class="btn btn-primary btn-block" name="update" type="submit" >Update</button>
          </form>
            </form>
          </div>        
        </div>
      </div>
    </div>
 </div>
 <?php include("./inc.footer.php");?>


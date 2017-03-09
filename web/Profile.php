<?php 
if(!isset($_SESSION)){
    session_start();
}

// SET $page_type = 'student','teacher','public'
$page_type = 'student';
require('inc.header.php');


if (isset($_POST['update'])) // HANDLE THE FORM
{
  if(!isset($db))  // CONNECT TO DATABASE
  {
    require_once('inc.dbc.php');
    $db = get_connection();
  }

  // PREVENT SQL INJECTION
  $q = $db->prepare('UPDATE User SET preferred_name = :name
                                    , email          = :email 
                                WHERE userid         = :uid');
  $q->execute(array(':name'  => stripslashes($_POST['pref_name']),
                    ':email' => stripslashes($_POST['email']),
                    ':uid'   => $_SESSION['userid']));

  if (!$q)
    $message = '<p class="alert-warning">Problem Handling Form</p>';
  else
    $message = '<p class="alert-success">Updated Successfully</p>';
}

# CONNECT TO DATABASE TO GET STUENT INFO
if (!isset($db)) {
    require_once('inc.dbc.php');
    $db = get_connection();
}

//require('profile.info.php');
//$attributes = get_date($_SESSION);

# BUILD QUERY
$q = 'SELECT userid, firstName, lastName, phone, email, phone, address
       FROM User
      WHERE userid = ' . $_SESSION['userid'];

$r = $db->query($q);

$row = $r->fetch(); // GET A SINGLE ROW
$attributes = array(
  "username" => $row['lastName'],
  "$userid"   => $row['userid'],
  "first name" => $row['firstName'],
  "last name" => $row['lastName'],
  "email"    => $row['email'],
  "phone"    => $row['phone'],
  "address"  => $row['address']
);
?>
 
<body>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h2 class="panel-title">Welcome to TSS445 Project Demo</h2>
    </div>
    <div class="panel-body">
      This mini project leverages Bootstrap 3.3.7 for HTML/CSS/JS, PHP5 and MariaDB X.X.X
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-sm-4">
        <ul class="nav nav-pills nav-stacked">
<!--  ************************** -->
<!--  SET NAVIGATION ACTIVE HERE -->
<!--  ************************** -->
          <li role="presentation" class="active">  <a href="Profile.php">Profile</a></li>
          <li role="presentation" class="inactive"><a href="EditProfile.php">Edit Profile</a></li>
          <li role="presentation" class="inactive">  <a href="ShoppingCart.php">Shopping Cart</a></li>
          <li role="presentation" class="inactive"><a href="Shopping.php">Go Shopping</a></li>
          <li role="presentation" class="inactive"><a href="Logout.php">Logout</a></li>
          </ul>	   
      </div>
      <div class="col-sm-8">
        <div class="panel panel-default">
          <div class="panel-heading"><?php echo $name; ?>'s Profile .</div>
          <div class="panel-body">
          <?php foreach($attributes as $key => $val)  {
            echo "<div class='row'><div class='col-sm-6'>{$key}</div><div class='col-sm-6'>{$val}</div></div>";
          }
          ?>
		      </div>
            </form>
          </div>        
        </div>
      </div>
    </div>
 </div>
 <?php include("./inc.footer.php");?>
 

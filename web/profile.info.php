<?php
  function get_data($arr) {
    require_once('inc.db.php');
    $db = get_connection();
    $q = 'SELECT userid, username, preferred_name, email 
           FROM User
          WHERE userid = ' . $arr['userid'];
    
    $r = $db->query($q);
    
    $row = $r->fetch(); // GET A SINGLE ROW
    $attributes = array(
      "username" => $row['username'],
      //$userid   => $row['userid'],
      "first name"    => $row['firstName'],
      "last name" => $row['lastName'],
      "email"    => $row['email'],
      "phone"    => $row['phone'],
      "address"  => $row['address']
    );
    return $attribbutes;
  }
?>

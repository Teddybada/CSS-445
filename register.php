<?php
session_start();
//connect to database
if(isset($_POST['register_btn']))
{
	
           //Create User
            $sql="INSERT INTO users(email,name, password, role) VALUES('$email', '$name','$password', '$role')";
            
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>TCSS 445</title>
</head>
<body>
<div class="header">
    <h1>Register</h1>
</div>
<form action="register.php" method="post">
  <table>
     <tr>
           <td>Email Address : </td>
           <td><input type="email" name="email" class="textInput" required></td>
     </tr>
     <tr>
           <td>Name : </td>
           <td><input type="text" name="name" class="textInput"></td>
     </tr>
      <tr>
           <td>Password : </td>
           <td><input type="password" name="password" class="textInput" required></td>
     </tr>
	 
	 <tr>
           <td>Role : </td>
		   <td><select name="role" required>
		    <option value="Cashier">Customer</option>
			<option value="Cashier">Cashier</option>
			<option value="Manager">Manager</option>
			<option value="DM">Database Manager</option>
			</select></td>
     </tr>
      <tr></tr>
      <tr>
           
           <td><input type="submit" name="register_btn" class="Register"></td>
     </tr>
 
</table>
</form>
</body>
</html>

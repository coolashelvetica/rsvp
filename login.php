<?php

 include 'db.php'; 

if(isset($_POST['username']) && isset($_POST['password']) ) 
  {


	$userlogin = $_POST['username'];
	$userpass = $_POST['password'];
	echo $userlogin;
	echo $userpass;

	$userinfo = mysql_query("SELECT * FROM users WHERE username = '$userlogin'") or die(mysql_error()); 

	 $check = mysql_fetch_array( $userinfo );

	 $checkname = $check['username'];
	 $checkpass = $check['password'];

	 if ($checkname == '')
	 {
	 	$successornot = "no";
	 }
	 else if ($userpass != $checkpass)
	 {
	 	$successornot = "no";
	 }
	 else if ($userlogin == $checkname && $userpass == $checkpass)
	 {
	 	$successornot = "yes";
	 }

	echo $checkname;
	echo ",";
	echo $checkpass;
	echo ",";
	echo $successornot;

	return($successornot);

}

	 
?>
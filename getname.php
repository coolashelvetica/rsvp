<?php

 include 'db.php'; 

 $tiquery = mysql_query("SELECT COUNT(*) FROM guests") or die(mysql_error()); 
$totalinvited = mysql_fetch_assoc($tiquery);
$tgquery = mysql_query("SELECT COUNT(*) FROM guests WHERE status = '1'") or die(mysql_error()); 
$totalguests = mysql_fetch_assoc($tgquery);
$ngquery = mysql_query("SELECT COUNT(*) FROM guests WHERE status = '2'") or die(mysql_error()); 
$notgoing = mysql_fetch_assoc($ngquery);
$totalinvited = $totalinvited['COUNT(*)'] - $notgoing['COUNT(*)'];

if(isset($_POST['phone']) && !isset($_POST['rsvp']) ) 
  {


	$guestnumber = $_POST['phone'];	
	$guestnumberstriped = preg_replace("/[^0-9]/","",$guestnumber);
	
 $data = mysql_query("SELECT * FROM guests WHERE phonenumber = '$guestnumberstriped'") 
	 or die(mysql_error()); 

	 $info = mysql_fetch_array( $data ); 



	$guestname = $info['name'];


	$status = $info['status'];
	$guest = "guest of " . $guestname;

   	 $hasguest = mysql_query("SELECT COUNT(*) FROM guests WHERE name = '$guest'") or die(mysql_error()); 
   	 $guestofguest = mysql_fetch_assoc($hasguest);
   	 $guestornot = $guestofguest['COUNT(*)'];

   	 if ($guestornot > 0)
   	 {
   	 	$guestcoming = "yes";
   	 }
   	 else
   	 {
   	 	$guestcoming = "no";
   	 }
	echo $guestname;
	echo ",";
	echo $guestnumberstriped;
	echo ",";
	echo $status;
	echo ",";
	echo $guestcoming;

	return($guestname);

}

	 
?>
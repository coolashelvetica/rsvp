<?php

 include 'db.php'; 


if(isset($_POST['phone'])) 
  {

  	$thestatus = $_POST['rsvp'];

	$guestnumber = $_POST['phone'];	
	$nameofperson = mysql_query("SELECT * FROM guests WHERE phonenumber = '$guestnumber' ") 
	 or die(mysql_error()); 
   $thename = mysql_fetch_array($nameofperson);
   $personname = $thename['name'];

	
  
  	if($thestatus == "Yes")
  	{
  		
  		mysql_query("UPDATE guests SET status='1' WHERE phonenumber = '$guestnumber' ") or die(mysql_error());
  		 $tiquery = mysql_query("SELECT COUNT(*) FROM guests") or die(mysql_error()); 
$totalinvited = mysql_fetch_assoc($tiquery);
$tgquery = mysql_query("SELECT COUNT(*) FROM guests WHERE status = '1'") or die(mysql_error()); 
$totalguests = mysql_fetch_assoc($tgquery);
$ngquery = mysql_query("SELECT COUNT(*) FROM guests WHERE status = '2'") or die(mysql_error()); 
$notgoing = mysql_fetch_assoc($ngquery);
$totalinvited = $totalinvited['COUNT(*)'] - $notgoing['COUNT(*)'];
  		echo $totalguests['COUNT(*)'];
  		echo ",";
  		echo $totalinvited;
  		return($totalguests['COUNT(*)']);

  	}

  	else if($thestatus == "Yes2")
  	{
      $guestsname = "guest of " . $personname;
      $guestnum = substr(number_format(time() * rand(),0,'',''),0,10);
  		mysql_query("INSERT INTO guests (name, phonenumber, status) VALUES ('$guestsname', '$guestnum', '1')")  or die(mysql_error());
  		mysql_query("UPDATE guests SET status='1' WHERE phonenumber = '$guestnumber' ") or die(mysql_error());
  		 $tiquery = mysql_query("SELECT COUNT(*) FROM guests") or die(mysql_error()); 
$totalinvited = mysql_fetch_assoc($tiquery);
$tgquery = mysql_query("SELECT COUNT(*) FROM guests WHERE status = '1'") or die(mysql_error()); 
$totalguests = mysql_fetch_assoc($tgquery);
$ngquery = mysql_query("SELECT COUNT(*) FROM guests WHERE status = '2'") or die(mysql_error()); 
$notgoing = mysql_fetch_assoc($ngquery);
$totalinvited = $totalinvited['COUNT(*)'] - $notgoing['COUNT(*)'];
$totalguests = $totalguests['COUNT(*)'];
  		echo $totalguests;
  		echo ",";
  		echo $totalinvited;
  		return($totalguests);

  	}

    else if($thestatus == "Yes3")
    {
      $guestsname = "guest of " . $personname;
      mysql_query("DELETE FROM guests WHERE name = '$guestsname'")  or die(mysql_error());
      mysql_query("UPDATE guests SET status='1' WHERE phonenumber = '$guestnumber' ") or die(mysql_error());
       $tiquery = mysql_query("SELECT COUNT(*) FROM guests") or die(mysql_error()); 
$totalinvited = mysql_fetch_assoc($tiquery);
$tgquery = mysql_query("SELECT COUNT(*) FROM guests WHERE status = '1'") or die(mysql_error()); 
$totalguests = mysql_fetch_assoc($tgquery);
$ngquery = mysql_query("SELECT COUNT(*) FROM guests WHERE status = '2'") or die(mysql_error()); 
$notgoing = mysql_fetch_assoc($ngquery);
$totalinvited = $totalinvited['COUNT(*)'] - $notgoing['COUNT(*)'];
$totalguests = $totalguests['COUNT(*)'];
      echo $totalguests;
      echo ",";
      echo $totalinvited;
      return($totalguests);

    }

    else if($thestatus == "No2")
    {
      $guestsname = "guest of " . $personname;
      mysql_query("DELETE FROM guests WHERE name = '$guestsname'")  or die(mysql_error());
      mysql_query("UPDATE guests SET status='2' WHERE phonenumber = '$guestnumber' ") or die(mysql_error());
       $tiquery = mysql_query("SELECT COUNT(*) FROM guests") or die(mysql_error()); 
$totalinvited = mysql_fetch_assoc($tiquery);
$tgquery = mysql_query("SELECT COUNT(*) FROM guests WHERE status = '1'") or die(mysql_error()); 
$totalguests = mysql_fetch_assoc($tgquery);
$ngquery = mysql_query("SELECT COUNT(*) FROM guests WHERE status = '2'") or die(mysql_error()); 
$notgoing = mysql_fetch_assoc($ngquery);
$totalinvited = $totalinvited['COUNT(*)'] - $notgoing['COUNT(*)'];
$totalguests = $totalguests['COUNT(*)'];
      echo $totalguests;
      echo ",";
      echo $totalinvited;
      return($totalguests);

    }

  	else if($thestatus == "No")
  	{
  		
  		mysql_query("UPDATE guests SET status='2' WHERE phonenumber = '$guestnumber' ") or die(mysql_error());
  		 $tiquery = mysql_query("SELECT COUNT(*) FROM guests") or die(mysql_error()); 
$totalinvited = mysql_fetch_assoc($tiquery);
$tgquery = mysql_query("SELECT COUNT(*) FROM guests WHERE status = '1'") or die(mysql_error()); 
$totalguests = mysql_fetch_assoc($tgquery);
$ngquery = mysql_query("SELECT COUNT(*) FROM guests WHERE status = '2'") or die(mysql_error()); 
$notgoing = mysql_fetch_assoc($ngquery);
$totalinvited = $totalinvited['COUNT(*)'] - $notgoing['COUNT(*)'];
  		echo $totalguests['COUNT(*)'];
  		echo ",";
  		echo $totalinvited;
  		return($totalguests['COUNT(*)']);

  	}
  
 	

}
?>
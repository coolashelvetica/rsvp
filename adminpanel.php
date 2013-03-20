<?php

 include 'db.php'; 


 $tiquery = mysql_query("SELECT COUNT(*) FROM guests") or die(mysql_error()); 
$totalinvited = mysql_fetch_assoc($tiquery);
$tgquery = mysql_query("SELECT COUNT(*) FROM guests WHERE status = '1'") or die(mysql_error()); 
$totalguests = mysql_fetch_assoc($tgquery);
$ngquery = mysql_query("SELECT COUNT(*) FROM guests WHERE status = '2'") or die(mysql_error()); 
$notgoing = mysql_fetch_assoc($ngquery);
$totalinvited = $totalinvited['COUNT(*)'] - $notgoing['COUNT(*)'];



$query = mysql_query("SELECT * FROM guests") or die(mysql_error()); 

$allnames = array();
$allstatus = array();
$allplus = array();
$allnums = array();
$phonenumber = array();
$count = 0;

while ($all = mysql_fetch_array($query)) {

	$guestsname = "guest of " .  $all['name'];

	$query2 = mysql_query("SELECT * FROM guests WHERE name = '$guestsname'") or die(mysql_error()); 
	
	if(mysql_num_rows($query2) == 0) {
	     $allplus[$count] = "No";
	} 
	else {
	    $allplus[$count] = "Yes";
	}


	$allnames[$count] = $all['name'];

	$phonenumber = str_split($all['phonenumber']);


	$allnums[$count] = "(".$phonenumber[0].$phonenumber[1].$phonenumber[2].") ".$phonenumber[3].$phonenumber[4].$phonenumber[5]."-".$phonenumber[6].$phonenumber[7].$phonenumber[8].$phonenumber[9];

	if($all['status'] == '0')
	{
		$allstatus[$count] = "No RSVP";
	}
		
	else if ($all['status'] == '1')
	{
		$allstatus[$count] = "Attending";
	}
	else if ($all['status'] == '2')
	{
		$allstatus[$count] = "Not Attending";
	} 



	$count++;
}


?>

<html>


<head id="www-sitename-com" data-template-set="html5-reset">

	
	<script type='text/javascript' src='_/js/jquery.min.js'></script>
	<script type='text/javascript' src="_/js/jquery.maskedinput-1.3.min.js"></script>

	<link rel="stylesheet" href="_/css/style.css">
	
	

<script type="text/javascript">

$(document).ready(function()
{
  //hide the all of the element with class msg_body
  //toggle the componenet with class msg_body


   $(".d-pop-button").click(function()
  	{

		$(".d-box").show();


 	});

 
	  

});
</script>
</head>

<body>
	<div class="blurback3"></div>
			<div class="counter2"><?php echo $totalguests['COUNT(*)']. "<span class='small'>of</span>". $totalinvited."<span class='small'>attending</span>"; ?></div>


	<div class="mainbody">
		<?php 

			echo "<div class='table'><table class='rsvptable'><thead><th>Name</th><th>Attending?</th><th>Plus One?</th><th>Phone Number</th></thead><tbody>";

			 for($i =0; $i < count($allnames); $i++)
				{
					echo "<tr> <td>".$allnames[$i]."</td>";
					if($allstatus[$i] == 'Not Attending')
					{
						echo " <td style='color:red; font-weight:bold;'>".$allstatus[$i]."</td>";
					}
					else if ($allstatus[$i] == 'Attending')
					{
						echo " <td style='color:green;font-weight:bold;'>".$allstatus[$i]."</td>";
					}
					else
					{
						echo " <td style='color:orange'>".$allstatus[$i]."</td>";
					}
					
					echo "<td>".$allplus[$i]."</td><td>".$allnums[$i]."</td></tr>";
				} 
			echo "</tbody></table></div>";
			?>
		</div>




</body>
</html>
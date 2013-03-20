<?php

 include 'db.php'; 


$tiquery = mysql_query("SELECT COUNT(*) FROM guests") or die(mysql_error()); 
$totalinvited = mysql_fetch_assoc($tiquery);
$tgquery = mysql_query("SELECT COUNT(*) FROM guests WHERE status = '1'") or die(mysql_error()); 
$totalguests = mysql_fetch_assoc($tgquery);
$ngquery = mysql_query("SELECT COUNT(*) FROM guests WHERE status = '2'") or die(mysql_error()); 
$notgoing = mysql_fetch_assoc($ngquery);
$totalinvited = $totalinvited['COUNT(*)'] - $notgoing['COUNT(*)'];
?>
<html>


<head id="www-sitename-com" data-template-set="html5-reset">

	
	<script type='text/javascript' src='_/js/jquery.min.js'></script>
	<script type='text/javascript' src="_/js/jquery.maskedinput-1.3.min.js"></script>

	<link rel="stylesheet" href="_/css/style.css">
	
	<script type='text/javascript'>//<![CDATA[ 
	$(window).load(function(){



	$("#phone").mask("(999) 999-9999");


	$("#phone").on("blur", function() {
	    var last = $(this).val().substr( $(this).val().indexOf("-") + 1 );
	    
	    if( last.length == 3 ) {
	        var move = $(this).val().substr( $(this).val().indexOf("-") - 1, 1 );
	        var lastfour = move + last;
	        
	        var first = $(this).val().substr( 0, 9 );
	        
	        $(this).val( first + '-' + lastfour );
	    }
	});
	});//]]>  

</script>

<script type="text/javascript">

$(document).ready(function()
{
  //hide the all of the element with class msg_body
  //toggle the componenet with class msg_body


   $(".d-pop-button").click(function()
  	{

		$(".d-box").show();


 	});
    $(".directionsraleigh").click(function()
  	{
  		$(".d-box").hide();
		$(".d-box-raleigh").show();


 	});

 	$(".directionsdurham").click(function()
  	{
  		$(".d-box").hide();
		$(".d-box-durham").show();


 	});

 	$(".directionsneither").click(function()
  	{
  		$(".d-box").hide();
		$(".d-box-neither").show();


 	});

   $(".loginbutton").click(function()
  	{
  		$(".loginbutton").hide();
  		$(".loginbuttonclose").show();

		$(".loginbox").slideDown('slow', function() {
    // Animation complete.
  });
		$(".loginbuttonclose").animate({ 
        top: "121px",
      }, 600 );
 	});

    $(".loginbuttonclose").click(function()
  	{
  		

		$(".loginbox").slideUp('slow', function() {
    // Animation complete.
  });

		$(".loginbuttonclose").animate({ 
        top: "0px",
      }, 600 );

		
  		$(".loginbutton").fadeIn(2000);
  		// $(".loginbuttonclose").hide();
 	});





   $(".x-close").click(function()
  	{

		$(".error1, .d-box, .thebox, .error2, .error3, .error4, .d-box-raleigh, .d-box-durham, .d-box-neither").hide();

		$(".right-area").show();
		$(".blurback2").show();

 	});

   $(".loginpressed").click(function(x)
   {
   		x.preventDefault();



   		var user = $("#username").val();
   		var pass = $("#password").val();
   		var loginType = 'username=' +user +'&password=' +pass;

   		if (user == '' || pass == '')
   		{
   			$(".thebox").hide();
   			$(".error4").show();

   		}
   		else
   		{
   			$.ajax({

   				type:"POST",
   				url: "login.php",
   				data: encodeURI(loginType),

   				 success: function(successornot) { 

   				 	var userstuff = successornot.split(',');
   				 		var userloginname = $.trim(userstuff[0]);
   				 		var userloginpass = userstuff[1];
   				 		var wassuccess = $.trim(userstuff[2]);
   				 		console.log(userloginname);
   				 		console.log(wassuccess);

   				 		if(wassuccess == 'yes')
   				 		{
   				 		
   				 			$(location).attr('href','adminpanel.php');

   				 		}
   				 		else
   				 		{
   				 			$(".thebox").hide();
   				 			$(".error3").show();
   				 		}

   				 	}

   		});	
   		}
   				 	

   });

   $(".gobutton").click(function(e)
   {
   		e.preventDefault();

   		if($("#phone").val() == '')
   		{
   			$(".right-area").hide();
   			$(".error1").show();

   		}
   		else
   		{
   			var guestnum = $("#phone").val();
   			var dataType = 'phone=' + guestnum;
   			$.ajax({

   				type:"POST",
   				url: "getname.php",
   				data: encodeURI(dataType),

   				 success: function(guestname) { 

   				 		var yourinfo = guestname.split(',');
   				 		var yourname = $.trim(yourinfo[0]);
   				 		var yournum = yourinfo[1];
   				 		var yourstatus = $.trim(yourinfo[2]);
   				 		var hasguest = $.trim(yourinfo[3]);
   				 		

   				 		if (!yourname)
   				 		{
   				 			$(".right-area").hide();
   				 			$(".error2").show();
   				 		}
   				 		else if (yourstatus == '1' && hasguest == 'no')
   				 		{
   				 			$(".password-box").fadeOut(100).hide();
   				 			$(".already1").fadeIn(100).show();
   				 	   		$(".already1 h1").html("<h1>Hi, " +yourname+ "!</h1>");

   				 	   		$(".yesbutton").click(function(f)
						   {
						   		f.preventDefault();

						   			var yesguest = $(".yesbutton").val();
						   			var dataType2 = 'phone=' +yournum +'&rsvp=' +yesguest;
						   			$.ajax({

						   				type:"POST",
						   				url: "rsvp.php",
						   				data: encodeURI(dataType2),


						   				 success: function(totalguests) { 

						   				 	var guestinfo = totalguests.split(',');
					   				 		var guestotal = guestinfo[0];
					   				 		var invitetotal = guestinfo[1];
					   				 		

						   				 		$(".already1").fadeOut(100).hide();
						   				 		$(".counter").fadeOut(100).hide();
						   				 		$(".counter").fadeIn(100).show();
						   				 		$(".counter").html("<div class='counter'>"+ guestotal+ 
						   				 			"<span class='small'>of</span>"+ invitetotal + "<span class='small'>attending</span></div>");
						   				 		$(".yay").fadeIn(100).show();
						   				 	    $(".yay h1").html("<h1>You're Awesome, " + yourname + "!</h1>");


						   				 	}
						   			});
						   		
						   });

							$(".yesbutton2").click(function(f)
						   {
						   		f.preventDefault();

						   			var yesguest2 = 'Yes2';

						   			var dataType2 = 'phone=' +yournum +'&rsvp=' +yesguest2;
						   			$.ajax({

						   				type:"POST",
						   				url: "rsvp.php",
						   				data: encodeURI(dataType2),


						   				 success: function(totalguests) { 

						   				 	var guestinfo2 = totalguests.split(',');
					   				 		var guestotal = guestinfo2[0];
					   				 		var invitetotal = guestinfo2[1];
					   				 		$(".left-area").fadeIn(100).show();
					   				 		$(".left-area").html("<img src='_/img/win.jpg'>");

						   				 		$(".already1").fadeOut(100).hide();
						   				 		$(".counter").fadeOut(100).hide();
						   				 		$(".counter").fadeIn(100).show();
						   				 		$(".counter").html("<div class='counter'>"+ guestotal+ 
						   				 			"<span class='small'>of</span>"+ invitetotal + "<span class='small'>attending</span></div>");
						   				 		$(".yay").fadeIn(100).show();
						   				 	    $(".yay h1").html("<h1>You're Awesome, " + yourname + "!</h1>");


						   				 	}
						   			});
						   		
						   });

							$(".nobutton").click(function(f)
						   {
						   		f.preventDefault();

						   			var noguest = $(".nobutton").val();
						   			var dataType2 = 'phone=' +yournum +'&rsvp=' +noguest;
						   			$.ajax({

						   				type:"POST",
						   				url: "rsvp.php",
						   				data: encodeURI(dataType2),


						   				 success: function(totalguests) { 

						   				 	var guestinfo = totalguests.split(',');
					   				 		var guestotal = guestinfo[0];
					   				 		var invitetotal = guestinfo[1];
					   				 		$(".left-area").fadeIn(100).show();
					   				 		$(".left-area").html("<img src='_/img/lose.jpg'>");

						   				 		$(".already1").fadeOut(100).hide();
						   				 		$(".counter").fadeOut(100).hide();
						   				 		$(".counter").fadeIn(100).show();
						   				 		$(".counter").html("<div class='counter'>"+ guestotal+ 
						   				 			"<span class='small'>of</span>"+ invitetotal + "<span class='small'>attending</span></div>");
						   				 		$(".bummer").fadeIn(100).show();
						   				 	    $(".bummer h1").html("<h1>Awww, that really sucks " + yourname + "!</h1>");


						   				 	}
						   			});
						   		
						   });
   				 		}
   				 		else if (yourstatus == '1' && hasguest == 'yes')
   				 		{
   				 			$(".password-box").fadeOut(100).hide();
   				 			$(".already2").fadeIn(100).show();
   				 	   		$(".already2 h1").html("<h1>Hi, " +yourname+ "!</h1>");

   				 	   		$(".yesbutton").click(function(f)
						   {
						   		f.preventDefault();

						   			var yesguest = $(".yesbutton").val();
						   			var dataType2 = 'phone=' +yournum +'&rsvp=' +yesguest;
						   			$.ajax({

						   				type:"POST",
						   				url: "rsvp.php",
						   				data: encodeURI(dataType2),


						   				 success: function(totalguests) { 

						   				 	var guestinfo = totalguests.split(',');
					   				 		var guestotal = guestinfo[0];
					   				 		var invitetotal = guestinfo[1];
					   				 		$(".left-area").fadeIn(100).show();
					   				 		$(".left-area").html("<img src='_/img/win.jpg'>");

						   				 		$(".already2").fadeOut(100).hide();
						   				 		$(".counter").fadeOut(100).hide();
						   				 		$(".counter").fadeIn(100).show();
						   				 		$(".counter").html("<div class='counter'>"+ guestotal+ 
						   				 			"<span class='small'>of</span>"+ invitetotal + "<span class='small'>attending</span></div>");
						   				 		$(".yay").fadeIn(100).show();
						   				 	    $(".yay h1").html("<h1>You're Awesome, " + yourname + "!</h1>");


						   				 	}
						   			});
						   		
						   });

							$(".yesbutton2").click(function(f)
						   {
						   		f.preventDefault();

						   			var yesguest2 = 'Yes3';

						   			var dataType2 = 'phone=' +yournum +'&rsvp=' +yesguest2;
						   			$.ajax({

						   				type:"POST",
						   				url: "rsvp.php",
						   				data: encodeURI(dataType2),


						   				 success: function(totalguests) { 

						   				 	var guestinfo2 = totalguests.split(',');
					   				 		var guestotal = guestinfo2[0];
					   				 		var invitetotal = guestinfo2[1];
					   				 		$(".left-area").fadeIn(100).show();
					   				 		$(".left-area").html("<img src='_/img/win.jpg'>");

						   				 		$(".already2").fadeOut(100).hide();
						   				 		$(".counter").fadeOut(100).hide();
						   				 		$(".counter").fadeIn(100).show();
						   				 		$(".counter").html("<div class='counter'>"+ guestotal+ 
						   				 			"<span class='small'>of</span>"+ invitetotal + "<span class='small'>attending</span></div>");
						   				 		$(".yay").fadeIn(100).show();
						   				 	    $(".yay h1").html("<h1>You're Awesome, " + yourname + "!</h1>");


						   				 	}
						   			});
						   		
						   });

							$(".nobutton").click(function(f)
						   {
						   		f.preventDefault();

						   			var noguest = 'No2';
						   			var dataType2 = 'phone=' +yournum +'&rsvp=' +noguest;
						   			$.ajax({

						   				type:"POST",
						   				url: "rsvp.php",
						   				data: encodeURI(dataType2),


						   				 success: function(totalguests) { 

						   				 	var guestinfo = totalguests.split(',');
					   				 		var guestotal = guestinfo[0];
					   				 		var invitetotal = guestinfo[1];
					   				 		$(".left-area").fadeIn(100).show();
					   				 		$(".left-area").html("<img src='_/img/lose.jpg'>");

						   				 		$(".already2").fadeOut(100).hide();
						   				 		$(".counter").fadeOut(100).hide();
						   				 		$(".counter").fadeIn(100).show();
						   				 		$(".counter").html("<div class='counter'>"+ guestotal+ 
						   				 			"<span class='small'>of</span>"+ invitetotal + "<span class='small'>attending</span></div>");
						   				 		$(".bummer").fadeIn(100).show();
						   				 	    $(".bummer h1").html("<h1>Awww, that really sucks " + yourname + "!</h1>");


						   				 	}
						   			});
						   		
						   });
   				 		}
   				 		else if (yourstatus == '2')
   				 		{
   				 			$(".password-box").fadeOut(100).hide();
   				 			$(".already3").fadeIn(100).show();
   				 	   		$(".already3 h1").html("<h1>Hi, " +yourname+ "!</h1>");

   				 	   		$(".yesbutton").click(function(f)
						   {
						   		f.preventDefault();

						   			var yesguest = $(".yesbutton").val();
						   			var dataType2 = 'phone=' +yournum +'&rsvp=' +yesguest;
						   			$.ajax({

						   				type:"POST",
						   				url: "rsvp.php",
						   				data: encodeURI(dataType2),


						   				 success: function(totalguests) { 

						   				 	var guestinfo = totalguests.split(',');
					   				 		var guestotal = guestinfo[0];
					   				 		var invitetotal = guestinfo[1];
					   				 		$(".left-area").fadeIn(100).show();
					   				 		$(".left-area").html("<img src='_/img/win.jpg'>");

						   				 		$(".already3").fadeOut(100).hide();
						   				 		$(".counter").fadeOut(100).hide();
						   				 		$(".counter").fadeIn(100).show();
						   				 		$(".counter").html("<div class='counter'>"+ guestotal+ 
						   				 			"<span class='small'>of</span>"+ invitetotal + "<span class='small'>attending</span></div>");
						   				 		$(".yay").fadeIn(100).show();
						   				 	    $(".yay h1").html("<h1>You're Awesome, " + yourname + "!</h1>");


						   				 	}
						   			});
						   		
						   });

							$(".yesbutton2").click(function(f)
						   {
						   		f.preventDefault();

						   			var yesguest2 = 'Yes2';

						   			var dataType2 = 'phone=' +yournum +'&rsvp=' +yesguest2;
						   			$.ajax({

						   				type:"POST",
						   				url: "rsvp.php",
						   				data: encodeURI(dataType2),


						   				 success: function(totalguests) { 

						   				 	var guestinfo2 = totalguests.split(',');
					   				 		var guestotal = guestinfo2[0];
					   				 		var invitetotal = guestinfo2[1];
					   				 		$(".left-area").fadeIn(100).show();
					   				 		$(".left-area").html("<img src='_/img/win.jpg'>");

						   				 		$(".already3").fadeOut(100).hide();
						   				 		$(".counter").fadeOut(100).hide();
						   				 		$(".counter").fadeIn(100).show();
						   				 		$(".counter").html("<div class='counter'>"+ guestotal+ 
						   				 			"<span class='small'>of</span>"+ invitetotal + "<span class='small'>attending</span></div>");
						   				 		$(".yay").fadeIn(100).show();
						   				 	    $(".yay h1").html("<h1>You're Awesome, " + yourname + "!</h1>");


						   				 	}
						   			});
						   		
						   });

							$(".nobutton").click(function(f)
						   {
						   		f.preventDefault();

						   			var noguest = $(".nobutton").val();
						   			var dataType2 = 'phone=' +yournum +'&rsvp=' +noguest;
						   			$.ajax({

						   				type:"POST",
						   				url: "rsvp.php",
						   				data: encodeURI(dataType2),


						   				 success: function(totalguests) { 

						   				 	var guestinfo = totalguests.split(',');
					   				 		var guestotal = guestinfo[0];
					   				 		var invitetotal = guestinfo[1];
					   				 		$(".left-area").fadeIn(100).show();
					   				 		$(".left-area").html("<img src='_/img/lose.jpg'>");

						   				 		$(".already3").fadeOut(100).hide();
						   				 		$(".counter").fadeOut(100).hide();
						   				 		$(".counter").fadeIn(100).show();
						   				 		$(".counter").html("<div class='counter'>"+ guestotal+ 
						   				 			"<span class='small'>of</span>"+ invitetotal + "<span class='small'>attending</span></div>");
						   				 		$(".bummer").fadeIn(100).show();
						   				 	    $(".bummer h1").html("<h1>Awww, that really sucks " + yourname + "!</h1>");


						   				 	}
						   			});
						   		
						   });
   				 		}
   				 		else
   				 		{


   				 		$(".password-box").fadeOut(100).hide();
   				 		$(".success").fadeIn(100).show();
   				 	    $(".success h1").html("<h1>Hi, " +yourname+ "!</h1>");

   				 	    $(".yesbutton").click(function(f)
						   {
						   		f.preventDefault();

						   			var yesguest = $(".yesbutton").val();
						   			var dataType2 = 'phone=' +yournum +'&rsvp=' +yesguest;
						   			$.ajax({

						   				type:"POST",
						   				url: "rsvp.php",
						   				data: encodeURI(dataType2),


						   				 success: function(totalguests) { 

						   				 	var guestinfo = totalguests.split(',');
					   				 		var guestotal = guestinfo[0];
					   				 		var invitetotal = guestinfo[1];
					   				 		$(".left-area").fadeIn(100).show();
					   				 		$(".left-area").html("<img src='_/img/win.jpg'>");
						   				 	
						   				 		$(".success").fadeOut(100).hide();
						   				 		$(".counter").fadeOut(100).hide();
						   				 		$(".counter").fadeIn(100).show();
						   				 		$(".counter").html("<div class='counter'>"+ guestotal+ 
						   				 			"<span class='small'>of</span>"+ invitetotal + "<span class='small'>attending</span></div>");
						   				 		$(".yay").fadeIn(100).show();
						   				 	    $(".yay h1").html("<h1>You're Awesome, " + yourname + "!</h1>");


						   				 	}
						   			});
						   		
						   });

							$(".yesbutton2").click(function(f)
						   {
						   		f.preventDefault();

						   			var yesguest2 = 'Yes2';

						   			var dataType2 = 'phone=' +yournum +'&rsvp=' +yesguest2;
						   			$.ajax({

						   				type:"POST",
						   				url: "rsvp.php",
						   				data: encodeURI(dataType2),


						   				 success: function(totalguests) { 

						   				 	var guestinfo2 = totalguests.split(',');
					   				 		var guestotal = guestinfo2[0];
					   				 		var invitetotal = guestinfo2[1];
					   				 		$(".left-area").fadeIn(100).show();
					   				 		$(".left-area").html("<img src='_/img/win.jpg'>");

						   				 		$(".success").fadeOut(100).hide();
						   				 		$(".counter").fadeOut(100).hide();
						   				 		$(".counter").fadeIn(100).show();
						   				 		$(".counter").html("<div class='counter'>"+ guestotal+ 
						   				 			"<span class='small'>of</span>"+ invitetotal + "<span class='small'>attending</span></div>");
						   				 		$(".yay").fadeIn(100).show();
						   				 	    $(".yay h1").html("<h1>You're Awesome, " + yourname + "!</h1>");


						   				 	}
						   			});
						   		
						   });

							$(".nobutton").click(function(f)
						   {
						   		f.preventDefault();

						   			var noguest = $(".nobutton").val();
						   			var dataType2 = 'phone=' +yournum +'&rsvp=' +noguest;
						   			$.ajax({

						   				type:"POST",
						   				url: "rsvp.php",
						   				data: encodeURI(dataType2),


						   				 success: function(totalguests) { 

						   				 	var guestinfo = totalguests.split(',');
					   				 		var guestotal = guestinfo[0];
					   				 		var invitetotal = guestinfo[1];
					   				 		$(".left-area").fadeIn(100).show();
					   				 		$(".left-area").html("<img src='_/img/lose.jpg'>");

						   				 		$(".success").fadeOut(100).hide();
						   				 		$(".counter").fadeOut(100).hide();
						   				 		$(".counter").fadeIn(100).show();
						   				 		$(".counter").html("<div class='counter'>"+ guestotal+ 
						   				 			"<span class='small'>of</span>"+ invitetotal + "<span class='small'>attending</span></div>");

						   				 		$(".bummer").fadeIn(100).show();
						   				 	    $(".bummer h1").html("<h1>Awww, that really sucks " + yourname + "!</h1>");


						   				 	}
						   			});
						   		
						   });

						}

   				 	}
   			});
   		}
   });


   

 
	  

});
</script>
</head>

<body>
	<div class="blurback2"></div>
	<div class="loginbutton">ADMIN LOGIN</div>

	<div class="loginbuttonclose">ADMIN LOGIN</div>
	<div class="loginbox"><form>Username <br><input type="text" id="username" name="username"/><br>Password <input type="password" id="password" name="password"><br><input type="submit" value="Login" class="loginpressed"></form></div>

	<div class="thebox" >
		<div class="blurback"></div>
		<div class="welcome-box-content"><img class="x-close" src="_/img/x-close.png"><h1>Hey!</h1><p>If you have this link then you're one of the lucky ones who have been invited to my housewarming get together. Once you x-out of this box you'll be able to RSVP so I have a good idea of who's coming, thanks!</p></div>
		
	</div>

	<div class="error1" style="display:none;">
		<div class="blurback"></div>
		<div class="welcome-box-content"><img class="x-close" src="_/img/x-close.png"><h1>Error!</h1><p>You did not enter a valid number, please make sure you entered it correctly. </p></div>
		
	</div>

	<div class="error2" style="display:none;">
		<div class="blurback"></div>
		<div class="welcome-box-content"><img class="x-close" src="_/img/x-close.png"><h1>Error!</h1><p>Your number doesn't appear
			to be on the list, please make sure you entered it correctly. </p>
			<br>
			<p class="smaller">If you entered it correctly and you think it should be on the list, <a href="mailto:fara.ashiru@gmail.com">EMAIL ME</a> with your correct phone number so I can correct the issue.</p></div>
		
	</div>

	<div class="error3" style="display:none;">
		<div class="blurback"></div>
		<div class="welcome-box-content"><img class="x-close" src="_/img/x-close.png"><h1>Error!</h1><p>Invalid Username or Password, please make sure you entered it correctly. </p>
			<br>
			</div>
		
	</div>
	<div class="error4" style="display:none;">
		<div class="blurback"></div>
		<div class="welcome-box-content"><img class="x-close" src="_/img/x-close.png"><h1>Error!</h1><p>You Left a Field blank, please make sure you entered it correctly. </p>
			<br>
			</div>
		
	</div>
	<div class="d-box-raleigh" style="display:none;">
		<div class="blurback"></div>
		<div class="welcome-box-content"><img class="x-close" src="_/img/x-close.png"><h1>Directions!</h1></p>
			<ul>
				<li class="fromwhere">From Raleigh (Via I-40 W)</li>
				<br>
				<li>1. Take US-40 W</li>
				<li>2. Take Exit 285 for Aviation Pkwy toward Morrisville/RDU Airport</li>
				<li>3. Turn Right on Aviation Pkway</li>
				<li>4. Turn Right onto Globe Rd</li>
				<li>5. Turn Right onto Alm St.</li>
				<li>6. Turn Right onto Lennox Haven Plc (Neighborhood is called SEVILLE AT BRIER CREEK)</li>
				<li>7. Make immediate Left onto Seville Drive</li>
				<li>8. My house is the last house on the Right with the Red door (Right next to the stop sign</li>
			</ul>
			<p>There is ample parking on the street as well as a parking lot right in front of my house.</p>
		</div>
		
	</div>

	<div class="d-box-durham" style="display:none;">
		<div class="blurback"></div>
		<div class="welcome-box-content"><img class="x-close" src="_/img/x-close.png"><h1>Directions!</h1></p>
			<ul>
				<li class="fromwhere">From Durham (Via US-70 E)</li>
				<br>
				<li>1. Take US-70 E</li>
				<li>2. Turn Right onto Brier Creek Pkwy</li>
				<li>3. Turn Left onto Alm St</li>
				<li>4. Turn Right onto Lennox Haven Plc (Neighborhood is called SEVILLE AT BRIER CREEK)</li>
				<li>5. Make immediate Left onto Seville Drive</li>
				<li>6. My house is the last house on the Right with the Red door (Right next to the Stop sign</li>
			</ul>
			<p>There is ample parking on the street as well as a parking lot right in front of my house.</p>
		</div>
		
	</div>

	<div class="d-box-neither" style="display:none;">
		<div class="blurback"></div>
		<div class="welcome-box-content"><img class="x-close" src="_/img/x-close.png"><h1>Directions!</h1></p>
			<br>
			<p>Enter ->  <span style="color:green">ALM ST, RALEIGH NC 27617</span> into your GPS (may be corrected to Morrisville, NC [this is okay])</p>
			<br>
			<p>If you turned onto ALM ST from BRIER CREEK PARKWAY</p>
			<ul>
				<li>1. Continue Straight on Alm St.</li>

				<li>2. Turn Right onto Lennox Haven Plc (Neighborhood is called SEVILLE AT BRIER CREEK)</li>
			<li>3. Make immediate Left onto Seville Drive</li>
				<li>4. My house is the last house on the Right with the Red door (Right next to the stop sign</li>
			</ul>

			<br>
			<p>If you turned onto ALM ST from GLOBE ST</p>
			<ul>
				<li>1. Continue Straight on Alm St.</li>

				<li>2. Turn Left onto Lennox Haven Plc (Neighborhood is called SEVILLE AT BRIER CREEK)</li>
			<li>3. Make immediate Left onto Seville Drive</li>
				<li>4. My house is the last house on the Right with the Red door (Right next to the stop sign</li>
			</ul>


				
			<p>There is ample parking on the street as well as a parking lot right in front of my house.</p>
		</div>
		
	</div>
	<div class="d-box" style="display:none;">
		<div class="blurback"></div>
		<div class="welcome-box-content2"><img class="x-close" src="_/img/x-close.png"><h1>Directions!</h1><p>Since my address is not google-mappable yet…</p>
			<ul>
				<li><a class="directionsraleigh pointer">Raleigh</a></li>
				<li><a class="directionsdurham pointer">Durham</a></li>
				<li><a class="directionsneither pointer">Neither</a></li>
			</ul>
		</div>
		
	</div>


	<div class="right-area">
		<div class="counter"><?php echo $totalguests['COUNT(*)']. "<span class='small'>of</span>". $totalinvited."<span class='small'>attending</span>"; ?></div>
		<div class="password-box">
			<h1>Shh.. It's a secret</h1>
			<p>Enter your phone number to rsvp</p>
			<form name="htmlForm"   >
			<input type="text" id="phone" name="phone"/>
			<br>
			<input type="submit" value="Go" class="gobutton" name="gobutton">
		
		</form>
	
	</div>
	

	<div class="success" style="display:none;"> 
			<h1>Hi, <?php echo $guestname?>!</h1>
			<p>So.. Are you coming?</p>
				<div class="rsvpbuttons">
					<form>
						<input hidden type="text" id="phone" name="phone" value="<?php echo $guestnumberstriped?>"/>
					<input type="submit" value="Yes" class="yesbutton" name="rsvp">
					<input type="submit" value="Yes Plus One" class="yesbutton2" name="rsvp">
					<input type="submit" value="No" class="nobutton" name="rsvp"></form>

				</div>
				<br>
				<p>Only Click Plus One if your plus one wasn't invited seperately! </p>

					</div>
		

		<div class="already1" style="display:none;"> 
			<h1>Hi, <?php echo $guestname?>!</h1>
			<p>You already said you're coming, are you still coming?</p>
				<div class="rsvpbuttons">
					<form>
						<input hidden type="text" id="phone" name="phone" value="<?php echo $guestnumberstriped?>"/>
					<input type="submit" value="Yes" class="yesbutton" name="rsvp">
					<input type="submit" value="Yes Plus One" class="yesbutton2" name="rsvp">
					<input type="submit" value="No" class="nobutton" name="rsvp"></form></div>
		
	</div>

	<div class="already2" style="display:none;"> 
			<h1>Hi, <?php echo $guestname?>!</h1>
			<p>You already said you're coming with a guest, are you still coming?</p>
				<div class="rsvpbuttons">
					<form>
						<input hidden type="text" id="phone" name="phone" value="<?php echo $guestnumberstriped?>"/>
					<input type="submit" value="Yes" class="yesbutton" name="rsvp">
					<input type="submit" value="Yes, Alone" class="yesbutton2" name="rsvp">
					<input type="submit" value="No" class="nobutton" name="rsvp"></form></div>
		
	</div>
	
	<div class="already3" style="display:none;"> 
			<h1>Hi, <?php echo $guestname?>!</h1>
			<p>You said you couldn't make it.. I hope you changed your mind!, are you coming now?</p>
				<div class="rsvpbuttons">
					<form>
						<input hidden type="text" id="phone" name="phone" value="<?php echo $guestnumberstriped?>"/>
					<input type="submit" value="Yes" class="yesbutton" name="rsvp">
					<input type="submit" value="Yes Plus One" class="yesbutton2" name="rsvp">
					<input type="submit" value="No" class="nobutton" name="rsvp"></form></div>
		
	</div>
	

<div class="yay"> 
			<h1>You're Awesome, <?php echo $guestname?>!</h1>
			<p>Here are the details!</p>
			<br><br>
			<h2 class="yay-title">Housewarming!!</h2>
			<h3><span class="forward-title">When? </span>March 2nd, 2013</h3>
			<h3><span class="forward-title">Time?</span> 5:30PM - Unteeel!</h3>
			<h3><span class="forward-title">Where?</span> 9307 Andalusia Walk Raleigh, NC 27617</h3>
			<p><a class="d-pop-button">Click Here</a> to Print or View Directions</p>
			<p><a href="_/docs/paperinvite.pdf" target="_blank">Click Here </a>to Print or View invite</p>
				
			
	</div>
	
	
	<div class="bummer"> 
			<h1>You suck, <?php echo $guestname?>!</h1>
			<p>but thanks for letting me know</p>
				
			
	</div>

</div>
</div>
</div>





</body>
</html>
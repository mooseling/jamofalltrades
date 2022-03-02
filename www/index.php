<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- GNU Sir Terry Pratchett -->
<html>
<head>
	<title>Welcome</title>
	<?php include "homeHeader.html"; ?>
	<link id="Style" rel="stylesheet" type="text/css" href="style.css">
	<script>
		function changeClasses(){
			var windowRatio = $(window).width()/$(window).height();
			if(windowRatio<1.4055)
				$("#links").attr("class", "heightDependant");
			else
				$("#links").attr("class", "widthDependant");
		}

		function loadBG(){
			$.get("homeworld.jpg").done(function(){
				$("#backgroundImg").css("background","url('homeworld.jpg') no-repeat center center fixed");
				$("#backgroundImg").css("background-size","cover");
				$("#backgroundImg").fadeIn(2000);
			});
		}
	</script>
</head>
<body onload="loadBG()" onresize="changeClasses()">
	<div class="bodyContent" id="Content">
		<div id="links">
			Hi there!<br>
			<a class="jslink" id="JS - WIJLT?" href="whatisjameslisteningto">What is James listening to?</a><br>
			<a class="jslink" id="JS - Exquisite Corpse" href="exquisitecorpse">Exquisite Corpse</a><br>
			<a class="jslink" id="JS - Quantum Decision Making" href="qdm">Quantum Decision Making</a><br>
			<a class="jslink" id="JS - Meet the Team" href="team">Meet the Team</a><br>
			<a class="jslink" id="JS - Contact" href="about">About</a><br>
			<a class="jslink" id="JS - Old" href="old">Old version of the site</a>
		</div>
		<script type="text/javascript">changeClasses();</script>
		<div id="backgroundImg"></div>
	</div>
</html>

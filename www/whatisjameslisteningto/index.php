<html>
	<head>
		<title>What Is James Listening To?</title>
		<?php include "../header.html"; ?>
		<script src=https://code.jquery.com/jquery-3.4.1.min.js></script>
		<link rel=stylesheet type=text/css href=style.css>
		<script src=wijltScripts.js></script>
	</head>
	<body onLoad=runPage()>
		<?php include "../navbar.php"; ?>
		<div id=loadingMessage>Loading...</div>
		<div id=wijltContent class=bodyContent>
			<div id=textPane>
				<a id=songLink>
					<div id=topText class=songTag></div>
					<div id=trackDiv class=songInfo></div>
					<div id=artistTag class=songTag></div>
					<div id=artistDiv class=songInfo></div>
					<div id=albumTag class=songTag></div>
					<div id=albumDiv class=songInfo></div>
				</a>
			</div>
			<div id=artPane><a id=songLink2><img id=albumArt></a></div>
		</div>
	</body>
</html>

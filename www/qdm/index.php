<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Quantum Decision Making</title>
	<?php include "../header.html"; ?>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<link id=qdmStyle rel=stylesheet type=text/css href=style.css>
</head>
<body>
	<?php include "../navbar.php"; ?>
	<div id=wrapper>
		<div id=choice class=centerDiv>
			<h1>Make a real decision.</h1>
			<form action="">
				Number of Options: <input type=text id=input name=options value=2><br>
			</form>
			<button onClick=choose()>Choose for me</button>
			<div id=result></div>
		</div>

		<div id=explanationLinkDiv class=centerDiv>
			<a id=explainLink href="">What is this page?</a><br>
			<div id=explanation style=display:none>
			Have you been pondering the nature of causality? Have you fallen into a deep well of nihilism, unable to forget that the future is immutably determined by the laws of physics? Fear not!<br>
			This webpage fetches a number from <a href=http://qrng.anu.edu.au/index.php>Australian National University</a>, where they measure quantum vacuum fluctuations. Science doesn't know of any mechanism behind these fluctuations - as far as we know, the results are <i>fundamentally random</i>. So, can't decide where to eat tonight, or whether to quit your job tomorrow? Ask quantum! There will really be no reason for its answer!
			</div>
		</div>
	</div>

	<script src=qdm.js></script>
</body>
</html>

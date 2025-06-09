<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>About</title>
	<?php include "../header.html"; ?>
	<link id=aboutStyle rel=stylesheet type=text/css href=style.css?1>
</head>
<body>
	<?php include "../navbar.php"; ?>
	<div id = ground>
		<div id=clouds>
			<h1>About this Site</h1>
			<div id=siteStats>
				<?php include "countLines.php"; ?>
				It is
				<?php
					$now = time(); // or your date as well
					$your_date = strtotime("4 December 2013");
					$datediff = $now - $your_date;
					echo round(($datediff / (60 * 60 * 24))/365);
				?>
				 years and <?php echo round(($datediff / (60 * 60 * 24))%365);?> days old.
			</div>
			<h1>About the Author</h1>
			<center>"James Stevenson hatched from an egg in the year 2015, then travelled back in time to 1999 to prevent the Y2K Bug. He failed." <i>&#8209;James&nbsp;Hope</i></center><br>
			<div id=myPicWrapper>
				<img id=myPic src=https://i.imgur.com/g25RlK9.jpg>
			</div>
			Current occupations:<br>
			Faffing with telescopes at <a href=https://supersharp.space target=_blank>SuperSharp</a><br>
			<a href=https://github.com/mooseling/BananaDrum target=_blank>Working</a> on <a href=https://bananadrum.net target=_blank>Banana Drum</a><br>
			Playing in <a href=https://londonschoolofsamba.co.uk/ target=_blank>some</a> <a href=https://gardencitysamba.com target=_blank>samba</a> <a href=https://arcoiris.org.uk target=_blank>bands</a><br>
			Chief Barista and Silly Person at <a href=https://sweetpeamarketgarden.co.uk target=_blank>Sweetpea Market Garden</a><br>
			Being an <a href=https://flubber-blob.com target=_blank>enormous</a> dweeb
			<br>
			<br>
			Previous occupations:<br>
			Having <a href=https://riptidelab.com/category/james-stevenson/ target=_blank>wild adventures</a><br>
			<a href=https://jamofalltrades.com target=_blank>Learning to</a> <a href=https://github.com/mooseling target=_blank>program</a><br>
            Almost never making <a href=https://soundcloud.com/thepatchworkorchestra target=_blank>music</a><br>
			Being an enormous dweeb<br>
			<p style=clear:both;></p>
			<h1>Unsolicited Recommendations</h1>
			<div class=opinion>
				<div class=imgWrapper>
					<img src=https://upload.wikimedia.org/wikipedia/en/4/44/ACureForSerpents.jpg>
				</div>
				<span class=text>
					<h2>Read this: Alberti Denti di Pirajno, <i>A Cure for Serpents</i></h2>
					Alberto Denti was an Italian doctor posted in North Africa throughout the 1920s, 30s, and 40s. In this book he recalls the various escapades and acquaintances from his time there, all true, and yet at times almost incredible. These are magical tales of people and cultures gone from the earth, rich and fascinating and alive. It is a truly beautiful book.
				</span>
			</div>
			<div class=opinion>
				<div class=imgWrapper>
					<img src=https://upload.wikimedia.org/wikipedia/en/e/e6/Bluebear.jpg>
				</div>
				<span class=text>
					<h2>Read this to someone: Walter Moers, <i>The 13½ Lives of Captain Bluebear</i></h2>
					Pull tome from shelf, clear your throat, and let a wild tale unfold. Who will you meet this time? The troglotroll? Querty Uiop? The old men of Tornado City? And where will you go? Atlantis? The 2364th dimension? Wheover and wherever, it will be new and wonderful. I'm always looking forward to opening this up again.
				</span>
			</div>
			<div class=opinion>
				<div class=imgWrapper>
					<a href=https://www.youtube.com/watch?v=nBUBMKzAFqs target=_blank><img src=https://i.imgur.com/F78i0T0.jpg></a>
				</div>
				<span class=text>
					<h2>A legendary group: <a href=https://www.youtube.com/watch?v=nBUBMKzAFqs target=_blank><i>Penguin Cafe Orchestra</i></a></h2>
					Born from the inspiration of a dream, Penguin Cafe Orchestra set out to make music celebrating the spontanaity and chaos of life. Joyous and playful, sometimes sorrowful, sometimes contemplative. Playful, childlike, human, free, and fun.
				</span>
			</div>
			<div class=opinion>
				<div class=imgWrapper>
					<a href=https://i.imgur.com/NgdzOG8.jpg><img src=https://i.imgur.com/NgdzOG8.jpg></a>
				</div>
				<span class=text>
					<h2>Best Board Game: <i>Scrubble</i></h2>
					Just play Scrabble, but throw out all the rules and don't keep score. Oh man it's so fun!
				</span>
			</div>

			<h1>Contact</h1>
			<div id=videoWrapper>
				<iframe id=video src=https://www.youtube.com/embed/iDhH1VWd9Uw?controls=0&modestbranding=1 frameborder="0"></iframe>

			</div>

			<div id=contactLink>
				<a href=mailto:james.stevenson.website@hotmail.com>Or email me</a>
			</div>
		</div>
	</div>
	<script>
	function calcParallax(tileheight, speedratio, scrollposition) {
	  //    by Brett Taylor https://inner.geek.nz/
	  //    originally published at https://inner.geek.nz/javascript/parallax/
	  //    usable under terms of CC-BY 3.0 licence
	  //    https://creativecommons.org/licenses/by/3.0/
	  return (-(Math.floor(scrollposition / speedratio) % (tileheight+1)));
	}

	document.body.onscroll = function() {
	    var groundparallax = calcParallax(window.innerWidth, 9, document.documentElement.scrollTop);
	    document.getElementById("ground").setAttribute("style","background-position:0 " + groundparallax + "px");
	};
	</script>
</body>
</html>

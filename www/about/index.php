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
			After that, I did lots of things. For one, I spent three years at Imperial College London learning to juggle and doing a radio show. When I left they gave me a degree in mathematics, which I wasn't entirely sure what to do with. I got a job in a cafe, took a few wild hitchhiking adventures, then went back to Imperial to learn to sail and dance. I didn't sail or dance at all, but this time they gave me a degree in "Environmental Technology".
			<br><br>

			Current occupations:<br>
			None lol<br>
			Working on <a href=https://github.com/mooseling/BananaDrum target=_blank>Banana Drum</a><br>
			Playing in two <a href=https://gardencitysamba.com target=_blank>samba</a> <a href=https://arcoiris.org.uk target=_blank>bands</a><br>
			Almost never making <a href=https://soundcloud.com/thepatchworkorchestra target=_blank>music</a><br>
			Being an enormous dweeb
			<br>
			<p style=clear:both;>

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
					<a href=https://www.youtube.com/watch?v=nBUBMKzAFqs target=_blank><img src=https://i.imgur.com/F78i0T0.jpg></a>
				</div>
				<span class=text>
				<h2>A legendary group: <a href=https://www.youtube.com/watch?v=nBUBMKzAFqs target=_blank><i>Penguin Cafe Orchestra</i></a></h2>
				Born from the rather unusual inspiration of a dream, Penguin Cafe Orchestra set out to make music celebrating the spontanaity and randomness of life. Their songs are joyous and playful, though sometimes sorrowful, sometimes contemplative. Their brilliance is in the freedom of their music, and the humanity. But these are big words from an ignorant child, so please, listen for yourself.
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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Exquisite Corpse</title>
	<?php include "../header.html"; ?>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css?blah">
	<script src="exquisiteCorpseScripts.js"></script>
</head>
<body onload="populateBody()">
	<?php include "../navbar.php"; ?>
	<div id="loading">Loading</div>
	<div id="bodyContent">
		<div id="galleryFrame">
			<div class="arrow" id="leftArrow"><a href="javascript:void(0)"><img src="Left_Arrow.svg" onmouseover="this.src='Left_Arrow_red.svg'" onmouseout="this.src='Left_Arrow.svg'" onclick="lastPic()"></a></div>
			<div class="arrow" id="rightArrow"><a href="javascript:void(0)"><img src="Right_Arrow.svg" onmouseover="this.src='Right_Arrow_red.svg'" onmouseout="this.src='Right_Arrow.svg'" onclick="nextPic()"></a></div>
			<div id="descriptionBox"><span id="descriptionText"></span><br><span><a id="mobileGalleryLink" href="javascript:void(0)" onclick="goToTutorialGallery()">→Go to Tutorial</a></span></div>
			<div class="galleryWrapper" id="corpseGallery"></div>
			<div class="galleryWrapper" id="tutorialGallery"></div>
		</div>
		<div id="sidebar">
			<div class="sidebarWrapper" id="corpseSidebarWrapper">
				<div class="sidebarHeading" id="corpseSidebarHeading">
					<span style="font-size: 24pt">Gallery</span><br>
					<i><a href="javascript:void(0)" onclick="goToTutorialGallery()">→Go to Tutorial</a></i>
				</div>
				<div class="thumbListWrapper" id="corpseThumbListWrapper">
					<div class="thumbList" id="corpseThumbList"></div>
				</div>
			</div>
			<div class="sidebarWrapper" id="tutorialSidebarWrapper">
				<div class="sidebarHeading" id="tutorialSidebarHeading">
					<span style="font-size: 24pt">Tutorial</span><br>
					<i><a href="javascript:void(0)" onclick="goToCorpseGallery()">→Go to Gallery</a></i>
					</div>
				<div class="thumbListWrapper" id="tutorialThumbListWrapper">
					<div class="thumbList" id="tutorialThumbList"></div>
				</div>
			</div>
		</div>
	</div>
</body>

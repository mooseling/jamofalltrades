var currentGallery = "corpse";//which gallery are we viewing?
var currentCorpse = 0;
var currentTutorial = 0;
var corpseData, tutorialData;//These will be arrays with the returned album data
var loadingProgress = [false, false, false];//An array of booleans: {firstPicLoaded,corpseAjaxFailed, tutorialAjaxSucceeded}
var loadedImages = 0;
var dataHolder = {}
var imageNumber = 0;//which corpse is centered?
var imageNumberT = 0;//which tutorial is centered?
var attempts = 0;//AJAX request attempts. The page gives up if it can't load the album after 3 tries.
var tAttempts = 0;//same, but for the tutorial album

function populateBody(){
	if (window.XMLHttpRequest){
		xmlhttp=new XMLHttpRequest();
		xmlhttp2= new XMLHttpRequest();
	}
	else {// for older IE 5/6
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp2=new ActiveXObject("Microsoft.XMLHTTP");
	}

	xmlhttp.onreadystatechange=function(){//LOAD GALLERY
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			corpseData=$.parseJSON(xmlhttp.responseText).data;
			loadCorpseDivs();
			loadFirstPic();
		}
		else if (xmlhttp.readyState==4 && xmlhttp.status==404)
		{
			if(attempts<4){
				xmlhttp.send();
				attempts++;
			}
			else{
				loadingProgress[1] = true;
				$("#corpseGallery").html("Fetching images from imgur.com failed. I've tried three times, but refresh if you want to try again.");
				if(loadingProgress[2]){
					loadTutorialImg(0);
				}
			}
		}
	}

	xmlhttp2.onreadystatechange=function(){//LOAD TUTORIAL
		if (xmlhttp2.readyState==4 && xmlhttp2.status==200){
			loadingProgress[2] = true;
			tutorialData=$.parseJSON(xmlhttp2.responseText).data;
			loadTutorialDivs();
			if(loadingProgress[1] || loadingProgress[0]){
				loadTutorialImg(0);
			}
		}
		else if (xmlhttp2.readyState==4 && xmlhttp.status==404)
		{
			if(tAttempts<4){
				xmlhttp2.send();
				tAttempts++;
			}
			else{
				$("#tutorialGallery").html("Fetching images from imgur.com failed. I've tried three times, but refresh if you want to try again.");
			}
		}
	}

	xmlhttp.open("GET","https://api.imgur.com/3/album/v4Qx8", true);
	xmlhttp.setRequestHeader("Authorization", "Client-ID be49e405f50dbc4")
	xmlhttp.send();
	attempts++;

	xmlhttp2.open("GET","https://api.imgur.com/3/album/JkBZz", true);
	xmlhttp2.setRequestHeader("Authorization", "Client-ID be49e405f50dbc4")
	xmlhttp2.send();
	tAttempts++;
}

function loadCorpseDivs(){
	for(i=0;i<corpseData.images_count;i++){
		var newDiv = document.createElement("div");
		newDiv.className = "picDiv";
		newDiv.id = "corpse" + i;
		$("#corpseGallery").append(newDiv);

		var newDiv = document.createElement("div");
		newDiv.className = "thumbDiv";
		newDiv.id = "corpseThumb" + i;
		$("#corpseThumbList").append(newDiv);
	}
}

function loadTutorialDivs(){
	for(i=0;i<tutorialData.images_count;i++){
		var newDiv = document.createElement("div");
		newDiv.className = "picDiv";
		newDiv.id = "tutorial" + i;
		$("#tutorialGallery").append(newDiv);

		var newDiv = document.createElement("div");
		newDiv.className = "thumbDiv";
		newDiv.id = "tutorialThumb" + i;
		$("#tutorialThumbList").append(newDiv);
	}
}

function loadFirstPic(){//Creates the first corpse img and thumb and sets it's onload to trigger the rest of the loading
	var newImg = document.createElement("img");
	newImg.id = "corpseImg0";
	if(corpseData.images[0].height > corpseData.images[0].width){
		newImg.className = "unloaded fader heightDependent";
	}
	else{
		newImg.className = "unloaded fader widthDependent";
	}
	newImg.src = "http://i.imgur.com/"+corpseData.images[0].id+corpseData.images[0].type.replace("image/",".");
	newImg.setAttribute("onload",'loadRestOfPics(); $("#corpseImg0").toggleClass("loaded unloaded"); updateLoadingStatus()');
	$("#corpse0").append(newImg);
	$("#corpseImg0").src = "http://i.imgur.com/"+corpseData.images[0].id+corpseData.images[0].type.replace("image/",".");
	$("#descriptionText").html(corpseData.images[0].description.replace(/\n/g,"<br>"));

	var newThumb = document.createElement("img");
	newThumb.id = "corpseThumbImg0";
	newThumb.className = "unloaded fader";
	newThumb.src = "http://i.imgur.com/"+corpseData.images[0].id+corpseData.images[0].type.replace("image/",".");
	newThumb.setAttribute("onload",'$("#corpseThumbImg0").toggleClass("loaded unloaded")');
	newThumb.setAttribute("onclick","goToCorpse(0)");
	$("#corpseThumb0").append(newThumb);
}

function loadRestOfPics(){
	loadingProgress[0] = true;
	loadCorpseImg(1);
	if(loadingProgress[2]){
		loadTutorialImg(0);
	}
}

function loadCorpseImg(whichPic){
	var newImg = document.createElement("img");
	newImg.id = "corpseImg" + whichPic;
	if(corpseData.images[whichPic].height > corpseData.images[whichPic].width){
		newImg.className = "unloaded fader heightDependent";
	}
	else{
		newImg.className = "unloaded fader widthDependent";
	}
	newImg.src = "http://i.imgur.com/"+corpseData.images[whichPic].id+corpseData.images[whichPic].type.replace("image/",".");
	if(whichPic<corpseData.images_count-1){
		newImg.setAttribute("onload",'$("#corpseImg'+whichPic+'").toggleClass("unloaded loaded"); updateLoadingStatus(); loadCorpseImg('+(whichPic + 1)+');');
	}
	else{
		newImg.setAttribute("onload",'$("#corpseImg'+whichPic+'").toggleClass("unloaded loaded"); updateLoadingStatus();');
	}
	$("#corpse" + whichPic).append(newImg);

	var newLink = document.createElement("a");
	newLink.id = "corpseThumbA" + whichPic;
	newLink.setAttribute("href","javascript:void(0)")
	newLink.setAttribute("onclick","goToCorpse("+whichPic+")");
	$("#corpseThumb"+whichPic).append(newLink);

	var newThumb = document.createElement("img");
	newThumb.id = "corpseThumbImg" + whichPic;
	newThumb.className = "unloaded fader";
	newThumb.src = "http://i.imgur.com/"+corpseData.images[whichPic].id+corpseData.images[whichPic].type.replace("image/",".");
	newThumb.setAttribute("onload",'$("#corpseThumbImg'+whichPic+'").toggleClass("loaded unloaded")');
	$("#corpseThumbA"+whichPic).append(newThumb);
}

function loadTutorialImg(whichPic){
	var newImg = document.createElement("img");
	newImg.id = "tutorialImg" + whichPic;
	if(tutorialData.images[whichPic].height > tutorialData.images[whichPic].width){
		newImg.className = "unloaded fader heightDependent";
	}
	else{
		newImg.className = "unloaded fader widthDependent";
	}
	newImg.src = "http://i.imgur.com/"+tutorialData.images[whichPic].id+tutorialData.images[whichPic].type.replace("image/",".");
	if(whichPic<tutorialData.images_count-1){
		newImg.setAttribute("onload",'$("#tutorialImg'+whichPic+'").toggleClass("unloaded loaded"); loadTutorialImg('+(whichPic + 1)+'); updateLoadingStatus();');
	}
	else{
		newImg.setAttribute("onload",'$("#tutorialImg'+whichPic+'").toggleClass("unloaded loaded"); updateLoadingStatus();');
	}
	$("#tutorial" + whichPic).append(newImg);

	var newLink = document.createElement("a");
	newLink.id = "tutorialThumbA" + whichPic;
	newLink.setAttribute("href","javascript:void(0)")
	newLink.setAttribute("onclick","goToTutorial("+whichPic+")");
	$("#tutorialThumb"+whichPic).append(newLink);

	var newThumb = document.createElement("img");
	newThumb.id = "tutorialThumbImg" + whichPic;
	newThumb.className = "unloaded fader";
	newThumb.src = "http://i.imgur.com/"+tutorialData.images[whichPic].id+tutorialData.images[whichPic].type.replace("image/",".");
	newThumb.setAttribute("onload",'$("#tutorialThumbImg'+whichPic+'").toggleClass("loaded unloaded")');
	$("#tutorialThumbA"+whichPic).append(newThumb);
}

function updateLoadingStatus(){
	loadedImages++;
	if(loadedImages<corpseData.images_count + tutorialData.images_count){
		$("#loading").append(".");
	}
	else{
		//$("#loading").fadeOut(function(){$(this).css("display","none");});
		$("#loading").fadeOut(function(){$(this).remove();});
	}
}

function goToCorpse(whichPic){
	currentCorpse = whichPic;
	$("#descriptionText").html(corpseData.images[whichPic].description.replace(/\n/g,"<br>"));
	goToCorpseGallery();
	$("#corpseGallery").css("left",(whichPic * -100) + "%");
}

function goToTutorial(whichPic){
	currentTutorial = whichPic;
	$("#descriptionText").html(tutorialData.images[whichPic].description.replace(/\n/g,"<br>"));
	goToTutorialGallery();
	$("#tutorialGallery").css("left",(whichPic * -100) + "%");
}

function goToCorpseGallery(){
	currentGallery = "corpse";
	$("#descriptionText").html(corpseData.images[currentCorpse].description.replace(/\n/g,"<br>"));
	$("#mobileGalleryLink").html("→Go to Tutorial");
	$("#mobileGalleryLink").attr("onclick", "goToTutorialGallery()");
	$("#corpseGallery").css("top",0);
	$("#corpseSidebarWrapper").css("top",0);
	$("#tutorialGallery").css("top",0);
	$("#tutorialSidebarWrapper").css("top","0");
}

function goToTutorialGallery(){
	currentGallery = "tutorial";
	$("#descriptionText").html(tutorialData.images[currentTutorial].description.replace(/\n/g,"<br>"));
	$("#mobileGalleryLink").html("→Go to Gallery");
	$("#mobileGalleryLink").attr("onclick", "goToCorpseGallery()");
	$("#corpseGallery").css("top","-100%");
	$("#corpseSidebarWrapper").css("top","-100%");
	$("#tutorialGallery").css("top","-100%");
	$("#tutorialSidebarWrapper").css("top","-100%");
}

function nextPic(){
	if(currentGallery == "corpse"){
		if(currentCorpse + 1 < corpseData.images_count)
		goToCorpse(currentCorpse + 1);
	}
	else{
		if(currentTutorial + 1 < tutorialData.images_count)
		goToTutorial(currentTutorial + 1);
	}
}

function lastPic(){
	if(currentGallery == "corpse"){
		if(currentCorpse > 0)
		goToCorpse(currentCorpse - 1);
	}
	else{
		if(currentTutorial > 0)
		goToTutorial(currentTutorial - 1);
	}
}

$(document).keydown(function(e) {
		    	switch(e.which) {
			        case 37: lastPic();// left
			        break;

			        case 38: goToCorpseGallery();
			        break;

			        case 39: nextPic();// right
			        break;

			        case 40: goToTutorialGallery();
			        break;

		        	default: return; // exit this handler for other keys
			    }
			    	e.preventDefault(); // prevent the default action (scroll / move caret)
				});

//$("#galleryFrame").on("swipeleft",lastPic());
//$("#galleryFrame").on("swiperight",nextPic());
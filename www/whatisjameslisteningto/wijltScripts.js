var CurrentTrack, CurrentState = "starting";
//allowed states: "starting", "playing", "not playing", "error, content", "error, no content"
var examplesong = {"artist":{"#text":"Radio Citizen","mbid":"452fec0f-6330-45e0-9d55-03c3d7a8a5e1"},"name":"Birds","streamable":"0","mbid":"4e9a00fe-2f8f-4bc7-9ba8-94a345c87de1","album":{"#text":"Berlin Serengeti","mbid":"d91ecbf2-efd2-411e-8c6b-abbcf02d31e3"},"url":"https://www.last.fm/music/Radio+Citizen/_/Birds","image":[{"#text":"https://lastfm-img2.akamaized.net/i/u/34s/2a28109a4d0a4aa2b10faad02b0a17f9.png","size":"small"},{"#text":"https://lastfm-img2.akamaized.net/i/u/64s/2a28109a4d0a4aa2b10faad02b0a17f9.png","size":"medium"},{"#text":"https://lastfm-img2.akamaized.net/i/u/174s/2a28109a4d0a4aa2b10faad02b0a17f9.png","size":"large"},{"#text":"https://lastfm-img2.akamaized.net/i/u/300x300/2a28109a4d0a4aa2b10faad02b0a17f9.png","size":"extralarge"}]};

function runPage(){
	var ResponseData;

	$.ajax({//AJAX to check last.fm. The paths for success and failure are contained within this.
		url:"https://ws.audioscrobbler.com/2.0/?method=user.getrecenttracks&user=DouglasMaguire&api_key=eea3ca68f588a5751f09c5126be8c032&format=json&limit=1",
		async: true,
		error: function(xhr,status,error){
			if (CurrentState == "playing" || CurrentState == "not playing")
				changeState("error, content", error);
			else
				changeState("error, no content", error);
			setTimeout(function(){runPage();},30000);
		},
		success: function(ResponseData,status,xhr)
		{
			if(ResponseData.recenttracks.track[0] != CurrentTrack)//Change content?
				if (ResponseData.recenttracks.track[0]['@attr'] == null)//Is the song NOT playing?
					if(CurrentState != "not playing")//Is the current state anything other than NOT playing?
						changeState("not playing", ResponseData);
					else
						changeContent(ResponseData.recenttracks.track[0], false);
				else //If the song IS currently playing
					if(CurrentState != "playing")//Do we need to change state?
						changeState("playing", ResponseData);
					else
						changeContent(ResponseData.recenttracks.track[0], false);
			setTimeout(function(){runPage();},30000);
		}
	});
}

function changeContent(ResponseTrack, stateIsChanging){//Called to change displayed song info and art in states "playing" or "not playing"
	$("#trackDiv").html(ResponseTrack.name);
	$("#artistDiv").html(ResponseTrack.artist["#text"]);
	$("#albumDiv").html(ResponseTrack.album["#text"]);
	$("#songLink").attr("href","https://www.youtube.com/results?search_query=" + ResponseTrack.artist["#text"] + " " + ResponseTrack.name);
	$("#songLink2").attr("href","https://www.youtube.com/results?search_query=" + ResponseTrack.artist["#text"] + " " + ResponseTrack.name);
	if (CurrentTrack == null || ResponseTrack.album["#text"] != CurrentTrack.album["#text"])//We do the following if the album is changing, so therefore the albumart
		if(ResponseTrack.image[0]["#text"] != ""){//Check if there is any album art for the new album
			var imgSrc = ResponseTrack.image[0]["#text"].replace(/lastfm-img2.akamaized.net\/.*\//, "lastfm-img2.akamaized.net/i/u/");
			$.get(imgSrc).done(function(){
				if(stateIsChanging)
					$("#albumArt").attr("src", imgSrc);
				else
					$("#albumArt").fadeOut(500, function(){
						$("#albumArt").attr("src", imgSrc);
						$("#albumArt").fadeIn(500);
					});
			}).fail(function(){
				setArtistPic(ResponseTrack,stateIsChanging);
			});
		}
		else{
			$("#albumArt").fadeOut(500);
			setArtistPic(ResponseTrack,stateIsChanging);
		}
	CurrentTrack = ResponseTrack;
}

function setArtistPic(ResponseTrack, stateIsChanging){
	$.get("https://ws.audioscrobbler.com/2.0/?method=artist.getinfo&mbid="+ResponseTrack.artist.mbid+"&api_key=eea3ca68f588a5751f09c5126be8c032&format=json&limit=1")
	.done(function(artistData){
		var artistImgSrc = artistData.artist.image[0]["#text"].replace(/lastfm-img2.akamaized.net\/.*\//, "lastfm-img2.akamaized.net/i/u/");
		$.get(artistImgSrc).done(function(){
			if(stateIsChanging)
				$("#albumArt").attr("src", artistImgSrc);
			else
				$("#albumArt").fadeOut(500, function(){
					$("#albumArt").attr("src", artistImgSrc);
					$("#albumArt").fadeIn(500);
				});
		}).fail(function(){
			if(!stateIsChanging)
				$("#albumArt").fadeOut(500);
		});
	}).fail(function(){
		if(!stateIsChanging)
			$("#albumArt").fadeOut(500);
	});
}

function changeState(newState, ResponseData){
	$("#wijltContent").fadeOut(500, function(){
		switch (newState){
			case "starting":
				//$("#wijltContent").html("Loading...");
				//$("#wijltContent").fadeIn(500);
				break;
			case "playing":
				$("#topText").html("Now playing:");
				$("#artistTag").html("By");
				$("#albumTag").html("On");
				changeContent(ResponseData.recenttracks.track[0], true);
				$("#wijltContent").fadeIn(500);
				break;
			case "not playing":
				$("#topText").html("Nothing is currently playing. The last known song was:");
				$("#artistTag").html("By");
				$("#albumTag").html("On");
				changeContent(ResponseData.recenttracks.track[0], true);
				$("#wijltContent").fadeIn(500);
				break;
			case "error, content":
				$("#topText").html("Something went wrong...<br>The last known song was:")
				$("#wijltContent").fadeIn(500);
				break;
			case "error, no content":
				$("#topText").html("Something went wrong, but here's a song James likes:");
				$("#artistTag").html("By");
				$("#albumTag").html("On");
				changeContent(examplesong, true);
				$("#wijltContent").fadeIn(500);
				break;
			default:
				$("#topText").html("Something is desperately wrong, but here's a song James likes:");
				$("#artistTag").html("By");
				$("#albumTag").html("On");
				changeContent(examplesong, true);
				$("#wijltContent").fadeIn(500);
				break;
		}
	});
	CurrentState = newState;
}

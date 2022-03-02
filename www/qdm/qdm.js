var lastResponse;

function isInt(x){
  return !isNaN(x) && parseInt(Number(x)) == x && !isNaN(parseInt(x, 10));
}

function choose(){
  var numOptions = $('#input').val();
  if(isInt(numOptions) && numOptions > 0){

    var ajaxobject;
    ajaxobject=new XMLHttpRequest();

    ajaxobject.onreadystatechange = function() {
      if(ajaxobject.readyState==4){
          if(ajaxobject.status == 200){
          var json = JSON.parse(ajaxobject.responseText);
          lastResponse = json.data;
          var resultAsInt = parseInt(numOptions*(parseInt(lastResponse, 16) + 1.0)/16777216) + 1;
          $('#result').html('Choose option ' + resultAsInt);
          $(document.body).css("background-color", "#" + lastResponse);
        }
        }
        else if(ajaxobject.readyState==1){
          $('#result').html("Loading...");//The other readystates are cycled through until 4 is reached, so no need to do anything apart from the first time.
        }
    };

    var url = "https://qrng.anu.edu.au/API/jsonI.php?length=1&type=hex16&size=3";

      ajaxobject.open("GET", url ,true);
    ajaxobject.send(null);
  } else {
    $('#result').html("Don't be silly.");
  }
}

$(function() {
    $("form input").keypress(function (e) {
        if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
            choose();
            return false;
        } else
            return true;
    });
});

$("#explainLink").click(function(event){
    event.preventDefault();
    $("#explanation").show(400);
  });

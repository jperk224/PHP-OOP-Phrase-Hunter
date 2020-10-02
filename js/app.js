////////////////////////////////////////////////////////////////////////////////////////
// ajax code for user guesses/puzzle refreshes

function submitUserGuess(guess = '') {  // guess param is optional, only used for keypress event
  
    var target = event.target;
  
  // create the xhr object
  var xhr = new XMLHttpRequest();

  // callback function to handle server response
  xhr.onreadystatechange = function (e) {
    if (this.readyState === 4 && this.status === 200) {
      // console.log(xhr.responseText);
      var gameInfo = JSON.parse(xhr.responseText);
      // console.log(gameInfo);
      document.getElementById('scoreboard').innerHTML = gameInfo["livesHTML"];
      document.getElementById('lives-count').innerHTML = "Remaining Lives: " + gameInfo["livesRemain"];
      document.getElementById('qwerty').innerHTML = gameInfo["keyboard"];
      document.getElementById('phraseDisplay').innerHTML = gameInfo["phrase"];
      document.getElementById('qwerty').innerHTML = gameInfo["keyboard"];

      // if gameOver is not an empty string, the game is over so render the modal
      if(!(gameInfo["gameOver"] === "")) {
        document.getElementById('game-over').innerHTML = gameInfo["gameOver"];
        document.getElementById('game-over').style.display = 'block';
      }
    }
  };

  // open and send the request with the user guess in the query string
  if(guess !== '') {
    var urlAppend = encodeURIComponent(guess);
  }
  else {
    var urlAppend = encodeURIComponent(target.innerHTML);
  }
  xhr.open("GET", "play.php?userGuess=" + urlAppend, true);
  xhr.send();

}

// initialte ajax request for keypress event
function submitUserGuessKeypress(event) {

var eventKeyCode = event.keyCode;
var eventString = String.fromCharCode(eventKeyCode).toUpperCase();
var keys = document.getElementsByClassName('key');
var submitGuess = true;  // assume the guess will be submitted

if(eventString >= 'A' && eventString <= 'Z') {
  // check whether the key is already disabled
 for(var i = 0; i < keys.length; i++) {
    if(keys[i].innerHTML == eventString) {
      if(keys[i].disabled) {
        submitGuess = false;
      }
    } 
  } 
}
else {
  submitGuess = false;  // we only want to submit letters A - Z
}

if(submitGuess) {
  submitUserGuess(eventString);
}

}

// send ajax request on keypress
document.onkeypress = function() {
  submitUserGuessKeypress(event);
}

////////////////////////////////////////////////////////////////////////////////////////
// index.php

// Render the rules modal
$(".rules-render").click(function(e) {
    $("#rules-modal").show();
});

// close the rules modal is the 'x' is clicked
$("#rules-close").click(function(e) {
    $("#rules-modal").hide();
});

// close the rules modal if the 'Got it' button is clicked
$("#rules-close-button").click(function(e) {
    $("#rules-modal").hide();
});

// close the rules modal if the user clicks anywhere outside the modal
$(".modal-container").click(function(e) {
    if( $(event.target).attr('class') === "modal-container" &&
        $("#rules-modal").css("display") === "block") {
        $("#rules-modal").hide();
    }
});

// render the form at game start to capture user info
$(".game-start").click(function(e) {
    $("#player-info").show();
});

// play.php

// toggle hamburger <ul> in mobile view
$("#hamburger").click(function(e) {
    $("#hamburger-menu").toggle();
});

// close the player form if user opts to not get a new game
$("#close-player-form").click(function(e) {
    $("#player-info").hide();
    e.preventDefault();
});

// render the hint modal
$("#hint-button").click(function(e) {
    $("#hint-modal").show();
});

// close the hint modal via 'x'
$("#hint-close").click(function(e) {
    $("#hint-modal").hide();
});

// close the hint modal via the button
$("#hint-close-button").click(function(e) {
    $("#hint-modal").hide();
});

// close the hint modal if the user clicks anywhere outside the modal
$(".modal-container").click(function(e) {
    if( $(event.target).attr('class') === "modal-container" &&
        $("#hint-modal").css("display") === "block") {
        $("#hint-modal").hide();
    }
});

// if the user clicks 'play again' prevent redirect home and render the difficulty selection form
// Buttons don't exist at page load and are rendered dynamically via AJAX
// document.on is needed to append an event listener to dynamic content
// (https://stackoverflow.com/questions/27870794/jquery-click-event-preventdefault-not-working/27870969)
$(document).on('click','#play-again',function(e){
    e.preventDefault();
    $('#game-over').hide();
    $("#player-info").show();
    return false;
});

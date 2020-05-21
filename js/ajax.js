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
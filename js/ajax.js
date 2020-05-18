// ajax code for user guesses/puzzle refreshes

function submitUserGuess() {
  
    var target = event.target;
  
  // create the xhr object
  var xhr = new XMLHttpRequest();

  // callback function to handle server response
  xhr.onreadystatechange = function (e) {
    if (this.readyState === 4 && this.status === 200) {
      // console.log(xhr.responseText);
      var gameInfo = JSON.parse(xhr.responseText);
      console.log(gameInfo);
      document.getElementById('scoreboard').innerHTML = gameInfo["livesHTML"];
      document.getElementById('lives-count').innerHTML = "Remaining Lives: " + gameInfo["livesRemain"];
      document.getElementById('qwerty').innerHTML = gameInfo["keyboard"];
      document.getElementById('phraseDisplay').innerHTML = gameInfo["phrase"];
      document.getElementById('qwerty').innerHTML = gameInfo["keyboard"];

      // if gameOver is not an empty string, the game is over, render the modal
      if(!(gameInfo["gameOver"] === "")) {
        document.getElementById('game-over').innerHTML = gameInfo["gameOver"];
        document.getElementById('game-over').style.display = 'block';
      }
    }
  };

  // open and send the request with the user guess in the query string
  // xhr.open("POST", "play.php", true);
  xhr.open("GET", "play.php?userGuess=" + target.innerHTML, true);
  xhr.send();

}

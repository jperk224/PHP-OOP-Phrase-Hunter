// ajax code for user guesses/puzzle refreshes

function submitUserGuess() {
  
    var target = event.target;
  
  // create the xhr object
  var xhr = new XMLHttpRequest();

  // callback function to handle server response
  xhr.onreadystatechange = function (e) {
    if (this.readyState === 4 && this.status === 200) {
      console.log(xhr.responseText);
      console.log(target);
    }
  };

  // open and send the request with the user guess in the query string
  xhr.open("GET", "gameInstance.php?userGuess=" + target.innerHTML, true);
  xhr.send();

}

<?php

//MODEL FUNCTIONS

// filter GET strings
function filterGetString($variable) {
    return filter_input(INPUT_GET, "$variable", FILTER_SANITIZE_STRING);
}

//VIEW FUNCTIONS

if(isset($_GET["userGuess"])) {
    echo "Hello ajax";
}

// render the rules-modal
function renderRules($numberOfGuesses) {
    echo    '<div class="modal-content">
		        <span class="close" id="rules-close">&times;</span>
			    <h4>Phrase Hunter Rules</h4>
			    <ul>
				    <p>Guess all the letters in a hidden, random phrase!</p>
                    <p>Use the onscreen keyboard.</p>  
                    <p>Letters can only be guessed once.</p>
				    <p>Can you get the phrase before ' . $numberOfGuesses . ' wrong guesses?</p> 
			    </ul>
			    <h5>Enjoy!</h5>
			    <button class="form-buttons" id="rules-close-button">Got it!</button>
		    </div>';
}

// render the player form for name and difficulty
function renderPlayerForm($playerName, $gamePhrases, $diffculty, $page=null) {
    echo '<div class="modal-content">
			<form action="play.php" method="get">
				<label for="playerName">Please Enter Your Name:</label>
				<input type="text" id="playerName" placeholder="Joe Smith" name="playerName"';
				if(!empty($playerName)) {
					echo 'value="' . $playerName .'"';		// player name persistence 
				} 
	echo		'<br>
				<label for="difficulty">Please Select Your Difficulty Level:</label>
                <select id="difficulty" name="difficulty">
                    <option value="random">Random</option>';    // This is first as a workaround for dropdown persistence
					// difficulty level form persistence via $difficulty argument
                    renderDifficulty($gamePhrases, $diffculty); 
	echo		'</select><br>
                <button class="form-buttons">Let\'s Go!</button>';
                if($page == "index") {
                    echo '<button class="form-buttons" formaction="index.php">I\'m Not Ready</button>	<!-- go back home -->';
                }
                else {
                    echo '<button class="form-buttons" id="close-player-form">Cancel</button>';
                }
    echo    '<input type="hidden" name="newGame" value="1">';            
	echo	'</form>
		    </div>';
}

// render the hint modal
function renderHint($source) {
    echo    '<div class="modal-content">
		        <span class="close" id="hint-close">&times;</span>
			    <h4>Source</h4>
			    <h5>' . $source . '</h5>
			    <button class="form-buttons" id="hint-close-button">Ok!</button>
		    </div>';
}

// render difficulty levels for selection
// takes an optional parameter to hold dropdown selection for form persistence
function renderDifficulty(ArrayRepo $phrases, $selection = null) {
    // create an array of all the difficulty levels and pull distinct values for UI rendering
    $difficultyArray = array();
    $challengeArray = array();
    foreach($phrases->getAll() as $phrase) {
        foreach($phrase as $key => $value) {
            if($key == "difficulty") {
                $difficultyArray[] = $value;
            }
        }
    }
    $difficultyArray = array_unique($difficultyArray);
    sort($difficultyArray);
    // cut of the number prefixes used to sort
    foreach($difficultyArray as $challenge) {
        $challenge = strtolower(substr($challenge, 4));     // string starts after "# - "
        $challengeArray[] = $challenge;
    }
    // echo out the entires as option fields
    foreach($challengeArray as $challenge) {
        if($challenge == $selection) {
            echo '<option value="'. $challenge . '" selected>' . ucfirst($challenge) . '</option>';
        }
        else {
            echo '<option value="'. $challenge . '">' . ucfirst($challenge) . '</option>';
        }
    }
}

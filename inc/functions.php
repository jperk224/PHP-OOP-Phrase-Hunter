<?php

//VIEW FUNCTIONS
// render the rules-modal content
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
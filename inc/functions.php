<?php

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

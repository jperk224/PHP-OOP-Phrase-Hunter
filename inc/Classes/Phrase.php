<?php

/**
 * Phrase class.
 * Handle phrases to be used as game puzzles.
 */

class Phrase implements RepositoryInterface {

    // class properties
    // private access modifiers promote encapsulation
    private $currentPhrase;             // current puzzle phrase
    private $selected = array();        // holds user guesses

    // constructor


    // getters
    public function getCurrentPhrase() {

    }

    public function getSelected() {

    }

    // setters
    public function setCurrentPhrase() {

    }

    public function setSelected($guess) {
        $guess = strtolower($guess);
        $this->selected[] = $guess;
        return;
    }

    // other methods

    // Get a random phrase- don't forget to include difficulty if/where applicable

    /**
     * addPhraseToDisplay(): Builds the HTML for the letters of the phrase. 
     * Each letter is presented by an empty box, one list item for each letter. 
     * See the example_html/phrase.txt file for an example of what the render HTML 
     * for a phrase should look like when the game starts. 
     * When the player correctly guesses a letter, the empty box is replaced with the matched letter. 
     * Use the class "hide" to hide a letter and "show" to show a letter. 
     * Make sure the phrase displayed on the screen doesn't include boxes for spaces: see example HTML.
     */

    /**
     * checkLetter(): checks to see if a letter matches a letter in the phrase. 
     * Accepts a single letter to check against the phrase. Returns true or false.
     */

}

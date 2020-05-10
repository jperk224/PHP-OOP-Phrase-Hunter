<?php

/**
 * Phrase class.
 * Handle phrases to be used as game puzzles.
 */

class Phrase {

    // class properties
    // private access modifiers promote encapsulation
    private $currentPhrase;             // current puzzle phrase
    private $selected = array();        // user letter guesses
    private $phrases;                   // collection of phrases

    /**
     * Class constructor.
     * If the phrase is not passed in, a random phrase is selected.
     * Converts phrases to all upper case to render 'Wheel of Fortune' style
     * and eliminate case-sensitivity for user guesses.
     * @param $phraseArray The array of phrases to select from randomly
     * @param $phrase The phrase for the puzzle (optional)
     * @param $selected The array of user guesses (optional)
     */
    public function __construct(ArrayRepo $phrases, $phrase = null, $selected = null) {

        $this->phrases = $phrases->getAll();

        if(isset($phrase)) {
            $this->currentPhrase = strtoupper($phrase);
        }
        else {
            $this->currentPhrase = strtoupper($this->phrases[array_rand($this->phrases)]["phrase"]);
        }
        if(isset($selected)) {
            $this->selected = $selected;
        }

    }

    // getters
    public function getCurrentPhrase() {

        return $this->currentPhrase;

    }

    public function getSelected() {

        return $this->selected;

    }

    // setters
    public function setCurrentPhrase() {

    }

    public function setSelected($guess) {
        $guess = strtoupper($guess);
        $this->selected[] = $guess;
        return;
    }

    // other methods

    /**
     * Turn the phrase into an array to render in the UI
     */
    public function splitPhrase() {
        return str_split($this->currentPhrase);
    }

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

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
     * (implementing this way is cleaner than housing the entire phrase array in the class)
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
    public function setCurrentPhrase($phrase) {

        $this->currentPhrase = $phrase;

    }

    public function setSelected($arr) {
        
        $this->selected = $arr;

    }

    // other methods

    /**
     * Turn the phrase into an array to render in the UI
     */
    public function splitPhrase() {
        // return str_split($this->currentPhrase);
        return explode(" ", $this->currentPhrase);
    }

    /**
     * Add player guesses to the selected array
     */
    public function addSelected($guess) {
        $guess = strtoupper($guess);
        $this->selected[] = $guess;
        return;
    }

    /**
     * Build and outpout the HTML for the letters of the phrase.
     */
    public function addPhraseToDisplay()
    {
        foreach ($this->splitPhrase() as $word) {
            echo '<div class="phrase-word">';
            for ($i = 0; $i < strlen($word); $i++) {
                if ($word[$i] >= "A" && $word[$i] <= "Z") {
                    echo '<li class="letter">' . $word[$i] . '</li>'; //TODO: add hide class
                } else {
                    echo '<li class="letter">' . $word[$i] . '</li>';
                }
            }
            echo '<li class="space"></li>';
            echo '</div>';
        }
    }

    /**
     * Check to see if a letter matches a letter in the phrase. 
     * Accepts a single letter to check against the phrase. Returns true or false.
     */
    public function checkLetter($letter) {
        $letter = strtoupper($letter);
        foreach($this->splitPhrase() as $phraseChar) {
            if($letter == $phraseChar) {
                return true;
            }
        }
        return false;
    }
}

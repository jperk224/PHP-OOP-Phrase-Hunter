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
     * @param $phrases The array of phrases to select from randomly 
     * (implementing in this manner is cleaner than housing the entire phrase array in the class)
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
     * Each word in the phrase it its own string element in the array
     * Each string is iterated through in addPhraseToDisplay()
     */
    public function splitPhrase() {
        return explode(" ", $this->currentPhrase);
    }

    /**
     * Add player guesses to the selected array
     * Creates an associative array
     * key is user guess, value is true/false based on whether its in the phrase
     */
    public function addGuess($guess) {
        $guess = strtoupper($guess);
        $this->selected[$guess] = $this->checkLetter($guess);
        return;
    }

    /**
     * Build and output the HTML for the letters of the phrase.
     */
    public function addPhraseToDisplay()
    // Note this has some duplication to handle AJAX
    {
        $phraseHTML = '';
        $arr = $this->getSelected();
        if(count($arr) > 0) { // it's not a new game, guesses have been made, return JSON-friendly format
            foreach ($this->splitPhrase() as $word) {
                $phraseHTML .= '<div class=\"phrase-word\">';
                for ($i = 0; $i < strlen($word); $i++) {
                    if ($word[$i] >= "A" && $word[$i] <= "Z") {
                        if(in_array($word[$i], array_keys($arr)) && $arr[$word[$i]]) {  // letter has been guessed and is in phrase
                            $phraseHTML .= '<li class=\"letter\">' . $word[$i] . '</li>'; 
                        }
                        else {
                            $phraseHTML .= '<li class=\"letter hide\">' . $word[$i] . '</li>'; 
                        } 
                    } else {
                        $phraseHTML .= '<li class=\"letter\">' . $word[$i] . '</li>'; // it's a special character so render it immediately
                    }
                }
                $phraseHTML .= '<li class=\"space\"></li>'; // render spaces w/o character boxes per requirements
                $phraseHTML .= '</div>';
            }
        }
        else {  // no guesses have been made, it's a new game, no check against selected or JSON friendly formatting needed
            foreach ($this->splitPhrase() as $word) {
                $phraseHTML .= '<div class="phrase-word">';
                for ($i = 0; $i < strlen($word); $i++) {
                    if ($word[$i] >= "A" && $word[$i] <= "Z") {
                        $phraseHTML .= '<li class="letter hide">' . $word[$i] . '</li>';
                    } else {
                        $phraseHTML .= '<li class="letter">' . $word[$i] . '</li>';     // special characters don't get hidden
                    }
                }
                $phraseHTML .= '<li class="space"></li>';
                $phraseHTML .= '</div>';
            }
        }
        return $phraseHTML;
    }

    /**
     * Check to see if a letter matches a letter in the phrase. 
     * Accepts a single letter to check against the phrase. Returns true or false.
     */
    public function checkLetter($letter) {
        $letter = strtoupper($letter);
        foreach($this->splitPhrase() as $phraseWord) {
            for($i = 0; $i < strlen($phraseWord); $i++) {
                if($letter == $phraseWord[$i]) {
                    return true;
                }
            }
        }
        return false;
    }
}

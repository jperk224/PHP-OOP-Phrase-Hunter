<?php

/**
 * Game class.
 * Handle game play.
 */

class Game {

    // class properties
    // private access modifiers promote encapsulation
    private $phrase;                    // an instance of the Phrase class to use with the game
    private $lives;                     // an integer for the number of wrong chances to guess the phrase
    private $initialLives;              // the initial Lives set at the beginning of the game 

    /**
     * Class constructor.
     * Instantiate a new Game instance.
     * @param $phrase The phrase for the puzzle (must be of type Phrase)
     */
    public function __construct(Phrase $phrase) {
        
        $this->phrase = $phrase;
        $this->lives = 5;               // current rules, user has 5 wrong attempts before 'game over'
                                        // this is the default if not explicitly set
        $this->initialLives = $this->lives;
    }

    // getters

    public function getPhrase() {
        return $this->phrase;
    }

    public function getLives() {
        return $this->lives;
    }

    public function getInitialLives() {
        return $this->initialLives;
    }

    // setters

    public function setPhrase($phrase) {
        $this->phrase = $phrase;
    }

    public function setLives($lives) {
        $this->lives = $lives;
    }

    public function setInitialLives($lives) {
        $this->initialLives = $lives;
    }

    // other methods

    /**
     * checkForWin(): this method checks to see if the player has selected all of the letters.
     */
    public function checkForWin() {
        $phrase = $this->getPhrase()->getCurrentPhrase();
        for($i = 0; $i < strlen($phrase); $i++) {
            if ($phrase[$i] >= "A" && $phrase[$i] <= "Z") {
                if(!(in_array($phrase[$i], array_keys($this->getPhrase()->getSelected())))) {
                    return false;   // exit early if there's a letter in the phrase not yet selected
                }
            } else {
                continue;
            }
        }
        return true;    // if you got here, all letters have been selected
    }

    /**
     * checkForLose(): this method checks to see if the player has guessed too many wrong letters.
     */
    public function checkForLose() {
        if($this->getLives() <=0) {
            return true;
        }
        return false;
    } 

    /**
     * gameOver(): this method displays one message if the player wins and another message if they lose. 
     * It returns false if the game has not been won or lost.
     */
    public function gameOver() {
        $endingHTML = '<div class=\"modal-content\">';    // open the end-of game modal, populate it based on win/loss
		$endingHTML = '<form action=\"index.php\" method=\"get\">';

        if($this->checkForWin()) {  // if true you won
            $endingHTML .= '<h4>Winner!!!</h4>';
        }
        
        if($this->checkForLose()) { //if true you lost
            $endingHTML .= '<h4>Better Luck Next Time!</h4>';
        }
        
        // appennd the rest of the modal html
        $endingHTML .= '<button class=\"form-buttons\" id=\"play-again\">Play Again</button>';
        $endingHTML .= '<button class=\"form-buttons\">Go Home</button>';
        $endingHTML .= '</form>';
        $endingHTML .= '</div>';

        if($this->checkForWin() || $this->checkForLose()) { // you either won or lost, so render a modal
            return $endingHTML;
        }
        else {
            return false;
        }
    }

    /**
     * displayKeyboard(): Create a onscreen keyboard form.  
     */
    public function displayKeyboard()
    {
        // Note: There's a bit of duplicated code here needed to handle AJAX requests cleanly
        $keyboardHTML = '';
        $keyboardArray = [
            ['q', 'w', 'e', 'r', 't', 'y', 'u', 'i', 'o', 'p'],
            ['a', 's', 'd', 'f', 'g', 'h', 'j', 'k', 'l'],
            ['z', 'x', 'c', 'v', 'b', 'n', 'm']
        ];

        $arr = $this->getPhrase()->getSelected();

        if (count($arr) > 0) {
            foreach ($keyboardArray as $keyrow) { // guesses already exist in the 'selected' array, its not a new game, return JSON format
                $keyboardHTML .= '<div class=\"keyrow\">';
                foreach ($keyrow as $key) {
                    $key = strtoupper($key);
                    // determine whether a given letter is marked as true/false (i.e. exists in the phrase)
                    if (array_key_exists($key, $arr)) {
                        if ($arr[$key]) {  // value is true so render with the 'correct' class
                            $keyboardHTML .= '<button class=\"key correct\" onclick=\"submitUserGuess()\" disabled>' . $key . '</button>';
                        } else {      // value is false, render with 'incorrect' class
                            $keyboardHTML .= '<button class=\"key incorrect\" onclick=\"submitUserGuess()\" disabled>' . $key . '</button>';
                        }
                    } else {      // key hasn't been used yet, it's not in selected array, assign no class and don't disable
                        $keyboardHTML .= '<button class=\"key\" onclick=\"submitUserGuess()\">' . $key . '</button>';
                    }
                }
                $keyboardHTML .= '</div>';
            }
        }
        else {
            foreach ($keyboardArray as $keyrow) {   // no guesses, it's a new game, render regular HTML
                $keyboardHTML .= '<div class="keyrow">';
                foreach ($keyrow as $key) {
                    $key = strtoupper($key);
                    $keyboardHTML .= '<button class="key" onclick="submitUserGuess()">' . $key . '</button>';
                }
                // close the div
                $keyboardHTML .= '</div>';
            }
        }

        return $keyboardHTML;
    }


    /**
     * displayScore(): Display the number of guesses available.
     * heigh and width attributes are applied as inline attributes to ovverride img size 
     */
    public function displayScore() {
        $scoreboardHtml = '';
        // if the selected array is empty the game has not started, render a fresh scoreboard
        if(count($this->getPhrase()->getSelected()) <= 0) {
            $scoreboardHtml .= '<ol>';
            for($i = 0; $i < $this->getLives(); $i++) {
                $scoreboardHtml .= '<li class="tries"><img src="images/liveHeart.png" height="35px" widght="30px"></li>';
            }
            $scoreboardHtml .= '</ol>';
        }
        else {  // Selected array is not empty, we're in a game, this is handling AJAX, so return JSON
            $scoreboardHtml .= '<ol>';
            // render the remaining lives first
            for($i = 0; $i < $this->getLives(); $i++) {
                $scoreboardHtml .= '<li class=\"tries\"><img src=\"images/liveHeart.png\" height=\"35px\" widght=\"30px\"></li>';
            }
            // render lost lives lost - difference between initial lives and remaining lives
            for($i = 0; $i < ($this->getInitialLives() - $this->getLives()); $i++) {
                $scoreboardHtml .= '<li class=\"tries\"><img src=\"images/lostHeart.png\" height=\"35px\" widght=\"30px\"></li>';
            }
            $scoreboardHtml .= '</ol>';
        }
        return $scoreboardHtml;
    }
}

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

    /**
     * Class constructor.
     * Instantiate a new Game instance.
     * @param $phrase The phrase for the puzzle (must be of type Phrase)
     */
    public function __construct(Phrase $phrase) {
        
        $this->phrase = $phrase;
        $this->lives = 5;               // current rules, user has 5 wrong attempts before 'game over'
                                        // this is the default if not explicitly set
    }

    // getters

    public function getPhrase() {
        return $this->phrase;
    }

    public function getLives() {
        return $this->lives;
    }

    // setters

    public function setPhrase($phrase) {
        $this->phrase = $phrase;
    }

    public function setLives($lives) {
        $this->lives = $lives;
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
     * See the example_html/scoreboard.txt file for an example of what the render HTML for a scoreboard should look like. 
     * Return string HTML of Scoreboard.
     */

}

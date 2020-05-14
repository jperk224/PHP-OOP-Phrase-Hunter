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
                                        // this is the default is not explicitly set
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


    /**
     * checkForLose(): this method checks to see if the player has guessed too many wrong letters.
     */ 

    /**
     * gameOver(): this method displays one message if the player wins and another message if they lose. 
     * It returns false if the game has not been won or lost.
     */

    /**
     * displayKeyboard(): Create a onscreen keyboard form.  
     */
    public function displayKeyboard() {
        $keyboardHTML = '';
        $keyboardArray = [
            ['q','w','e','r','t','y','u','i','o','p'],
            ['a','s','d','f','g','h','j','k','l'],
            ['z','x','c','v','b','n','m']
        ];
        foreach($keyboardArray as $keyrow) {
            $keyboardHTML .= '<div class="keyrow">';
            foreach($keyrow as $key) {
                $keyboardHTML .= '<button class="key" onclick="submitUserGuess()">' . $key . '</button>';
            }
            $keyboardHTML .= '</div>';
        }
        return $keyboardHTML;
    }


    /**
     * displayScore(): Display the number of guesses available. 
     * See the example_html/scoreboard.txt file for an example of what the render HTML for a scoreboard should look like. 
     * Return string HTML of Scoreboard.
     */

}

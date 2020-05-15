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
    public function displayKeyboard($arr)
    {
        $keyboardHTML = '';
        $keyboardArray = [
            ['q', 'w', 'e', 'r', 't', 'y', 'u', 'i', 'o', 'p'],
            ['a', 's', 'd', 'f', 'g', 'h', 'j', 'k', 'l'],
            ['z', 'x', 'c', 'v', 'b', 'n', 'm']
        ];
        //$selectedArray = $this->getPhrase()->getSelected(); // this should grab the current array after most recent guess
        // $selectedArray = $arr;
        if(count($arr) > 0) {
            echo "array has count" . count($arr);
        }
        else {
            echo "array is 0";
        }
        // var_dump($arr);   
        foreach ($keyboardArray as $keyrow) {
            $keyboardHTML .= '<div class="keyrow">';
            foreach ($keyrow as $key) {
                $key = strtoupper($key);
                echo "KEY: $key\n";
                var_dump(array_keys($arr));


                if (count($arr) > 0) {    // guesses already exist in the 'selected' array
                    // determine whether a given letter is marked as true/false (i.e. exists in the phrase)
                    if (array_key_exists($key, $arr)) {   
                        echo "KEY IS IN ARRAY\n";
                        // if ($arr[$key]) {  // value is true so render with the 'correct' class
                        //     $keyboardHTML .= '<button class="key correct" onclick="submitUserGuess()" disabled>' . $key . '</button>';
                        // } else {      // value is false, render with 'incorrect' class
                        //     $keyboardHTML .= '<button class="key incorrect" onclick="submitUserGuess()" disabled>' . $key . '</button>';
                        // }
                    } else {      // key hasn't been used yet, it's not in selected array, assign no class and don't disable
                        echo "KEY IS NOT IN ARRAY\n";
                        // $keyboardHTML .= '<button class="key" onclick="submitUserGuess()">' . $key . '</button>';
                    }
                } 
                // else {    // no guesses in the array, render a fresh keyboard
                     $keyboardHTML .= '<button class="key" onclick="submitUserGuess()">' . $key . '</button>';
                // }
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

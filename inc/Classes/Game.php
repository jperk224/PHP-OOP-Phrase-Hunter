<?php

/**
 * Game class.
 * Handle game play.
 */

class Game {

    // class properties
    // private access modifiers promote encapsulation
    private $phrase;        // an instance of the Phrase class to use with the game
    private $lives;         // an integer for the number of wrong chances to guess the phrase

    // constructor


    // getters


    // setters


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
     * See the example_html/keyboard.txt file for an example of what the render HTML for the keyboard should look like. 
     * If the letter has been selected the button should be disabled. 
     * Additionally, the class "correct" or "incorrect" should be added based on the checkLetter() method of the Phrase object. 
     * Return a string of HTML for the keyboard form.
     */

    /**
     * displayScore(): Display the number of guesses available. 
     * See the example_html/scoreboard.txt file for an example of what the render HTML for a scoreboard should look like. 
     * Return string HTML of Scoreboard.
     */

}

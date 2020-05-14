<?php
require_once(__DIR__ . '/inc/config.php');
// gameInstance variable references - $gamePhrase, $currentGame
$currentPhraseObject = unserialize($_SESSION["currentPhraseObject"]);
$currentGameObject = unserialize($_SESSION["currentGameObject"]);

    if(isset($_GET["userGuess"])) {
        $userGuess = filterGetString("userGuess");
        $returnKeyboard = $currentGameObject->displayKeyboard();    // TODO: this needs to render a specific keyboard based on inputs
        $responseJSON = "{
            \"userGuess\" : $userGuess,
            \"keyboard\" : $returnKeyboard
        }";


        echo $responseJSON;
    }
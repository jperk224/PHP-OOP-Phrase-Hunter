<?php
require_once(__DIR__ . '/inc/config.php');
// gameInstance variable references - $gamePhrase, $currentGame
$currentPhraseObject = unserialize($_SESSION["currentPhraseObject"]);
$currentGameObject = unserialize($_SESSION["currentGameObject"]);

    if(isset($_GET["userGuess"])) {
        var_dump($currentPhraseObject->getCurrentPhrase());
        var_dump($currentGameObject->getLives());
        $userGuess = filterGetString("userGuess");
        var_dump($userGuess);
    }
<?php
require_once(__DIR__ . '/inc/config.php');
// gameInstance variable references - $gamePhrase, $currentGame
$currentPhraseObject = unserialize($_SESSION["currentPhraseObject"]);
$currentGameObject = unserialize($_SESSION["currentGameObject"]);
var_dump($currentPhraseObject->getCurrentPhrase());
var_dump($currentGameObject->getLives());

    if(isset($_GET["userGuess"])) {
        $userGuess = filterGetString("userGuess");
        echo json_encode("hi");
    }
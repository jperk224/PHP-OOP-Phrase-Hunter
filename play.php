<?php

require_once(__DIR__ . '/inc/config.php');
require_once(__DIR__ . './views/header.php');

// filter $gamePhrases based on difficulty level selected
if(isset($_GET["difficulty"])) {
    if($_GET["difficulty"] == "easy") {
        $array = $gamePhrases->getAll("1 - easy", "difficulty");    
        //TODO: if the phrase has already been used, pluck it out before choosing one at random
        $phrase = $array[array_rand($array)]["phrase"];
    }
    else if($_GET["difficulty"] == "medium") {
        $array = $gamePhrases->getAll("2 - medium", "difficulty");
        $phrase = $array[array_rand($array)]["phrase"];
    }
    else if($_GET["difficulty"] == "hard") {
        $array = $gamePhrases->getAll("3 - hard", "difficulty");
        // with hard, we need the source for hints
        $phrase = $array[array_rand($array)];
        $source = $phrase["source"];
        $phrase = $phrase["phrase"];
    }
    else {  // player chose random, pull the entire phrase array and create a random phrase object
        $array = $gamePhrases->getAll();
        // grab the source if the randomly chosen phrase is hard difficulty
        $phrase = $array[array_rand($array)];
        if($phrase["difficulty"]  == "3 - hard") {
            $source = $phrase["source"];
        }
        $phrase = $phrase["phrase"];
    }    
}

$gamePhrase = new Phrase($gamePhrases, $phrase);
$currentGame = new Game($gamePhrase);
$currentGame->setLives($numberOfGuesses);       // explicitly set number of guesses so easily changed in config.php


?>

<main>
    <div class="main-container">
        <div id="banner" class="section">
            <h2 class="header">Phrase Hunter</h2>
        </div>
    </div>
</main>

<?php

require_once(__DIR__ . './views/footer.php');

?>

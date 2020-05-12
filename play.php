<?php

require_once(__DIR__ . '/inc/config.php');
require_once(__DIR__ . './views/header.php');

// variables for form persistence
$playerName = '';
$diffculty = '';

if(isset($_GET["playerName"])) {
	$playerName = filterGetString("playerName");
}

if(isset($_GET["difficulty"])) {
	$diffculty = filterGetString("difficulty");
}

// filter $gamePhrases based on difficulty level selected
if (isset($_GET["difficulty"])) {
    if ($_GET["difficulty"] == "easy") {
        $array = $gamePhrases->getAll("1 - easy", "difficulty");
        //TODO: if the phrase has already been used, pluck it out before choosing one at random
        $phrase = $array[array_rand($array)]["phrase"];
    } else if ($_GET["difficulty"] == "medium") {
        $array = $gamePhrases->getAll("2 - medium", "difficulty");
        $phrase = $array[array_rand($array)]["phrase"];
    } else if ($_GET["difficulty"] == "hard") {
        $array = $gamePhrases->getAll("3 - hard", "difficulty");
        // with hard, we need the source for hints
        $phrase = $array[array_rand($array)];
        $source = $phrase["source"];
        $phrase = $phrase["phrase"];
    } else {  // player chose random, pull the entire phrase array and create a random phrase object
        $array = $gamePhrases->getAll();
        // grab the source if the randomly chosen phrase is hard difficulty
        $phrase = $array[array_rand($array)];
        if ($phrase["difficulty"]  == "3 - hard") {
            $source = $phrase["source"];
        }
        $phrase = $phrase["phrase"];
    }
}

$gamePhrase = new Phrase($gamePhrases, $phrase);
$currentGame = new Game($gamePhrase);
$currentGame->setLives($numberOfGuesses);       // explicitly set number of guesses so easily changed in config.php

?>

<header>
    <div class="logo">
        <img src="images/letters1.jpg" alt="Phrase Hunter" />
        <h1>Phrase Hunter</h1>
    </div>
</header>
<nav class="navbar">
    <div id="hamburger">&#9776;</div>
    <ul class="menu" id="hamburger-menu">
        <li class="rules-render">Rules</li>
        <li class="game-start">New Game</li>
        <li><a href="index.php">Home</a></li>
    </ul>
</nav>

<main>
    <!-- The phrase display -->
    <div class="section">
        <?php      
        $currentGame->getPhrase()->addPhraseToDisplay();
        ?>
    </div>

    <!-- The Rules Modal -->
    <!-- adapted from W3 Schools 'How to Create a Modal Box' -->
    <!-- https://www.w3schools.com/howto/howto_css_modals.asp -->
    <div id="rules-modal" class="modal-container">
        <?php renderRules($numberOfGuesses); ?>
    </div> <!-- end rules modal -->

    <!-- <div class="main-container">
        <div id="banner" class="section">
            <h2 class="header">Phrase Hunter</h2>
        </div>
    </div> -->
</main>

<!-- Player Form - enter name and difficulty level -->
<div id="player-info" class="modal-container">
    <?php renderPlayerForm($playerName, $gamePhrases, $diffculty); ?>
</div>

<?php

require_once(__DIR__ . './views/footer.php');

?>
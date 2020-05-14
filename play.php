<?php

require_once(__DIR__ . '/inc/config.php');
require_once(__DIR__ . './views/header.php');

/* AJAX  receipt
1. chek whether user is right or wrong
2. if right, include 'number of letters'
3. if wrong -> you're wrong
4. render score
*/

// variables for form persistence
$playerName = '';
$diffculty = '';

if (isset($_GET["playerName"])) {
    $playerName = filterGetString("playerName");
}

if (isset($_GET["difficulty"])) {
    $difficulty = filterGetString("difficulty");
}

// filter $gamePhrases based on difficulty level selected
if (isset($difficulty)) {
    if ($difficulty == "easy") {
        $array = $gamePhrases->getAll("1 - easy", "difficulty");
        //TODO: if the phrase has already been used, pluck it out before choosing one at random
        $phrase = $array[array_rand($array)]["phrase"];
    } else if ($difficulty == "medium") {
        $array = $gamePhrases->getAll("2 - medium", "difficulty");
        $phrase = $array[array_rand($array)]["phrase"];
    } else if ($difficulty == "hard") {
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

// write these to a new file for ajax requests
//********************************************************************
$file = 'gameInstance.php';
$file_contents = '';
$file_contents .= '<?php' . "\n";
$file_contents .= 'require_once(__DIR__ . \'/inc/config.php\');' . "\n";
$file_contents .= '
    if(isset($_GET["userGuess"])) {
        $userGuess = filterGetString("userGuess");
        echo json_encode("hi");
    }';

file_put_contents($file, $file_contents);

//**********************************************************************

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
        <li class="rules-render menu-links">Rules</li>
        <li class="game-start menu-links">New Game</li>
        <li class="menu-links"><a href="index.php">Home</a></li>
    </ul>
</nav>
<article>
    <button onclick="submitUserGuess()">TEST AJAX</button>
    <div class="game-banner">
        <h3 id="game-header">Phrase Hunter</h3>
        <h3 id="lives-count">Remaining Guesses: <?php echo $numberOfGuesses; ?></h3>
    </div>
</article>
<main>
    <?php
    if (!empty($source)) {
        echo '<div class="main-button-wrapper" id="hint-button"><button class="form-buttons hint">Get Hint</button></div>';
    }
    ?>
    <!-- The phrase display -->
    <div class="section">
        <?php
        $currentGame->getPhrase()->addPhraseToDisplay();
        ?>
    </div>
</main>
<!-- The Rules Modal -->
<!-- adapted from W3 Schools 'How to Create a Modal Box' -->
<!-- https://www.w3schools.com/howto/howto_css_modals.asp -->
<div id="rules-modal" class="modal-container">
    <?php renderRules($numberOfGuesses); ?>
</div> <!-- end rules modal -->

<!-- Player Form - enter name and difficulty level -->
<div id="player-info" class="modal-container">
    <?php renderPlayerForm($playerName, $gamePhrases, $diffculty); ?>
</div>

<!-- Hint Modal -->
<div id="hint-modal" class="modal-container">
    <?php renderHint($source) ?>;
</div>

<?php

require_once(__DIR__ . './views/footer.php');

?>
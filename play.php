<?php

$page = 'play';

require_once(__DIR__ . '/inc/config.php');

// variables for persistence
if (isset($_SESSION["currentPhraseObject"])) {
    $currentPhraseObject = unserialize($_SESSION["currentPhraseObject"]);
} else {
    $currentPhraseObject = '';
}

if (isset($_SESSION["currentGameObject"])) {
    $currentGameObject = unserialize($_SESSION["currentGameObject"]);
} else {
    $currentGameObject = '';
}

$playerName = '';
$difficulty = '';

if (isset($_GET["userGuess"])) {     // AJAX handling

    $userGuess = strtoupper(filterGetString("userGuess"));
    if(!($currentGameObject->getPhrase()->checkLetter($userGuess))) {   // guess is wrong, lose a life
        $currentGameObject->setLives($currentGameObject->getLives() - 1);
    }
    $currentGameObject->getPhrase()->addGuess($userGuess);

    $gameOver = $currentGameObject->gameOver();
    $returnLives = $currentGameObject->getLives();
    $returnScoreboard = $currentGameObject->displayScore();
    $returnPhrase = $currentGameObject->getPhrase()->addPhraseToDisplay();
    $returnKeyboard = $currentGameObject->displayKeyboard();

    // overwrite the session objects so the user guesses persist in the selected array
    $_SESSION["currentPhraseObject"] = serialize($currentGameObject->getPhrase());
    $_SESSION["currentGameObject"] = serialize($currentGameObject);

    // JSON to return
    $responseJSON = "{
        \"userGuess\" : \"$userGuess\",
        \"keyboard\" : \"$returnKeyboard\",
        \"phrase\" : \"$returnPhrase\",
        \"livesHTML\" : \"$returnScoreboard\",
        \"livesRemain\" : \"$returnLives\",
        \"gameOver\" : \"$gameOver\"
    }";

    echo $responseJSON;
} else {    // It's not an AJAX request, we're starting a new game, render a new page

    require_once(__DIR__ . './views/header.php');

    if (isset($_GET["playerName"])) {
        $playerName = filterGetString("playerName");
    }

    if (isset($_GET["difficulty"])) {
        $difficulty = filterGetString("difficulty");
    } else {          // redirect home if difficuly not set, it should be

        header("location:index.php");
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
            // with hard, we need the definition for hints
            $phrase = $array[array_rand($array)];
            $definition = $phrase["definition"];
            $phrase = $phrase["phrase"];
        } else {  // player chose random, pull the entire phrase array and create a random phrase object
            $array = $gamePhrases->getAll();
            // grab the definition if the randomly chosen phrase is hard difficulty
            $phrase = $array[array_rand($array)];
            if ($phrase["difficulty"]  == "3 - hard") {
                $definition = $phrase["definition"];
            }
            $phrase = $phrase["phrase"];
        }
    }

    $gamePhrase = new Phrase($gamePhrases, $phrase);
    $currentGame = new Game($gamePhrase);
    $currentGame->setLives($numberOfGuesses);           // explicitly set number of guesses so easily changed in config.php
    $currentGame->setInitialLives($numberOfGuesses);    // needed to render lives lost, see Game::displayScore()

    // set session variables for these pieces so they can be referenced in the php file handling the AJAX request
    $_SESSION["currentPhraseObject"] = serialize($currentGame->getPhrase());
    $_SESSION["currentGameObject"] = serialize($currentGame);

    //TODO: Did these work?
    $_SESSION["playerName"] = $playerName;
    $_SESSION["difficulty"] = $difficulty;

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
    <article id="game-hero">
        <div class="game-banner">
            <h3 id="game-header">Player Name: <?php echo $playerName; ?></h3>
            <h3 id="lives-count">Remaining Lives: <?php echo $numberOfGuesses; ?></h3>
        </div>
        <div id="scoreboard" class="section">
            <?php echo $currentGame->displayScore(); ?>
        </div>
    </article>
    <main>
        <?php
        if (!empty($definition)) {
            echo '<div class="main-button-wrapper" id="hint-button"><button class="form-buttons hint">Get Hint</button></div>';
        }
        ?>
        <!-- The phrase display -->
        <div id="phraseDisplay" class="section">
            <?php echo $currentGame->getPhrase()->addPhraseToDisplay(); ?>
        </div>
        <!-- Display the keyboard -->
        <div id="qwerty" class="section">
            <?php echo $currentGame->displayKeyboard(); ?>
        </div>
        <!-- end keyboard display -->
    </main>
    <!-- The Rules Modal -->
    <!-- adapted from W3 Schools 'How to Create a Modal Box' -->
    <!-- https://www.w3schools.com/howto/howto_css_modals.asp -->
    <div id="rules-modal" class="modal-container">
        <?php renderRules($numberOfGuesses); ?>
    </div> <!-- end rules modal -->

    <!-- Player Form - enter name and difficulty level -->
    <div id="player-info" class="modal-container">
        <?php renderPlayerForm($playerName, $gamePhrases, $difficulty); ?>
    </div>

    <!-- Hint Modal -->
    <div id="hint-modal" class="modal-container">
        <?php renderHint($definition) ?>;
    </div>

    <!-- End of Game Modal -->
    <div id="game-over" class="modal-container"></div>

<?php

    require_once(__DIR__ . './views/footer.php');
}       // end of non-AJAX branch
?>
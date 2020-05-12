<?php

require_once(__DIR__ . '/inc/config.php');
require_once(__DIR__ . './views/header.php');

// filter $gamePhrases based on difficulty level selected
if(isset($_GET["difficulty"])) {
    if($_GET["difficulty"] == "easy") {
        $array = $gamePhrases->getAll("1 - easy", "difficulty");
        var_dump($array);
    }
    else if($_GET["difficulty"] == "medium") {
        $array = $gamePhrases->getAll("2 - medium", "difficulty");
        var_dump($array);
    }
    else if($_GET["difficulty"] == "hard") {
        $array = $gamePhrases->getAll("3 - hard", "difficulty");
        var_dump($array);
    }
    else {  // player chose random, pull the entire phrase array and create a random phrase object
        $array = $gamePhrases->getAll();
        var_dump($array);
    }    
}

$gamePhrase = new Phrase($gamePhrases);
// var_dump($gamePhrase);
// $currentGame = new Game($testPhrase);

//echo ($testPhrase->getCurrentPhrase());
//var_dump($testPhrase->splitPhrase());

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
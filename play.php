<?php

require_once(__DIR__ . '/inc/config.php');
require_once(__DIR__ . './views/header.php');


$testPhrase = new Phrase($gamePhrases);
$currentGame = new Game($testPhrase);

echo($testPhrase->getCurrentPhrase());
var_dump($testPhrase->splitPhrase());

?>

<div class="main-container">
    <div id="banner" class="section">
        <h2 class="header">Phrase Hunter</h2>
    </div>
</div>

</body>

</html>

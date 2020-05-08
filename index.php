<?php

require_once(__DIR__ . '/inc/config.php');
require_once(__DIR__ . './views/header.php');

$testPhrases = new ArrayRepo($phrases);
var_dump($testPhrases->getAll());
echo "****************************************************";
var_dump($testPhrases->getAll("difficulty"));


?>

<div class="main-container">
	<h2 class="header">Phrase Hunter</h2>
	<form action="play.php">
		<input id="btn__reset" type="submit" value="Start Game" />
	</form>
</div>

</body>

</html>
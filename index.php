<?php

require_once(__DIR__ . '/inc/config.php');
require_once(__DIR__ . './views/header.php');

// 
if($_SERVER["REQUEST_METHOD"] == "GET") {
	if(isset($_GET["rules"])) {
		echo '<script> console.log("Hi Jeff!"); </script>';
	}
	
	if(isset($_GET["test"])) {
		echo "Test Button Clicked";
	}
}


?>

<div class="main-container">
	<h2 class="header">Phrase Hunter</h2>
	<form action="play.php">
		<button class="form-buttons">Start Game</button>
		<button class="form-buttons" id="rules-render" formaction="index.php" name="rules">Rules</button>
	</form>
</div>

</body>

</html>
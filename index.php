<?php

require_once(__DIR__ . '/inc/config.php');
require_once(__DIR__ . '/views/header.php');

// variables for form persistence
$playerName = '';
$difficulty = '';

if(isset($_GET["playerName"])) {
	$playerName = filterGetString("playerName");
	$_SESSION["playerName"] = $playerName;
}
else if(isset($_SESSION["playerName"])) {
	$playerName = $_SESSION["playerName"];
}


if(isset($_GET["difficulty"])) {
	$difficulty = filterGetString("difficulty");
	$_SESSION["difficulty"] = $difficulty;
}
else if(isset($_SESSION["difficulty"])) {
	$difficulty = $_SESSION["difficulty"];
}


?>

<main>
	<div class="main-container">
		<h2 class="header">Phrase Hunter</h2>
			<div class="main-button-wrapper">
				<button class="form-buttons game-start">Start Game</button>
				<button class="form-buttons rules-render">Rules</button>
			</div>
	</div> 	<!--end main-container -->

	<!-- The Rules Modal -->
	<!-- adapted from W3 Schools 'How to Create a Modal Box' -->
	<!-- https://www.w3schools.com/howto/howto_css_modals.asp -->
	<div id="rules-modal" class="modal-container">
		<?php renderRules($numberOfGuesses); ?>
	</div> <!-- end rules modal -->
	
	<!-- Player Form - enter name and difficulty level -->
    <div id="player-info" class="modal-container">
		<?php renderPlayerForm($playerName, $gamePhrases, $difficulty, "index"); ?>	
    </div>
</main>

<?php 

require_once(__DIR__ . '/views/footer.php');

?>

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
		<?php renderPlayerForm($playerName, $gamePhrases, $diffculty, "index"); ?>	
		<!-- <div class="modal-content">
			<form action="play.php" method="get">
				<label for="playerName">Please Enter Your Name:</label>
				<input type="text" id="playerName" placeholder="Joe Smith" name="playerName"
				<?php 
				// if(!empty($playerName)) {
					// echo 'value="' . $playerName .'"';		// player name persistence 
				// } 
				?>><br>
				<label for="difficulty">Please Select Your Difficulty Level:</label>
				<select id="difficulty" name="difficulty">
					<option value="random">Random</option>
					<?php 
					// difficulty level form persistence via $difficulty argument
					// renderDifficulty($gamePhrases, $diffculty); 
					?>	
				</select><br>
				<button class="form-buttons">Let's Go!</button>
				<button class="form-buttons" formaction="index.php">I'm Not Ready</button>	<!-- go back home -->
			<!-- </form> -->
		<!-- </div> -->
    </div>
</main>

<?php 

require_once(__DIR__ . './views/footer.php');

?>

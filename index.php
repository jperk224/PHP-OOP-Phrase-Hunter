<?php

require_once(__DIR__ . '/inc/config.php');
require_once(__DIR__ . './views/header.php');

?>

<main>
	<div class="main-container">
		<h2 class="header">Phrase Hunter</h2>
		<form action="play.php">
			<button class="form-buttons">Start Game</button>
			<button class="form-buttons" id="rules-render">Rules</button>
			<!-- <input type="submit" class="form-buttons" value="Start Game">
			<input type="button" class="form-buttons" id="rules-render" value="Rules"> -->
		</form>
	</div>
	<!--end main-container -->

	<!-- The Rules Modal -->
	<!-- adapted from W3 Schools 'How to Create a Modal Box' -->
	<!-- https://www.w3schools.com/howto/howto_css_modals.asp -->
	<div id="rules-modal" class="modal-container">
		<?php renderRules($numberOfGuesses); ?>
		<!-- <div class="modal-content">
			<span class="close" id="rules-close">&times;</span>
			<h4>Phrase Hunter Rules</h4>
			<ul>
				<li>Guess all the letters in a hidden, random phrase!</li>
				<li>Use the onscreen keyboard.  Letters can only be guessed once.</li>
				<li>Can you get the phrase before  wrong guesses?</li> 
			</ul>
			<h5>Enjoy!</h5>
			<button class="form-buttons">Got it!</button>
		</div> -->
	</div> <!-- end rules modal -->
</main>

<?php 

require_once(__DIR__ . './views/footer.php');

?>

<?php

require_once(__DIR__ . '/inc/config.php');
require_once(__DIR__ . './views/header.php');

// 
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	if (isset($_GET["rules"])) {
		echo '<script> console.log("Hi Jeff!"); </script>';
	}

	if (isset($_GET["test"])) {
		echo "Test Button Clicked";
	}
}


?>

<main>
	<div class="main-container">
		<h2 class="header">Phrase Hunter</h2>
		<form action="play.php">
			<button class="form-buttons">Start Game</button>
			<button class="form-buttons" id="rules-render" formaction="index.php" name="rules">Rules</button>
		</form>
	</div>
	<!--end main-container -->

	<!-- The Rules Modal -->
	<!-- adapted from W3 Schools 'How to Create a Modal Box' -->
	<!-- https://www.w3schools.com/howto/howto_css_modals.asp -->
	<div id="rules-modal" class="modal-container">
		<div class="modal-content">
			<span class="close">&times;</span>
			<p>RULES... RULES...</p>
		</div>
	</div> <!-- end rules modal -->
</main>

<?php 

require_once(__DIR__ . './views/footer.php');

?>

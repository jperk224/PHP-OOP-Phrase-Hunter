<?php
require_once(__DIR__ . '/inc/config.php');

    if(isset($_GET["userGuess"])) {
        $userGuess = filterGetString("userGuess");
        echo json_encode("hi");
    }
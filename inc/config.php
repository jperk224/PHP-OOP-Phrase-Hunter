<?php

// include the data store
require_once(__DIR__ . '/phraseStore.php');

// include php functions
require_once(__DIR__ . '/functions.php');

/**
 * The config.php file is the first step in setting up the autoloader.
 * Use this file for all the shared functionality needed throughout the application
 * include this file on any page or a shared header
 */

// Start the session --> enables session variables
session_start();

/**
 * Class/Interface autoloader.
 * Autoload class files to eliminate the need to explicitly include them on each needed page.
 * Leverages glob to account for needed classes AND interfaces
 * @param string $className
 */

function autoloader($className) {

    /**
     * glob searches pathnames matching current directory/*
     * i.e. inc/Classes, inc/Interfaces
     * GLOB_ONLYDIR ensures only *directories* matching the provided pattern are returned
     */
    foreach(glob(__DIR__ . '/*', GLOB_ONLYDIR) as $directory) {
        // search for the needed file, once found, require it on the page and break out of the loop
        if(file_exists($directory . '/' . $className . '.php')) {
            require_once($directory . '/' . $className . '.php');
            break;
        }
    }
} 

/**
 * Autoloader registration.
 * When a class is instantiated, PHP passes the class name to spl_autoload_register().
 * The class name will be passed as the argument into the registered autoloader()
 * function to require the class file if its not already included.
 * (https://stackoverflow.com/questions/7651509/what-is-autoloading-how-do-you-use-spl-autoload-autoload-and-spl-autoload-re)
 */

 spl_autoload_register("autoloader");

$gamePhrases = new ArrayRepo($phrases); // the Phrase datastore for the game
$numberOfGuesses = 5;   // default game lives is 5 per requirements

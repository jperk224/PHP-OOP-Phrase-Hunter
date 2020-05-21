# PHP-OOP-Phrase-Hunter

## Unit 4 Project

### Game Show App

* Features mobile-first responsive design to render good UX across varying viewports
* Uses PHP OOP principles render random phrase puzzles
* Features modal overlays to display rules, select puzzle difficulty and render winning/losing notifications
* Session variables maintain player name and puzzle difficulty persistence
* AJAX technology updates game play in real time without full page refreshes
* Guess correctly and you'll feel pretty good about winning
* If you lose, just try again!
* Have Fun!

### CSS Edits

* General coloar scheme changes for different look/feel and accessibility contrast
* Body background- add CSS gradient for unique coloring
* Landing page header and game banner- add text shadow for contrast
* Form buttons
    * Changed color for improved contrast and flip colors on focus/hover for accessibility
    * Added slight box shadow effects for contrast
* Player form
    * Adjusted margins and flex spacing for better alignment (mobile)

#### Media Query for varying viewports
* Tablet/Full Screen
    * Remove Hamburger menu and render nav links
    * Various margin/padding/display adjustments for spacing and alignment

#### _Summarize the project and what problem it was solving_
This project served as a capstone for OOP in PHP.  I was tasked with developing classes to keep the source code modular.  I then wrote scripts to instantiate game objects for use in a game where the end user tries to solve a random, hidden phrase before guess attempts run out. 

This game can be enhanced in the future by using additonal global variables to track session high scores and flag puzzles from recurring for play until all other phrases under a particular difficulty level have been exhausted.  

#### _What did you do particularly well?_
I implemented AJAX funcitonality to play the game without continual page refreshes for the bext UX.  I developed data store interfaces that can be leveraged if the puzzle phrase store changes from something other than a PHP array.  I used mobile-first responsive design techniques to render a UI that has consistent look, feel and functionality across varying viewports including mobile, tablet, and full screen.

#### _Where could you enhance your code? How would these improvements make your code more efficient, secure, and so on?_
Some of the funcitons are built with branching that build the HTML differently based on whether its responding to an intial page GET or an AJAX request.  The led to some duplicate lines in the function.  These could be refactored to better reduce or eliminate duplication.

#### _Did you find writing any piece of this code challenging, and how did you overcome this?_
Building the AJAX functionality was the most difficult task for this project.  I had to break each step down repeatedly and test at a near unit-test-like level, while logging output to the console to validate results and expectations.

#### _What skills from this project will be particularly transferable to other projects and/or course work?_
Further refining OOP principles and solidifying my AJAX knowledge should transfer well to future development projects.

#### _How did you make this program maintainable, readable, and adaptable?_
Much of the code is built using the OOP paradigm with encapsulation.  Object instances share traits and methods that make their use repetable and easying maintainable from a single source file.
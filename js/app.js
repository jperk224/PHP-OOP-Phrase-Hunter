// index.php

// Render the rule modal
$(".rules-render").click(function(e) {
    $("#rules-modal").show();
});

// close the rules modal is the 'x' is clicked
$("#rules-close").click(function(e) {
    $("#rules-modal").hide();
});

// close the rules modal if the 'Got it' button is clicked
$("#rules-close-button").click(function(e) {
    $("#rules-modal").hide();
});

// close the rules modal if the user clicks anywhere outside the modal
$(".modal-container").click(function(e) {
    if( $(event.target).attr('class') === "modal-container" &&
        $("#rules-modal").css("display") === "block") {
        $("#rules-modal").hide();
    }
});

// render the from at game start to capture user info
$(".game-start").click(function(e) {
    $("#player-info").show();
});

// play.php

// toggle hamburger <ul> in mobile view
// jQuery toggle() did not play nice with the css display, so conditional is used
$("#hamburger").click(function(e) {
    $("#hamburger-menu").toggle();
});

// close the player form is user opts to not get a new game
$("#close-player-form").click(function(e) {
    $("#player-info").hide();
    e.preventDefault();
});

// render the hint modal
$("#hint-button").click(function(e) {
    $("#hint-modal").show();
});

// close the hint modal via 'x'
$("#hint-close").click(function(e) {
    $("#hint-modal").hide();
});

// close the hint modal via the button
$("#hint-close-button").click(function(e) {
    $("#hint-modal").hide();
});

// close the hint modal if the user clicks anywhere outside the modal
$(".modal-container").click(function(e) {
    if( $(event.target).attr('class') === "modal-container" &&
        $("#hint-modal").css("display") === "block") {
        $("#hint-modal").hide();
    }
});

// if the user clicks 'play again' prevent redirect home and render the difficulty selection form\
// Buttons don't exist at page load and are rendered dynamically via AJAX
// document.on is needed to append an event listener to dynamic content
// (https://stackoverflow.com/questions/27870794/jquery-click-event-preventdefault-not-working/27870969)
$(document).on('click','#play-again',function(e){
    e.preventDefault();
    $('#game-over').hide();
    $("#player-info").show();
    return false;
});

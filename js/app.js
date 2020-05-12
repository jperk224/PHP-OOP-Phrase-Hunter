// index.php

// Stop rules-render button from submitting the form
// use an anonymous callback to stop form submission and render the rules modal
$("#rules-render").click(function(e) {
    $("#rules-modal").show();
    e.preventDefault();
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
$("#game-start").click(function(e) {
    $("#player-info").show();
});

// play.php

// toggle hamburger <ul> in mobile view
// jQuery toggle() did not play nice with the css display, so conditional is used
$("#hamburger").click(function(e) {
    $("#hamburger-menu").toggle();
});

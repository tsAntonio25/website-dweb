// user log in
let loggedin = "<?php echo json_encode($_SESSION['loggedin']); ?>"

// menu
const menu = document.getElementById("usermenu")
const nouser = document.getElementById("nouser")
const withuser = document.getElementById("withuser")

// profile log in
function checkprofile() {

    console.log("nagclick");

    // show
    if (menu.style.display === "block") {
        menu.style.display = "none"

    } else {
        menu.style.display = "block" 

        // check
        if (loggedin) {
            // my profile and log out
            withuser.style.display = "block"
            nouser.style.display = "none"
            console.log("may user")

        } else {
            // sign up and login
            nouser.style.display = "block"
            withuser.style.display = "none"
            console.log("walang user")
        }
    }
}
// user log in
let username = "aweasd"
let password =" asdsff"

// menu
const menu = document.getElementsById("usermenu")
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
        if (username && password) {
            // my profile and log out
            withuser.document.style.display = "block"

            // show profile and log out

            // style

        } else {
            // sign up and login

            // show profile and log out
            withuser.document.style.display = "block"

            // style
        }
    }
}
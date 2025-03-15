// user log in
let username
let password

// menu
const menu = document.getElementsById("usermenu")

// profile log in
function checkprofile() {

    // show
    if (menu.style.display === "block") {
        menu.style.display = "none"

    } else {
        menu.style.display = "block" 

        // check
        if (username && password) {
            // my profile and log out
            optn1.innerHTML = "My Profile"
            optn2.innerHTML = "Log Out"

            // show profile and log out

            // style

        } else {
            // sign up and login

            // show profile and log out

            // style
        }
    }
}
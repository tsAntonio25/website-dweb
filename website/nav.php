<html lang="en">
    <head>
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class = "logo">
            <a href="landing.php"><img src="assets\logo.png" alt="car logo"></a>
            <a href="landing.php"><h2>The Garage</h2></a>
        </div>
        <nav class='headerNav'>
            <ul>
                <li><a href = "home.php">HOME</a></li>
                <li><a href = "carlisting.php">CAR LISTING</a></li>
                <li><a href = "about.php" >ABOUT</a></li>
                <li><a href = "contact.php">CONTACT</a></li>
                <li><i onclick="checkprofile()" class="fa fa-user-circle-o"></i>
                </li>
            </ul>
        </nav>
        <div id="usermenu">
            <div class="menu-container">
                <div class="nouser" id="nouser">
                    <ul>
                    <li><a href="signup.php">Sign Up</a></li>
                    <li><a href="login.php">Log In</a></li>
                    </ul>
                </div>

                <div class="withuser" id="withuser">
                <ul>
                    <li><a href="myprofile.php">My Profile</a></li>
                    <li><a href="">Log Out</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <script src="js\script.js"></script>
    </body> 
</html>

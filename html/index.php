<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lock N Key</title>


    <link rel="icon" type="image/png" href="../images/android-chrome-512x512.png">
    <link rel="manifest" href="../images/site.webmanifest">

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/loader.css">
</head>

<body>
    <div class="loader-container">
        <svg class="loader" viewbox="0 0 300 300">
            <circle cx="150" cy="150" r="60" stroke="#66FCF1" />
            <circle cx="150" cy="150" r="50" stroke="#A8CF45" />
            <circle cx="150" cy="150" r="40" stroke="#66FCF1" />
            <circle cx="150" cy="150" r="30" stroke="#A8CF45" />
            <circle cx="150" cy="150" r="20" stroke="#66FCF" />
            <circle cx="150" cy="150" r="10" stroke="#A8CF45" />
        </svg>
        <h1>Lock And Key</h1>
    </div>

    <header>
        <div class="nav-container">
            <div class="navbar">
                <img src="../images/logo.PNG" alt="logo" width="100">
                <ul>
                    <a href="index.php" id="active">
                        <li id="one">Home</li>
                    </a>
                    <a href="signup.php" id="u1">
                        <li id="two">sign up</li>
                    </a>
                    <a href="login.php" id="u2">
                        <li id="three">login</li>
                    </a>
                    <a href="logout.php" id="four" style="display:none">
                        <li>logout</li>
                    </a>
                </ul>
            </div class="navbar">
        </div>
        </div>
    </header>
<?php

if (array_key_exists("loggedin", $_SESSION)) {
    if ($_SESSION["loggedin"] == true) {
        echo '<script>
var a=document.getElementById("two");
a.innerHTML="Generator";
var b=document.getElementById("three");
b.innerHTML="Locker";
document.getElementById("u1").href = "generate.html";
document.getElementById("u2").href = "safe.html";
var c=document.getElementById("four");
c.style.display="block";
</script>';
    }
}

?>
    <main class="home-main">

        <div class="desc-container">
            <h1 class="header">
                <span class="typing" data-wait="2000" data-words='["One Place For","All Your Passwords"]'
                    style="text-transform: capitalize;"></span>
            </h1>
            <marquee behavior="scroll" direction="horizontal" scrollamount="12">Strong Encrypted Secure Storage for all
                your passwords</marquee>
        </div>

        <div class="generator-container">
            <h1>Password Generator</h1>
            <div class="password-output">
                <textarea name="" id="ran" readonly rows="1"></textarea>
                <span class="fa fa-clipboard fa-2x copy tooltip" aria-hidden="true" onclick="copy(event)">
                    <span class="tooltiptext" style="font-size: 15px;">Copied</span>
                </span>
            </div>
            <button onclick="build()">Build</button>

            <p style="text-align: center;">To make more custom strong password and save it to your personal locker
                <a href="login.php">Log In</a></p>
        </div>
    </main>
</body>
<footer>
    <div class="copyright">Copyright © 2020 Lock&Key</div>
    <div>
        <a href="https://github.com/Jas-077/IWP_Project" target="_blank">
            <i class="fa fa-github fa-2x" aria-hidden="true"></i>
        </a>
    </div>

    <script src="../js/loader.js"></script>
    <script src="../js/homepage.js"></script>
</footer>
<script>

    function copy(event) {
        var pswd = event.target
        // console.log(pswd)
        var parent = pswd.parentElement
        //console.log(parent)

        var pswdtxt = parent.getElementsByTagName("textarea")[0]
        pswdtxt.select()
        document.execCommand('copy')

        var tooltip = parent.getElementsByClassName('tooltiptext')[0]
        //console.log(tooltip)
        tooltip.style.visibility = "visible"

        setTimeout(function () {
            tooltip.style.visibility = "hidden"
        }, 1000)
    }

    function build() {

    var x = document.getElementById("ran");

    var arr = ['sletters', 'uletters', 'numbers', 'special']
    var dict = {
        'sletters': "abcdefghijklmnopqrstuvwxyz",
        'uletters': "ABCDEFGHIJKLMNOPQRSTUVWXYZ",
        'numbers': "0123456789",
        'special': "~`!@#$%^&*()_-+={[}]|\:;'<,>.?/"
    }

    var pswd = ""
    for (var i = 0; i < 10; i++) {
        var j = Math.ceil((Math.random() * 16 + i)) % 8
        if (j >= 0 && j < 2) j = 0
        else if (j >= 2 && j < 4) j = 1
        else if (j >= 4 && j < 6) j = 2
        else if (j >= 6 && j < 8) j = 3
        pswd += dict[arr[j]][Math.floor((Math.random() * 15) % arr[j].length)]
    }

    x.innerHTML = pswd;
    }
    build()
</script>

</html>
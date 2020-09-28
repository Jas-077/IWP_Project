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
</head>

<body>
    <header>
        <div class="nav-container">
            <div class="navbar">
                <img src="../images/logo.PNG" alt="logo" width="100">
                <ul>
                    <a href="homepage.html" id="active">
                        <li id="one">Home</li>
                    </a>
                    <a href="signup.php" id="u1">
                        <li id="two">sign up</li>
                    </a>
                    <a href="login.php" id="u2">
                        <li id="three">login</li>
                    </a>
                </ul>
            </div class="navbar">
        </div>
        </div>
    </header>
<?php
if($_SESSION["loggedin"]==true)
{
echo '<script>
var a=document.getElementById("two");
a.innerHTML="Genertor";
var b=document.getElementById("three");
b.innerHTML="Safe";
document.getElementById("u1").href = "generate.html";
document.getElementById("u2").href = "safe.html";
</script>';
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
            <button>Build</button>

            <p style="text-align: center;">To make more custom strong password and save it to your personal locker
                <a href="login.html">Log In</a></p>
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

    var x = document.getElementById("ran");
    var z = Math.floor((Math.random() * (15 - 12)) + 12);
    var r = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ ~`!@#$%^&*()_-+={[}]|\:;'<,>.?/";
    var t = "";
    for (var i = 0; i < 10; i++) {
        t += r[Math.floor(Math.random() * r.length)];
    }
    x.innerHTML = t;
</script>

</html>
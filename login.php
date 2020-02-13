<?php
require 'connect.php';
include 'functions.php';
?>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<script src="https://kit.fontawesome.com/231d0d22c1.js" crossorigin="anonymous"></script>
<link href='https://fonts.googleapis.com/css?family=IBM Plex Mono' rel='stylesheet'>
<link rel="stylesheet" href="login.css">
<style>
    body {
        font-family: 'IBM Plex Mono';
    }
</style>
</head>
<body>
<div id="particles-js"></div>
<div id="top_bar">
    <div id="title">
        <a style="color: white; text-decoration:none;" href="main.php">theWall<i class="fas fa-user-secret" id="title_icon"></i></a>
    </div>
    <div id="nav_bar">
        <a class="nav_button" href="upload.php" value="upload">upload</a>
        <a class="nav_button" href="login.php" value="login">login</a>
        <a class="nav_button" href="https://www.marxists.org/archive/marx/works/download/pdf/Manifesto.pdf">Marx's manifest</a>
        <input type="text" id="search_input" placeholder="search" style="font-family: 'IBM Plex Mono'">
        <i class="fas fa-search" id="search_icon"></i>
    </div>
</div>
<div id="page_content">
<?php
$userinfo = $pdo->query('select * from users');
if (!isset($_GET['register'])) {?>
    <form method="post" class="login_form">
    <h id="text_sign_in">Sign In</h>
        <input type="text" name="username" id="username" class="text_input" placeholder="username">
        <input type="password" name="password" id="password" class="text_input" placeholder="password">
        <input type="submit" name="send_request" value="Log in" id="submit-button" style="font-family: 'IBM Plex Mono'">
        <a id="text_register_link" href="login.php?register=1">Dont have an account?</a>
    </form>
    
    <?php
    if (isset($_POST["send_request"])){
        foreach($userinfo as $row){
            $auth = password_verify($_POST['password'], $row['password']);
            var_dump($auth);
            if ($_POST['username'] == $row['username'] && $auth === TRUE){
                echo "logged in as ".$_POST['username'].PHP_EOL;
                setcookie("LoggedInUser", $row['userID'], time() + 86400);
                header("Location: ./main.php");
            }
        }
        echo "failed to log in, try again.";
    }
}
else{
    ?>
    <form method="post" onsubmit="return confirm('Are you sure you want to register?');" id="login" class="login_form">
        <h id="text_sign_in">Register</h>
        <input type="text" class="text_input" name="username" id="username" placeholder="username">
        <input type="password" class="text_input" name="password" id="password" placeholder="password">
        <input type="password" class="text_input" name="confpassword" id="password" placeholder="confirm password">
        <h id="text_register_link">How much do you like jazz?</h>
        <div id="rangebox"><output id="rangevalue">5</output><h id="rangevalue">/10</h></div>
        <input type="range" name="jazzlevel" min="0" max="10" onchange="rangevalue.value=value"/>
        <input type="submit" id="submit-button" name="register" value="Register" style="font-family: 'IBM Plex Mono'">
    </form><?php
    if (isset($_POST['register'])){
        $users = $pdo->query('select username from users');
        $unique = true;
        foreach ($users as $user) {
            if ($_POST['username'] == $user['username']){
                $unique = false;
            }
        }
        if ($_POST['password'] == $_POST['confpassword'] && $unique == true) {
            $crypt = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $query = "insert into users (username, password, IQ) VALUES(:user, :pass, :iq)";
            $pdoresult = $pdo->prepare($query);
            $pdoExec = $pdoresult->execute(array(":user"=>$_POST['username'],":pass"=>$crypt,":iq"=>calcJazz($_POST['jazzlevel'])));

            ?><script>document.getElementById("login").style.display ="none";</script>
            <p>Successfully registered! <a href="login.php">Return to login</a></p><?php
        }
        elseif ($unique == true){
            echo "passwords do not match.";
        }
        else {
            echo "username is not unique.";
        }
    }
}?>
</div>

</body>
<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script>
            particlesJS.load('particles-js', 'particles.json', function(){
            console.log('particles.json loaded...');
            });
</script>
</html>
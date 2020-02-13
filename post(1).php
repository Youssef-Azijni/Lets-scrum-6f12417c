<?php
require 'connect.php';
include 'functions.php';
$comments = $pdo->query('select * from comments where postID ='.$_GET['id']);
?>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<script src="https://kit.fontawesome.com/231d0d22c1.js" crossorigin="anonymous"></script>
<link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
<script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link href='https://fonts.googleapis.com/css?family=IBM Plex Mono' rel='stylesheet'>
<link rel="stylesheet" href="post.css">
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
<div id="all">
    <?php
     loadCurrentPost($_GET['id']);
    ?>
    <div class="comment_section">
        <form method="post" style="margin: 0; padding: 0; display:flex;">
            <textarea placeholder="place your comment" name="comment" id="comment_input" required></textarea>
            <input id="submit_comment" type="submit" name="submit_comment" value="commit" onsubmit="cleanComments()">
        </form>
    </div>
    <div id="comments">
    <?php
    if (isset($_POST['submit_comment']) && $_POST['comment'] != ""){
        $pdo->query("insert into comments (postID, content) VALUES(".$_GET['id'].",'".$_POST['comment']."') ");
    }
    loadComments($_GET['id']);
    ?>
        </div>
</div>

<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script>
    particlesJS.load('particles-js', 'particles.json', function(){
    console.log('particles.json loaded...');
    });
</script>
<script>
    function cleanComments(){
        document.getElementById('comments').innerHTML = "";
    }
</script>
</body>
</html>
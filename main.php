<?php
require 'connect.php';
include 'functions.php';
$postinfo = $pdo->query('select * from posts');
?>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

<script src="https://kit.fontawesome.com/231d0d22c1.js" crossorigin="anonymous"></script>
<link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
<script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link href='https://fonts.googleapis.com/css?family=IBM Plex Mono' rel='stylesheet'>
<link rel="stylesheet" href="mobile.css">
<style>
    body {
        font-family: 'IBM Plex Mono';
    }
</style>
</head>
<body>
<div id="particles-js"></div>
<div onclick="closePost()" id="page" style="width: 100%; height:100%; position:absolute;">
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
loadPosts();
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
document.getElementById("page").addEventListener("click", closePost);
function gotoPost(id){
    window.location.assign("post.php?id="+id);
}
function readPost(id) {
    document.getElementById(id).style.height = "max-content";
   
}
function closePost(){
        document.getElementsByClass("post_frame").style.height = "160px";
}

// document.getElementById("particles-js").addEventListener("click", closePost);

</script>
</body>
</html>
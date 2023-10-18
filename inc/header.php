<?php
require_once 'functions/dbFunctions.php';
   if($_POST['searchSubmit']){
    $search = trim(filter_input(INPUT_POST, 'search', FILTER_SANITIZE_STRING));
    $result = search($search);
    var_dump($result);
   }
?>

<div>
    <ul class="header">
       <li><a href="index.php"><img class='logo' src="https://static.vecteezy.com/system/resources/thumbnails/009/351/562/small/play-button-sign-png.png" alt=""></a></li>
        <li class = 'headerLink'><a href="addMovies.php">Add Movie</a></li>
        <li class = 'headerLink'><a href="addSongs.php">Add Song</a></li>
        <li class = 'headerLink'><a href="movies.php">Movies</a></li>
        <li class = 'headerLink'><a href="songs.php">Songs</a></li>
    </ul>
</div>

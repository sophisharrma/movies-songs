<?php 
require_once "functions/dbFunctions.php";
$movies = getMovies();
$songs = getSongs();
$randomMovies = array_rand($movies, 4);
$randomSongs = array_rand($songs,4);
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, intial-scale=1.0">
        <title>index</title>
        <link rel='stylesheet' type="text/css" href='styles.css'>
    </head>
    <body>
        <?php require_once 'inc/header.php'; ?>
        <h2>Some Random Movies</h2>
        <div class='wrapper'>
            <?php 
           foreach($randomMovies as $movie){?>
            <div class='box'>
                <img class="img" src="<?php echo $movies[$movie]['movieImg']?>" alt="">
                <h3><?php echo ucwords($movies[$movie]['movieTitle'])?></h3>
                <span><strong>Rating - </strong><?php echo $movies[$movie]['movieRating']?></span> <br>
                <p><strong>Description - </strong><?php echo substr($movies[$movie]['movieDesc'],0,100).'...'?></p>
            </div>
            <?php 
            } ?>
        </div>

        <h2>Some Random Songs</h2>
        <div class='wrapper'>
            <?php 
           foreach($randomSongs as $song){?>
            <div class='box'>
                <img class="img" src="<?php echo $songs[$song]['songImg']?>" alt="">
                <h3><?php echo ucwords($songs[$song]['songTitle'])?></h3>
                <span><strong>Rating - </strong><?php echo $songs[$song]['songRating']?></span> <br>
                <p><strong>Singers- </strong><?php echo ucwords($songs[$song]['songSingers'])?></p>
            </div>
            <?php 
            } ?>
        </div>

    </body>
</html>
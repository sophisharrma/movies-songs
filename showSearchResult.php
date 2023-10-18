<?php
require_once 'functions/dbFunctions.php';
   
    if($_POST['TitlesSubmit']){
        $titleSearch = trim(filter_input(INPUT_POST, 'TitlesSearch', FILTER_SANITIZE_STRING));
        $result = searchByTitle($titleSearch);
    }
    if($_POST['RatingsSubmit']){
        $ratingSearch = trim(filter_input(INPUT_POST, 'RatingsSearch', FILTER_SANITIZE_NUMBER_INT));
        $result = searchByRating($ratingSearch);
    }
    if($_POST['DescriptionSubmit']){
        $descSearch = trim(filter_input(INPUT_POST, 'DescriptionSearch', FILTER_SANITIZE_STRING));
        $result = searchByDesc($descSearch);
    }

    if($_POST['TitlesSongSubmit']){
        $titleSearch = trim(filter_input(INPUT_POST, 'TitlesSongSearch', FILTER_SANITIZE_STRING));
        $resultSong = searchBySongTitle($titleSearch);
    }
    if($_POST['RatingsSongSubmit']){
        $ratingSearch = trim(filter_input(INPUT_POST, 'RatingsSongSearch', FILTER_SANITIZE_NUMBER_INT));
        $resultSong = searchBySongRating($ratingSearch);
    }
    if($_POST['SingersSongSubmit']){
        $singerSearch = trim(filter_input(INPUT_POST, 'SingersSongSearch', FILTER_SANITIZE_STRING));
        $resultSong = searchBySingers($singerSearch);
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, intial-scale=1.0">
        <title>Show Movies</title>
        <link rel='stylesheet' type="text/css" href='styles.css'>
    </head>
    <body>
        <?php 
        require_once 'inc/header.php';
        ?>
        <h2>Result</h2>
        <div class='wrapper'>
            <?php 
            if(!empty($result))
            {
                foreach($result as $movie){?>
                    <div class='box'>
                        <img class="img" src="<?php echo $movie['movieImg']?>" alt="">
                        <h3><?php echo ucwords($movie['movieTitle'])?></h3>
                        <span><strong>Rating - </strong><?php echo $movie['movieRating']?></span> <br>
                        <p><strong>Description - </strong><?php echo substr($movie['movieDesc'],0,250)?></p>
                        
                    </div>
                    <?php } 
            }elseif(!empty($resultSong)){
                foreach($resultSong as $song){?>
                    <div class='box'>
                        <img class="img" src="<?php echo $song['songImg']?>" alt="">
                        <h3><?php echo ucwords($song['songTitle'])?></h3>
                        <span><strong>Rating - </strong><?php echo $song['songRating']?></span> <br>
                        <p><strong>Singers - </strong><?php echo $song['songSingers']?></p>
                        
                    </div>
                    <?php } 
            }
            else{ 
                echo "<p> No result found </p>"; 
                }
            ?>
        </div>
        
    </body>
</html>
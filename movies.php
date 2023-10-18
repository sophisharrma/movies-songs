<?php 
require_once "functions/dbFunctions.php";
$movies = getMovies();

if($_GET['movieIdDel']){
    $movieId = filter_input(INPUT_GET, 'movieIdDel', FILTER_SANITIZE_NUMBER_INT);
    if(deleteMovie($movieId)){
       header('location: movies.php');
    }else{
        echo 'deletion failed';
    }
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
        require_once 'inc/filtersMovie.php';
        ?>
        <h2>Movies</h2>
        <div class='wrapper'>
            <?php 
           foreach($movies as $movie){?>
            <div class='box'>
                <img class="img" src="<?php echo $movie['movieImg']?>" alt="">
                <h3><?php echo ucwords($movie['movieTitle'])?></h3>
                <span><strong>Rating - </strong><?php echo $movie['movieRating']?></span> <br>
                <p><strong>Description - </strong><?php echo substr($movie['movieDesc'],0,250)?></p>
                <a class='update' href="updateMovies.php?movieIdUpd=<?php echo $movie['movieId']?>">Update</a>
                <a class='delete' href="movies.php?movieIdDel=<?php echo $movie['movieId']?>">Delete</a>
            </div>
            <?php } ?>
        </div>
        
    </body>
</html>
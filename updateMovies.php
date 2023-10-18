<?php 
require_once 'inc/connection.php';
if($_POST['submit']){
    $title = filter_input(INPUT_POST, 'movieTitle', FILTER_SANITIZE_STRING);
    $rating = filter_input(INPUT_POST, 'imdbRating', FILTER_SANITIZE_NUMBER_FLOAT);
    $img = filter_input(INPUT_POST, 'img', FILTER_SANITIZE_URL);
    $desc = filter_input(INPUT_POST, 'desc', FILTER_SANITIZE_STRING);

    if(empty($title) || empty($rating) || empty($img)){
        $msg = 'field cannot be empty';
    }else{
        require_once 'functions/dbFunctions.php';
        if(insertMovie($title, $rating, $img, $desc)){
            $msg = "insertion done";
        }else{
            $msg = "insertion failed";
        }
    }
    
}

if($_GET['movieIdUpd']){
    $movieId = filter_input(INPUT_GET, 'movieIdUpd', FILTER_SANITIZE_NUMBER_INT);
}
if($_POST['update']){
    $title = filter_input(INPUT_POST, 'movieTitle', FILTER_SANITIZE_STRING);
    $rating = filter_input(INPUT_POST, 'imdbRating', FILTER_SANITIZE_NUMBER_FLOAT);
    $img = filter_input(INPUT_POST, 'img', FILTER_SANITIZE_URL);
    $desc = filter_input(INPUT_POST, 'desc', FILTER_SANITIZE_STRING);

    if(empty($title) || empty($rating) || empty($img)){
        $msg = 'field cannot be empty';
    }else{
        require_once 'functions/dbFunctions.php';
        if(updateMovie($title, $rating, $img, $desc, $movieId)){
            header('location: movies.php');
        }else{
            $msg = "updation failed";
        }
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, intial-scale=1.0">
        <title>Update Movies</title>
        <link rel='stylesheet' type="text/css" href='styles.css'>
    </head>
    <body>
        <?php require_once 'inc/header.php'; ?>
        <h2>Update Movie</h2>
        <pre styles='color:red'><?php echo $msg; ?></pre>
        <form class="form" action="" method='post'>
            <?php 
             global $conn;
             $selectMovieStmt = $conn->prepare('SELECT * FROM movies WHERE movieId=?');
             $selectMovieStmt->bindParam(1, $movieId, PDO::PARAM_INT);
             $selectMovieStmt->execute();
             while($row = $selectMovieStmt->fetch(PDO::FETCH_ASSOC)){
            ?>
            <label for="movieTitle">Title</label> :-
            <input type="text" id="movieTitle" name='movieTitle' value=<?php echo $row['movieTitle']?>><br>
            <label for="imdbRating">Rating</label> :-
            <input type="number" value=<?php echo $row['movieRating']?> min=0 max=5 id="imdbRating" name='imdbRating'> out of 5<br>
            <label for="img">Image Url</label> :-
            <input type="text" value=<?php echo $row['movieImg']?> id="img" name='img'><br>
            <label for="desc">Description</label> :-
            <input type="text" value=<?php echo $row['movieDesc']?> id="desc" name='desc' ><br>
            <?php } ?>
            <input type="submit" name='update' value="Update"><br>
        </form>
    </body>
</html>
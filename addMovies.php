<?php 

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

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, intial-scale=1.0">
        <title>Add Movies</title>
        <link rel='stylesheet' type="text/css" href='styles.css'>
    </head>
    <body>
        <?php require_once 'inc/header.php'; ?>
        <h2>Add Movie</h2>
        <pre styles='color:red'><?php echo $msg; ?></pre>
        <form class="form" action="" method='post'>
            <label for="movieTitle">Title</label> :-
            <input type="text" id="movieTitle" name='movieTitle'><br>
            <label for="imdbRating">Rating</label> :-
            <input type="float" min=0 max=5 id="imdbRating" name='imdbRating'> out of 5<br>
            <label for="img">Image Url</label> :-
            <input type="text" id="img" name='img'><br>
            <label for="desc">Description</label> :-
            <textarea type="text" id="desc" name='desc' rows="6" fixed></textarea><br>
            <input type="submit" name='submit' value="Add"><br>
        </form>
    </body>
</html>
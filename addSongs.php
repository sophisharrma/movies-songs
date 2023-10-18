<?php 

if($_POST['submit']){
    $title = filter_input(INPUT_POST, 'movieTitle', FILTER_SANITIZE_STRING);
    $rating = filter_input(INPUT_POST, 'imdbRating', FILTER_SANITIZE_NUMBER_FLOAT);
    $img = filter_input(INPUT_POST, 'img', FILTER_SANITIZE_URL);
    $singers = filter_input(INPUT_POST, 'singers', FILTER_SANITIZE_STRING);

    if(empty($title) || empty($rating) || empty($img)){
        $msg = 'field cannot be empty';
    }else{
        require_once 'functions/dbFunctions.php';
        if(insertSongs($title, $rating, $img, $singers)){
            $msg = "song insertion done";
        }else{
            $msg = "song insertion failed";
        }
    }
    
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, intial-scale=1.0">
        <title>Add Songs</title>
        <link rel='stylesheet' type="text/css" href='styles.css'>
    </head>
    <body>
        <?php require_once 'inc/header.php'; ?>
        <h2>Add Songs</h2>
        <pre styles='color:red'><?php echo $msg; ?></pre>
        <form class="form" action="" method='post'>
            <label for="movieTitle">Title</label> :-
            <input type="text" id="movieTitle" name='movieTitle'><br>
            <label for="imdbRating">Rating</label> :-
            <input type="float" min=0 max=5 id="imdbRating" name='imdbRating'> out of 5<br>
            <label for="img">Image Url</label> :-
            <input type="text" id="img" name='img'><br>
            <label for="singers">Singers</label> :-
            <input type="text" id="singers" name='singers'><br>
            <input type="submit" name='submit' value="Add"><br>
        </form>
    </body>
</html>
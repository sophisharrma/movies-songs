<?php 
require_once 'inc/connection.php';
if($_GET['updSongId']){
    $songId = filter_input(INPUT_GET, 'updSongId', FILTER_SANITIZE_NUMBER_INT);
}
if($_POST['update']){
    $title = filter_input(INPUT_POST, 'movieTitle', FILTER_SANITIZE_STRING);
    $rating = filter_input(INPUT_POST, 'imdbRating', FILTER_SANITIZE_NUMBER_FLOAT);
    $img = filter_input(INPUT_POST, 'img', FILTER_SANITIZE_URL);
    $singers = filter_input(INPUT_POST, 'singers', FILTER_SANITIZE_STRING);

    if(empty($title) || empty($rating) || empty($img)){
        $msg = 'field cannot be empty';
    }else{
        require_once 'functions/dbFunctions.php';
        if(updateSongs($title, $rating, $img, $singers, $songId)){
           header('location: songs.php');
        }else{
            $msg = "song updation failed";
        }
    }
    
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, intial-scale=1.0">
        <title>Update Songs</title>
        <link rel='stylesheet' type="text/css" href='styles.css'>
    </head>
    <body>
        <?php require_once 'inc/header.php'; ?>
        <h2>Update Songs</h2>
        <pre styles='color:red'><?php echo $msg; ?></pre>
        <form class="form" action="" method='post'>
            <?php 
            $getVal = $conn->prepare('SELECT * FROM songs WHERE songId=?');
            $getVal->bindParam(1, $songId, PDO::PARAM_INT);
            $getVal->execute();
            while($row = $getVal->fetch(PDO::FETCH_ASSOC)){
            ?>
            <label for="movieTitle">Title</label> :-
            <input type="text" value="<?php echo $row['songTitle']; ?>" id="movieTitle" name='movieTitle'><br>
            <label for="imdbRating">Rating</label> :-
            <input type="float" value="<?php echo $row['songRating']; ?>" min=0 max=5 id="imdbRating" name='imdbRating'> out of 5<br>
            <label for="img">Image Url</label> :-
            <input type="text" value="<?php echo $row['songImg']; ?>"id="img" name='img'><br>
            <label for="singers">Singers</label> :-
            <input type="text" value="<?php echo $row['songSingers']; ?>"id="singers" name='singers'><br>
            <?php } ?>
            <input type="submit" name='update' value="Update"><br>
        </form>
    </body>
</html>
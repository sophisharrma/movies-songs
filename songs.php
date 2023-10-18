<?php 
require_once "functions/dbFunctions.php";
$songs = getSongs();

if($_GET['delSongId']){
    $songId = filter_input(INPUT_GET, 'delSongId', FILTER_SANITIZE_NUMBER_INT);
    if(deleteSong($songId)){
        header('location: songs.php');
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
        <title>Show Songs</title>
        <link rel='stylesheet' type="text/css" href='styles.css'>
    </head>
    <body>
        <?php require_once 'inc/header.php';
        require_once 'inc/filtersSong.php'; ?>
        <h2>Songs</h2>
        <div class="wrapper">
            <?php 
           foreach($songs as $song){?>
            <div class='box'>
                <img  class="img" src="<?php echo $song['songImg']?>" alt="">
                <h3><?php echo ucwords($song['songTitle'])?></h3>
                <span>Rating - <?php echo $song['songRating']?></span> <br>
                <p><strong>Singers - </strong><?php echo ucwords($song['songSingers'])?></p>
                <a href="updateSongs.php?updSongId=<?php echo $song['songId']?>">Update</a>
                <a href="songs.php?delSongId=<?php echo $song['songId']?>">Delete</a>
            </div>
            <?php } ?>
        </div>
        
    </body>
</html>
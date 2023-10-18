<?php
 require_once 'inc/connection.php';

function insertMovie($title, $rating, $img, $desc){
    try{
        global $conn;
        $insertStmt = $conn->prepare('INSERT INTO movies(movieTitle, movieRating, movieImg, movieDesc)
        VALUES(?,?,?,?)');
        $insertStmt->bindParam(1, $title, PDO::PARAM_STR);
        $insertStmt->bindParam(2, $rating, PDO::PARAM_INT);
        $insertStmt->bindParam(3, $img, PDO::PARAM_STR);
        $insertStmt->bindParam(4, $desc, PDO::PARAM_STR);
        $insertStmt->execute();   
    }catch(PDOException $e){
        echo 'insert Function not working '. $e->getMessage();
        return false;
    }
    return true; 
}
function updateMovie($title, $rating, $img, $desc, $movieId){
    try{
        global $conn;
        $updateStmt = $conn->prepare('UPDATE movies 
        SET movieTitle=?,
        movieRating=?,
        movieImg=?,
        movieDesc=?
        WHERE movieID =?');
        $updateStmt->bindParam(1, $title, PDO::PARAM_STR);
        $updateStmt->bindParam(2, $rating, PDO::PARAM_INT);
        $updateStmt->bindParam(3, $img, PDO::PARAM_STR);
        $updateStmt->bindParam(4, $desc, PDO::PARAM_STR);
        $updateStmt->bindParam(5, $movieId, PDO::PARAM_INT);
        $updateStmt->execute();   
        
    }catch(PDOException $e){
        echo 'update Function not working '. $e->getMessage();
        return false;
    }
    return true; 
}
function getMovies(){
    global $conn;
    $selectMovieStmt = $conn->prepare('SELECT * FROM movies');
    $selectMovieStmt->execute();
    $movies = $selectMovieStmt->fetchAll(PDO::FETCH_ASSOC);
    return $movies;
}

function insertSongs($title, $rating, $img, $singers){
    try{
        global $conn;
        $insertSongStmt = $conn->prepare('INSERT INTO songs(songTitle, songRating, songImg, songSingers)
        VALUES(?,?,?,?)');
        $insertSongStmt->bindParam(1, $title, PDO::PARAM_STR);
        $insertSongStmt->bindParam(2, $rating, PDO::PARAM_INT);
        $insertSongStmt->bindParam(3, $img, PDO::PARAM_STR);
        $insertSongStmt->bindParam(4, $singers, PDO::PARAM_STR);
        $insertSongStmt->execute();
    }catch(PDOException $e){
        echo 'song insertion failed ' . $e->getMessage();
        return false;
    }
    return true;
}

function getSongs(){
    global $conn;
    $selectSongStmt = $conn->prepare("SELECT * FROM songs");
    $selectSongStmt->execute();
    $songs = $selectSongStmt->fetchAll(PDO::FETCH_ASSOC);
    return $songs;
}

function deleteMovie($movieId){
    try{
        global $conn;
        $deleteMovieStmt = $conn->prepare("DELETE FROM movies WHERE movieId=?");
        $deleteMovieStmt->bindParam(1, $movieId, PDO::PARAM_INT);
        $deleteMovieStmt->execute();
    }catch(PDOException $e){
        echo 'deletion failed ' . $e->getMessage();
        return false;
    }
    return true;
}

function deleteSong($songId){
    global $conn;
    try{
       $deleteSongStmt = $conn->prepare('DELETE FROM songs WHERE songId=?');
       $deleteSongStmt->bindParam(1, $songId, PDO::PARAM_INT);
       $deleteSongStmt->execute();
    }catch(PDOException $e){
        echo 'delete query failed' . $e->getMessage();
        return false;
    }
    return true;

}

function updateSongs($title, $rating, $img, $singers, $songId){
   global $conn;
   try{
    $updateSongStmt = $conn->prepare('UPDATE songs 
    SET songTitle = ?,
    songRating=?,
    songImg=?,
    songsingers=?
    WHERE songId=?');
    $updateSongStmt->bindParam(1, $title, PDO::PARAM_STR);
    $updateSongStmt->bindParam(2, $rating, PDO::PARAM_INT);
    $updateSongStmt->bindParam(3, $img, PDO::PARAM_STR);
    $updateSongStmt->bindParam(4, $singers, PDO::PARAM_STR);
    $updateSongStmt->bindParam(5, $songId, PDO::PARAM_INT);

    $updateSongStmt->execute();

   }catch(PDOException $e){
    echo ' update query failed' . $e->getMessage();
    return false;
   }
   return true;
}

function searchByTitle($titleSearch){
    global $conn;
    try{
        $searchStmt = $conn->prepare('SELECT * FROM movies WHERE movieTitle LIKE ?');
        $searchStmt->bindValue(1, '%'.$titleSearch.'%', PDO::PARAM_STR);
        $searchStmt->execute();
        $result = $searchStmt->fetchAll(PDO::FETCH_ASSOC);
    }catch(PDOException $e){
        echo 'search query failed' . $e->getMessage();
        return array();
    }
    return $result;
}

function searchBySongTitle($titleSearch){
    global $conn;
    try{
        $searchStmt = $conn->prepare('SELECT * FROM songs WHERE songTitle LIKE ?');
        $searchStmt->bindValue(1, '%'.$titleSearch.'%', PDO::PARAM_STR);
        $searchStmt->execute();
        $result = $searchStmt->fetchAll(PDO::FETCH_ASSOC);
    }catch(PDOException $e){
        echo 'search query failed' . $e->getMessage();
        return array();
    }
    return $result;
}


function searchByRating($ratingSearch){
    global $conn;
    try{
        $searchStmt = $conn->prepare('SELECT * FROM movies WHERE movieRating=?');
        $searchStmt->bindParam(1, $ratingSearch, PDO::PARAM_INT);
        $searchStmt->execute();
        $result = $searchStmt->fetchAll(PDO::FETCH_ASSOC);
    }catch(PDOException $e){
        echo 'search query failed' . $e->getMessage();
        return array();
    }
    return $result;
}    

function searchBySongRating($ratingSearch){
    global $conn;
    try{
        $searchStmt = $conn->prepare('SELECT * FROM songs WHERE songRating=?');
        $searchStmt->bindParam(1, $ratingSearch, PDO::PARAM_INT);
        $searchStmt->execute();
        $result = $searchStmt->fetchAll(PDO::FETCH_ASSOC);
    }catch(PDOException $e){
        echo 'search query failed' . $e->getMessage();
        return array();
    }
    return $result;
}
function searchByDesc($descSearch){
    global $conn;
    try{
        $searchStmt = $conn->prepare('SELECT * FROM movies WHERE movieDesc LIKE ?');
        $searchStmt->bindValue(1, '%'.$descSearch.'%', PDO::PARAM_STR);
        $searchStmt->execute();
        $result = $searchStmt->fetchAll(PDO::FETCH_ASSOC);
    }catch(PDOException $e){
        echo 'search query failed' . $e->getMessage();
        return array();
    }
    return $result;
}

function searchBySingers($singerSearch){
    global $conn;
    try{
        $searchStmt = $conn->prepare('SELECT * FROM songs WHERE songSingers LIKE ?');
        $searchStmt->bindValue(1, '%'.$singerSearch.'%', PDO::PARAM_STR);
        $searchStmt->execute();
        $result = $searchStmt->fetchAll(PDO::FETCH_ASSOC);
    }catch(PDOException $e){
        echo 'search query failed' . $e->getMessage();
        return array();
    }
    return $result;
}
<?php
require_once 'functions/dbFunctions.php';

?>

<div>
    <ul class="filter">
        <?php
        $movieColumnNames = ['Titles', 'Ratings', 'Singers'];
        foreach($movieColumnNames as $col){?>
            <li class = 'headerLink'>
               <?php echo $col; ?>
                <form action="showSearchResult.php" method="post">
                    <input type="text" name=' <?php echo $col.'SongSearch'; ?>'>
                    <input type="submit" name=' <?php echo $col.'SongSubmit'; ?>'>
                </form>
            </li>
        <?php }
        ?>
    </ul>
</div>

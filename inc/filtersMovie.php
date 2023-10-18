<div>
    <ul class="filter">
        <?php
        $movieColumnNames = ['Titles', 'Ratings', 'Description'];
        foreach($movieColumnNames as $col){?>
            <li class = 'headerLink'>
               <?php echo $col; ?>
                <form action="showSearchResult.php" method="post">
                    <input type="text" name=' <?php echo $col.'Search'; ?>'>
                    <input type="submit" name=' <?php echo $col.'Submit'; ?>'>
                </form>
            </li>
        <?php }
        ?>
    </ul>
</div>

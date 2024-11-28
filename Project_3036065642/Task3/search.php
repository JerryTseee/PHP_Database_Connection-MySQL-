<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Search a event</title>
        <style>
            th, td { border: 1px solid black; }
        </style>
    </head>
    <body>
        <?php
            include 'config.php';
        ?>
        <form action = "search_result.php" method = "post">
            <input type="search" name = "keyword" id="keyword">
            <input type="submit" value="Search">
        </form>
    </body>
</html>
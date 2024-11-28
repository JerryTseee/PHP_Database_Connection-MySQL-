<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Artists who held event in 703 Mallory St</title>
        <style>
            th, td { border: 1px solid black; }
        </style>
    </head>
    <body>
        <?php
            include 'config.php';
        ?>
        <?php
            $pdo = new PDO("mysql:dbname=${config['dbname']};host=${config['host']};charset=utf8", $config['name'], $config['pass']);
            //it is already distinct here! if use DISTINCT, it will be empty
            $sql = 'SELECT a.name, a.gender, a.artist_id FROM dbprj_artists a'
                    . ' WHERE a.artist_id IN (SELECT p.artist_id FROM dbprj_performs p, dbprj_events e'
                    . ' WHERE p.event_id = e.event_id AND e.address = "703 Mallory St")'
                    . ' ORDER BY a.name ASC, a.artist_id ASC';
            $result = $pdo->query($sql);

            //set up the table structure
            echo '<table>';
            echo '<tr>';
            echo '<th>Artist name</th>';
            echo '<th>Gender</th>';
            echo '</tr>';

            //print the results
            foreach ($result as $row){
                echo '<tr>';    
                $name = htmlspecialchars($row['name']);
                $aid = htmlspecialchars($row['artist_id']);
                echo '<td>';
                echo '<a href="artist_events.php?art=' . $aid . '">' . $name . '</a>';
                echo '</td>';
                echo '<td>' . htmlspecialchars($row['gender']).'</td>';
                echo '</tr>';
            }

            echo '</table>';
        ?>
    </body>
</html>

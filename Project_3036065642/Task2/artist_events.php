<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>artists_events</title>
        <style>
            th, td { border: 1px solid black; }
        </style>
    </head>
    <body>
        <?php
            include 'config.php';
        ?>
        <?php
            $pdo = new PDO("mysql:dbname=${config['dbname']};host=${config['host']};charset=utf8",$config['name'], $config['pass']);
            $artistID = $_GET['art'];
            $sql = 'SELECT e.name, e.address, e.schedule FROM dbprj_events e '
                    .'WHERE e.event_id IN (SELECT p.event_id FROM dbprj_performs p, dbprj_artists a '
                    .'WHERE p.artist_id = a.artist_id AND a.artist_id = :aid) '
                    .'ORDER BY e.schedule DESC, e.event_id ASC';

            $stmt = $pdo->prepare($sql);
            $stmt->execute([':aid'=>$artistID]);
            $result = $stmt->fetchAll();

            //set up the table structure
            echo '<table>';
            echo '<tr>';
            echo '<th>Event name</th>';
            echo '<th>Address</th>';
            echo '<th>Schedule</th>';
            echo '</tr>';
            foreach ($result as $row){
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['name']).'</td>';
                echo '<td>' . htmlspecialchars($row['address']).'</td>';
                echo '<td>' . htmlspecialchars($row['schedule']).'</td>';
                echo '</tr>';
            }
            echo '</table>';

        ?>
    </body>
</html>

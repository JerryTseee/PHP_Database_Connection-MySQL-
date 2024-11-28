<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>event</title>
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
            $sql = 'SELECT e.event_id, e.name, e.address, e.schedule, GROUP_CONCAT(a.name SEPARATOR ",") AS artists'
                . ' FROM dbprj_events e'
                . ' LEFT JOIN dbprj_performs p ON e.event_id = p.event_id'
                . ' LEFT JOIN dbprj_artists a ON p.artist_id = a.artist_id'
                . ' GROUP BY e.event_id'
                . ' ORDER BY e.schedule DESC, e.event_id ASC';
            $result = $pdo->query($sql);

            //set up the table structure
            echo '<table>';
            echo '<tr>';
            echo '<th>Event name</th>';
            echo '<th>Address</th>';
            echo '<th>Schedule</th>';
            echo '<th>Performers</th>';
            echo '<th>Add artist</th>';
            echo '</tr>';


            //print the results
            foreach ($result as $row){
                echo '<tr>';    
                echo '<td>' . htmlspecialchars($row['name']).'</td>';
                echo '<td>' . htmlspecialchars($row['address']).'</td>';
                echo '<td>' . htmlspecialchars($row['schedule']).'</td>';
                echo '<td>' . htmlspecialchars($row['artists']).'</td>';
                
                echo '<td><form action="add_artist.php" method="POST"><input type="hidden" name="event_id" value='.$row['event_id'].'"><input type="submit" value="Add artist"></form></td>';

                echo '</tr>';
            }

            echo '</table>';
        ?>
    </body>
</html>

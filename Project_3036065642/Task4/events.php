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
            $sql = 'SELECT e.name, e.address, e.schedule, COUNT(p.artist_id) AS num FROM dbprj_events e, dbprj_performs p'
                    . ' WHERE e.event_id = p.event_id'
                    . ' GROUP BY e.event_id'
                    . ' ORDER BY e.name, e.event_id ASC';
            $result = $pdo->query($sql);

            //set up the table structure
            echo '<table>';
            echo '<tr>';
            echo '<th>Event name</th>';
            echo '<th>Address</th>';
            echo '<th>Schedule</th>';
            echo '<th>Performers</th>';
            echo '</tr>';

            //print the results
            foreach ($result as $row){
                echo '<tr>';    
                $name = htmlspecialchars($row['name']);
                $eid = htmlspecialchars($row['event_id']);
                echo '<td>';
                echo '<a href="view_event.php?e_name=' . $name . '">' . $name . '</a>';
                echo '</td>';
                echo '<td>' . htmlspecialchars($row['address']).'</td>';
                echo '<td>' . htmlspecialchars($row['schedule']).'</td>';
                echo '<td>' . htmlspecialchars($row['num']).'</td>';
                echo '</tr>';
            }

            echo '</table>';
        ?>
    </body>
</html>

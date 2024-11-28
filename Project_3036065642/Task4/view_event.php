<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>view_events</title>
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
            $eventName = $_GET['e_name'];
            //my first sql (make sure the table is complete!)
            $sql = 'SELECT e.name, e.address, e.schedule, d.director, NULL as conductor, GROUP_CONCAT(g.genre SEPARATOR ",") AS genres, NULL as instruments'
                    .' FROM dbprj_events e'
                    .' LEFT OUTER JOIN dbprj_dramas d ON e.event_id = d.event_id'
                    .' LEFT OUTER JOIN dbprj_genres g ON e.event_id = g.event_id'
                    .' WHERE e.name = :name AND d.director IS NOT NULL'
                    .' GROUP BY e.event_id'
                    .' UNION'
                    .' SELECT e.name, e.address, e.schedule, NULL as director, c.conductor, NULL as genres, GROUP_CONCAT(i.instrument SEPARATOR ",") AS instruments'
                    .' FROM dbprj_events e'
                    .' LEFT OUTER JOIN dbprj_concerts c ON e.event_id = c.event_id'
                    .' LEFT OUTER JOIN dbprj_instruments i ON e.event_id = i.event_id'
                    .' WHERE e.name = :name AND c.conductor IS NOT NULL'
                    .' GROUP BY e.event_id';

            $stmt = $pdo->prepare($sql);
            $stmt->execute([':name'=>$eventName]);
            $result = $stmt->fetchAll();

            echo '<table>';
            foreach ($result as $row){
                echo '<tr>';
                echo '<th>Name:</th>'; 
                echo '<td>' . htmlspecialchars($row['name']).'</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<th>Address:</th>';
                echo '<td>' . htmlspecialchars($row['address']).'</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<th>Schedule:</th>';
                echo '<td>' . htmlspecialchars($row['schedule']).'</td>';
                echo '</tr>';

                if(!empty($row['director'])){
                    echo '<tr><th>Director:</th><td>' . htmlspecialchars($row['director']) . '</td></tr>';
                    echo '<tr><th>Genres:</th><td>' . htmlspecialchars($row['genres']) . '</td></tr>';
                }
                else if(!empty($row['conductor'])){
                    echo '<tr><th>Conductor:</th><td>' . htmlspecialchars($row['conductor']) . '</td></tr>';
                    echo '<tr><th>Instruments:</th><td>' . htmlspecialchars($row['instruments']) . '</td></tr>';
                }
            }
            echo '</table>';
            
            //my second sql
            $sql = 'SELECT a.name, a.gender'
                    .' FROM dbprj_artists a'
                    .' WHERE a.artist_id IN (SELECT p.artist_id FROM dbprj_performs p, dbprj_events e'
                    .' WHERE p.event_id = e.event_id AND e.name = :name)'
                    .' ORDER BY a.name ASC, a.artist_id ASC';

            $stmt = $pdo->prepare($sql);
            $stmt->execute([':name'=>$eventName]);
            $result = $stmt->fetchAll();

            echo '<table>';
            echo '<tr>';
            echo '<th>Artist name</th>';
            echo '<th>Gender</th>';
            echo '</tr>';
            foreach ($result as $row){
                echo '<tr>';    
                echo '<td>' . htmlspecialchars($row['name']).'</td>';
                echo '<td>' . htmlspecialchars($row['gender']).'</td>';
                echo '</tr>';
            }
            echo '</table>';


            //my third sql(if it is a concert->display the parts)
            $sql = 'SELECT p.part_id, p.pic'
                    .' FROM dbprj_concerts_parts p'
                    .' WHERE p.event_id IN (SELECT e.event_id FROM dbprj_events e'
                    .' WHERE e.name = :name)'
                    .' ORDER BY p.part_id ASC';

            $stmt = $pdo->prepare($sql);
            $stmt->execute([':name'=>$eventName]);
            $result = $stmt->fetchAll();

            if(!empty($result)){
                echo '<table>';
                echo '<tr>';
                echo '<th>Part ID</th>';
                echo '<th>Person in charge</th>';
                echo '</tr>';
                foreach ($result as $row){
                    echo '<tr>';    
                    echo '<td>' . htmlspecialchars($row['part_id']).'</td>';
                    echo '<td>' . htmlspecialchars($row['pic']).'</td>';
                    echo '</tr>';
                }
                echo '</table>';
            }
        ?>
    </body>
</html>

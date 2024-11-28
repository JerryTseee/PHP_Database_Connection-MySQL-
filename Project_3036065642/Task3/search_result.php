<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Search result</title>
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

            $keyword = '%'.$_POST['keyword'].'%';//it is a LIKE clause
            $sql = 'SELECT e.name, e.address, e.schedule FROM dbprj_events e'
                    .' WHERE e.name LIKE :keyword ORDER BY e.name ASC, e.event_id ASC';
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':keyword' => $keyword]);
            $result = $stmt->fetchAll();

            echo '<table>';
            echo '<tr><th>Event name</th><th>Address</th><th>Schedule</th></tr>';

            foreach($result as $row){
                echo '<tr>';
                echo '<td>'. htmlspecialchars($row['name']).'</td>';
                echo '<td>'. htmlspecialchars($row['address']).'</td>';
                echo '<td>'. htmlspecialchars($row['schedule']).'</td>';
                echo '</tr>';
            }

            echo '</table>';

        ?>
    </body>
</html>
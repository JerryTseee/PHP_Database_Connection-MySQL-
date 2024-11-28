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
            
            $q = $_GET['q'];
            switch($q){
                case 1://if q = 1
                    $sql = "SELECT e.event_id, e.name"
                          ." FROM dbprj_events e"
                          ." LEFT OUTER JOIN dbprj_concerts c ON e.event_id = c.event_id"
                          ." WHERE e.schedule >= '2024-10-01 00:00'"
                          ." AND c.event_id IS NOT NULL"
                          ." ORDER BY e.schedule ASC"
                          ." LIMIT 4";
                          break;

                case 2://if q = 2
                    $sql = "SELECT e.event_id, e.name"
                          ." FROM dbprj_events e"
                          ." WHERE e.event_id IN("
                          ." SELECT p.event_id"
                          ." FROM dbprj_performs p"
                          ." WHERE p.artist_id IN("
                          ." SELECT p.artist_id"
                          ." FROM dbprj_performs p"
                          ." WHERE YEAR(e.schedule) = 2024"//only get the 2024 year
                          ." GROUP BY p.artist_id"
                          ." HAVING COUNT(e.event_id) >= 3))";
                          break;

                case 3://if q = 3
                    $sql = "SELECT e.event_id, e.name"
                          ." FROM dbprj_events e"
                          ." WHERE e.event_id NOT IN ("
                          ." SELECT c.event_id"
                          ." FROM dbprj_concerts c"
                          ." UNION"
                          ." SELECT d.event_id"
                          ." FROM dbprj_dramas d )";
                          break;
            }
            $result = $pdo->prepare($sql);
            $result->execute();
            
            foreach($result->fetchAll(PDO::FETCH_ASSOC) as $row){
                echo '('.implode(', ', $row) . ')<br>';
            }
            
        ?>
    </body>
</html>

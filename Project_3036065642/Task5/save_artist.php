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
            
            //collect values from form fields(still POST method)
            $event_id = $_POST['event_id'];
            $artist_id = $_POST['artist'];

            $sql = 'INSERT INTO dbprj_performs(artist_id, event_id) VALUES (:artist_id, :event_id)';
            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                    ':artist_id'=>$artist_id,
                    ':event_id'=>$event_id]);

            echo 'Artist added';
        ?>
    </body>
</html>

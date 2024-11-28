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
            
            $event_id = $_POST['event_id'];//get the event_id from the manage_events.php
            
            $sql = 'SELECT a.artist_id, a.name'
                 .' FROM dbprj_artists a'
                 .' WHERE a.artist_id NOT IN('
                 .' SELECT p.artist_id'
                 .' FROM dbprj_performs p'
                 .' WHERE p.event_id = :event_id)'
                 .' ORDER BY a.name ASC, a.artist_id ASC';
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':event_id'=>$event_id]);

            //Returns an array containing all of the result set rows
            $result = $stmt->fetchAll();


            //start building HTML form
            echo '<form action="save_artist.php" method="post">';//using post method
            echo '<label for="artist_name">Add artist:</label>';//label
			echo '<select name="artist" id="artist_name">';
            foreach($result as $row){//drop down menu
                echo '<option value="'. $row['artist_id'] . '">'//send the artist_id
				     . $row['name']
				     . '</option>';
            }
            echo '</select><br>';
            echo '<input type="hidden" name="event_id" value="'.$event_id.'">';//send the event_id
			echo '<input type="submit" value="Save">';
			echo '</form>';
            
        ?>
    </body>
</html>

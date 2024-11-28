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
            echo '<table>';

            echo '<tr>';
            echo '<th>Q_ID</th>';
            echo '<th>SQL</th>';
            echo '<th>Execute</th>';
            echo '</tr>';

            //first sql
            echo '<tr>';
            echo '<td>a</td>';
            echo '<td>example SQL 1</td>';
            echo '<td><a href="execute_sql.php?q=1">Execute</a></td>';
            echo '</tr>';

            //second sql
            echo '<tr>';
            echo '<td>b</td>';
            echo '<td>example SQL 2</td>';
            echo '<td><a href="execute_sql.php?q=2">Execute</a></td>';
            echo '</tr>';

            //third sql
            echo '<tr>';
            echo '<td>c</td>';
            echo '<td>example SQL 3</td>';
            echo '<td><a href="execute_sql.php?q=3">Execute</a></td>';
            echo '</tr>';

            echo '</table>';
        ?>
    </body>
</html>

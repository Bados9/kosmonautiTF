<?php
    $conn = pg_connect(getenv("DATABASE_URL")) or die('Could not connect: ' . pg_last_error());

    /*$query = 'DROP TABLE astronauts;';
    $result = pg_query($query) or die('Query failed: ' . pg_last_error());
    $query = 'CREATE TABLE astronauts (firstname VARCHAR(20) NOT NULL,
                                       surname VARCHAR(20) NOT NULL, 
                                       bdate DATE NOT NULL,
                                       superpower VARCHAR(50),
                                       PRIMARY KEY(firstname, surname, bdate));';
    
    $result = pg_query($query) or die('Query failed: ' . pg_last_error());*/

    $query = "INSERT INTO astronauts VALUES('Adam', 'Jiruška', '1999-01-02', 'neco');";
    $result = pg_query($query) or die('Query failed: ' . pg_last_error());

    $result = pg_query("SELECT * FROM astronauts");
    if (!$result) {
    echo "An error occurred.\n";
    exit;
    }

    while ($row = pg_fetch_row($result)) {
    echo "jméno: $row[0]  příjmení: $row[1] datum: $row[2] superschopnost: $row[3]";
    echo "<br />\n";
    }

    pg_close($dbconn);
?>
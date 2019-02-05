<?php
    $conn = pg_connect(getenv("DATABASE_URL")) or die('Could not connect: ' . pg_last_error());

    /*$query = 'CREATE TABLE astronauts (firstname VARCHAR(20),
                                       surname VARCHAR(20), 
                                       bdate DATE,
                                       superpower VARCHAR(50));';
    */
    $query = "INSERT INTO astronauts VALUES('David', 'Janeček', '2004-05-05', 'nic');";
    $result = pg_query($query) or die('Query failed: ' . pg_last_error());

    

    pg_close($dbconn);
?>
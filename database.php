<?php
    $conn = pg_connect(getenv("DATABASE_URL")) or die('Could not connect: ' . pg_last_error());
    echo "ahooj";
    $query = 'CREATE TABLE astronauts (firstname VARCHAR(20),
                                       surname VARCHAR(20), 
                                       bdate TIMESTAMP,
                                       superpower VARCHAR(50));';
    $result = pg_query($query) or die('Query failed: ' . pg_last_error());

    /*$db = parse_url(getenv("DATABASE_URL"));
    $db["path"] = ltrim($db["path"], "/");
    echo "ahoooj";
    echo $db["path"];*/
    pg_close($dbconn);
?>
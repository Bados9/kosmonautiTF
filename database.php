<?php
    $conn = pg_connect(getenv("DATABASE_URL")) or die('Could not connect: ' . pg_last_error());

    function newAstronaut($fname, $sname, $bdate, $superpwr){
        $query = "INSERT INTO astronauts VALUES(DEFAULT, '{$fname}', '{$sname}', '{$bdate}', '{$superpwr}');";
        echo $query;
        $result = pg_query($query) or die('Query failed: ' . pg_last_error());
    }

    function editAstronaut($astroID, $fname, $sname, $bdate, $superpwr){
        //$query = 'INSERT INTO astronauts VALUES(DEFAULT, $fname, $sname, $bdate, $superpwr);';
        $result = pg_query($query) or die('Query failed: ' . pg_last_error());
    }

    /*$query = 'DROP TABLE astronauts;';
    $result = pg_query($query) or die('Query failed: ' . pg_last_error());
    $query = 'CREATE TABLE astronauts (astroID SERIAL NOT NULL,
                                       firstname VARCHAR(20) NOT NULL,
                                       surname VARCHAR(20) NOT NULL, 
                                       bdate DATE NOT NULL,
                                       superpower VARCHAR(50),
                                       PRIMARY KEY(astroID, firstname, surname));';
    
    $result = pg_query($query) or die('Query failed: ' . pg_last_error());*/

    //newAstronaut("David", "Janeček", '2001-05-05', "nic");
    //newAstronaut("Adam", "Jiruška", '1999-01-02', "nemá");

    $result = pg_query("SELECT * FROM astronauts");
    if (!$result) {
    echo "An error occurred.\n";
    exit;
    }

    while ($row = pg_fetch_row($result)) {
    echo "jméno: $row[1]  příjmení: $row[2] datum: $row[3] superschopnost: $row[4]";
    echo "<br />\n";
    }

    pg_close($dbconn);
?>
<?php
    $conn = pg_connect(getenv("DATABASE_URL")) or die('Could not connect: ' . pg_last_error());

    function newAstronaut($fname, $sname, $bdate, $superpwr){
        $query = "INSERT INTO astronauts VALUES(DEFAULT, '{$fname}', '{$sname}', '{$bdate}', '{$superpwr}');";
        $result = pg_query($query) or die('Query failed: ' . pg_last_error());
    }

    function editAstronaut($astroID, $fname, $sname, $bdate, $superpwr){
        $query = "UPDATE astronauts SET firstname='{$fname}', surname='{$sname}', bdate='{$bdate}', superpower='{$superpwr}' WHERE astroID = {$astroID}";       
        $result = pg_query($query) or die('Query failed: ' . pg_last_error());
    }

    function removeAstronaut($astroID){
        $query = "DELETE FROM astronauts WHERE astroID = '{$astroID}';";
        $result = pg_query($query) or die('Query failed: ' . pg_last_error());
    }

    function getAstronaut($astroID){
        $query = "SELECT * FROM astronauts WHERE astroID = '{$astroID}';";
        $result = pg_query($query) or die('Query failed: ' . pg_last_error());
        $row = pg_fetch_row($result);
        echo json_encode($row);
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

    function getAllAstronauts(){
        $result = pg_query("SELECT * FROM astronauts");
        if (!$result) {
        echo "An error occurred.\n";
        exit;
        }
        return $result;
    }

    if(isset($_POST['action']) && !empty($_POST['action'])) {
        $function = $_POST['action'];
        switch($function) {
            case 'newAstronaut' : newAstronaut($_POST['fname'], $_POST['sname'], $_POST['bdate'], $_POST['superpwr']);break;
            case 'removeAstronaut' : removeAstronaut($_POST['id']);break;
            case 'getAstronaut' : getAstronaut($_POST['id']);break;
            case 'editAstronaug' : editAstronaut($_POST['id'], $_POST['fname'], $_POST['sname'], $_POST['bdate'], $_POST['superpwr']);break;
        }
    }

    pg_close($dbconn);
?>
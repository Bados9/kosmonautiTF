<html>
 <head>
    <title>Kosmonauti</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <meta charset="utf-8">
 </head>
 <body>
    <?php include 'database.php'; ?>
    <h1>Evidence kosmonautů</h1>
    
    <table class='table table-bordered'>
        <tr>
            <th>Jméno</th>
            <th>Příjmení</th>
            <th>Datum narození</th>
            <th>Superschopnost</th>
        </tr>
        <?
        $result = getAllAstronauts();
        while ($row = pg_fetch_row($result)){ ?>
        <tr>
            <td> <?= $row[1]; ?></td>
            <td> <?= $row[2]; ?></td>
            <td> <?= $row[3]; ?></td>
            <td> <?= $row[4]; ?></td>
        </tr>
        <?}?>
    </table>
 
</body>
</html>
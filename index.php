<html>
 <head>
    <title>Kosmonauti</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
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
            <th></th>
            <th></th>
        </tr>
        <?
        $result = getAllAstronauts();
        while ($row = pg_fetch_row($result)){ ?>
        <tr>
            <td> <?= $row[1]; ?></td>
            <td> <?= $row[2]; ?></td>
            <td> <?= $row[3]; ?></td>
            <td> <?= $row[4]; ?></td>
            <td> <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil text-warning"></span> Upravit</button> </td>
            <td> <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-remove text-danger"></span> Odstranit</button> </td>
        </tr>
        <?}?>
    </table>

    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal"> Přidat astronauta </button>

    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
                <p>Some text in the modal.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </div>

        </div>
    </div>
</body>
</html>
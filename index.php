<html>
 <head>
    <title>Kosmonauti</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <meta charset="utf-8">
 </head>
 <body>
    <script>
        $(document).ready(function(){
            $('#newAstronaut').click(function() {    
                console.log("jsem tu");
                $.ajax({ url: 'database.php',
                data: {func: 'newAstronaut'},
                type: 'post',
                success: function(output) {
                        alert(output);
                    }
                });
            });
        });

   </script>
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

    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#addAstronaut"> Přidat astronauta </button>

    <div id="addAstronaut" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Nový kosmonaut</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="name">Jméno:</label>
                        <input type="text" class="form-control" id="name">
                    </div>
                    <div class="form-group">
                        <label for="surname">Příjmení:</label>
                        <input type="text" class="form-control" id="surname">
                    </div>
                    <div class="form-group">
                        <label for="bdate">Datum narození:</label>
                        <input type="date" class="form-control" id="bdate">
                    </div>
                    <div class="form-group">
                        <label for="superpwr">Superschopnost:</label>
                        <input type="text" class="form-control" id="superpwr">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id ="newAstronaut" class="btn btn-default" data-dismiss="modal">Add</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>


</body>
</html>
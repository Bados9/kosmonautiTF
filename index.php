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
                $.ajax({    url: "database.php",
                            data: { action: "newAstronaut",
                                    fname: $('#fname').val(),
                                    sname: $('#sname').val(),
                                    bdate:  $('#bdate').val(),
                                    superpwr:  $('#superpwr').val()},
                            type: "POST",
                            success: function(){
                                var markup = <tr><td>a</td><td>b</td><td>c</td><td>d</td></tr>
                                $("table tbody").append(markup);

                                console.log("astronaut added");
                            }
                });
            });
        });
   </script>
    <?php include 'database.php'; ?>
    <h1>Evidence kosmonautů</h1>
    
    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>Jméno</th>
                <th>Příjmení</th>
                <th>Datum narození</th>
                <th>Superschopnost</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
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
        </tbody>
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
                        <label for="fname">Jméno:</label>
                        <input type="text" class="form-control" id="fname">
                    </div>
                    <div class="form-group">
                        <label for="sname">Příjmení:</label>
                        <input type="text" class="form-control" id="sname">
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
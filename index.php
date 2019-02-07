<html>
 <head>
    <title>Kosmonauti</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <meta charset="utf-8">
 </head>
 <body>
    <script>
        var removeID;
        $(document).ready(function(){
            //$('#astroTable').DataTable();
            //$('.dataTables_length').addClass('bs-select');
            $('#removeAstronaut').on('show.bs.modal', function(e) {
				removeID = $(e.relatedTarget).data('id');
                console.log("funguje aspon tohle?");
			}); 
            $('#removeByID').click(function() {
                console.log("removeID");
                $.ajax({    url: "database.php",
                            data: { action: "removeAstronaut",
                                    id: removeID },
                            type: "POST",
                            success: function(){
                                console.log("astronaut removed");
                            }
                });
            });
            $('#newAstronaut').click(function() {    
                $.ajax({    url: "database.php",
                            data: { action: "newAstronaut",
                                    fname: $('#fname').val(),
                                    sname: $('#sname').val(),
                                    bdate:  $('#bdate').val(),
                                    superpwr:  $('#superpwr').val()},
                            type: "POST",
                            success: function(){
                                var markup = "<tr> \
                                                <td>" + $('#fname').val() + "</td> \
                                                <td>" + $('#sname').val() + "</td> \
                                                <td>" + $('#bdate').val() + "</td> \
                                                <td>" + $('#superpwr').val() + "</td> \
                                                <td> <button type='button' class='btn btn-default'><span class='glyphicon glyphicon-pencil text-warning'></span> Upravit</button> </td> \
                                                <td> <button type='button' class='btn btn-default'><span class='glyphicon glyphicon-remove text-danger'></span> Odstranit</button> </td> \
                                              </tr>";
                                $("table tbody").append(markup);

                                console.log("astronaut added");
                            }
                });
            });
        });
   </script>
    <?php include 'database.php'; ?>
    <h1>Evidence kosmonautů</h1>
    
    <table id='astroTable' class='table table-bordered dataTable'>
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
        <?php
        function refreshTable(){
        $result = getAllAstronauts();
        while ($row = pg_fetch_row($result)){ ?>
        <tr>
            <td> <?= $row[1]; ?></td>
            <td> <?= $row[2]; ?></td>
            <td> <?= $row[3]; ?></td>
            <td> <?= $row[4]; ?></td>
            <td> <button type="button" class="btn btn-default">
                    <span class="glyphicon glyphicon-pencil text-warning"></span> Upravit</button> </td>
            <td> <button type="button" id="remove" class="btn btn-default" data-id="<?= $row[0]; ?>" data-toggle="modal" data-target="#removeAstronaut">
                    <span class="glyphicon glyphicon-remove text-danger"></span> Odstranit</button> </td>
        </tr>
        <?}};refreshTable();?>
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
                <button type="button" id ="newAstronaut" class="btn btn-default" data-dismiss="modal">Přidat</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Zavřít</button>
            </div>
            </div>
        </div>
    </div>

    <div id="removeAstronaut" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Potvrzení</h4>
            </div>
            <div class="modal-body">
                Opravdu chcete kosmonauta odstranit z evidence?
            </div>
            <div class="modal-footer">
                <button type="button" id="removeByID" class="btn btn-default" data-dismiss="modal">Ano</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Ne</button>
            </div>
            </div>
        </div>
    </div>
    
</body>
</html>
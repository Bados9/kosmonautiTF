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
        var removeID;
        var editID;
        $(document).ready(function(){
            //$('#astroTable').DataTable();
            //$('.dataTables_length').addClass('bs-select');
            
            $('#removeAstronaut').on('show.bs.modal', function(e) {
				removeID = $(e.relatedTarget).data('id');
			}); 

            $('#editAstronaut').on('show.bs.modal', function(e) {
				editID = $(e.relatedTarget).data('id');
                $.ajax({    url: "database.php",
                            data: { action: "getAstronaut",
                                    id: editID },
                            type: "POST",
                            success: function(data){
                                var response = JSON.parse(data);
                                $("#fname1").val(response[1]);
                                $("#sname1").val(response[2]);
                                $("#bdate1").val(response[3]);
                                $("#superpwr1").val(response[4]);
                            }

                });
			});
            
            $('#removeByID').click(function() {
                $.ajax({    url: "database.php",
                            data: { action: "removeAstronaut",
                                    id: removeID },
                            type: "POST",
                            success: function(){
                                location.reload();
                            }
                });
            });

            $('#editByID').click(function() {
                $.ajax({    url: "database.php",
                            data: { action: "editAstronaut",
                                    id: editID,
                                    fname: $('#fname1').val(),
                                    sname: $('#sname1').val(),
                                    bdate:  $('#bdate1').val(),
                                    superpwr:  $('#superpwr1').val()},
                            type: "POST",
                            success: function(){
                                location.reload();
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

            $('#edit').click(function() {
                console.log("click na edit");
                editID = $('#edit').data('id');
                $.ajax({    url: "database.php",
                            data: { action: "getAstronaut",
                                    id: editID },
                            type: "POST",
                            success: function(data){
                                console.log("uspech nebo ne");
                            }

                });
            });
        });
   </script>
    <?php include 'database.php'; ?>
    <div class="border border-black">
        <p style="font-size:160%;" class="col-sm-8">This is a paragraph.</p>
        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#addAstronaut"> Přidat astronauta </button>
    </div>

    <div class="mx-auto">
        <table id='astroTable' class='table col-sm-8'>
            <thead>
                <tr>
                    <th>Jméno</th>
                    <th>Příjmení</th>
                    <th>Datum narození</th>
                    <th>Superschopnost</th>
                    <th colspan="2"></th>
                </tr>
            </thead>
            <tbody>
            <?php
            function refreshTable(){
            $result = getAllAstronauts();
            while ($row = pg_fetch_row($result)){ ?>
            <tr>
                <td class="col-sm-2"> <?= $row[1]; ?></td>
                <td class="col-sm-2"> <?= $row[2]; ?></td>
                <td class="col-sm-2"> <?= $row[3]; ?></td>
                <td class="col-sm-2"> <?= $row[4]; ?></td>
                <td class="col-sm-1"> <button type="button" id="edit" class="btn btn-default" data-id="<?= $row[0]; ?>" data-toggle="modal" data-target="#editAstronaut">
                        <span class="glyphicon glyphicon-pencil text-warning"></span> Upravit</button> </td>
                <td class="col-sm-1"> <button type="button" id="remove" class="btn btn-default" data-id="<?= $row[0]; ?>" data-toggle="modal" data-target="#removeAstronaut">
                        <span class="glyphicon glyphicon-remove text-danger"></span> Odstranit</button> </td>
            </tr>
            <?}};refreshTable();?>
            </tbody>
        </table>
    </div>
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

    <div id="editAstronaut" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Editace kosmonauta</h4>
            </div>
            <div class="modal-body">
            <form>
                    <div class="form-group">
                        <label for="fname">Jméno:</label>
                        <input type="text" class="form-control" id="fname1" value="">
                    </div>
                    <div class="form-group">
                        <label for="sname">Příjmení:</label>
                        <input type="text" class="form-control" id="sname1">
                    </div>
                    <div class="form-group">
                        <label for="bdate">Datum narození:</label>
                        <input type="date" class="form-control" id="bdate1">
                    </div>
                    <div class="form-group">
                        <label for="superpwr">Superschopnost:</label>
                        <input type="text" class="form-control" id="superpwr1">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="editByID" class="btn btn-default" data-dismiss="modal">Upravit</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Zrušit</button>
            </div>
            </div>
        </div>
    </div>
    
</body>
</html>
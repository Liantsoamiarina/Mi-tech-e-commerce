<?php
require_once "../config/accesSecurity.php";
require_once "../Controller/client/show.php";
include_once "../Views/partials/header.php";
?>

<div class="row m-0 inter" id="template-background">
    <div class="col-md-2 h-100 menu-list">
        <?php include_once "../Views/partials/menu.php";?>
    </div>
    <div class="col-md-10 boardParent">
        <?php include_once "../Views/partials/header-board.php";?>
        <div class="content-board">
            <h2>Gestion des clients</h2>
            <div class="list-services">
                <div class="table-services">
                <table class="table table-striped table-responsive">
                    <thead class="sticky-top">
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="inter-light">
                        <?php foreach ($client["donnees"] as $user) : ?>
                            <tr>
                                <td><?=$user["id_client"];?></td>
                                <td><?=$user["email_client"];?></td>
                                <td>
                                    <button type="button" onclick="deleteUser(<?=$user['id_client'];?>)" class="btn btn-danger"><i class="fa fa-user-times"></i></button>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de suppression -->
<div class="modal fade" id="deleteUser" tabindex="-1" aria-labelledby="deletePersonLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered text-center">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h5 class="modal-title text-center text-danger" id="deletePersonLabel">Suppression</h5>
            </div>
            <div class="modal-body">
                Êtes vous sûr de vouloir supprimer cette personne ?
            </div>
            <div class="modal-footer">
                <form action="/deleteuser" method="post">
                    <input type="hidden" name="idUser" id="idUser">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" name="deleteUser" class="btn btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include_once "../Views/partials/footer.php";
?>











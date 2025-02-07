<?php
require_once "../config/accesSecurity.php";
require_once "../Controller/commande/show.php";
include_once "../Views/partials/header.php";
?>

<div class="row m-0 inter" id="template-background">
    <div class="col-md-2 h-100 menu-list">
        <?php include_once "../Views/partials/menu.php";?>
    </div>
    <div class="col-md-10 boardParent">
        <?php include_once "../Views/partials/header-board.php";?>
        <div class="content-board">
            <h2>Gestion des commandes</h2>
            <div class="list-services">
                <div class="table-services">
                <table class="table table-striped table-responsive">
                    <thead class="sticky-top">
                        <tr>
                            <th>ID</th>
                            <th>Article</th>
                            <th>Quantité</th>
                            <th>Prix</th>
                            <th>Client</th>
                            <th>Adresse de livraison</th>
                            <th>Date</th>
                            <th>Statut</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="inter-light">
                        <?php foreach ($commande["donnees"] as $listCommande) : ?>
                            <tr>
                                <td><?=$listCommande["id_commande"];?></td>
                                <td><?=$listCommande["libelle"];?></td>
                                <td><?=$listCommande["qte"];?></td>
                                <td>$<?=$listCommande["commande_prix"];?></td>
                                <td><?=$listCommande["nom"]." ".$listCommande["prenom"];?></td>
                                <td><?=$listCommande["adresse"];?></td>
                                <td><?=date("d/m/Y", strtotime($listCommande["date"]));?></td>
                                <td>
                                    <?php if($listCommande["statut"]=="En cours") : ?>
                                        <button disabled class="btn btn-warning"><?=$listCommande["statut"];?></button>
                                    <?php elseif($listCommande["statut"]=="Expédiée") : ?>
                                        <button disabled class="btn btn-primary"><?=$listCommande["statut"];?></button>
                                    <?php else : ?>
                                        <button disabled class="btn btn-success"><?=$listCommande["statut"];?></button>
                                    <?php endif;?>
                                </td>
                                <td>
                                    <form action="/statut" method="post">
                                        <input type="hidden" name="id" value="<?=$listCommande["id_commande"];?>">

                                        <button name="expedier" class="btn btn-primary" title="Expedier la commande" <?php if($listCommande["statut"]=="Livré" || $listCommande["statut"]=="Expédié") : ?> disabled <?php endif;?>>
                                            <i class="fas fa-truck"></i>
                                        </button>

                                        <button name="livrer" class="btn btn-success" title="Confirmer la livraison de la commande" <?php if($listCommande["statut"]=="En cours" || $listCommande["statut"]=="Livré") : ?> disabled <?php endif;?>>
                                            <i class="fas fa-handshake"></i>
                                        </button>
                                    </form>
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


<?php
include_once "../Views/partials/footer.php";
?>











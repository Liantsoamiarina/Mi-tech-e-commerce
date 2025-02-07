<?php
require_once "../config/cartsecurity.php";
require_once "../Controller/produit/showOne.php";
require_once "../Controller/panier/delete.php";
include_once "../Views/partials/header.php";

?>

<body>
    <div class="container">
        <header class="container-fluid roboto-regular" id="acceuil">
            <nav class="navbar navbar-expand-lg navbar-light sticky-top bg-white">
                <div class="container-fluid">
                    <a href="" class="navbar-brand">
                    <div><span class="text-dark ">Mi-</span><span class="text-secondary">Tech</span></div>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                      </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                        <ul class="navbar-nav roboto-medium">
                            <li class="nav-item">
                                <a href="/#acceuil" class="nav-link">Acceuil</a>
                            </li>
                            <li class="nav-item">
                                <a href="/#produit" class="nav-link">Produits</a>
                            </li>
                            <li class="nav-item">
                                <a href="/cartinfo" class="nav-link active">Mon panier</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <div class="container cart mt-4">
            <div class="row mt-4">
                <div class="col-md-8">
                    <h4 class="inter-medium text-dark text-start mb-4"> Produit focus</h4>
                    <div class="row">
                        <?php if (!empty($id)) : ?>
                        <div class="col-md-6">
                            <?php foreach ($produits as $produit) : ?>
                                <p>
                                    <h6>Produit : <span class="inter-light"><?=$produit["libelle_produit"]?></span></h6>
                                </p>
                                <p>
                                    <h6>Catégorie : <span class="inter-light"><?=$produit["categorie"]?></span></h6>
                                </p>
                                <p>
                                    <h6>Quantité disponible : <span class="inter-light"><?=$produit["quantite"]?></span></h6>
                                </p>
                                <form action="/addtocart" method="post">
                                    <input type="hidden" id="produit_id" name="idProduit" value="<?=$produit["id_produit"]?>">
                                    <input type="hidden" id="" name="libelle" value="<?=$produit["libelle_produit"]?>">
                                    <input type="hidden" id="prixU" value="<?=$produit["prix"]?>">
                                    <label for=""><h6>Quantité à commander :</h6></label>
                                    <input type="number" class="" min="1" max="<?=$produit["quantite"]?>" value="1" name="quantite" id="qte" style="width: 100px;">
                                    <div>
                                        <label for=""><h6>Prix total (Ar) :</h6></label>
                                        <input type="text" value="" id="prixT" name="prixTotal" style="border: none; color: grey;" readonly>
                                    </div>
                                    <div class="col-md-6">
                            <div class="d-flex flex-column gap-3 mt-3">
                                <?php foreach ($produit["photos"] as $photo) : ?>
                                    <img src="image/<?=$photo?>" alt="" class="rounded" width="50%">
                                <?php endforeach;?>
                            </div>
                        </div>
                        <br>
                                    <div class="mt-2">
                                        <button class="btn btn-outline-dark inter-light" name="ajouterAuPanier"><i class="fa fa-cart-arrow-down "></i> Ajouter au panier</button>
                                    </div>
                                </form>
                            <?php endforeach ;?>
                        </div>

                        <?php endif ;?>
                        <?php if (empty($id)) : ?>
                            <div class="col-md-6">
                                <h6 class="inter-light">Aucun article selectionné pour l'instant.</h6>
                            </div>
                        <?php endif ;?>
                    </div>
                </div>
                <div class="col-md-4 border rounded p-3">
                    <h4 class="text-center mb-5"><i class="fas fa-shopping-cart"></i> Votre panier</h4>
                    <div class="d-flex flex-column justify-content-between">
                        <div class="d-flex flex-column gap-3" style="height: 300px; overflow: auto;">
                            <?php foreach ($_SESSION["client"]["panier"] as $panier) : ?>
                                <div class="p-2 rounded" style="background-color: whitesmoke;">
                                    <div class="d-flex flex-row justify-content-between">
                                        <h6><?=$panier["libelle"];?></h6>
                                        <div>
                                            <a href="/cartinfo?idDel=<?=$panier["id"];?>" class="text-danger"><i class="fa fa-trash"></i></a>
                                            <!-- <a href="/cartinfo?id=<?=$panier["id"];?>"><i class="fa fa-edit"></i></a> -->
                                        </div>
                                    </div>
                                    <h6>Quantité : <span class="inter-light"><?=$panier["quantite"];?></span></h6>
                                    <h6>Prix : <span class="inter-light"><?=$panier["prix"];?> Ar</span></h6>
                                    <input type="hidden" class="prixArticle" value="<?=$panier["prix"];?>" readonly>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="mt-3">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#commande" class="btn btn-dark  inter-light w-100" <?php if(empty($_SESSION["client"]["panier"])) : ?> disabled <?php endif;?>> Passer la commande <span class="inter-medium" id="totalCommande"></span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


<!-- Modal de confirmation de la commande -->
<div class="modal fade" id="commande" tabindex="-1" aria-labelledby="commanderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h3 class="modal-title text-center inter-light" id="commandeModalLabel">Confirmation de votre commande</h3>
            </div>
            <form action="/passcommande" method="post" enctype="multipart/form-data" class="form-with-regexlib inter-light">
                <div class="modal-body d-flex flex-column gap-3">
                    <input type="hidden" id="commandeTotal" name="commandeTotal">
                    <div class="form-group">
                        <label for="nom">Nom :</label>
                        <input type="text" class="form-control" name="name" id="nom" required>
                        <div class="invalide-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prénom(s) :</label>
                        <input type="text" class="form-control" name="firstname" id="prenom" required>
                        <div class="invalide-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email :</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                        <div class="invalide-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="phone">Contact :</label>
                        <input type="text" class="form-control" name="phoneNumber" id="phone" required>
                        <div class="invalide-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="adresse">Adresse de livraison :</label>
                        <input type="text" class="form-control" name="adresse" id="adresse" required>
                        <div class="invalide-feedback"></div>
                    </div>
                    <Label for="message">Message : </Label>
                    <textarea name="comments" id="message" cols="20" rows="2">

                    </textarea>
                    <button class="btn btn-success" name="confirmCommande"><i class="fa fa-check text-light"></i> Confirmer</button>
            </form>
        </div>
    </div>
</div>

<script>
    var prixU = document.getElementById("prixU");
    var prixT = document.getElementById("prixT");
    var qte = document.getElementById("qte");

    function recalculerPrix() {
        var total = prixU.value * qte.value;
        prixT.value = total;
    }

    if (qte) {
        window.addEventListener('load', recalculerPrix);
        qte.addEventListener("input", recalculerPrix);
    }

    //Calcul du prix total de la commande à passer
    var prixTotal = 0;
    var prixArticle = document.querySelectorAll(".prixArticle");
    console.log(prixArticle);
    var spanPrixTotal = document.getElementById("totalCommande");
    var commandeTotal = document.getElementById("commandeTotal");
    function calculPrixTotal(){
        prixArticle.forEach(array => {
            prixTotal += parseInt(array.value);
            if (prixTotal > 0) {
                spanPrixTotal.textContent =prixTotal +" "+"Ar";
                commandeTotal.value = prixTotal;
            }else {
                spanPrixTotal.textContent = "";
                commandeTotal.value = "";
            }
        });
    }

    window.addEventListener('load', calculPrixTotal);
</script>

<?php
include_once "../Views/partials/footer.php";
?>

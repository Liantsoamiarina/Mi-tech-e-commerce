<?php
require_once "../Controller/produit/show.php";
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

<form action="" method="post" class="search-form w-300 d-flex flex-row gap-4">
    <div class="form-group">
        <input type="text" class="form-control search-input" placeholder="Rechercher un produit...">
    </div>
    <div class="form-group">
        <select class="form-select search-select" aria-label="" name="categorie" id="">
            <option value="Tout">Tout</option>
            <option value="Smartphone">Smartphone</option>
            <option value="Ordinateur portable">Ordinateur portable</option>
            <option value="Ordinateur de bureau">Ordinateur de bureau</option>
            <option value="Composant informatique">Composant informatique</option>
        </select>
    </div>
</form>
<br>
                            <li class="nav-item">
                                <a href="#acceuil" class="nav-link active">Acceuil</a>
                            </li>
                            <li class="nav-item">
                                <a href="#produit" class="nav-link">Produits</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a href="#contact" class="nav-link">Contact</a>
                            </li> -->
                            <?php if (!empty($_SESSION["client"])) : ?>
                                <li class="nav-item">
                                    <a href="/cartinfo" class="nav-link">Mon panier</a>
                                </li>
                            <?php endif;?>
                            <li class="nav-item">
                                <?php if (!empty($_SESSION["client"])) : ?>
                                    <a href="" type="button" data-bs-toggle="modal" data-bs-target="#signOut" class="nav-link">Se deconnecter</a>
                                <?php endif;?>
                                <?php if (empty($_SESSION["client"])) : ?>
                                    <a href="/login" class="nav-link">Se connecter</a>
                                <?php endif;?>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="bannier">
             <h1 class="typing-effect">Bienvenue sur Mi-tech !</h1>
            </div>

            </div>
        </header>

        <div class="container" id="produit">
            <!-- <div class="mb-5 text-center">
                <h3 class="text-center inter-bold">Nos produits</h3>
                <span class="text-center inter-light">Achetez nos produits de gammes</span>
            </div> -->
            <div class="content">
             <hr class="stylish-line">
            </div>
                                    <br>
            <div class="row">
                <?php foreach ($produits as $produit) : ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <?php if (!empty($produit['photos'])): ?>
                            <img src="image/<?=htmlspecialchars($produit["photos"][0]); ?>" alt="Photo produit" class="card-img-top">
                        <?php else: ?>
                            <p>Aucune photo disponible</p>
                        <?php endif; ?>
                        <div class="card-body">
                            <div class="d-flex flex-row justify-content-between gap-3">
                                <div class="">
                                    <h5 class="card-title"><?=$produit["libelle_produit"];?></h5>
                                </div>
                            </div>
                            <div class="contentPrice w-25">
                                <span class="inter-medium">Prix:  <?=$produit["prix"]?> Ar</span>
                            </div>
                            <p class="inter-light">En stock : <?=$produit["quantite"];?></p>
                            <button type="button" class="btn w-100 btn-buy inter-medium"
                                onclick='infoProduct(<?= json_encode($produit['id_produit']) ?>, <?= json_encode($produit['libelle_produit']) ?>, <?= json_encode($produit['prix']) ?>, <?= json_encode($produit['quantite']) ?>, <?= json_encode($produit['categorie']) ?>, <?= json_encode(array_map(fn($photo) => 'image/' . $photo, $produit['photos'] ?? [])) ?>)'>
                                <i class="fas fa-shopping-cart"></i> Passer le commande
                            </button>

                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>



<!-- Modal de détail -->
<div class="modal fade" id="detailProduitModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailProduitModalLabel">Détail du produit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p><strong>Nom : </strong><span id="product-libelle"></span></p>
                <p><strong>Prix : </strong><span id="product-prix"></span></p>
                <p><strong>Quantité disponible : </strong><span id="product-quantite"></span></p>
                <p><strong>Catégorie : </strong><span id="product-categorie"></span></p>

                <h5>Photos</h5>
                <div id="product-photos" class="d-flex flex-wrap"></div>
            </div>
            <div class="modal-footer">
                <a href="" id="idProduit" disabled class="btn btn-buy inter-medium" type="submit"></a>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal de deconnexion -->
<div class="modal fade" id="signOut" tabindex="-1" aria-labelledby="signOutLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered text-center">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h5 class="modal-title text-center text-dark" id="signOutLabel"><i class="fa fa-user-times"></i> Deconnexion</h5>
            </div>
            <div class="modal-body">
                Êtes vous sûr de vouloir se deconnecter ?
            </div>
            <div class="modal-footer">
                <form action="/signoutclient" method="post">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" name="signOut" class="btn btn-danger"><i class="fa fa-sign-out"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include_once "../Views/partials/footer.php";
?>

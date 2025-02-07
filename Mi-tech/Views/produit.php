<?php
require_once "../config/accesSecurity.php";
require_once "../Controller/produit/show.php";
include_once "../Views/partials/header.php";
?>

<div class="row m-0 inter" id="template-background">
    <div class="col-md-2 h-100 menu-list">
        <?php include_once "../Views/partials/menu.php";?>
    </div>
    <div class="col-md-10 boardParent">
        <?php include_once "../Views/partials/header-board.php";?>
        <div class="content-board">
            <h2>Gestion des produits</h2>
            <div class="list-services">
                <div class="d-flex flex-row justify-content-end add-services">
                    <button class="btn" data-bs-toggle="modal" data-bs-target="#addProduitModal"><i class="fa fa-plus"></i> Nouveau</button>
                </div>
                <div class="table-services">
                <table class="table table-striped table-responsive">
                    <thead class="sticky-top">
                        <tr>
                            <th>ID</th>
                            <th>Libellé</th>
                            <th>Prix</th>
                            <th>Catégorie</th>
                            <th>Stock</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="inter-light">
                        <?php foreach ($produits as $produit) : ?>
                            <tr>
                                <td><?= htmlspecialchars($produit["id_produit"]); ?></td>
                                <td><?= htmlspecialchars($produit["libelle_produit"]); ?></td>
                                <td>$ <?= htmlspecialchars($produit["prix"]); ?></td>
                                <td><?= htmlspecialchars($produit["categorie"]); ?></td>
                                <td><?= htmlspecialchars($produit["quantite"]); ?></td>
                                <td class="btn-action-service">
                                    <button class="btn btn-danger" onclick="deleteProduct(<?= $produit['id_produit'] ?>)"><i class="fa fa-trash"></i></button>
                                    <button class="btn" onclick='editProduct(<?= json_encode($produit['id_produit']) ?>, <?= json_encode($produit['libelle_produit']) ?>, <?= json_encode($produit['prix']) ?>, <?= json_encode($produit['quantite']) ?>, <?= json_encode($produit['categorie']) ?>,)'>
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de suppression -->
<div class="modal fade" id="deleteProduct" tabindex="-1" aria-labelledby="deleteProductLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered text-center">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h5 class="modal-title text-center text-danger" id="deleteProductLabel">Suppression d'un produit</h5>
            </div>
            <div class="modal-body">
                Êtes vous sûr de vouloir supprimer cet article ?
            </div>
            <div class="modal-footer">
                <form action="/deleteproduct" method="post">
                    <input type="hidden" name="idProduit" id="delete-id-produit">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" name="deleteProduct" class="btn btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal d'ajout -->
<div class="modal fade" id="addProduitModal" tabindex="-1" aria-labelledby="addProduirModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h3 class="modal-title text-center inter-regular" id="addProduitModalLabel">Nouveau produit</h3>
            </div>
            <form action="addproduct" method="post" enctype="multipart/form-data" class="form-with-regexlib inter-light">
                <div class="modal-body d-flex flex-column gap-3">
                    <div class="form-group">
                        <label for="libelle">Libellé :</label>
                        <input type="text" class="form-control" name="libelle" id="libelle" required>
                        <div class="invalide-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="prix">Prix Unitaire :</label>
                        <input type="text" class="form-control" name="prix" id="prix" required>
                        <div class="invalide-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="">Catégorie : </label>
                        <select class="form-select inter-light" aria-label="" name="categorie" id="">
                            <option value="Smartphone" class="inter-light">Smartphone</option>
                            <option value="Ordinateur portable" class="inter-light">Ordinateur portable</option>
                            <option value="Ordinateur de bureau" class="inter-light">Ordinateur de bureau</option>
                            <option value="Composant informatique" class="inter-light">Composant informatique</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="qte">Quantité :</label>
                        <input type="number" min="1" class="form-control" name="quantite" id="qte" required>
                        <div class="invalide-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="photos">Photo :</label>
                        <input type="file" class="form-control" name="photos[]" id="photos" multiple accept="image/*">
                        <div class="preview" id="preview"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary inter-light" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" id="add-btn-service" name="addProduct" class="btn btn-success inter-light">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal de modification -->
<div class="modal fade" id="editProduitModal" tabindex="-1" aria-labelledby="editProduirModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h3 class="modal-title text-center inter-regular" id="editProduitModalLabel">Mise à jour d'un produit</h3>
            </div>
            <form action="editproduct" method="post" class="form-with-regexlib inter-light">
                <div class="modal-body d-flex flex-column gap-3">
                    <input type="hidden" id="produit-idProduit" name="idProduit">
                    <div class="form-group">
                        <label for="produit-libelle">Libellé :</label>
                        <input type="text" class="form-control" name="libelle" id="produit-libelle" required>
                        <div class="invalide-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="produit-prix">Prix Unitaire :</label>
                        <input type="text" class="form-control" name="prix" id="produit-prix" required>
                        <div class="invalide-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="">Catégorie : </label>
                        <select class="form-select inter-light" aria-label="" name="categorie" id="produit-categorie">
                            <option value="Smartphone" class="inter-light">Smartphone</option>
                            <option value="Ordinateur portable" class="inter-light">Ordinateur portable</option>
                            <option value="Ordinateur de bureau" class="inter-light">Ordinateur de bureau</option>
                            <option value="Composant informatique" class="inter-light">Composant informatique</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="produit-quantite">Quantité :</label>
                        <input type="number" min="0" class="form-control" name="quantite" id="produit-quantite" required>
                        <div class="invalide-feedback"></div>
                    </div>
                    <div class="bg-warning">
                        <p class="">
                            NB : Veuillez supprimer l'article et l'ajouter de nouveau si vous souhaitez mettre à jour ses photos.
                        </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary inter-light" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" id="add-btn-service" name="editProduct" class="btn btn-success inter-light">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const inputFile = document.getElementById('photos');
    const previewContainer = document.getElementById('preview');

    inputFile.addEventListener('change', function(event) {
        previewContainer.innerHTML = '';

        const files = event.target.files;
        Array.from(files).forEach(file => {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                previewContainer.appendChild(img);
            }
            
            reader.readAsDataURL(file);
        });
    });
</script>
<?php
include_once "../Views/partials/footer.php";
?>











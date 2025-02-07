function deleteUser(id){
    const myModal = new bootstrap.Modal(document.getElementById('deleteUser'));
    inputId = document.getElementById('idUser');
    myModal.show();
    inputId.value = id;
}

function deleteProduct(id){
    const myModal = new bootstrap.Modal(document.getElementById('deleteProduct'));
    inputId = document.getElementById('delete-id-produit');
    myModal.show();
    inputId.value = id;
}

function editProduct(id, libelle, prix, quantite, categorie) {
    const myModalUp = new bootstrap.Modal(document.getElementById('editProduitModal'));

    // Remplir les informations du produit dans le modal
    document.getElementById('produit-libelle').value = libelle;
    document.getElementById('produit-prix').value = `${prix}`;
    document.getElementById('produit-quantite').value = quantite;
    document.getElementById('produit-categorie').value = categorie;
    document.getElementById('produit-idProduit').value = id;

    myModalUp.show();
}

function infoProduct(id, libelle, prix, quantite, categorie, photos) {
    const myModalUp = new bootstrap.Modal(document.getElementById('detailProduitModal'));

    document.getElementById('product-libelle').textContent = libelle;
    document.getElementById('product-prix').textContent = `${prix} Ar`;
    document.getElementById('product-quantite').textContent = quantite;
    document.getElementById('product-categorie').textContent = categorie;
    document.getElementById("idProduit").textContent = "";
    document.getElementById('idProduit').href = "/cartinfo?id=" + id;
    var icone = "";

    if (parseInt(quantite) <= 0) {
        document.getElementById("idProduit").textContent = "Stock épuisé";
        document.getElementById("idProduit").style.pointerEvents = "none";
        document.getElementById("idProduit").style.opacity = "0.5";
    }else {
        icone = document.createElement('i');
        icone.classList.add('fas', 'fa-shopping-cart');
        document.getElementById("idProduit").appendChild(icone);
        document.getElementById("idProduit").style.pointerEvents = "";
        document.getElementById("idProduit").style.opacity = "";
    }

    const photoContainer = document.getElementById('product-photos');
    photoContainer.innerHTML = '';
    photos.forEach(photo => {
        const img = document.createElement('img');
        img.src = photo;
        img.alt = libelle;
        img.classList.add('img-fluid', 'm-2');
        img.style.maxWidth = '200px';
        photoContainer.appendChild(img);
    });

    myModalUp.show();
}



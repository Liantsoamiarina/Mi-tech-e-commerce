<div class="w-100 h-100 p-2 d-flex flex-column">
    <div class="logo text-center">
        <a href="" class="navbar-brand">
		<div><span class="text-dark ">Mi-</span><span class="text-secondary">Tech</span></div>
        </a>
        <div class="slogan">
            <span class="inter-light">
               <i class="fas fa-cogs"></i> Administrateur
            </span>
        </div>
    </div>
    <div class="d-flex flex-column h-100 justify-content-between">
        <nav class="navbar">
            <ul class="navbar-nav d-flex flex-column">
                <!-- <li class="nav-item">
                    <a href="/dashboard" class="nav-link"><i class="fa-solid fa-house-laptop fa-lg"></i> Tableau de bord</a>
                </li> -->
                <li class="nav-item">
                    <a href="/produits" class="nav-link"><i class="fa fa-tag fa-lg"></i> Produits</a>
                </li>
                <li class="nav-item">
                    <a href="/commande" class="nav-link"><i class="fas fa-receipt fa-lg"></i> Commandes</a>
                </li>
                <li class="nav-item">
                    <a href="/clients" class="nav-link"><i class="fa fa-user fa-lg"></i> Utilisateur</a>
                </li>
                <!-- <li class="nav-item">
                    <a href="/utilisateurs" class="nav-link"><i class="fa-solid fa-user-tie fa-lg"></i> Utilisateurs</a>
                </li> -->
            </ul>
        </nav>
        <div class="nav-footer">
            <ul class="navbar-nav d-flex flex-column">
                <!-- <li class="nav-item">
                    <a href="/setting" class="nav-link"><i class="fa-solid fa-gear fa-lg"></i> Paramètres</a>
                </li> -->
                <li class="nav-item">
                    <a href="" type="button" data-bs-toggle="modal" data-bs-target="#signOut" class="btn text-danger" class="nav-link"><i class="fa fa-sign-out"></i> Se deconnecter</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- Modal de deconnexion -->
<div class="modal fade" id="signOut" tabindex="-1" aria-labelledby="signOutLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered text-center">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h5 class="modal-title text-center text-danger" id="signOutLabel">Deconnexion</h5>
            </div>
            <div class="modal-body">
                Êtes vous sûr de vouloir se deconnecter ?
            </div>
            <div class="modal-footer">
                <form action="/signout" method="post">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" name="signOut" class="btn btn-danger">Se deconnecter</button>
                </form>
            </div>
        </div>
    </div>
</div>

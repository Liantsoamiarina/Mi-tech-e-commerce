<?php
    include_once "../Views/partials/header.php";
?>
<div class="container">
    <div class="row h-100">
        <div class="col-md-4"></div>
        <div class="col-md-4 d-flex flex-column justify-content-center roboto-regular gap-4">
            <h4 class="text-center roboto-light"><i class="fa fa-user"></i>  Client</h4>
            <form action="/userConnexion" method="post" class="form-with-regexlib d-flex flex-column gap-3">
                <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                    <div class="invalide-feedback"></div>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe :</label>
                    <input type="password" id="password" name="pass" class="form-control" required>
                    <div class="invalide-feedback"></div>
                </div>
                <button class="btn btn-outline-dark" name="logIn">Se connecter</button>
                <div class="d-flex flex-row justify-content-between singin-link">
                    <a href="/signin" class="text-center">Créer un compte</a>
                </div>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
<?php
    include_once "../Views/partials/footer.php";
?>

<?php
    include_once "../Views/partials/header.php";
?>
<div class="container">
    <div class="row h-100">
        <div class="col-md-4"></div>
        <div class="col-md-4 d-flex flex-column justify-content-center roboto-regular gap-4">
            <h4 class="text-center roboto-light"><i class="fa fa-user-plus"></i> Créer un compte</h4>
            <form action="/inscription" method="post" class="form-with-regexlib d-flex flex-column gap-3">
                <!-- <div class="form-group">
                    <label for="username">Nom d'utilisateur :</label>
                    <input type="text" id="username" name="name" class="form-control" required>
                    <div class="invalide-feedback"></div>
                </div> -->
                <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                    <div class="invalide-feedback"></div>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe :</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                    <div class="invalide-feedback"></div>
                </div>
                <div class="form-group">
                    <label for="confirm">Confirmer :</label>
                    <input type="text" id="confirm" name="confirm" class="form-control" required>
                    <div class="invalide-feedback"></div>
                </div>
                <!-- <div class="form-group">
                    <label for="code">Code vérification :</label>
                    <input type="code" id="code" name="code" class="form-control" required>
                    <div class="invalide-feedback"></div>
                </div> -->
                <button class="btn btn-outline-dark" name="signIn">S'inscrire</button>
                <div class="singin-link text-center">
                    <a href="/login" class="">Se connecter</a>
                </div>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
<?php
    include_once "../Views/partials/footer.php";
?>

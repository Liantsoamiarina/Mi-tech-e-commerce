
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/all.min.js"></script>
<script src="assets/js/sweetalert2.min.js"></script>
<script src="assets/js/regexlib/regexlib.js"></script>
<script src="assets/js/actions.js"></script>
<script src="assets/js/viewpsw.js"></script>
<?php if (!empty($_SESSION["label"])) : ?>
<script src="assets/js/<?=$_SESSION["label"]?>.js"></script>
<?php endif;?>
<?php if (!empty($_SESSION["style"])) : ?>
<script src="assets/js/<?=$_SESSION["style"]?>.js"></script>
<?php endif;?>


<?php
    if ((!empty($_SESSION["error"]) || !empty($_SESSION["success"]))) {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: '" . (!empty($_SESSION["error"]) ? 'error' : 'success') . "',
                    title: '" . htmlspecialchars($_SESSION["title"], ENT_QUOTES) . "',
                    text: '" . (!empty($_SESSION["error"]) ? htmlspecialchars($_SESSION["error"], ENT_QUOTES) : htmlspecialchars($_SESSION["success"], ENT_QUOTES)) . "',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Remplacer l'URL actuelle par un nouvel URL dynamique
                        window.location.replace('" . $_SESSION["newUrl"] . "');
                    }
                });
            });
        </script>
        ";

        //Réinitialisation des variables de gestion d'erreur
        $_SESSION["error"] = "";
        $_SESSION["title"] = "";
        $_SESSION["newUrl"] = "";
        $_SESSION["success"] = "";
    }            
?>

</body>
</html>
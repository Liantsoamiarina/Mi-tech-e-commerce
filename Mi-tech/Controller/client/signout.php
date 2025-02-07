<?php
if (isset($_POST["signOut"])) {
    session_destroy();
    header("location:/");
}
<?php
if (empty($_SESSION["admin"])) {
    header("location:/admin");
}